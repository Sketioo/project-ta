@extends('layouts.app')

@push('styles')
<style>
    .kurikulum-header {
        background-color: #f8f9fa;
        padding: 3rem 0;
        text-align: center;
        margin-bottom: 3rem;
    }
    .kurikulum-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark-color);
    }
    .kurikulum-description {
        font-size: 1.1rem;
        color: #6c757d;
        max-width: 800px;
        margin: 0.5rem auto 0;
    }
    .kurikulum-gallery {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    .kurikulum-image-wrapper {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .kurikulum-image-wrapper:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.15);
    }
    .kurikulum-image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
    }
</style>
@endpush

@section('content')
<div class="kurikulum-header">
    <div class="container">
        <h1 class="kurikulum-title">{{ $curriculum->name }}</h1>
        @if($curriculum->description)
            <p class="kurikulum-description">{{ $curriculum->description }}</p>
        @endif
    </div>
</div>

<div class="container mb-5">
    @if($curriculum->images->isNotEmpty())
        <div class="kurikulum-gallery">
            @foreach($curriculum->images as $image)
                <a href="{{ Storage::url($image->image_path) }}" data-toggle="lightbox" data-gallery="kurikulum-gallery">
                    <div class="kurikulum-image-wrapper">
                        <img src="{{ Storage::url($image->image_path) }}" class="img-fluid" alt="Gambar Kurikulum {{ $curriculum->name }}">
                    </div>
                </a>
            @endforeach
        </div>
    @else
        <div class="text-center py-5">
            <p class="text-muted">Tidak ada gambar yang tersedia untuk kurikulum ini.</p>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush
