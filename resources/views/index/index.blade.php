@php
    use App\Models\Showtime;
@endphp

<!DOCTYPE html>
<html lang="en" >

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

    <div class="md:hidden">
        @include('shared/carousel')
    </div>

    <div class="hidden  md:mb-6 md-pb-6 md:flex justify-content-center bg-gradient-to-t from-p_primary-400 to-p_primary-500">
        <div class="mx-md-4 mx-lg-5">
            @include('shared/carousel')
        </div>
    </div>


    <div class="p-2 sm:mx-3 w-90 mt-md-3 mb-md-3 d-md-flex  justify-content-center">
        <div class="mt-3 p-2 sm:mx-3 max-w-6xl flex-grow-1">
            <span class="fs-3 fw-bolder text-p_accent-600">Repertuar</span>
            <div class="input-group date">
                <input type="date" class="form-control " id="datepicker" placeholder="Select date"
                    aria-label="Select date" aria-describedby="datepicker" onchange="getMovieShowtimes()"
                    value="{{ $date }}" />
            </div>
            <table class="table mt-4 w-100 bg-p_secondary-300 rounded-3">
                <thead class="text-p_support-50">
                <tr class="border-t border-p_primary-100">
                    <th class="col-5 text-p_support-50 border-bottom-0">Filmy</th>
                    <th class="col-6 text-p_support-50 border-bottom-0">Godziny</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($shows as $show)
                    <tr class="border-t border-p_primary-100 hover:bg-p_secondary-200 hover:text-p_accent-600">
                        <td class='col-5 text-p_support-50 border-bottom-0'><div class='inline-flex'>{{ $show->movie->title }}</div></td>
                        <td class='col-6 d-inline-flex h-100 align-items-center border-bottom-0'>
                            @php
                                $showTimes = Showtime::where('show_id', $show->id)->get();
                            @endphp

                            @foreach ($showTimes as $showtime)
                                @if ($showtime->show_id===$show->id)
                                    <a class='text-decoration-none bg-p_support-50 text-p_accent-600 p-1 m-1 rounded-3 hover:bg-p_accent-700 hover:text-p_accent-300' method='get' href='/showtimes/{{$showtime->id}}'> {{$showtime->time}} </a>
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
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var day = ("0" + today.getDate()).slice(-2);
            var month = ("0" + (today.getMonth() + 1)).slice(-2);
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
            console.warn("aaaaa");

            var url = "{{ route('getMovieShowtimes', ['date' => ':date']) }}";
            url = url.replace(':date', selectedDate);
            xhr.open("GET", url, true);
            xhr.send();
        }
    </script>

</body>

</html>
