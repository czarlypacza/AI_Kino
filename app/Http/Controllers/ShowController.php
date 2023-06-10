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
        $recommended1 = Movie::all()->random(9)->toArray();
        $arr_recomm = array_chunk($recommended1, 3);

        $recommended2 = Movie::all()->random(12)->toArray();
        $arr_recomm2 = array_chunk($recommended2, 4);

        $recommended3 = Movie::all()->random(12)->toArray();
        $arr_recomm3 = array_chunk($recommended3, 6);
        $rooms = [];
        $shows = Show::where('date',now()->format('Y-m-d'))->get();
        $date = now()->format('Y-m-d');
        //TODO: zaprogramowac logike usuwajaca zarezerwowane juz sale podczas dodawania nowej godziny

        return view('shows.index', ['rooms'=>Room::all(),'movies' => Movie::all(), 'shows' => $shows, 'showtimes' => Showtime::orderBy('show_id')->orderBy('time')->get(), 'date' => $date, 'recommended1' => $arr_recomm,'recommended2' => $arr_recomm2,'recommended3' => $arr_recomm3]);
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
            'movie_id'=>'required',
            'date'=>'required',
            ]
        );
        $show = Show::where('date',$request->date)->where('movie_id',$request->movie_id)->first();

        if($show){
            return redirect()->back()->with('error','Movie is already scheduled for this day');
        }else {
            Show::create($request->all());
            return redirect()->back();
        }
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
        $request->validate([
                'movie_id'=>'required',
                'date'=>'required',
            ]
        );

        $pastshow = Show::where('date',$request->date)->where('movie_id',$request->movie_id)->first();

        if($pastshow){
            return redirect()->back()->withErrors('Ten film jest dodany w dany dzień');
        }else{
            $show->update($request->all());
            return redirect()->route('shows.index');
        }
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
