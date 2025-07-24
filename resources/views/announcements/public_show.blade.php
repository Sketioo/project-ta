@extends('layouts.app')

@section('title', $announcement->title)

@section('content')
    <div class="container py-5 announcement-detail-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <article class="announcement-article" data-animation="animate__fadeInUp">
                    <h1 class="announcement-article-title text-center mb-3">{{ $announcement->title }}</h1>
                    <div class="announcement-article-meta text-center text-muted mb-5">
                        <i class="fas fa-tag me-1"></i> {{ ucfirst($announcement->category) }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-clock me-1"></i> {{ $announcement->created_at->format('d F Y') }}
                    </div>

                    @if($announcement->photos_path && count($announcement->photos_path) > 0)
                        @if(count($announcement->photos_path) > 1)
                            <div id="announcementCarousel" class="carousel slide announcement-carousel mb-4" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach($announcement->photos_path as $index => $photoPath)
                                        <button type="button" data-bs-target="#announcementCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach($announcement->photos_path as $index => $photoPath)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $photoPath) }}" class="d-block w-100" alt="{{ $announcement->title }} Image {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#announcementCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#announcementCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div class="announcement-article-main-image mb-4">
                                <img src="{{ asset('storage/' . $announcement->photos_path[0]) }}" alt="{{ $announcement->title }}" class="img-fluid rounded shadow-sm">
                            </div>
                        @endif
                    @else
                        <div class="announcement-article-main-image mb-4">
                            <img src="https://via.placeholder.com/800x400.png/cccccc/ffffff?text=No+Image" alt="No Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endif

                    <div class="announcement-article-content mb-5">
                        <p>{{ $announcement->content }}</p>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('announcements.public.index') }}" class="btn btn-outline-secondary announcement-back-btn" data-animation="animate__fadeInUp" data-animation-delay="0.2s"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Pengumuman</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
