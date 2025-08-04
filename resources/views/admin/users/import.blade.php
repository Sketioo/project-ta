@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Impor Pengguna dari Excel</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Unggah File Excel</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.users.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Pilih file Excel (.xlsx, .xls)</label>
                            <input class="form-control" type="file" id="file" name="file" required>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-upload me-2"></i>Impor
                        </button>
                        <a href="{{ route('admin.users.exportTemplate') }}" class="btn btn-secondary">
                            <i class="fas fa-download me-2"></i>Unduh Template
                        </a>
                    </form>
                </div>
                <div class="card-footer">
                    <p class="mb-0"><strong>Panduan:</strong></p>
                    <ol>
                        <li>Unduh file template yang disediakan.</li>
                        <li>Isi data pengguna sesuai dengan kolom yang ada (`name`, `username`, `email`, `password`, `role`).</li>
                        <li>Kolom `password` jika dikosongkan akan diisi dengan password default: 'password'.</li>
                        <li>Kolom `role` jika dikosongkan akan diisi dengan peran default: 'mahasiswa'.</li>
                        <li>Simpan file dan unggah di sini.</li>
                    </ol>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
