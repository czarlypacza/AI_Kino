<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Showtime;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $today = Carbon::now()->startOfDay();

        $showtimes = Showtime::whereHas('show', function ($query) use ($today, $now) {
            $query->where('date', $today)
                ->whereHas('movie', function ($query) use ($now) {
                    $query->whereRaw('TIMESTAMPDIFF(MINUTE, showtimes.time, ?) BETWEEN 0 AND movies.duration', [$now]);
                });
        })->get();

        return view('dashboard', ['showtimes' => $showtimes,'users'=>User::paginate(15)]);
    }
}
