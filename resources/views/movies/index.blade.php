<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filmy</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    @vite([ 'resources/css/app.css','public/css/bootstrap.css','resources/js/app.js','public/js/bootstrap.bundle.js'])

    <style>
        .p_primary-text {
            color: #212121;
        }

        .p_primary-bg {
            background-color: #212121;
        }

        .p_primary-border {
            border: 1px solid #212121;
        }
        .p_secondary-text {
            color: #181818;
        }

        .p_secondary-bg {
            background-color: #181818;
        }

        .p_secondary-border {
            border: 1px solid #181818;
        }
        .p_support-text {
            color: #0D7377;
        }

        .p_support-bg {
            background-color: #0D7377;
        }

        .p_support-border {
            border: 1px solid #0D7377;
        }
        .p_accent-text {
            color: #14FFEC;
        }

        .p_accent-bg {
            background-color: #14FFEC;
        }

        .p_accent-border {
            border: 1px solid #14FFEC;
        }
        .accordion-button:focus {
            z-index: 3;
            border-color: #181818;
            outline: 0;
            box-shadow: var(--bs-accordion-btn-focus-box-shadow);
        }
        .accordion-button:not(.collapsed) {
            color: #14FFEC;
            background-color: #181818;
            box-shadow: inset 0 calc(-1 * var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
        }
        .accordion-button {
            color: #11CCBE;
        }
        .accordion-item {
            border: var(--bs-accordion-border-width) solid #2A8587;
        }
    </style>
</head>
<body class="bg-p_primary-400 md:text-lg">
@include('layouts.navigation')
<div class="flex flex-col align-items-center">
<div class="row w-100 mt-3 max-w-7xl">
    <div class="col-11 mt-3 mx-auto">
        <h3 class="fs-1 fw-bolder text-p_accent-500">Filmy</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="accordion accordion-flush p_primary-bg rounded-2" id="accordionMovies">
            @foreach($movies as $movie)
                <div class="accordion-item border-0">
                    <h2 class="accordion-header p_primary-bg" id="flush-headingOne">
                        <button class="accordion-button collapsed p_primary-bg text-p_accent-600" type="button" data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne{{$movie->id}}" aria-expanded="false"
                                aria-controls="flush-collapseOne">
                            {{ $movie->title }}
                        </button>
                    </h2>
                    <div id="flush-collapseOne{{$movie->id}}" class="accordion-collapse p_primary-bg collapse"
                         aria-labelledby="flush-headingOne" data-bs-parent="#accordionMovies">
                        <div class="accordion-body">

                            <div class="card mb-3 bg-transparent">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="{{ asset($movie->image) }}" class="img-fluid rounded-start"
                                             alt="{{$movie->image}}">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h4 class="card-title text-p_accent-600">{{$movie->title}}</h4>
                                            <p class="card-text text-p_support-50">{{$movie->description}}</p>
                                            <div class="row text-p_support-50">
                                                <div class="col col-6">
                                                    <h5>Reżyseria:</h5>
                                                    <p>{{$movie->director}}</p>
                                                </div>
                                                <div class="col col-6">
                                                    <h5>Aktorzy:</h5>
                                                    <p>{{$movie->actors}}</p>
                                                </div>
                                            </div>
                                            <div class="row text-p_support-50">
                                                <div class="col col-6">
                                                    <p>Czas trwania:{{$movie->duration}} min</p>
                                                </div>
                                                <div class="col col-6">
                                                    <p>Gatunek: @foreach ($movie->genre as $genre)
                                                            {{$genre->name}},
                                                        @endforeach</p>
                                                </div>
                                            </div>
                                            <div class="row bg-p_primary-500 mt-3 mb-4">
                                                <div class="col col-3 text-center md:text-lg">
                                                    <a data-bs-toggle="modal" data-bs-target="#moviesEDIT{{$movie->id}}" class="btn btn-success btn-lg">Edytuj</a>
                                                    <div class="modal fade bg-transparent" id="moviesEDIT{{$movie->id}}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content bg-transparent rounded-2">
                                                                <form method="POST" action="{{route('movies.update',[$movie])}}" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="modal-header bg-p_primary-500">
                                                                        <h5 class="modal-title text-p_support-50" id="exampleModalLabel">Edytuj film</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body align-items-center justify-content-evenly bg-p_primary-500 text-p_support-50 border-b border-t border-p_accent-900">
                                                                        <input value="{{$movie->title}}" class="form-control mb-1" type="text" name="title" placeholder="Tytuł filmu">
                                                                        <textarea class="form-control mb-1" rows="4" name="description" placeholder="Opis filmu">{{$movie->description}}</textarea>
                                                                        <div class="input-group mb-1">
                                                                            <input type="file" class="form-control" name="image" placeholder="img" aria-label="img"
                                                                                   aria-describedby="basic-addon1">
                                                                            <input value="{{$movie->director}}" type="text" class="form-control" name="director" placeholder="Reżyseria" aria-label="Reżyseria" aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <input class="form-control mb-1" value="{{$movie->actors}}" type="text" name="actors" placeholder="Aktorzy">
                                                                        <div class="input-group mb-1">
                                                                            <input value="{{$movie->duration}}" type="text" class="form-control" name="duration" placeholder="Czas trwania" aria-label="Czas trwania" aria-describedby="basic-addon1">
                                                                            <input type="text" value="{{$movie->score}}" class="form-control" name="score" placeholder="Ocena (1-10)" aria-label="Ocena" aria-describedby="basic-addon1">
                                                                        </div>
                                                                        <div class="mb-1">
                                                                            <label class="form-label">Gatunki filmu:</label>
                                                                            <div class="row bg-p_primary-500">
                                                                                <div class="col md:text-lg">
                                                                                    @foreach ($genres->slice(0, $genres->count()/2) as $genre)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}" @if($movie->genre->contains($genre->id)) checked @endif>
                                                                                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                                                                                {{ $genre->name }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <div class="col md:text-lg">
                                                                                    @foreach ($genres->slice($genres->count()/2) as $genre)
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}" id="genre{{ $genre->id }}" @if($movie->genre->contains($genre->id)) checked @endif>
                                                                                            <label class="form-check-label" for="genre{{ $genre->id }}">
                                                                                                {{ $genre->name }}
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer p_primary-bg">
                                                                        <x-primary-button type="submit">Zapisz</x-primary-button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col col-3 text-center md:text-lg">
                                                    <form method="POST" action="{{ route('movies.destroy',[$movie]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-lg " type="submit">Usuń</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
