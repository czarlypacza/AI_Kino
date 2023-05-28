<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ShowController;
use App\Http\Controllers\ShowtimeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\Show;
use App\Models\Showtime;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/kino',[Controller::class,'index'])->name('guest_index');

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/getMovieShowtimes/{date}',  function ($date) {
//     $shows = Show::whereDate('date', $date)->get();
//     $html = "";
//     foreach ($shows as $show) {
//       $html .= "<tr>";
//       $html .= "<td>" . $show->movie->title . "</td>";
//       $html .= "<td>" . $show->date . "</td>";
//       $html .= "</tr>";
//     }
//     return $html;

//     //return $shows;
// })->name('getMovieShowtimes');

Route::get('/getMovieShowtimesShow/{date}',[Controller::class,'getMovieShowtimesShow'])->name('getMovieShowtimesShow');
Route::get('/getMovieShowtimes/{date}',[Controller::class,'getMovieShowtimes'])->name('getMovieShowtimes');

Route::resource('shows',ShowController::class);
Route::get('shows/{show}/{date}/edit', [ShowController::class, 'edit'])->name('shows.edit');

Route::resource('showtimes',ShowtimeController::class);

Route::resource('movies', MovieController::class);

Route::resource('rooms',RoomController::class)->except('show');

Route::get('/room/{room}/{showtime}',[RoomController::class,'show'])->name('room.show');

//Route::post('/ticket',[TicketController::class,'store'])->name('tickets.store');

Route::resource('tickets',TicketController::class);

//Route::get('/showtime/{id}',[ShowtimeController::class,'show']);

Route::resource('users', UserController::class);

Route::get('/dashboard',[DashboardController::class,'index'] )->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
