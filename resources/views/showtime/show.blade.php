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
    @vite([ 'resources/css/app.css','public/css/bootstrap.css','resources/js/app.js','public/js/bootstrap.bundle.js'])
    <style>
        .p_primary-bg {
            background-color: #212121;
        }
    </style>
</head>

<body class="bg-p_primary-400 md:text-lg">
@include('layouts.navigation')

    <div class="row mt-3 w-100">
        <div class="col col-11 mt-3 mx-auto">
            <h3 class="text-p_accent-500">Szczegóły seansu</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="bg-p_primary-500 rounded-2">
            <div class="card mb-3 bg-transparent " >
                <div class="row g-0">
                  <div class="col-md-4">
                    <img src="{{ asset($showtime->show->movie->image) }}" class="img-fluid rounded-start" alt="{{$showtime->show->movie->image}}">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h4 class="card-title text-p_accent-600">{{$showtime->show->movie->title}}</h4>
                      <p class="card-text text-p_support-50">{{$showtime->show->movie->description}}</p>
                      <div class="row text-p_support-50">
                        <div class="col col-6">
                            <h5>Reżyseria:</h5>
                            <p>{{$showtime->show->movie->director}}</p>
                        </div>
                        <div class="col col-6">
                            <h5>Aktorzy:</h5>
                            <p>{{$showtime->show->movie->actors}}</p>
                        </div>
                      </div>
                      <div class="row text-p_support-50">
                        <div class="col col-6">
                            <p>Czas trwania:{{$showtime->show->movie->duration}} min</p>
                        </div>
                        <div class="col col-6">
                            <p>Gatunek: @foreach ($showtime->show->movie->genre as $genre)
                                {{$genre->name}},
                            @endforeach</p>
                        </div>
                      </div>
                      <div class="row text-p_support-50">
                          <div class="col col-6">
                            <p>Data: {{$showtime->show->date}}</p>
                          </div>


                          @can('is-admin')
                              <div class="col col-3">
                                  <p>Godzina: {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}</p>
                              </div>
                              <div class="col col-3">
                                  <p>Sala: {{$showtime->room->id}}</p>
                              </div>
                          @else
                              <div class="col col-6">
                                  <p>Godzina: {{ \Carbon\Carbon::parse($showtime->time)->format('H:i') }}</p>
                              </div>
                          @endcan
                      </div>
                      <div class="row">
                        {{-- <button class="btn btn-info btn-lg" onclick="{{route('room.show',['room'=>$showtime->room,'showtime'=>$showtime])}}">Wybierz miejsca</button> --}}

                          <div class="col col-6">
                              <form action="{{ route('room.show', ['room'=>$showtime->room, 'showtime' => $showtime]) }}" method="get" >
                                  <x-primary-button  type="submit">Wybierz miejsca</x-primary-button>
                              </form>
                          </div>

                          @can('is-admin')
                          <div class="col col-3" >
                              <a data-bs-toggle="modal" data-bs-target="#showtimesADD"
                                               class="btn btn-success btn-lg ">Edytuj</a>
                              <div class="modal fade" id="showtimesADD" tabindex="-1" aria-hidden="true">
                                  <div class="modal-dialog " >
                                      <div class="modal-content p_primary-bg text-p_accent-600">
                                          <form method="POST" action="{{ route('showtimes.update',[$showtime]) }}">
                                              @csrf
                                              @method('PUT')
                                              <div class="modal-header text-p_accent-600">
                                                  <h5 class="modal-title" id="exampleModalLabel">Edytuj godzine</h5>
                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                              </div>
                                              <div class="modal-body d-flex align-items-center justify-content-evenly text-p_accent-700">
                                                  <input type="hidden" name="show_id" value="{{$showtime->show->id}}" class="form-control" id="show_id" >
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
                                                  <x-primary-button type="submit"  >Zapisz</x-primary-button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col col-3">
                              <form method="POST" action="{{ route('showtimes.destroy',[$showtime]) }}">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger btn-lg " type="submit" >Usuń</button>

                              </form>
                          </div>
                          @endcan
                        </div>
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
