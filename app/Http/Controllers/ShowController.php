<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Show;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Showtime;


class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = [];
        $shows = Show::where('date',now()->format('Y-m-d'))->get();
        $date = now()->format('Y-m-d');
        //TODO: zaprogramowac logike usuwajaca zarezerwowane juz sale podczas dodawania nowej godziny

        return view('shows.index', ['rooms'=>Room::all(),'movies' => Movie::all(), 'shows' => $shows, 'showtimes' => Showtime::orderBy('show_id')->orderBy('time')->get(), 'date' => $date, 'recommended1' => Movie::all()->random(3)]);
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
        Show::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Show $show)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Show $show,$date)
    {
        return view('shows.edit', ['show' => $show,'date'=>$date,'movies'=>Movie::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Show $show)
    {
        $show->update($request->all());
        return redirect()->route('shows.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Show $show)
    {
        $show->delete();
        return redirect()->back();
    }
}