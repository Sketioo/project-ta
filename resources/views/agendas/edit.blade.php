@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Agenda</h1>
            </div>

            <div class="card shadow mb-4 custom-form-card">
                <div class="card-header py-3 custom-form-header">
                    <h6 class="m-0 font-weight-bold text-white">Form Edit Agenda</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.agendas.update', $agenda->id) }}" method="POST" enctype="multipart/form-data" class="agenda-form">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label custom-form-label">Judul Agenda</label>
                                    <input type="text" class="form-control custom-form-input" id="title" name="title" value="{{ old('title', $agenda->title) }}" required>
                                    @error('title')
                                        <div class="text-danger custom-form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label custom-form-label">Tanggal</label>
                                    <input type="date" class="form-control custom-form-input" id="date" name="date" value="{{ old('date', $agenda->date->format('Y-m-d')) }}" required>
                                    @error('date')
                                        <div class="text-danger custom-form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label custom-form-label">Lokasi</label>
                            <input type="text" class="form-control custom-form-input" id="location" name="location" value="{{ old('location', $agenda->location) }}" required>
                            @error('location')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="link_terkait" class="form-label">Link Terkait (Opsional)</label>
                            <input type="url" class="form-control @error('link_terkait') is-invalid @enderror" id="link_terkait" name="link_terkait" value="{{ old('link_terkait', $agenda->link_terkait) }}" placeholder="https://contoh.com/pendaftaran">
                            @error('link_terkait')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label custom-form-label">Deskripsi</label>
                            <textarea class="form-control custom-form-input" id="description" name="description" rows="5" required>{{ old('description', $agenda->description) }}</textarea>
                            @error('description')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" {{ old('is_published', $agenda->is_published) ? 'checked' : '' }}>
                            <label class="form-check-label custom-form-label" for="is_published">Publikasikan Agenda</label>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label custom-form-label">Ganti Gambar Agenda (Pilih baru untuk mengganti)</label>
                            <input type="file" class="form-control custom-form-input" id="images" name="images[]" multiple accept="image/*">
                            @error('images.*')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                            <div id="image-preview-container" class="mt-3 row">
                                @if($agenda->images && count($agenda->images) > 0)
                                    @foreach($agenda->images as $imagePath)
                                        <div class="col-md-3 mb-3">
                                            <img src="{{ asset('storage/' . $imagePath) }}" alt="Agenda Image" class="img-thumbnail img-fluid rounded" style="height: 100px; object-fit: cover;">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary custom-submit-btn">Update Agenda</button>
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
        const imageInput = document.getElementById('images');
        const imagePreviewContainer = document.getElementById('image-preview-container');

        imageInput.addEventListener('change', function () {
            // Clear previous previews, but keep existing images if no new files are selected
            if (this.files.length > 0) {
                imagePreviewContainer.innerHTML = ''; 
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
                        imagePreviewContainer.appendChild(colDiv);
                    };

                    reader.readAsDataURL(file);
                });
            }
        });
    });
</script>
@endpush
