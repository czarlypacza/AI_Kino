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



    @include('shared/carousel')

    <div class="row w-100">
        <div class="col-11 mt-3 mx-auto">
            <span class="fs-3 fw-bolder">Repertuar</span>
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
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>Filmy</th>
                        <th>Godziny</th>
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
                                    <a class='btn btn-primary btn-sm m-1' method='get' href='/showtimes/{{$showtime->id}}'> {{$showtime->time}} </a>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    @endforeach

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
                if (xhr.readyState == XMLHttpRequest.DONE) {
                    // Handle the response
                    if (xhr.status == 200) {
                        // Replace the contents of the tbody with the new shows data
                        var tbody = document.querySelector("table.table tbody");
                        tbody.innerHTML = xhr.responseText;
                    } else {
                        console.error("Request failed: " + xhr.status);
                    }
                }
            };
            console.warn("aaaaa");

            // Send the request to the server
            var url = "{{ route('getMovieShowtimes', ['date' => ':date']) }}";
            url = url.replace(':date', selectedDate);
            xhr.open("GET", url, true);
            xhr.send();
        }
    </script>

</body>

</html>
