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
            @if(Auth::user()->role == 'kaprodi')
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('kaprodi.achievements.index') ? 'active' : '' }}" href="{{ route('kaprodi.achievements.index') }}">
                    <span data-feather="check-square" class="align-middle me-2"></span>
                    Validasi Prestasi
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
            @if(Auth::user()->role == 'admin')
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('admin.partners.index') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                    <i class="fas fa-handshake me-2"></i>Manajemen Mitra
                </a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('admin.agendas.index') ? 'active' : '' }}" href="{{ route('admin.agendas.index') }}">
                    <span data-feather="calendar" class="align-middle me-2"></span>
                    Manajemen Agenda
                </a>
            </li>
            <li class="nav-item my-1">
                <a class="nav-link py-2 {{ Request::routeIs('admin.documents.index') ? 'active' : '' }}" href="{{ route('admin.documents.index') }}">
                    <span data-feather="file" class="align-middle me-2"></span>
                    Manajemen Dokumen
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>