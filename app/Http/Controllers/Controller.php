<?php

namespace App\Http\Controllers;

use App\Models\Carousel;
use App\Models\Movie;
use App\Models\Room;
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
        $recommended1 = Movie::all()->random(9)->toArray();
        $arr_recomm = array_chunk($recommended1, 3);

        $recommended2 = Movie::all()->random(12)->toArray();
        $arr_recomm2 = array_chunk($recommended2, 4);

        $recommended3 = Movie::all()->random(12)->toArray();
        $arr_recomm3 = array_chunk($recommended3, 6);


        return  view('index\index', ['carousels'=>Carousel::all(),'movies' => Movie::all(), 'shows' => Show::where('date',now()->format('Y-m-d'))->get(), 'showtimes' => Showtime::orderBy('show_id')->orderBy('time')->get(), 'date' => now()->format('Y-m-d'), 'recommended1' => $arr_recomm,'recommended2' => $arr_recomm2,'recommended3' => $arr_recomm3]);
    }
    public function getMovieShowtimes($date)
    {
        $shows = Show::where('date', $date)->get();
        $html = '';

        foreach ($shows as $show) {
            $showtimes = Showtime::where('show_id', $show->id)->get();
            $showT = '';

            foreach ($showtimes as $showtime) {
                $showT .= "<a class='text-decoration-none bg-p_support-50 text-p_accent-600 p-1 m-1 rounded-3 hover:bg-p_accent-700 hover:text-p_accent-300' href='/showtimes/".$showtime->id."'>" . $showtime->time . "</a>";
            }

            $html .= "<tr class='border-t border-p_primary-100 hover:bg-p_secondary-200 hover:text-p_accent-600'>";
            $html .= "<td class='col-5 text-p_support-50 border-bottom-0'><div class='inline-flex'>" . Movie::find($show->movie_id)->title . "</div></td>";
            $html .= "<td class='col-6 d-inline-flex h-100 align-items-center border-bottom-0'>" . $showT . "</td>";
            $html .= "</tr>";
        }

        return $html;
    }

    /*public function getMovieShowtimesShow($date)
    {
    $shows = Show::where('date', $date)->get();

    $html = '';

    foreach ($shows as $show) {
        $showtimes = Showtime::where('show_id', $show->id)->orderBy('time')->get();
        $rooms = Room::all();
        $showT = '';

        foreach ($showtimes as $showtime) {
            $showT .= "<a class='btn btn-primary btn-sm m-1' href='/showtimes/".$showtime->id."'>" . $showtime->time . "</a>";
        }

        if (Gate::allows('is-admin')){
            $showT .= "<a data-bs-toggle='modal' data-bs-target='#showtimesADD".$show->id."'  class='btn btn-info btn-sm m-1'>+</a>";
            $showT .= "<div class='modal fade' id='showtimesADD" . $show->id . "' tabindex='-1' aria-hidden='true'>";
            $showT .= "<div class='modal-dialog'>";
            $showT .= "<div class='modal-content'>";
            $showT .= "<form method='POST' action='" . route('showtimes.store') . "' >";
            $showT .= "<input type='hidden' name='_token' value='" . csrf_token() . "'>";
            $showT .= "<div class='modal-header'>";
            $showT .= "<h5 class='modal-title' id='exampleModalLabel'>Dodaj godzine</h5>";
            $showT .= "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
            $showT .= "</div>";
            $showT .= "<div class='modal-body d-flex align-items-center justify-content-evenly'>";
            $showT .= "<input type='hidden' name='show_id' value='" . $show->id . "' class='form-control' id='show_id' >";
            $showT .= "<div class='form-group mb-2 me-2'>";
            $showT .= "<label for='time'>Wybierz godzine:</label>";
            $showT .= "<input type='time' id='time' name='time' class='form-control'>";
            $showT .= "</div>";
            $showT .= "<div class='form-group mb-2 me-2'>";
            $showT .= "<label for='room_id'>Wybierz film:</label>";
            $showT .= "<select id='room_id' name='room_id' type='select' class='form-select'>";
            foreach ($rooms as $room) {
                $showT .= "<option value='" . $room->id . "'>Pokój nr: " . $room->id . "</option>";
            }
            $showT .= "</select>";
            $showT .= "</div>";
            $showT .= "</div>";
            $showT .= "<div class='modal-footer'>";
            $showT .= "<button type='submit' class='btn btn-primary'>Zapisz</button>";
            $showT .= "</div>";
            $showT .= "</form>";
            $showT .= "</div>";
            $showT .= "</div>";
            $showT .= "</div>";

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
}*/
    public function getMovieShowtimesShow($date)
    {
        $shows = Show::where('date', $date)->get();
        $html = '';

        foreach ($shows as $show) {
            $showtimes = Showtime::where('show_id', $show->id)->orderBy('time')->get();
            $rooms = Room::all();
            $showT = '';

            foreach ($showtimes as $showtime) {
                $showT .= "<a class='text-decoration-none bg-p_support-50 text-p_accent-600 p-1 m-1 rounded-3 hover:bg-p_accent-700 hover:text-p_accent-300' href='/showtimes/".$showtime->id."'>" . $showtime->time . "</a>";
            }

            if (Gate::allows('is-admin')){
                $showT .= "<a data-bs-toggle='modal' data-bs-target='#showtimesADD".$show->id."'  class='btn btn-info btn-sm m-1'>+</a>";
                $showT .= "<div class='modal fade' id='showtimesADD" . $show->id . "' tabindex='-1' aria-hidden='true'>";
                $showT .= "<div class='modal-dialog'>";
                $showT .= "<div class='modal-content bg-p_primary-500'>";
                $showT .= "<form method='POST' action='" . route('showtimes.store') . "' class='bg-p_primary-500 rounded-2'>";
                $showT .= "<input type='hidden' name='_token' value='" . csrf_token() . "'>";
                $showT .= "<div class='modal-header bg-p_primary-500 border-b border-0'>";
                $showT .= "<h5 class='modal-title text-p_support-50' id='exampleModalLabel'>Dodaj godzine</h5>";
                $showT .= "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
                $showT .= "</div>";
                $showT .= "<div class='modal-body d-flex align-items-center justify-content-evenly bg-p_primary-500 text-p_support-50 border-b border-t border-p_accent-900'>";
                $showT .= "<input type='hidden' name='show_id' value='" . $show->id . "' class='form-control' id='show_id' >";
                $showT .= "<div class='form-group mb-2 me-2'>";
                $showT .= "<label for='time'>Wybierz godzine:</label>";
                $showT .= "<input type='time' id='time' name='time' class='form-control'>";
                $showT .= "</div>";
                $showT .= "<div class='form-group mb-2 me-2'>";
                $showT .= "<label for='room_id'>Wybierz film:</label>";
                $showT .= "<select id='room_id' name='room_id' type='select' class='form-select'>";
                foreach ($rooms as $room) {
                    $showT .= "<option value='" . $room->id . "'>Pokój nr: " . $room->id . "</option>";
                }
                $showT .= "</select>";
                $showT .= "</div>";
                $showT .= "</div>";
                $showT .= "<div class='modal-footer bg-p_primary-500 border-0'>";
                $showT .= "<button type='submit' class='btn btn-primary'>Zapisz</button>";
                $showT .= "</div>";
                $showT .= "</form>";
                $showT .= "</div>";
                $showT .= "</div>";
                $showT .= "</div>";
            }

            $html .= "<tr class='border-t border-p_primary-100 hover:bg-p_secondary-200 hover:text-p_accent-600'>";
            $html .= "<td class='col-5 text-p_support-50 border-bottom-0'><div class='inline-flex'><img class='w-10 lg:w-20' src='" . asset($show->movie->image) . "' alt=''>" . $show->movie->title . "</div></td>";
            $html .= "<td class='col-6 d-inline-flex h-100 align-items-center border-bottom-0'>" . $showT . "</td>";

            if (Gate::allows('is-admin')) {
                $html .= "<td><a href='" . route('shows.edit', ['show' => $show->id, 'date' => $date]) . "' class='btn btn-success btn-sm m-1'>Edycja</a></td>";
                $html .= "<td><form method='POST' action='" . route('shows.destroy', $show->id) . "'><input type='hidden' name='_token' value='" . csrf_token() . "'><input type='hidden' name='_method' value='DELETE'><input type='submit' value='Usuń' class='btn btn-danger btn-sm m-1'></form></td>";
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
