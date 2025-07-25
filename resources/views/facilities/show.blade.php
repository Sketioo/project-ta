@extends('layouts.app')

@section('title', $facility->name)

@push('styles')
<style>
    .facility-detail-section {
        padding: 60px 0;
    }
    .facility-carousel .carousel-item img {
        width: 100%;
        height: 500px;
        object-fit: cover;
        border-radius: 10px;
    }
    .facility-carousel .carousel-control-prev-icon,
    .facility-carousel .carousel-control-next-icon {
        background-color: rgba(0, 0, 0, 0.5);
        border-radius: 50%;
    }
    .facility-info h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
    }
    .facility-info .description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 30px;
    }
    .person-in-charge {
        background-color: #f8f9fa;
        padding: 15px 20px;
        border-radius: 8px;
        border-left: 5px solid #0d6efd;
    }
</style>
@endpush

@section('content')
<div class="container facility-detail-section">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Facility Photos Carousel -->
            @if($facility->photos->isNotEmpty())
                <div id="facilityCarousel" class="carousel slide facility-carousel mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($facility->photos as $key => $photo)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $photo->photo_path) }}" alt="{{ $facility->name }} - Foto {{ $key + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    @if($facility->photos->count() > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#facilityCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#facilityCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @endif

            <!-- Facility Information -->
            <div class="facility-info">
                <h1>{{ $facility->name }}</h1>
                <div class="description">
                    {!! nl2br(e($facility->description)) !!}
                </div>

                @if($facility->person_in_charge)
                    <div class="person-in-charge">
                        <p class="mb-0"><strong><i class="fas fa-user-shield me-2"></i>Penanggung Jawab:</strong> {{ $facility->person_in_charge }}</p>
                    </div>
                @endif

                <div class="mt-4">
                    <a href="{{ route('facilities.index') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Fasilitas</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
