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
</head>

<body>
    @include('shared/nav')
    <div class="row w-100 mt-5">
        <div class="col-11 mt-5 mx-auto">
            <span class="fs-3 fw-bolder ">Repertuar</span>
            <div class="input-group date mt-3">
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
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Filmy</th>
                        <th>Godziny</th>
                        @can('is-admin')
                            <th scope="col" colspan="2"></th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach ($shows as $show)
                        <tr>
                            <td>{{ $show->movie->title }}</td>
                            <td>
                                @php
                                    $showTimes = Showtime::where('show_id', $show->id)->get();
                                @endphp
                                @foreach ($showtimes as $showtime)
                                    @if ($showtime->show_id===$show->id)
                                        <a class='btn btn-primary btn-sm m-1' href='/showtimes/{{$showtime->id}}'> {{$showtime->time}} </a>
                                    @endif
                                @endforeach
                                @can('is-admin')
                                    <a data-bs-toggle="modal" data-bs-target="#showtimesADD{{$show->id}}"  class="btn btn-info btn-sm m-1">+</a>
                                    <div class="modal fade" id="showtimesADD{{$show->id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ route('showtimes.store') }}" class="">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Dodaj godzine</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body d-flex align-items-center justify-content-evenly">
                                                        <input type="hidden" name="show_id" value="{{$show->id}}" class="form-control" id="show_id" >
                                                        <div class="form-group mb-2 me-2">
                                                            <label for="time">Wybierz godzine:</label>
                                                            <input type="time" id="time" name="time" class="form-control">
                                                        </div>
                                                        <div class="form-group mb-2 me-2">
                                                            <label for="room_id">Wybierz sale:</label>
                                                            <select id="room_id" name="room_id" type="select" class="form-select ">
                                                                @foreach($rooms as $room)
                                                                    <option value="{{$room->id}}">Pokój nr: {{$room->id}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-primary" >Zapisz</button>
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
        function getMovieShowtimes() {
            // Get the selected date from the datepicker input
            var selectedDate = document.getElementById("datepicker").value;


            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Define the function to be called when the response is received
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    // Handle the response
                    if (xhr.status === 200) {
                        // Replace the contents of the tbody with the new shows data
                        var tbody = document.querySelector("table.table tbody");
                        tbody.innerHTML = xhr.responseText;
                    } else {
                        console.error("Request failed: " + xhr.status);
                    }
                }
            };

            // Send the request to the server
            var url = "{{ route('getMovieShowtimes', ['date' => ':date']) }}";
            url = url.replace(':date', selectedDate);
            xhr.open("GET", url, true);
            xhr.send();
        }
    </script>

</body>

</html>
