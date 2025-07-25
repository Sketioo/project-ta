@extends('layouts.app')

@section('title', 'Fasilitas Program Studi')

@push('styles')
<style>
    .facility-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #e0e0e0;
        border-radius: 10px;
        overflow: hidden;
        height: 100%;
    }
    .facility-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .facility-image-container {
        width: 100%;
        height: 220px;
        overflow: hidden;
    }
    .facility-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .facility-card:hover .facility-image-container img {
        transform: scale(1.1);
    }
    .facility-card .card-body {
        background-color: #fff;
    }
    .facility-card .card-title {
        color: #333;
        font-weight: 600;
    }
    .section-header {
        padding: 80px 0 40px 0;
        text-align: center;
        background-color: #f8f9fa;
    }
    .section-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #343a40;
    }
    .section-header p {
        font-size: 1.2rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
    <!-- Header Section -->
    <section class="section-header">
        <div class="container">
            <h1>Fasilitas Kami</h1>
            <p>Ruang dan peralatan modern untuk mendukung proses belajar dan berkarya.</p>
        </div>
    </section>

    <!-- Facilities Section -->
    <section id="facilities" class="py-5">
        <div class="container">
            @if($facilities->isNotEmpty())
            <div class="row g-4">
                @foreach ($facilities as $facility)
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                    <div class="card facility-card w-100" onclick="window.location='{{ route('facilities.show', $facility->id) }}'" style="cursor: pointer;">
                        <div class="facility-image-container">
                            @if(!empty($facility->photos))
                                <img src="{{ asset('storage/' . $facility->photos[0]) }}" class="card-img-top" alt="{{ $facility->name }}">
                            @else
                                <img src="https://via.placeholder.com/400x220.png/1a1a1a/ffffff?text=TRPL" class="card-img-top" alt="No Image">
                            @endif
                        </div>
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $facility->name }}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="mt-5 d-flex justify-content-center">
                {{ $facilities->links() }}
            </div>
            @else
            <div class="empty-state text-center py-5">
                <i class="fas fa-door-closed fa-4x text-muted mb-3"></i>
                <h3 class="empty-state-text">Belum Ada Fasilitas</h3>
                <p class="empty-state-subtext">Informasi mengenai fasilitas akan segera diperbarui.</p>
            </div>
            @endif
        </div>
    </section>
@endsection
