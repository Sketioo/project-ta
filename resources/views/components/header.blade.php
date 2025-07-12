<header class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-graduation-cap me-2"></i>
            <strong>Prodi</strong> TRPL
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="/">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('agenda') ? 'active' : '' }}" href="/agenda">
                        <i class="fas fa-calendar-alt me-1"></i>Agenda
                    </a>
                </li>
            </ul>
            <div class="d-flex align-items-center">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-dark custom-login-btn">
                        <i class="fas fa-sign-in-alt me-1"></i>Login
                    </a>
                @endguest
                @auth
                    @if (Auth::user()->role == 'mahasiswa')
                        <a href="{{ route('achievements.create') }}" class="btn btn-primary-custom me-2">
                            <i class="fas fa-award me-1"></i>Ajukan Prestasi
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary custom-dashboard-btn me-2">
                            <i class="fas fa-tachometer-alt me-1"></i>Dashboard
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</header>
