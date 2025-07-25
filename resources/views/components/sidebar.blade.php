<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar-layout">
    <div class="position-sticky">
        <div class="sidebar-header text-center">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fas fa-graduation-cap me-2"></i>
                <strong>Prodi</strong> TRPL
            </a>
        </div>

        <ul class="nav flex-column px-3 flex-grow-1">
            <li class="nav-item-header mt-3 mb-1 text-uppercase">
                <span>Menu Utama</span>
            </li>

            @if(Auth::user()->role != 'mahasiswa')
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt fa-fw me-2"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('suggestions.index') ? 'active' : '' }}" href="{{ route('suggestions.index') }}">
                    <i class="fas fa-inbox fa-fw me-2"></i>
                    Saran & Masukan
                </a>
            </li>
            @endif

            @if(Auth::user()->role == 'kaprodi')
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('kaprodi.achievements.index') ? 'active' : '' }}" href="{{ route('kaprodi.achievements.index') }}">
                    <i class="fas fa-check-circle fa-fw me-2"></i>
                    Validasi Prestasi
                </a>
            </li>
            @endif

            @if(Auth::user()->role == 'mahasiswa')
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('achievements.create') ? 'active' : '' }}" href="{{ route('achievements.create') }}">
                    <i class="fas fa-trophy fa-fw me-2"></i>
                    Ajukan Prestasi
                </a>
            </li>
            @endif

            @if(Auth::user()->role == 'admin')
            <li class="nav-item-header mt-4 mb-1 text-uppercase">
                <span>Manajemen Konten</span>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.agendas.index') ? 'active' : '' }}" href="{{ route('admin.agendas.index') }}">
                    <i class="fas fa-calendar-days fa-fw me-2"></i>
                    Manajemen Agenda
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.partners.index') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">
                    <i class="fas fa-handshake fa-fw me-2"></i>
                    Manajemen Mitra
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.documents.index') ? 'active' : '' }}" href="{{ route('admin.documents.index') }}">
                    <i class="fas fa-folder-open fa-fw me-2"></i>
                    Manajemen Dokumen
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.faqs.index') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">
                    <i class="fas fa-question-circle fa-fw me-2"></i>
                    Manajemen FAQ
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.announcements.index') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">
                    <i class="fas fa-bullhorn fa-fw me-2"></i>
                    Manajemen Pengumuman
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::routeIs('admin.facilities.index') ? 'active' : '' }}" href="{{ route('admin.facilities.index') }}">
                    <i class="fas fa-building fa-fw me-2"></i>
                    Manajemen Fasilitas
                </a>
            </li>
            @endif
        </ul>
    </div>
</nav>
