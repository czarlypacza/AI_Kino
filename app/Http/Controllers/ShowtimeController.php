<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Room;
use App\Models\Show;

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
    /*public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|date_format:H:i',
        ]);


        $time = Carbon::parse($request->time);
        Showtime::create([
            'time' => $time,
            'room_id' => $request->room_id,
            'show_id' => $request->show_id,
        ]);
        return redirect()->back();
    }*/
    public function store(Request $request)
    {
        $request->validate([
            'time' => 'required|date_format:H:i',
            'room_id' => 'required',
            'show_id' => 'required'
        ]);

        $time = Carbon::parse($request->time);
        $show = Show::find($request->show_id);
        $movie = Movie::find($show->movie_id);
        $duration = $movie->duration;

        $startDateTime = Carbon::parse($show->date . ' ' . $time->toTimeString());
        $endDateTime = (clone $startDateTime)->addMinutes($duration);

        $existingShowtimes = Showtime::where('room_id', $request->room_id)
            ->whereHas('show', function ($query) use ($show) {
                $query->where('date', $show->date);
            })
            ->get();

        foreach ($existingShowtimes as $existingShowtime) {
            $existingShow = Show::find($existingShowtime->show_id);
            $existingMovie = Movie::find($existingShow->movie_id);

            $existingStartDateTime = Carbon::parse($existingShow->date . ' ' . $existingShowtime->time);
            $existingEndDateTime = (clone $existingStartDateTime)->addMinutes($existingMovie->duration);

            if ($startDateTime->between($existingStartDateTime, $existingEndDateTime) ||
                $endDateTime->between($existingStartDateTime, $existingEndDateTime)) {
                return redirect()->back()->withErrors(['time' => 'W podanej sali jest już seans o danej godzinie.']);
            }
        }

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
        $recommended1 = Movie::all()->random(9)->toArray();
        $arr_recomm = array_chunk($recommended1, 3);

        $recommended2 = Movie::all()->random(12)->toArray();
        $arr_recomm2 = array_chunk($recommended2, 4);

        $recommended3 = Movie::all()->random(12)->toArray();
        $arr_recomm3 = array_chunk($recommended3, 6);
        return view('showtime/show',['rooms'=>Room::all(),'showtime' => $showtime, 'recommended1' => $arr_recomm,'recommended2' => $arr_recomm2,'recommended3' => $arr_recomm3,'genres'=>$showtime->show->movie->genres]);
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
        //$time = Carbon::parse($request->time);
        $request->validate([
            'time' => 'required|date_format:H:i',
            'room_id' => 'required',
            'show_id' => 'required'
        ]);

        $time = Carbon::parse($request->time);
        $show = Show::find($request->show_id);
        $movie = Movie::find($show->movie_id);
        $duration = $movie->duration;

        $startDateTime = Carbon::parse($show->date . ' ' . $time->toTimeString());
        $endDateTime = (clone $startDateTime)->addMinutes($duration);

        $existingShowtimes = Showtime::where('room_id', $request->room_id)
            ->whereHas('show', function ($query) use ($show) {
                $query->where('date', $show->date);
            })->where('show_id', '!=', $show->id)->get();


        foreach ($existingShowtimes as $existingShowtime) {
            $existingShow = Show::find($existingShowtime->show_id);
            $existingMovie = Movie::find($existingShow->movie_id);

            $existingStartDateTime = Carbon::parse($existingShow->date . ' ' . $existingShowtime->time);
            $existingEndDateTime = (clone $existingStartDateTime)->addMinutes($existingMovie->duration);

            if ($startDateTime->between($existingStartDateTime, $existingEndDateTime) ||
                $endDateTime->between($existingStartDateTime, $existingEndDateTime)) {
                return redirect()->back()->withErrors(['time' => 'W podanej sali jest już seans o danej godzinie.']);
            }
        }

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
