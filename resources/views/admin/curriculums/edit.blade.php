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
    .delete-image-btn {
        position: absolute;
        top: 5px;
        right: 5px;
        background-color: rgba(231, 76, 60, 0.8);
        color: white;
        border: none;
        border-radius: 50%;
        width: 25px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .delete-image-btn:hover {
        background-color: #e74c3c;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Edit Kurikulum</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Kurikulum</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.curriculums.update', $curriculum->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Kurikulum</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $curriculum->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi (Opsional)</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $curriculum->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Tambah Gambar Baru</label>
                            <input type="file" name="images[]" id="images" class="form-control @error('images.*') is-invalid @enderror" multiple>
                            <small class="form-text text-muted">Anda bisa memilih lebih dari satu gambar untuk ditambahkan. Format: JPG, PNG. Maks 2MB per gambar.</small>
                            @error('images.*')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <div id="image-preview-container" class="image-preview-container"></div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label>
                            <div class="image-preview-container">
                                @forelse ($curriculum->images as $image)
                                    <div class="image-preview-item" id="image-{{ $image->id }}">
                                        <img src="{{ Storage::url($image->image_path) }}" alt="Gambar Kurikulum">
                                        <button type="button" class="delete-image-btn" data-image-id="{{ $image->id }}">&times;</button>
                                    </div>
                                @empty
                                    <p class="text-muted">Tidak ada gambar.</p>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" {{ $curriculum->is_visible ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_visible">Tampilkan di Navigasi</label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.curriculums.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Perubahan
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
        // Preview for new images
        $('#images').on('change', function(event) {
            const previewContainer = $('#image-preview-container');
            previewContainer.empty();
            const files = event.target.files;
            if (files) {
                Array.from(files).forEach(file => {
                    if (!file.type.startsWith('image/')) { return; }
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewContainer.append(`<div class="image-preview-item"><img src="${e.target.result}"></div>`);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });

        // AJAX delete for existing images
        $('.delete-image-btn').on('click', function() {
            if (!confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                return;
            }

            const button = $(this);
            const imageId = button.data('image-id');
            const url = `/admin/curriculum-images/${imageId}`;

            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        $(`#image-${imageId}`).remove();
                        alert('Gambar berhasil dihapus.');
                    } else {
                        alert('Gagal menghapus gambar.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Gagal menghapus gambar.');
                }
            });
        });
    });
</script>
@endpush
