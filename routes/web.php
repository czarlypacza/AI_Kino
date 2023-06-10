<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Show;
use App\Models\Showtime;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use Laravel\Cashier\Http\Controllers\WebhookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::post('/pay', function (Request $request) {
//    $payment = $request->user()->pay(
//        $request->get('amount')
//    );
//
//    return $payment->client_secret;
//})->name('pay');
/*Route::post('/pay', function (Request $request) {
    $payment = $request->user()->pay(
        $request->get('amount')
    );

    return response()->json([
        'client_secret' => $payment->client_secret,
        'payment_id' => $payment->id
    ]);
})->name('pay');*/
Route::post('/pay', function (Request $request) {
    $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));

    $checkout_session = $stripe->checkout->sessions->create([
        'line_items' => [[
            'price_data' => [
                'currency' => 'pln',
                'product_data' => [
                    'name' => 'Bilet',
                ],
                'unit_amount' => $request->get('amount'),
            ],
            'quantity' => 1,
        ]],
        'customer_email' => $request->user()->email,
        'mode' => 'payment',
        'success_url' => \redirect()->back()->with('success', 'Payment successful')->getTargetUrl(),
        'cancel_url' => 'http://localhost:8000/kino',
    ]);

    return response()->json(['url' => $checkout_session->url]);
})->middleware('auth')->name('pay');


Route::get('payment/{id}', [PaymentController::class,'show'])->middleware('auth')->name('payment');
//Route::post('webhook', 'WebhookController@handleWebhook')->name('webhook');

/*Route::get('/charge-checkout', function (Request $request) {
    return $request->user()->checkoutCharge(1200, 'T-Shirt', 5);
});*/


/*Route::get('/billing-portal', function (Request $request) {
    return $request->user()->redirectToBillingPortal(route('guest_index'));
});*/

Route::get('/kino',[Controller::class,'index'])->name('guest_index');

Route::get('/',function (){
    return redirect('kino');
});

/*Route::get('/', function () {
    return view('welcome');
})->name('home');*/

// Route::get('/getMovieShowtimes/{date}',  function ($date) {
//     $shows = Show::whereDate('date', $date)->get();
//     $html = "";
//     foreach ($shows as $show) {
//       $html .= "<tr>";
//       $html .= "<td>" . $show->movie->title . "</td>";
//       $html .= "<td>" . $show->date . "</td>";
//       $html .= "</tr>";
//     }
//     return $html;

//     //return $shows;
// })->name('getMovieShowtimes');

Route::get('/getMovieShowtimesShow/{date}',[Controller::class,'getMovieShowtimesShow'])->name('getMovieShowtimesShow');
Route::get('/getMovieShowtimes/{date}',[Controller::class,'getMovieShowtimes'])->name('getMovieShowtimes');

Route::resource('shows',ShowController::class);
Route::get('shows/{show}/{date}/edit', [ShowController::class, 'edit'])->middleware('can:is-admin,get')->name('shows.edit');

Route::resource('showtimes',ShowtimeController::class);

Route::resource('movies', MovieController::class)->middleware('can:is-admin,get,post,delete');;

Route::resource('rooms',RoomController::class)->middleware('can:is-admin,get')->except('show');

Route::get('/room/{room}/{showtime}',[RoomController::class,'show'])->name('room.show');

//Route::post('/ticket',[TicketController::class,'store'])->name('tickets.store');

Route::resource('tickets',TicketController::class);

//Route::get('/showtime/{id}',[ShowtimeController::class,'show']);

Route::resource('users', UserController::class)->middleware('can:is-admin,get');

Route::get('/dashboard',[DashboardController::class,'index'] )->middleware('can:is-admin,get')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
