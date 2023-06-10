<h2 class="fs-3 fw-bolder text-p_accent-600 px-2 lg:px-4 xl:pb-4 xl:px-5">Polecamy</h2>
<div id="carouselPolecamy" class="carousel slide mt-2 lg:hidden"  >
    <div class="carousel-inner ">

    @forelse ($recommended1 as $item)
            @if($loop->first)

      <div class="carousel-item active bg-p_primary-400">
        {{-- <img src="..." class="d-block w-100" alt="..."> --}}
        <div class="row">
        @foreach($item as $recomm)

            <div class=" col-4  border-p_support-100">
                <div class="card border-0 border-p_support-100 bg-p_primary-500 ">
                    <img src="{{ asset($recomm['image'])}}" class="card-img-top border-p_support-100" alt="...">
                    <div class="card-body bg-p_primary-500 border-p_support-100">
                        <h5 class="card-title bg-p_primary-500 text-p_accent-600">{{$recomm['title']}}</h5>
                    </div>
                </div>
            </div>

        @endforeach

        </div>
      </div>
            @else
                <div class="carousel-item bg-p_primary-400">
                    {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                    <div class="row">
                        @foreach($item as $recomm)

                            <div class=" col-4  border-p_support-100">
                                <div class="card border-0 border-p_support-100 bg-p_primary-500 ">
                                    <img src="{{ asset($recomm['image'])}}" class="card-img-top border-p_support-100" alt="...">
                                    <div class="card-body bg-p_primary-500 border-p_support-100">
                                        <h5 class="card-title bg-p_primary-500 text-p_accent-600">{{$recomm['title']}}</h5>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>

            @endif
        @empty

        @endforelse

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPolecamy" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselPolecamy" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
  </div>


<div id="carouselPolecamylg" class="carousel slide mt-2 hidden lg:flex xl:hidden"  >
    <div class="carousel-inner ">
        @forelse ($recommended2 as $item)
            @if($loop->first)

                <div class="carousel-item active bg-p_primary-400">
                    {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                    <div class="row">
                        @foreach($item as $recomm)

                            <div class=" col-3  border-p_support-100">
                                <div class="card border-0 border-p_support-100 bg-p_primary-500 ">
                                    <img src="{{ asset($recomm['image'])}}" class="card-img-top border-p_support-100" alt="...">
                                    <div class="card-body bg-p_primary-500 border-p_support-100">
                                        <h5 class="card-title bg-p_primary-500 text-p_accent-600">{{$recomm['title']}}</h5>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            @else
                <div class="carousel-item bg-p_primary-400">
                    {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                    <div class="row">
                        @foreach($item as $recomm)

                            <div class=" col-3  border-p_support-100">
                                <div class="card border-0 border-p_support-100 bg-p_primary-500 ">
                                    <img src="{{ asset($recomm['image'])}}" class="card-img-top border-p_support-100" alt="...">
                                    <div class="card-body bg-p_primary-500 border-p_support-100">
                                        <h5 class="card-title bg-p_primary-500 text-p_accent-600">{{$recomm['title']}}</h5>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>

            @endif
        @empty

        @endforelse

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPolecamylg" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselPolecamylg" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

<div id="carouselPolecamyxl" class="carousel slide mt-2 hidden xl:flex"  >
    <div class="carousel-inner ">
        @forelse ($recommended3 as $item)
            @if($loop->first)

                <div class="carousel-item active bg-p_primary-400">
                    {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                    <div class="row">
                        @foreach($item as $recomm)

                            <div class=" col-2  border-p_support-100">
                                <div class="card border-0 border-p_support-100 bg-p_primary-500 ">
                                    <img src="{{ asset($recomm['image'])}}" class="card-img-top border-p_support-100" alt="...">
                                    <div class="card-body bg-p_primary-500 border-p_support-100">
                                        <h5 class="card-title bg-p_primary-500 text-p_accent-600">{{$recomm['title']}}</h5>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>
            @else
                <div class="carousel-item bg-p_primary-400">
                    {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                    <div class="row">
                        @foreach($item as $recomm)

                            <div class=" col-2  border-p_support-100">
                                <div class="card border-0 border-p_support-100 bg-p_primary-500 ">
                                    <img src="{{ asset($recomm['image'])}}" class="card-img-top border-p_support-100" alt="...">
                                    <div class="card-body bg-p_primary-500 border-p_support-100">
                                        <h5 class="card-title bg-p_primary-500 text-p_accent-600">{{$recomm['title']}}</h5>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>
                </div>

            @endif
        @empty

        @endforelse

    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselPolecamyxl" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselPolecamyxl" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

  <script>
    // Get the carousel element
    var carouselElement = document.getElementById('carouselPolecamy');

    // Get the carousel buttons
    var prevButton = carouselElement.querySelector('.carousel-control-prev');
    var nextButton = carouselElement.querySelector('.carousel-control-next');

    // Add event listeners to the buttons
    prevButton.addEventListener('click', function() {
      carouselElement.carousel('prev');
    });

    nextButton.addEventListener('click', function() {
      carouselElement.carousel('next');
    });

    // Get the carousel element
    var carouselElementlg = new bootstrap.Carousel(document.getElementById('carouselPolecamylg'));

    // Get the carousel buttons
    var prevButtonlg = carouselElementlg.querySelector('.carousel-control-prev');
    var nextButtonlg = carouselElementlg.querySelector('.carousel-control-next');

    prevButtonlg.addEventListener('click', function() {
        carouselElementlg.prev();
    });

    nextButtonlg.addEventListener('click', function() {
        carouselElementlg.carousel('next');
    });

    // Get the carousel element
    var carouselElementxl = new bootstrap.Carousel(document.getElementById('carouselPolecamylg'));

    // Get the carousel buttons
    var prevButtonxl = carouselElementxl.querySelector('.carousel-control-prev');
    var nextButtonxl = carouselElementxl.querySelector('.carousel-control-next');

    prevButtonxl.addEventListener('click', function() {
        carouselElementxl.prev();
    });

    nextButtonxl.addEventListener('click', function() {
        carouselElementxl.carousel('next');
    });

  </script>

