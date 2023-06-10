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
    <br>
    <div class="container mt-5 mb-5">
        <div class="row mt-5 text-center text-p_accent-600"><h2>Edytuj seans</h2></div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row ">
            <div class="col col-10 mx-auto">
                <form method="POST" action="{{route('shows.update',$show->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="movie_id" >Film</label>
                        <select id="movie_id" name="movie_id" type="select" class="form-select">
                            @foreach ($movies as $movie)
                                @if ($movie->id===$show->movie->id)
                                    <option selected value="{{$movie->id}}">{{$movie->title}}</option>
                                @else
                                    <option value="{{$movie->id}}">{{$movie->title}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group date">
                        <label for="date">Data</label>
                        <input type="date" class="form-control" name="date" id="date" placeholder="Select date"
                            aria-label="Select date" aria-describedby="datepicker" onchange="getMovieShowtimes()"
                            value="{{ $date }}" >

                    </div>
                    <div class="text-center mt-4 mb-4">
                        <x-primary-button type="submit"> Wyślij</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>



    @include('shared\footer')

    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

</body>

</html>
