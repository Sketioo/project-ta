@extends('layouts.app')

@section('title', 'Tambah Fasilitas Baru')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3 mb-4">
                <h1 class="page-title">Tambah Fasilitas Baru</h1>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Formulir Fasilitas</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="person_in_charge" class="form-label">Penanggung Jawab (Opsional)</label>
                            <input type="text" class="form-control @error('person_in_charge') is-invalid @enderror" id="person_in_charge" name="person_in_charge" value="{{ old('person_in_charge') }}">
                            @error('person_in_charge')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photos" class="form-label">Foto Fasilitas</label>
                            <input type="file" class="form-control @error('photos') is-invalid @enderror" id="photos" name="photos[]" multiple required>
                            <div class="form-text">Anda dapat memilih lebih dari satu foto. Pastikan foto memiliki rasio 4:3 atau 16:9 untuk tampilan terbaik.</div>
                            @error('photos')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                             @error('photos.*')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Simpan</button>
                            <a href="{{ route('admin.facilities.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
