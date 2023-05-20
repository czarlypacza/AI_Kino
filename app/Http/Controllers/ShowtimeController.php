<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Room;

class ShowtimeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard');
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
        $time = Carbon::parse($request->time);
        Showtime::create([
            'time' => $time,
            'room_id' => $request->room_id,
            'show_id' => $request->show_id,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Showtime $showtime)
    {
        //$showtime = Showtime::findOrFail($id);

        return view('showtime/show',['rooms'=>Room::all(),'showtime' => $showtime, 'recommended1' => Movie::all()->random(3),'genres'=>$showtime->show->movie->genres]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Showtime $showtime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Showtime $showtime)
    {
        $time = Carbon::parse($request->time);
        $showtime->update([
            'time' => $time,
            'room_id' => $request->room_id,
            'show_id' => $request->show_id,
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Showtime $showtime)
    {
        $showtime->delete();
        return redirect()->route('shows.index');
    }
}
