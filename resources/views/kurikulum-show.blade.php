@extends('layouts.app')

@push('styles')
<style>
    .kurikulum-body {
        background-color: #f8f9fa;
        padding: 3rem 0;
    }
    .kurikulum-title-container {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .kurikulum-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--dark-color);
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }
    .kurikulum-title::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 100px;
        height: 4px;
        background-color: var(--primary-color);
        border-radius: 2px;
    }
    .kurikulum-description {
        font-size: 1.1rem;
        color: #6c757d;
        margin-top: 1rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .page-content-container {
        max-width: 900px;
        margin: 0 auto;
        background-color: #fff;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.07);
    }
    .kurikulum-image-card {
        margin-bottom: 2rem;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.08);
        border: 1px solid #e9ecef;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .kurikulum-image-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
    }
    .kurikulum-image-card .card-header {
        background-color: #fff;
        font-weight: 600;
        color: var(--dark-color);
        border-bottom: 1px solid #e9ecef;
    }
    .kurikulum-image-card .card-body {
        padding: 0;
    }
    .kurikulum-image-card img {
        width: 100%;
        height: auto;
        display: block;
    }
    .empty-state-kurikulum {
        text-align: center;
        padding: 3rem;
    }
</style>
@endpush

@section('content')
<div class="kurikulum-body">
    <div class="container">
        <div class="kurikulum-title-container">
            <h1 class="kurikulum-title">{{ $curriculum->name }}</h1>
            @if($curriculum->description)
                <p class="kurikulum-description">{{ $curriculum->description }}</p>
            @endif
        </div>

        <div class="page-content-container">
            @if($curriculum->images->isNotEmpty())
                <div class="kurikulum-gallery">
                    @foreach($curriculum->images as $index => $image)
                        <div class="card kurikulum-image-card">
                            <div class="card-header">
                                Struktur Kurikulum - Bagian {{ $index + 1 }}
                            </div>
                            <div class="card-body">
                                <a href="{{ Storage::url($image->image_path) }}" data-toggle="lightbox" data-gallery="kurikulum-gallery">
                                    <img src="{{ Storage::url($image->image_path) }}" class="img-fluid" alt="Gambar Kurikulum {{ $curriculum->name }} bagian {{ $index + 1 }}">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state-kurikulum">
                    <p class="h5 text-muted">Tidak ada gambar struktur kurikulum yang tersedia saat ini.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush

