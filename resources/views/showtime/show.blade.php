<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$showtime->show->movie->title}}</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/tempusdominus-bootstrap-4@5.39.0/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
</head>
<body>
    @include('shared/nav')

    <div class="row mt-5">
        <div class="col col-11 mt-5 mx-auto">
            <h3>Szczegóły seansu</h3>
            <div class="card mb-3" >
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset($showtime->show->movie->image) }}" class="img-fluid rounded-start" alt="{{$showtime->show->movie->image}}">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h4 class="card-title">{{$showtime->show->movie->title}}</h5>
                      <p class="card-text">{{$showtime->show->movie->description}}</p>
                      <div class="row">
                        <div class="col col-6">
                            <h5>Reżyseria:</h5>
                            <p>{{$showtime->show->movie->director}}</p>
                        </div>
                        <div class="col col-6">
                            <h5>Aktorzy:</h5>
                            <p>{{$showtime->show->movie->actors}}</p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col col-6">
                            <p>Czas trwania:{{$showtime->show->movie->duration}} min</p>
                        </div>
                        <div class="col col-6">
                            <p>Gatunek: @foreach ($showtime->show->movie->genre as $genre)
                                {{$genre->name}},
                            @endforeach</p>{{--  TODO: zrobic tabele gatunkow i wyswietlanie do odpowiednich filmow kilku gatunkow --}}
                        </div>
                      </div>
                      <div class="row">
                          <div class="col col-6">
                            <p>Data: {{$showtime->show->date}}</p>
                          </div>
                          <div class="col col-6">
                            <p>Godzina: {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}</p>
                          </div>
                      </div>
                      <div class="row">
                        {{-- <button class="btn btn-info btn-lg" onclick="{{route('room.show',['room'=>$showtime->room,'showtime'=>$showtime])}}">Wybierz miejsca</button> --}}
                        <form action="{{ route('room.show', ['room'=>$showtime->room, 'showtime' => $showtime]) }}" method="get">
                            <button class="btn btn-info btn-lg" type="submit">Wybierz miejsca</button>
                        </form>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>


    @include('shared/polecamy')

    @include('shared\footer')
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>

</body>
</html>
