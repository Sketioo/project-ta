@extends('layouts.app')

@section('title', 'Sistem Informasi Prodi')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section hero-background text-white text-center d-flex align-items-center justify-content-center position-relative">
        <div class="hero-overlay position-absolute w-100 h-100"></div>
        <div class="container position-relative z-1">
            <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Teknologi Rekayasa Perangkat Lunak</h1>
            <p class="lead mb-5 animate__animated animate__fadeInUp">Mencetak talenta digital yang kreatif, inovatif, dan berdaya saing global.</p>
            <a href="#contact" class="btn btn-light btn-lg rounded-pill animate__animated animate__zoomIn">Hubungi Kami</a>
        </div>
    </section>

    <!-- Mitra Section -->
    <section id="mitra" class="py-5 bg-light" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="text-center section-title mb-5">Mitra Program Studi</h2>
            @if($partners->isNotEmpty())
                <div id="mitraCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $chunkedPartners = $partners->chunk(6); // 6 logos per slide
                        @endphp

                        @foreach ($chunkedPartners as $key => $chunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row justify-content-center align-items-center g-4">
                                @foreach ($chunk as $partner)
                                <div class="col-6 col-md-4 col-lg-2 text-center">
                                    <div class="partner-logo-wrapper">
                                        <a href="{{ $partner->website_url ?? '#' }}" target="_blank" rel="noopener noreferrer" title="{{ $partner->name }}">
                                            <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" class="img-fluid mx-auto">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if(count($chunkedPartners) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#mitraCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mitraCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @else
                <p class="text-center text-muted">Belum ada mitra yang terdaftar.</p>
            @endif
        </div>
    </section>

    <!-- Prestasi Section -->
    <section id="prestasi" class="py-5" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="text-center section-title mb-5">Prestasi Mahasiswa</h2>
            <div id="achievementCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $chunkedAchievements = $achievements->chunk(3); // 3 cards per slide
                    @endphp

                    @forelse ($chunkedAchievements as $key => $chunk)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach ($chunk as $achievement)
                            <div class="col-md-4">
                                <div class="card h-100 achievement-card">
                                    <div class="achievement-image-container">
                                        @if($achievement->photo_path)
                                            <img src="{{ asset('storage/' . $achievement->photo_path) }}" class="card-img-top" alt="{{ $achievement->title }}">
                                        @else
                                            <img src="https://via.placeholder.com/400x200.png/cccccc/ffffff?text=No+Image" class="card-img-top" alt="No Image">
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $achievement->title }}</h5>
                                        <p class="card-text text-muted">{{ Str::limit($achievement->description, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @empty
                    <div class="carousel-item active">
                        <div class="col-12">
                            <p class="text-center">Belum ada prestasi mahasiswa yang ditampilkan.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#achievementCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#achievementCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Dokumen Section -->
    <section id="dokumen" class="py-5 bg-light" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="text-center section-title mb-5">Dokumen Penting</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            @if($documents->isNotEmpty())
                                <ul class="list-group list-group-flush">
                                    @foreach($documents as $document)
                                    <li class="list-group-item d-flex justify-content-between align-items-center document-list-item">
                                        <span class="document-title">{{ $document->title }}</span>
                                        <a href="{{ Storage::url($document->file_path) }}" class="btn btn-sm btn-outline-primary document-download-btn" download>
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-center text-muted mb-0">Belum ada dokumen yang tersedia.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection