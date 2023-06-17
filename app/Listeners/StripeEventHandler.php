<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Laravel\Cashier\Events\WebhookReceived;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class StripeEventHandler
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'charge.succeeded') {
            $charge = $event->payload['data']['object'];

            // Get email from the charge details
            $email = $charge['billing_details']['email'];

            // Get the paid amount
            $amountPaid = $event->payload['data']['object']['amount'] /100;

            // Get the charge creation timestamp
            $chargeTimestamp = $charge['created'];

            // Lookup the user by the email from Stripe
            $user = User::where('email', $email)->first();

            if ($user) {
                // Now find the unpaid tickets linked to the account and mark them as paid
                $unpaidTickets = Ticket::where('user_id', $user->id)
                    ->where('status', 'pending')
                    ->orderBy('created_at','desc')
                    ->get();

                foreach ($unpaidTickets as $ticket) {
                    // Check if this ticket can be paid
                    if ($ticket->price <= $amountPaid && $ticket->created_at->getTimestamp() <= $chargeTimestamp) {
                        $ticket->status = 'paid';
                        $ticket->save();
                        $transaction = DB::table('transactions')->where('id', $ticket->id)->first();
                        if ($transaction) {
                            $transaction->status = 'paid';
                            DB::table('transactions')->where('id', $transaction->id)->update(['status' => 'paid']);
                        }


                        // Subtract the price of the ticket from the amount paid
                        $amountPaid -= $ticket->price;
                        Log::info('Marked ticket as paid: ' . $ticket->id . "Amout paid: " . $amountPaid);
                    } else {
                        // Not enough money to pay for this ticket, or the ticket was created after the payment, so break the loop
                        break;
                    }
                }
            }
        }
    }
}
