<nav class="col-md-2 d-none d-md-block bg-light sidebar sidebar-custom">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            @if(Auth::user()->role != 'mahasiswa')
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <span data-feather="home" class="align-middle me-2"></span>
                    Dashboard
                </a>
            </li>
            @endif
            @if(Auth::user()->role != 'mahasiswa')
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('suggestions.index') ? 'active' : '' }}" href="{{ route('suggestions.index') }}">
                    <span data-feather="file-text" class="align-middle me-2"></span>
                    Saran dan Masukan
                </a>
            </li>
            @endif
            {{-- <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('agenda') ? 'active' : '' }}" href="{{ route('agenda') }}">
                    <span data-feather="calendar" class="align-middle me-2"></span>
                    Agenda
                </a>
            </li> --}}
            @if(Auth::user()->role == 'mahasiswa')
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('achievements.create') ? 'active' : '' }}" href="{{ route('achievements.create') }}">
                    <span data-feather="award" class="align-middle me-2"></span>
                    Ajukan Prestasi
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>