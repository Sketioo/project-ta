@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3 mb-4">
                <h1 class="page-title">Edit Fasilitas</h1>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Formulir Edit: {{ $facility->name }}</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $facility->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $facility->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="person_in_charge" class="form-label">Penanggung Jawab (Opsional)</label>
                            <input type="text" class="form-control @error('person_in_charge') is-invalid @enderror" id="person_in_charge" name="person_in_charge" value="{{ old('person_in_charge', $facility->person_in_charge) }}">
                            @error('person_in_charge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photos" class="form-label">Tambah Foto Baru</label>
                            <input type="file" class="form-control @error('photos') is-invalid @enderror" id="photos" name="photos[]" multiple>
                            <div class="form-text">Anda dapat memilih lebih dari satu foto untuk ditambahkan. Biarkan kosong jika tidak ingin menambah foto.</div>
                            @error('photos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                             @error('photos.*')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                            <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Foto Saat Ini</h5>
                </div>
                <div class="card-body">
                    @if($facility->photos->isNotEmpty())
                        <div class="row g-3">
                            @foreach($facility->photos as $photo)
                                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                    <div class="position-relative current-photo-container">
                                        <img src="{{ asset('storage/' . $photo->photo_path) }}" class="img-fluid rounded" alt="Foto fasilitas">
                                        <form action="{{ route('admin.facilities.photo.destroy', $photo->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1" title="Hapus Foto">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-muted mb-0">Tidak ada foto untuk fasilitas ini.</p>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('styles')
<style>
.current-photo-container {
    transition: transform 0.2s ease-in-out;
}
.current-photo-container:hover {
    transform: scale(1.05);
}
.current-photo-container .btn-danger {
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
}
.current-photo-container:hover .btn-danger {
    opacity: 1;
}
</style>
@endpush
