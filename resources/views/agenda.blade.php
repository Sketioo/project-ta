@extends('layouts.app')

@section('title', 'Agenda & Kegiatan')

@section('content')
    <div class="container py-5">
        <h1 class="text-center section-title mb-5">Agenda & Kegiatan</h1>
        <div class="row g-4">
            @forelse($agendas as $agenda)
            <div class="col-md-4 agenda-card-wrapper" data-animation="animate__fadeInUp">
                <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden agenda-card">
                    <div class="agenda-image-container">
                        @if($agenda->images && count($agenda->images) > 0)
                            <img src="{{ asset('storage/' . $agenda->images[0]) }}" class="card-img-top" alt="{{ $agenda->title }}">
                        @else
                            <img src="https://via.placeholder.com/400x250.png/cccccc/ffffff?text=No+Image" class="card-img-top" alt="No Image">
                        @endif
                    </div>
                    <div class="card-body d-flex flex-column agenda-card-body">
                        <h5 class="card-title fw-bold text-primary">{{ $agenda->title }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($agenda->description, 100) }}</p>
                        <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>Tanggal: {{ $agenda->date->format('d M Y') }}</small></p>
                        <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Lokasi: {{ $agenda->location }}</small></p>
                        <a href="{{ route('agenda.show.public', $agenda->id) }}" class="btn btn-outline-primary mt-auto agenda-read-more-btn">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>Tidak ada agenda yang tersedia saat ini. Silakan cek kembali nanti!
                </div>
            </div>
            @endforelse
        </div>
    </div>
@endsection
