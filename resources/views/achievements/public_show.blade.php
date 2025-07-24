@extends('layouts.app')

@section('title', $achievement->nama_kompetisi . ' - ' . $achievement->prestasi)

@section('content')
    <div class="container py-5 agenda-detail-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <article class="agenda-article" data-animation="animate__fadeInUp">
                    <h1 class="agenda-article-title text-center mb-3">{{ $achievement->nama_kompetisi }} - {{ $achievement->prestasi }}</h1>
                    <div class="agenda-article-meta text-center text-muted mb-5">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $achievement->tanggal_pelaksanaan->format('d F Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-trophy me-1"></i> {{ $achievement->tingkat_kompetisi }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-building me-1"></i> {{ $achievement->penyelenggara }}
                    </div>

                    @if($achievement->photos_dokumentasi && count($achievement->photos_dokumentasi) > 0)
                        @if(count($achievement->photos_dokumentasi) > 1)
                            <div id="achievementCarousel" class="carousel slide agenda-carousel mb-4" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach($achievement->photos_dokumentasi as $index => $photoPath)
                                        <button type="button" data-bs-target="#achievementCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach($achievement->photos_dokumentasi as $index => $photoPath)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $photoPath) }}" class="d-block w-100" alt="Dokumentasi Prestasi {{ $achievement->nama_kompetisi }} Image {{ $index + 1 }}">
                                        </div>
                                    @endforeach
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
                        @else
                            <div class="agenda-article-main-image mb-4">
                                <img src="{{ asset('storage/' . $achievement->photos_dokumentasi[0]) }}" alt="{{ $achievement->nama_kompetisi }}" class="img-fluid rounded shadow-sm">
                            </div>
                        @endif
                    @else
                        <div class="agenda-article-main-image mb-4">
                            <img src="https://via.placeholder.com/800x400.png/cccccc/ffffff?text=No+Image" alt="No Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endif

                    <div class="agenda-article-content mb-5">
                        <p>{{ $achievement->keterangan_lomba }}</p>
                    </div>

                    

                    <div class="text-center mt-5">
                        <a href="{{ route('home') }}#prestasi" class="btn btn-outline-secondary agenda-back-btn" data-animation="animate__fadeInUp" data-animation-delay="0.2s"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Prestasi</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
