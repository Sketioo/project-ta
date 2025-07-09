@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Agenda</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="{{ route('agendas.edit', $agenda->id) }}" class="btn btn-warning custom-edit-btn"><i class="fas fa-edit me-2"></i>Edit</a>
            <a href="{{ route('agendas.index') }}" class="btn btn-secondary custom-back-btn ms-2"><i class="fas fa-arrow-left me-2"></i>Kembali</a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4 agenda-detail-card">
                <div class="card-header py-3 agenda-detail-header">
                    <h4 class="m-0 font-weight-bold text-white">{{ $agenda->title }}</h4>
                </div>
                <div class="card-body agenda-detail-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1 agenda-detail-info"><i class="fas fa-calendar-alt me-2 text-primary"></i><strong>Tanggal:</strong> {{ $agenda->date->format('d F Y') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1 agenda-detail-info"><i class="fas fa-map-marker-alt me-2 text-primary"></i><strong>Lokasi:</strong> {{ $agenda->location }}</p>
                        </div>
                    </div>

                    <h5 class="mt-4 mb-2 agenda-section-title">Deskripsi:</h5>
                    <p class="agenda-description-text">{{ $agenda->description }}</p>

                    <h5 class="mt-4 mb-2 agenda-section-title">Status Publikasi:</h5>
                    <p>
                        @if($agenda->is_published)
                            <span class="badge bg-success agenda-status-badge">Published</span>
                        @else
                            <span class="badge bg-warning text-dark agenda-status-badge">Draft</span>
                        @endif
                    </p>

                    @if($agenda->images && count($agenda->images) > 0)
                        <h5 class="mt-4 mb-3 agenda-section-title">Gambar Agenda:</h5>
                        <div class="row agenda-image-gallery">
                            @foreach($agenda->images as $imagePath)
                                <div class="col-md-4 mb-3">
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Agenda Image" class="img-fluid rounded shadow-sm agenda-detail-img">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">Tidak ada gambar untuk agenda ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</main>
    </div>
</div>
@endsection
