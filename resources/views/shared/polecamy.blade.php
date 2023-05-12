<h2 class="fs-3 fw-bolder">Polecamy</h3>
<div id="carouselPolecamy" class="carousel slide mt-2" >
    <div class="carousel-inner ">
      <div class="carousel-item active">
        {{-- <img src="..." class="d-block w-100" alt="..."> --}}
        <div class="row">
            @forelse ($recommended1 as $recomm)
            <div class=" col-4">
                <div class="card">
                    <img src="{{ asset($recomm->image)}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Film</h5>
                    </div>
                </div>
            </div>
            @empty

            @endforelse
        </div>

      </div>
      <div class="carousel-item">
        <div class="row">
            <div class=" col-4">
                <div class="card">
                    <img src="storage\img\civil_war.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Film</h5>
                    </div>
                </div>
            </div>
            <div class=" col-4">
                <div class="card">
                    <img src="" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Film</h5>
                    </div>
                </div>
            </div>
            <div class=" col-4">
                <div class="card">
                    <img src="" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Film</h5>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="row">
            <div class=" col-4">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Film</h5>
                    </div>
                </div>
            </div>
            <div class=" col-4">
                <div class="card">
                    <img src="" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Film</h5>
                    </div>
                </div>
            </div>
            <div class=" col-4">
                <div class="card">
                    <img src="" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Film</h5>
                    </div>
                </div>
            </div>
        </div>
      </div>
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
  </script>

