<nav class="navbar navbar-expand-sm bg-dark fixed-top">
    <div class="container-fluid ">
        <a href="{{route('guest_index')}}" class="navbar-brand text-white">Kino</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
            aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="collapse navbar-collapse text-white" id="navbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a href="{{route('shows.index')}}" class="nav-link text-white">Repertuar</a>
                </li>
                <li class="nav-item">
                    <a href="#Login" class="nav-link text-white">Oferty</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('logout') }}">{{ Auth::user()->name }}, wyloguj się... </a>
                    </li>
                @else
                <li class="nav-item">
                    <a href="{{route('login')}}" class="nav-link text-white">Zaloguj</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('register')}}" class="nav-link text-white">Zajerejstruj</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
