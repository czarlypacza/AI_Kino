<div id="carouselMovies" class="max-w-4xl max-h-96 sm:flex mx-auto carousel slide pt-3 xl:hidden bg-gradient-to-t from-p_primary-400 to-p_primary-500 "  data-bs-ride="carousel">

<div class="carousel-inner max-h-100">
    @foreach($carousels as $carousel)
        @if($loop->first)
          <div class="carousel-item active h-100 ">
            <img src="img\{{$carousel->img}}" class="d-block w-100 md:rounded-md" alt="incepcja">
              <div class="carousel-caption d-block d-md-block">
                  <h5 class="text-white font-weight-bold border border-opacity-10 border-dark rounded-1 p-2" style="background-color: rgba(0,0,0,0.1);">
                      {{$carousel->movie->title}}/@foreach($carousel->movie->genre as $genre) {{$genre->name}} @endforeach
                  </h5>
              </div>

          </div>
            @else
            <div class="carousel-item h-100">
                <img src="img\{{$carousel->img}}" class="d-block w-100 md:rounded-md" alt="incepcja">
                <div class="carousel-caption d-block d-md-block">
                    <h5 class="text-white font-weight-bold border border-opacity-10 border-dark rounded-1 p-2" style="background-color: rgba(0,0,0,0.1);">
                        {{$carousel->movie->title}}/@foreach($carousel->movie->genre as $genre) {{$genre->name}} @endforeach
                    </h5>
                </div>
            </div>
        @endif

    @endforeach

    </div>
  </div>
<div id="carouselMovies" class="max-w-6xl max-h-80 mx-auto carousel slide pt-3 hidden xl:flex bg-gradient-to-t from-p_primary-400 to-p_primary-500 "  data-bs-ride="carousel">

    <div class="carousel-inner max-h-100">
        @foreach($carousels as $carousel)
            @if($loop->first)
                <div class="carousel-item active h-100 ">
                    <img src="img\lg\{{$carousel->img}}" class="d-block w-100 md:rounded-md" alt="incepcja">
                    <div class="carousel-caption d-block d-md-block">
                        <h5 class="text-white font-weight-bold border border-opacity-10 border-dark rounded-1 p-2" style="background-color: rgba(0,0,0,0.1);">
                            {{$carousel->movie->title}}/@foreach($carousel->movie->genre as $genre) {{$genre->name}} @endforeach
                        </h5>
                    </div>

                </div>
            @else
                <div class="carousel-item h-100">
                    <img src="img\lg\{{$carousel->img}}" class="d-block w-100 md:rounded-md" alt="incepcja">
                    <div class="carousel-caption d-block d-md-block">
                        <h5 class="text-white font-weight-bold border border-opacity-10 border-dark rounded-1 p-2" style="background-color: rgba(0,0,0,0.1);">
                            {{$carousel->movie->title}}/@foreach($carousel->movie->genre as $genre) {{$genre->name}} @endforeach
                        </h5>
                    </div>
                </div>
            @endif

        @endforeach

    </div>
</div>
