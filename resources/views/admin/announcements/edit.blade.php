@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Pengumuman</h1>
            </div>

            <div class="card shadow mb-4 custom-form-card">
                <div class="card-header py-3 custom-form-header">
                    <h6 class="m-0 font-weight-bold text-white">Form Edit Pengumuman</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data" class="announcement-form">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label custom-form-label">Judul Pengumuman</label>
                            <input type="text" class="form-control custom-form-input" id="title" name="title" value="{{ old('title', $announcement->title) }}" required>
                            @error('title')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="akademik" {{ old('category', $announcement->category) == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="non-akademik" {{ old('category', $announcement->category) == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label custom-form-label">Konten Pengumuman</label>
                            <textarea class="form-control custom-form-input" id="content" name="content" rows="8" required>{{ old('content', $announcement->content) }}</textarea>
                            @error('content')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Ganti Foto Pengumuman (Opsional)</label>
                            <input type="file" name="photos[]" id="photos" class="form-control @error('photos.*') is-invalid @enderror" accept="image/*" multiple>
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti foto. Format: JPG, PNG, GIF, SVG. Maks 2MB per foto. Dimensi disarankan 16:9.</small>
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="photos-preview-container" class="mt-3 row">
                                @if($announcement->photos_path && count($announcement->photos_path) > 0)
                                    @foreach($announcement->photos_path as $photoPath)
                                        <div class="col-md-3 mb-3">
                                            <img src="{{ Storage::url($photoPath) }}" alt="Pengumuman Image" class="img-thumbnail img-fluid rounded" style="height: 100px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ old('is_published', $announcement->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label custom-form-label" for="is_published">Publikasikan Pengumuman</label>
                        </div>

                        <button type="submit" class="btn btn-primary custom-submit-btn">Perbarui Pengumuman</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const photosInput = document.getElementById('photos');
        const photosPreviewContainer = document.getElementById('photos-preview-container');

        photosInput.addEventListener('change', function () {
            // Clear previous previews, but keep existing images if no new files are selected
            if (this.files.length > 0) {
                photosPreviewContainer.innerHTML = ''; 
            }

            if (this.files) {
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();

                    reader.onload = function (e) {
                        const colDiv = document.createElement('div');
                        colDiv.classList.add('col-md-3', 'mb-3');

                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail', 'img-fluid', 'rounded');
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';

                        colDiv.appendChild(img);
                        photosPreviewContainer.appendChild(colDiv);
                    };

                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endpush
