@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .image-preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
    }
    .image-preview-item {
        position: relative;
        width: 150px;
        height: 150px;
    }
    .image-preview-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Tambah Kurikulum Baru</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Kurikulum</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.curriculums.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kurikulum</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required placeholder="Contoh: Kurikulum 2024">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Gambar Struktur Kurikulum</label>
                            <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror" multiple>
                            <small class="form-text text-muted">Anda bisa memilih lebih dari satu gambar. Format: JPG, PNG. Maks 2MB per gambar.</small>
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div id="image-preview-container" class="image-preview-container"></div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" checked>
                                <label class="form-check-label" for="is_visible">Tampilkan di Navigasi</label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.curriculums.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Kurikulum
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#images').on('change', function(event) {
            const previewContainer = $('#image-preview-container');
            previewContainer.empty(); // Clear previous previews
            
            const files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    if (!file.type.startsWith('image/')) { return; }

                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const previewItem = `
                            <div class="image-preview-item">
                                <img src="${e.target.result}" alt="${file.name}">
                            </div>
                        `;
                        previewContainer.append(previewItem);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endpush
