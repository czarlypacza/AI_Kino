<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Movie;
use App\Models\Show;
use App\Models\Showtime;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tickets.index', ['tickets'=>Ticket::paginate(15),'transactions'=>DB::table('transactions')->paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Ticket::create($request->all());
        $showtime = Showtime::find($request->showtime_id);
        $user = User::find($request->user_id);

        DB::table('transactions')->insert([
            'title' =>$showtime->show->movie->title,
            'date' => $showtime->show->date,
            'time' => $showtime->time,
            'room' => $showtime->room->id,
            'seat' => $request->seat,
            'row' => $request->row,
            'price' => $request->price,
            'email' => $user->email,
        ]);


        $ticket = new Ticket($request->all());
        //$ticket->save();
        //after the ticket is created redirect to the start page
        return redirect('/kino');

        //return "aaaa";
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back()->with('status', 'Ticket deleted successfully!');
    }
}
