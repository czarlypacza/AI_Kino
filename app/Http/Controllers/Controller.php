<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Show;
use App\Models\Showtime;
use App\Http\Controllers\ShowtimeController;
use Illuminate\Support\Facades\Gate;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index()
    {
        return  view('index\index', ['movies' => Movie::all(), 'shows' => Show::where('date',now()->format('Y-m-d'))->get(), 'showtimes' => Showtime::all(), 'date' => now()->format('Y-m-d'), 'recommended1' => Movie::all()->random(3)]);
    }
    // public function getMovieShowtimes($date)
    // {
    //     $shows = Show::where('date', $date)->get();

    //     $html = "";
    //     // foreach ($shows as $show) {
    //     //     $html .= "<tr>";
    //     //     $html .= "<td>" . $show->movie->title . "</td>";
    //     //     $html .= "<td>" . $show->date . "</td>";
    //     //     $html .= "</tr>";
    //     // }
    //     foreach ($shows as $show) {
    //         $showtimes = Showtime::where('show_id', $show->id)->get();
    //         $showT = '';
    //         foreach ($showtimes as $showtime) {
    //             $showT .= "<a class='btn btn-primary btn-sm m-1' method='get' href='/showtimes/".$showtime->id."'>" . $showtime->time . "</a>";
    //         }
    //        //$html .= "<tr><td>" . Movie::find($show->movie_id)->title . "</td><td>" . $showT . "</td></tr>";
    //        $html .= "<tr>";
    //         $html .= "<td>" . Movie::find($show->movie_id)->title . "</td>";
    //         $html .= "<td>" . $showT . "</td>";

    //         if (Gate::allows('is-admin')) {
    //             $html .= "<td><a href='" . route('shows.edit', [$show->id, $date]). "' class='btn btn-success btn-sm m-1'>Edycja</a></td>";
    //         }

    //         $html .= "</tr>";
    //     }
    //     return $html;

    //     //return "<tr><td>".$date."</td><td></td></tr>";
    //     // return  view('guest\index',['movies'=>Movie::all(),'shows'=>Show::all(),'date'=>$date,'recommended1'=>Movie::all()->random(3)]);
    // }
    public function getMovieShowtimes($date)
{
    $shows = Show::where('date', $date)->get();

    $html = '';

    foreach ($shows as $show) {
        $showtimes = Showtime::where('show_id', $show->id)->get();
        $showT = '';

        foreach ($showtimes as $showtime) {
            $showT .= "<a class='btn btn-primary btn-sm m-1' method='get' href='/showtimes/".$showtime->id."'>" . $showtime->time . "</a>";
        }

        $html .= "<tr>";
        $html .= "<td>" . $show->movie->title . "</td>";
        $html .= "<td>" . $showT . "</td>";

        if (Gate::allows('is-admin')) {
            $html .= "<td>";
            $html .= "<a href='" . route('shows.edit', ['show' => $show->id, 'date' => $date]) . "' class='btn btn-success btn-sm m-1'>Edycja</a>";
            $html .= "</td>";
            $html .= "<td>";
            $html .= "<form method='POST' action='" . route('shows.destroy', $show->id) . "'>";
            $html .= "<input type='hidden' name='_token' value='" . csrf_token() . "'>";
            $html .= "<input type='hidden' name='_method' value='DELETE'>";
            $html .= "<input type='submit' value='Usuń' class='btn btn-danger btn-sm m-1'>";
            $html .= "</form>";
            $html .= "</td>";
        }

        $html .= "</tr>";
    }

    if (Gate::allows('is-admin') && Movie::count() != $shows->count()) {
        $html .= "<tr>";
        $html .= "<td colspan='4'>";
        $html .= "<form method='POST' action='" . route('shows.store') . "' class='d-flex align-items-center'>";
        $html .= "<input type='hidden' name='_token' value='" . csrf_token() . "'>";
        $html .= "<div class='form-group mb-2 flex-grow-1 me-2'>";
        $html .= "<select id='movie_id' name='movie_id' type='select' class='form-select'>";

        foreach (Movie::all() as $movie) {
            $var = true;

            foreach ($shows as $show) {
                if ($show->movie->id === $movie->id) {
                    $var = false;
                    break;
                }
            }

            if ($var) {
                $html .= "<option value='".$movie->id."'>".$movie->title."</option>";
            }
        }

        $html .= "</select>";
        $html .= "</div>";
        $html .= "<input class='btn btn-secondary btn-sm' type='submit' value='Dodaj'>";
        $html .= "<div class='form-group date' hidden>";
        $html .= "<input type='date' class='form-control' name='date' id='datepicker' placeholder='Select date' aria-label='Select date' aria-describedby='datepicker' onchange='getMovieShowtimes()' value='".$date."' />";
        $html .= "</div>";
        $html .= "</form>";
        $html .= "</td>";
        $html .= "</tr>";
    }

    return $html;
}


}
