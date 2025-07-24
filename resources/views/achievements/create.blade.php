@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Ajukan Prestasi</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Pengajuan Prestasi</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nim" class="form-label">NIM</label>
                                <input type="text" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" value="{{ old('nim', Auth::user()->nim ?? '') }}" required>
                                @error('nim')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', Auth::user()->name ?? '') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_kompetisi" class="form-label">Nama Kompetisi</label>
                                <input type="text" class="form-control @error('nama_kompetisi') is-invalid @enderror" id="nama_kompetisi" name="nama_kompetisi" value="{{ old('nama_kompetisi') }}" required>
                                @error('nama_kompetisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="tingkat_kompetisi" class="form-label">Tingkat Kompetisi</label>
                                <input type="text" class="form-control @error('tingkat_kompetisi') is-invalid @enderror" id="tingkat_kompetisi" name="tingkat_kompetisi" value="{{ old('tingkat_kompetisi') }}" required>
                                @error('tingkat_kompetisi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="penyelenggara" class="form-label">Penyelenggara</label>
                                <input type="text" class="form-control @error('penyelenggara') is-invalid @enderror" id="penyelenggara" name="penyelenggara" value="{{ old('penyelenggara') }}" required>
                                @error('penyelenggara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="prestasi" class="form-label">Prestasi</label>
                                <input type="text" class="form-control @error('prestasi') is-invalid @enderror" id="prestasi" name="prestasi" value="{{ old('prestasi') }}" required>
                                @error('prestasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tanggal_pelaksanaan" class="form-label">Tanggal Pelaksanaan</label>
                                <input type="date" class="form-control @error('tanggal_pelaksanaan') is-invalid @enderror" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="{{ old('tanggal_pelaksanaan') }}" required>
                                @error('tanggal_pelaksanaan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dosen_pembimbing" class="form-label">Dosen Pembimbing (Opsional)</label>
                                <input type="text" class="form-control @error('dosen_pembimbing') is-invalid @enderror" id="dosen_pembimbing" name="dosen_pembimbing" value="{{ old('dosen_pembimbing') }}">
                                @error('dosen_pembimbing')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file_sertifikat" class="form-label">File Sertifikat (PDF, DOCX, JPG, PNG)</label>
                            <input type="file" class="form-control @error('file_sertifikat') is-invalid @enderror" id="file_sertifikat" name="file_sertifikat">
                            @error('file_sertifikat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="keterangan_lomba" class="form-label">Keterangan Lomba (Opsional)</label>
                            <textarea class="form-control @error('keterangan_lomba') is-invalid @enderror" id="keterangan_lomba" name="keterangan_lomba" rows="5">{{ old('keterangan_lomba') }}</textarea>
                            @error('keterangan_lomba')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="photos_dokumentasi" class="form-label">Foto Dokumentasi (Opsional, Multiple)</label>
                            <input type="file" class="form-control @error('photos_dokumentasi.*') is-invalid @enderror" id="photos_dokumentasi" name="photos_dokumentasi[]" multiple>
                            @error('photos_dokumentasi.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('achievements.create') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">Ajukan Prestasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
