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
                    <a class="nav-link {{ Request::is('agenda*') ? 'active' : '' }}" href="/agenda">
                        <i class="fas fa-calendar-alt me-1"></i>Agenda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('announcements*') ? 'active' : '' }}" href="/announcements">
                        <i class="fas fa-bullhorn me-1"></i>Pengumuman
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle nav-link-dropdown-custom" href="#" id="navbarDropdownTentangProdi" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-info-circle me-1"></i>Tentang Prodi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownTentangProdi">
                        <li><a class="dropdown-item" href="{{ route('facilities.index') }}"><i class="fas fa-building me-2"></i>Fasilitas</a></li>
                        <li class="dropdown-submenu">
                            <a class="dropdown-item dropdown-toggle" href="#"><i class="fas fa-book me-2"></i>Kurikulum</a>
                            <ul class="dropdown-menu">
                                @forelse($navCurriculums as $curriculum)
                                    <li><a class="dropdown-item" href="{{ route('kurikulum.show', $curriculum) }}"><i class="fas fa-calendar-check me-2"></i>{{ $curriculum->name }}</a></li>
                                @empty
                                    <li><a class="dropdown-item" href="#">Tidak ada kurikulum</a></li>
                                @endforelse
                            </ul>
                        </li>
                    </ul>
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

                    <a href="{{ route('logout') }}" class="btn btn-danger"
                       onclick="event.preventDefault(); document.getElementById('logout-form-header').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                    <form id="logout-form-header" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
            </div>
        </div>
    </div>
</header>
