@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Tambah Pengumuman Baru</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Pengumuman</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.announcements.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Pengumuman</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <select class="form-select @error('category') is-invalid @enderror" id="category" name="category" required>
                                <option value="">Pilih Kategori</option>
                                <option value="akademik" {{ old('category') == 'akademik' ? 'selected' : '' }}>Akademik</option>
                                <option value="non-akademik" {{ old('category') == 'non-akademik' ? 'selected' : '' }}>Non-Akademik</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Konten Pengumuman</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_published" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_published">Publikasikan Pengumuman</label>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.announcements.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
