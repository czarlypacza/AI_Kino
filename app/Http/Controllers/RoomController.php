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
            'rows' => 'required|integer|min:5|max:25',
            'cols' => 'required|integer|min:5|max:25',
        ]);

        Room::create($request->all());
        return redirect()->route('rooms.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Room $room, Showtime $showtime)
    {
        $recommended1 = Movie::all()->random(9)->toArray();
        $arr_recomm = array_chunk($recommended1, 3);

        $recommended2 = Movie::all()->random(12)->toArray();
        $arr_recomm2 = array_chunk($recommended2, 4);

        $recommended3 = Movie::all()->random(12)->toArray();
        $arr_recomm3 = array_chunk($recommended3, 6);
        return view('room.show', [
            'room' => $room,
            'showtime' => $showtime,
            'recommended1' => $arr_recomm,'recommended2' => $arr_recomm2,'recommended3' => $arr_recomm3,
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
            'rows' => 'required|integer|min:5|max:25',
            'cols' => 'required|integer|min:5|max:25',
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
