@extends('layouts.app')

@section('title', $agenda->title)

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <article class="agenda-article">
                    <h1 class="agenda-article-title text-center mb-3">{{ $agenda->title }}</h1>
                    <div class="agenda-article-meta text-center text-muted mb-5">
                        <i class="fas fa-calendar-alt me-1"></i> {{ $agenda->date->format('d F Y') }}
                        <span class="mx-2">•</span>
                        <i class="fas fa-map-marker-alt me-1"></i> {{ $agenda->location }}
                    </div>

                    @if($agenda->images && count($agenda->images) > 0)
                        @if(count($agenda->images) > 1)
                            <div id="agendaCarousel" class="carousel slide agenda-carousel mb-4" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    @foreach($agenda->images as $index => $imagePath)
                                        <button type="button" data-bs-target="#agendaCarousel" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                                <div class="carousel-inner">
                                    @foreach($agenda->images as $index => $imagePath)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $imagePath) }}" class="d-block w-100" alt="{{ $agenda->title }} Image {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#agendaCarousel" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#agendaCarousel" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <div class="agenda-article-main-image mb-4">
                                <img src="{{ asset('storage/' . $agenda->images[0]) }}" alt="{{ $agenda->title }}" class="img-fluid rounded shadow-sm">
                            </div>
                        @endif
                    @else
                        <div class="agenda-article-main-image mb-4">
                            <img src="https://via.placeholder.com/800x400.png/cccccc/ffffff?text=No+Image" alt="No Image" class="img-fluid rounded shadow-sm">
                        </div>
                    @endif

                    <div class="agenda-article-content mb-5">
                        <p>{{ $agenda->description }}</p>
                    </div>

                    <div class="text-center mt-5">
                        <a href="{{ route('agenda') }}" class="btn btn-outline-secondary agenda-back-btn"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Agenda</a>
                    </div>
                </article>
            </div>
        </div>
    </div>
@endsection
