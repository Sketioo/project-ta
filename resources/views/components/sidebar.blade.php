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

            {{-- Common for Admin & Kaprodi --}}
            @if(in_array(Auth::user()->role, ['admin', 'kaprodi']))
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt fa-fw me-2"></i>
                        Dashboard
                    </a>
                </li>
            @endif

            {{-- Mahasiswa Menu --}}
            @if(Auth::user()->role == 'mahasiswa')
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('achievements.create') ? 'active' : '' }}" href="{{ route('achievements.create') }}">
                        <i class="fas fa-trophy fa-fw me-2"></i>
                        Ajukan Prestasi
                    </a>
                </li>
            @endif

            {{-- Kaprodi Menu --}}
            @if(Auth::user()->role == 'kaprodi')
                <li class="nav-item-header mt-4 mb-1 text-uppercase">
                    <span>Validasi & Masukan</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('kaprodi.achievements.index') ? 'active' : '' }}" href="{{ route('kaprodi.achievements.index') }}">
                        <i class="fas fa-check-circle fa-fw me-2"></i>
                        Validasi Prestasi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('suggestions.index') ? 'active' : '' }}" href="{{ route('suggestions.index') }}">
                        <i class="fas fa-inbox fa-fw me-2"></i>
                        Saran & Masukan
                    </a>
                </li>
            @endif

            {{-- Admin Menu --}}
            @if(Auth::user()->role == 'admin')
                <li class="nav-item-header mt-4 mb-1 text-uppercase">
                    <span>Manajemen</span>
                </li>
                {{-- Group 1: Manajemen Konten --}}
                <li class="nav-item">
                    <a class="nav-link collapsed d-flex justify-content-between align-items-center" href="#contentSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="contentSubmenu">
                        <span>
                            <i class="fas fa-file-alt fa-fw me-2"></i>
                            Manajemen Konten
                        </span>
                        <i class="fas fa-chevron-up"></i>
                    </a>
                    <div class="collapse" id="contentSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link {{ Request::routeIs('admin.agendas.index') ? 'active' : '' }}" href="{{ route('admin.agendas.index') }}">Agenda</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::routeIs('admin.announcements.index') ? 'active' : '' }}" href="{{ route('admin.announcements.index') }}">Pengumuman</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::routeIs('admin.documents.index') ? 'active' : '' }}" href="{{ route('admin.documents.index') }}">Dokumen</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::routeIs('admin.curriculums.index') ? 'active' : '' }}" href="{{ route('admin.curriculums.index') }}">Kurikulum</a></li>
                        </ul>
                    </div>
                </li>

                {{-- Group 2: Manajemen Halaman --}}
                <li class="nav-item">
                    <a class="nav-link collapsed d-flex justify-content-between align-items-center" href="#pageSubmenu" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pageSubmenu">
                        <span>
                            <i class="fas fa-sitemap fa-fw me-2"></i>
                            Kelola Halaman
                        </span>
                        <i class="fas fa-chevron-up"></i>
                    </a>
                    <div class="collapse" id="pageSubmenu">
                        <ul class="nav flex-column ms-3">
                            <li class="nav-item"><a class="nav-link {{ Request::routeIs('admin.partners.index') ? 'active' : '' }}" href="{{ route('admin.partners.index') }}">Mitra</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::routeIs('admin.faqs.index') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">FAQ</a></li>
                            <li class="nav-item"><a class="nav-link {{ Request::routeIs('admin.facilities.index') ? 'active' : '' }}" href="{{ route('admin.facilities.index') }}">Fasilitas</a></li>
                        </ul>
                    </div>
                </li>
                 <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('suggestions.index') ? 'active' : '' }}" href="{{ route('suggestions.index') }}">
                        <i class="fas fa-inbox fa-fw me-2"></i>
                        Saran & Masukan
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function(){
    // --- Initial State Setup ---
    const collapseTriggers = document.querySelectorAll('.sidebar-layout .nav-link[data-bs-toggle="collapse"]');

    const setInitialIcon = (trigger) => {
        const icon = trigger.querySelector('.fas[class*="fa-chevron-"]');
        if (!icon) return;
        
        const target = document.querySelector(trigger.getAttribute('data-bs-target'));
        if (target && target.classList.contains('show')) {
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        } else {
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    };

    const activeSubLink = document.querySelector('.nav-item .collapse .nav-link.active');
    if (activeSubLink) {
        const collapseElement = activeSubLink.closest('.collapse');
        if (collapseElement) {
            collapseElement.classList.add('show');
            const trigger = document.querySelector(`[data-bs-target="#${collapseElement.id}"]`);
            if (trigger) {
                trigger.classList.remove('collapsed');
                trigger.setAttribute('aria-expanded', 'true');
            }
        }
    }
    
    collapseTriggers.forEach(setInitialIcon);

    // --- Click Event Handling ---
    collapseTriggers.forEach(trigger => {
        trigger.addEventListener('click', function() {
            const icon = this.querySelector('.fas[class*="fa-chevron-"]');
            if (icon) {
                icon.classList.toggle('fa-chevron-up');
                icon.classList.toggle('fa-chevron-down');
            }
        });
    });
});
</script>
@endpush

@push('styles')
<style>
    /* More robust fix for the layout jump issue */
    .sidebar-layout .position-sticky {
        /* Set height to fill viewport minus header (adjust 56px if needed) */
        height: calc(100vh - 56px); 
        /* Enable vertical scrolling ONLY on this container */
        overflow-y: auto;
        /* Keep it positioned correctly below the header */
        top: 56px; 
    }

    /* Smoother animation for the collapse itself */
    .sidebar-layout .collapse {
        transition: height 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Synchronized, smoother animation for the icon */
    .sidebar-layout .nav-link .fas[class*="fa-chevron-"] {
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-layout .collapse .nav-link {
        font-size: 0.9rem;
        padding: 0.5rem 1rem 0.5rem 2.5rem;
    }
    .sidebar-layout .collapse .nav-link.active {
        font-weight: bold;
        color: var(--primary-color);
    }
    .sidebar-layout .nav-link[data-bs-toggle="collapse"] {
        padding-right: 1rem;
    }
</style>
@endpush