</div>

<div class="row bg-p_primary-400 mt-3 mb-4">
    <div class="col text-center md:text-lg">
        <x-primary-button data-bs-toggle="modal" data-bs-target="#moviesADD">Dodaj film</x-primary-button>
        <div class="modal fade bg-transparent" id="moviesADD" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-transparent rounded-2">
                    <form method="POST" action="{{route('movies.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header bg-p_primary-500">
                            <h5 class="modal-title text-p_support-50" id="exampleModalLabel">Dodaj film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body align-items-center justify-content-evenly bg-p_primary-500 text-p_support-50 border-b border-t border-p_accent-900">
                            <input class="form-control mb-1" type="text" name="title" placeholder="Tytuł filmu">
                            <textarea class="form-control mb-1" rows="4" name="description"
                                      placeholder="Opis filmu"></textarea>
                            <div class="input-group mb-1">
                                <input type="file" class="form-control" name="image" placeholder="img" aria-label="img"
                                       aria-describedby="basic-addon1">
                                <input type="text" class="form-control" name="director" placeholder="Reżyseria"
                                       aria-label="Reżyseria" aria-describedby="basic-addon1">
                            </div>
                            <input class="form-control mb-1" type="text" name="actors" placeholder="Aktorzy">
                            <div class="input-group mb-1">
                                <input type="text" class="form-control" name="duration" placeholder="Czas trwania"
                                       aria-label="Czas trwania" aria-describedby="basic-addon1">
                                <input type="text" class="form-control" name="score" placeholder="Ocena (1-10)"
                                       aria-label="Ocena" aria-describedby="basic-addon1">
                            </div>
                            {{--here--}}
                            <div class="mb-1">
                                <label class="form-label">Gatunki filmu:</label>
                                <div class="row bg-p_primary-500">
                                    <div class="col md:text-lg">
                                        @foreach ($genres->slice(0, $genres->count()/2) as $genre)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="genres[]"
                                                       value="{{ $genre->id }}" id="genre{{ $genre->id }}">
                                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="col md:text-lg">
                                        @foreach ($genres->slice($genres->count()/2) as $genre)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="genres[]"
                                                       value="{{ $genre->id }}" id="genre{{ $genre->id }}">
                                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                                    {{ $genre->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer p_primary-bg">
                            <x-primary-button type="submit">Zapisz</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@include('shared\footer')
{{--<script src="{{ asset('js/bootstrap.bundle.js') }}"></script>--}}

</body>
</html>
