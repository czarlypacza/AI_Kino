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
        return view('room.index', ['rooms' => Room::all()]);
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
        $request->validate([
            'rows' => 'required|integer|min:1|max:25',
            'cols' => 'required|integer|min:1|max:25',
        ]);

        Room::create($request->all());
        return redirect()->route('rooms.index');
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
        $request->validate([
            'rows' => 'required|integer|min:1|max:25',
            'cols' => 'required|integer|min:1|max:25',
        ]);
        $room->update($request->all());
        return redirect()->route('rooms.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index');
    }
}
