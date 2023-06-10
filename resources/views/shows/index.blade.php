@php
    use App\Models\Showtime;
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kino</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    @vite([ 'resources/css/app.css','public/css/bootstrap.css','resources/js/app.js','public/js/bootstrap.bundle.js'])

</head>

<body class="bg-p_primary-400 md:text-lg">
@include('layouts.navigation')

<div class="p-2 sm:mx-3 w-90 mt-md-3 mb-md-3 d-md-flex justify-content-center">
    <div class="mt-3 p-2 sm:mx-3 max-w-6xl flex-grow-1">
        <span class="fs-3 fw-bolder text-p_accent-600">Repertuar</span>
        <div class="input-group date">
            <input type="date" class="form-control" id="datepicker" placeholder="Select date"
                   aria-label="Select date" aria-describedby="datepicker" onchange="getMovieShowtimes()"
                   value="{{ $date }}" />
            <button class="btn btn-outline-secondary" type="button" id="prev-date-btn">
                <i class="bi bi-arrow-left"></i>
            </button>
            <button class="btn btn-outline-secondary" type="button" id="next-date-btn">
                <i class="bi bi-arrow-right"></i>
            </button>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table mt-4 w-100 bg-p_secondary-300 rounded-3" >
            <thead class="text-p_support-50">
            <tr class="border-t border-p_primary-100">
                <th >Filmy</th>
                <th >Godziny</th>
                @can('is-admin')
                    <th scope="col" colspan="2"></th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach ($shows as $show)
                <tr class="border-t border-p_primary-100 hover:bg-p_secondary-200 hover:text-p_accent-600" >
                    <td class='col-5 text-p_support-50 border-bottom-0'>
                        <div class='inline-flex'>
                            <img class='w-10 lg:w-20' src="{{ asset($show->movie->image) }}" alt=""> {{ $show->movie->title }}
                        </div>
                    </td>
                    <td class='col-6 d-inline-flex h-100 align-items-center border-bottom-0'>
                        @php
                            $showTimes = Showtime::where('show_id', $show->id)->get();
                        @endphp
                        @foreach ($showtimes as $showtime)
                            @if ($showtime->show_id===$show->id)
                                <a class='text-decoration-none bg-p_support-50 text-p_accent-600 p-1 m-1 rounded-3 hover:bg-p_accent-700 hover:text-p_accent-300' method='get' href='/showtimes/{{$showtime->id}}'> {{$showtime->time}} </a>
                            @endif
                        @endforeach

                        <!--add showtime button-->
                        @can('is-admin')
                            <a data-bs-toggle="modal" data-bs-target="#showtimesADD{{$show->id}}"  class="btn btn-info btn-sm m-1">+</a>
                            <div class="modal fade " id="showtimesADD{{$show->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog ">
                                    <div class="modal-content bg-p_primary-500 ">
                                        <form method="POST" action="{{ route('showtimes.store') }} " class="bg-p_primary-500 rounded-2">
                                            @csrf
                                            <div class="modal-header bg-p_primary-500 border-b border-0">
                                                <h5 class="modal-title text-p_support-50" id="exampleModalLabel">Dodaj godzine</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body d-flex align-items-center justify-content-evenly bg-p_primary-500 text-p_support-50 border-b border-t border-p_accent-900">
                                                <input type="hidden" name="show_id" value="{{$show->id}}" class="form-control" id="show_id" >
                                                <div class="form-group mb-2 me-2">
                                                    <label for="time">Wybierz godzine:</label>
                                                    <input type="time" id="time" name="time" value="09:00" min="09:00" max="20:00" class="form-control">
                                                </div>
                                                <div class="form-group mb-2 me-2 ">
                                                    <label for="room_id">Wybierz sale:</label>
                                                    <select id="room_id" name="room_id" type="select" class="form-select ">
                                                        @foreach($rooms as $room)
                                                            <option value="{{$room->id}}">Pokój nr: {{$room->id}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-p_primary-500 border-0">
                                                <x-primary-button type="submit" >Zapisz</x-primary-button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>


                        @endcan

                    </td>
                    @can('is-admin')
                        <td>
                            <a href="{{route('shows.edit', ['show'=>$show->id,'date'=> $date])}}" class="btn btn-success btn-sm m-1">Edycja</a>
                        </td>
                        <td><form method="POST" action="{{ route('shows.destroy', $show->id) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" value="Usuń" class="btn btn-danger btn-sm m-1">
                            </form></td>
                    @endcan
                </tr>
            @endforeach
            @can('is-admin')
                @if (count($movies)!=count($shows))
                    <tr>
                        <td colspan="4">
                            <form method="POST" action="{{ route('shows.store') }}" class="d-flex align-items-center">
                                @csrf
                                <div class="form-group mb-2 flex-grow-1 me-2">
                                    <select id="movie_id" name="movie_id" type="select" class="form-select ">
                                        @foreach ($movies as $movie)
                                            @php
                                                $var = true;
                                            @endphp
                                            @foreach ($shows as $show)
                                                @if ($show->movie->id===$movie->id)
                                                    @php
                                                        $var=false;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($var)
                                                <option value="{{$movie->id}}">{{$movie->title}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <input class="btn btn-secondary btn-sm" type="submit" value="Dodaj">
                                <div class="input-group date " hidden>
                                    <input type="date" class="form-control" name="date" id="datepicker" placeholder="Select date"
                                           aria-label="Select date" aria-describedby="datepicker" onchange="getMovieShowtimes()"
                                           value="{{ $date }}" />
                                </div>
                            </form>
                        </td>
                    </tr>
                @endif

            @endcan
            </tbody>
        </table>
    </div>
</div>

@include('shared\polecamy')

@include('shared\footer')

<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var today = new Date();
        var day = ("0" + today.getDate()).slice(-2);  // ensure two digits
        var month = ("0" + (today.getMonth() + 1)).slice(-2);  // ensure two digits, January is 0 in JavaScript
        var year = today.getFullYear();

        var todayFormatted = year + '-' + month + '-' + day;
        document.getElementById("datepicker").min = todayFormatted;
    });
</script>
<script>
    function getMovieShowtimes() {
        var selectedDate = document.getElementById("datepicker").value;

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState == XMLHttpRequest.DONE) {
                if (xhr.status == 200) {
                    var tbody = document.querySelector("table.table tbody");
                    tbody.innerHTML = xhr.responseText;
                } else {
                    console.error("Request failed: " + xhr.status);
                }
            }
        };

        var url = "{{ route('getMovieShowtimes', ['date' => ':date']) }}";
        url = url.replace(':date', selectedDate);
        xhr.open("GET", url, true);
        xhr.send();
    }
</script>
</body>


</html>
