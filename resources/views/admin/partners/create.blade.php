@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .card-header {
        background-color: #4a5568;
        color: white;
    }
    .btn-primary {
        background-color: #4299e1;
        border-color: #4299e1;
    }
    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }
    #logo-preview-container {
        margin-top: 15px;
        text-align: center;
    }
    #logo-preview {
        max-width: 200px;
        max-height: 200px;
        border: 1px solid #ddd;
        padding: 5px;
        border-radius: 4px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="dashboard-title">Manajemen Mitra</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Tambah Mitra Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Mitra</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website_url" class="form-label">URL Situs Web</label>
                            <input type="url" name="website_url" id="website_url" class="form-control @error('website_url') is-invalid @enderror" value="{{ old('website_url') }}">
                            @error('website_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo Mitra</label>
                            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" required>
                            <small class="form-text text-muted">Format: JPG, PNG, GIF, SVG. Maks 2MB. Dimensi disarankan 1:1 (persegi).</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="logo-preview-container" style="display:none;">
                                <img id="logo-preview" src="#" alt="Pratinjau Logo" />
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" checked>
                                <label class="form-check-label" for="is_visible">Tampilkan di Halaman Utama</label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Mitra
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
        $('#logo').on('change', function(event) {
            const [file] = this.files;
            if (file) {
                const previewContainer = $('#logo-preview-container');
                const previewImage = $('#logo-preview');
                
                previewImage.attr('src', URL.createObjectURL(file));
                previewContainer.show();

                previewImage.on('load', function() {
                    URL.revokeObjectURL(previewImage.attr('src')); // Free memory
                });
            }
        });
    });
</script>
@endpush