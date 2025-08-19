@extends('layouts.app')

@section('title', __('messages.facilities') . ' - Sistem Informasi Prodi TRPL')

@section('content')
<section class="facility-section">
    <div class="container">

        <div class="section-title-container">
            <h2>{{ __('messages.facilities') }}</h2>
            <p>{{ __('messages.facilities_description') }}</p>
        </div>

        @if($facilities->isNotEmpty())
            <div class="facility-grid">
                @foreach ($facilities as $facility)
                    <div class="facility-card">
                        <div class="card-img-container">
                            @if($facility->photos && !empty($facility->photos[0]))
                                <img src="{{ asset('storage/' . $facility->photos[0]) }}" class="card-img" alt="{{ $facility->name }}">
                            @else
                                <div class="facility-placeholder">
                                    <span>{{ __('messages.image_not_available') }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $facility->name }}</h3>
                            <p class="card-text">{{ Str::limit($facility->description, 120) }}</p>
                            <a href="{{ route('facilities.show', $facility->id) }}" class="btn btn-primary">{{ __('messages.view_details') }}</a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($facilities->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $facilities->links() }}
                </div>
            @endif
        @else
            <div class="empty-state-container">
                <div class="icon">
                    <i class="fas fa-building-circle-xmark"></i>
                </div>
                <h3>{{ __('messages.facilities_not_available') }}</h3>
                <p>{{ __('messages.facilities_not_available_message') }}</p>
            </div>
        @endif

    </div>
</section>
@endsection