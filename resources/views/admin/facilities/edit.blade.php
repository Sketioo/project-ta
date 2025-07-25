@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@push('styles')
<style>
.delete-photo-label {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
    background-color: rgba(255, 255, 255, 0.8);
    border-radius: 0.25rem;
    padding: 0.25rem 0.5rem;
}
.delete-photo-label input[type="checkbox"] {
    margin-right: 0.5rem;
}
.current-photo-container img.to-be-deleted {
    opacity: 0.4;
    border: 2px solid #dc3545;
}
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3 mb-4">
                <h1 class="page-title">Edit Fasilitas</h1>
            </div>

            <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Formulir Edit: {{ $facility->name }}</h5>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Kelola Foto</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Foto Saat Ini</label>
                            @if(!empty($facility->photos))
                                <div class="row g-3">
                                    @foreach($facility->photos as $photoPath)
                                        <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                                            <div class="position-relative current-photo-container">
                                                <img src="{{ asset('storage/' . $photoPath) }}" class="img-fluid rounded" alt="Foto fasilitas">
                                                <label class="delete-photo-label">
                                                    <input type="checkbox" name="deleted_photos[]" value="{{ $photoPath }}" onchange="this.closest('.current-photo-container').querySelector('img').classList.toggle('to-be-deleted', this.checked)"> Hapus
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-center text-muted mb-0">Tidak ada foto untuk fasilitas ini.</p>
                            @endif
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="photos" class="form-label">Tambah Foto Baru</label>
                            <input type="file" class="form-control @error('photos.*') is-invalid @enderror" id="photos" name="photos[]" multiple>
                            <div class="form-text">Anda dapat memilih lebih dari satu foto untuk ditambahkan.</div>
                            @error('photos.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-0">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                    <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection
