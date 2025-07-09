<nav class="col-md-2 d-none d-md-block bg-light sidebar sidebar-custom">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <span data-feather="home" class="align-middle me-2"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('suggestions.index') ? 'active' : '' }}" href="{{ route('suggestions.index') }}">
                    <span data-feather="file-text" class="align-middle me-2"></span>
                    Saran dan Masukan
                </a>
            </li>
            {{-- <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('agenda') ? 'active' : '' }}" href="{{ route('agenda') }}">
                    <span data-feather="calendar" class="align-middle me-2"></span>
                    Agenda
                </a>
            </li> --}}
        </ul>
    </div>
</nav>