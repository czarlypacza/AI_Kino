<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Ticket;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room, Showtime $showtime)
    {
        return view('room.show', [
            'room' => $room,
            'showtime' => $showtime,
            'recommended1' => Movie::all()->random(3),
            'tickets'=>$showtime->ticket
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        //
    }
}
