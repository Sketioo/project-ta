@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Edit Fasilitas: {{ $facility->name }}</h1>
            </div>

            <div class="card">
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
                            <div class="form-text">Anda dapat memilih lebih dari satu foto untuk ditambahkan.</div>
                            @error('photos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                             @error('photos.*')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">Batal</a>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    Foto Saat Ini
                </div>
                <div class="card-body">
                    @if($facility->photos->isNotEmpty())
                        <div class="row g-3">
                            @foreach($facility->photos as $photo)
                                <div class="col-md-3">
                                    <div class="position-relative">
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
                        <p class="text-center text-muted">Tidak ada foto untuk fasilitas ini.</p>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
