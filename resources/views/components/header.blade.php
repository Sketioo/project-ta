<header class="navbar navbar-expand-lg navbar-light shadow-sm sticky-top custom-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><i class="fas fa-graduation-cap me-2"></i>Prodi TRPL</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/"><i class="fas fa-home me-1"></i>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/agenda"><i class="fas fa-calendar-alt me-1"></i>Agenda & Kegiatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#prestasi"><i class="fas fa-trophy me-1"></i>Prestasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#dokumen"><i class="fas fa-file-alt me-1"></i>Dokumen</a>
                </li>
            </ul>
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-outline-primary custom-login-btn"><i class="fas fa-sign-in-alt me-1"></i>Login</a>
            </div>
        </div>
    </div>
</header>
