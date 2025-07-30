@extends('layouts.app')

@section('title', $facility->name)

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/custom-facility-show.css') }}">
@endpush

@section('content')
<section class="facility-show-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">

                <div class="facility-container">

                    <div class="facility-header text-center">
                        <h1>{{ $facility->name }}</h1>
                    </div>

                    <!-- Facility Photos Carousel -->
                    @if(!empty($facility->photos))
                        <div id="facilityCarousel" class="carousel slide facility-gallery mb-5" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @foreach($facility->photos as $key => $photoPath)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $photoPath) }}" alt="{{ $facility->name }} - Foto {{ $key + 1 }}">
                                    </div>
                                @endforeach
                            </div>
                            @if(count($facility->photos) > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#facilityCarousel" data-bs-slide="prev">
                                <i class="fas fa-chevron-left"></i>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#facilityCarousel" data-bs-slide="next">
                                <i class="fas fa-chevron-right"></i>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                        </div>
                    @endif

                    <!-- Facility Information -->
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            @if($facility->person_in_charge)
                                <div class="info-box">
                                    <p>
                                        <i class="fas fa-user-shield me-2"></i>
                                        <strong>Penanggung Jawab:</strong> {{ $facility->person_in_charge }}
                                    </p>
                                </div>
                            @endif

                            <div class="facility-description">
                                {!! nl2br(e($facility->description)) !!}
                            </div>

                            <div class="mt-4 text-center">
                                <a href="{{ route('facilities.index') }}" class="btn btn-back">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
@endsection