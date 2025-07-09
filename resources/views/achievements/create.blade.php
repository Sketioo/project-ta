@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Ajukan Prestasi</h1>
            </div>

            <div class="card shadow mb-4 custom-form-card">
                <div class="card-header py-3 custom-form-header">
                    <h6 class="m-0 font-weight-bold text-white">Form Pengajuan Prestasi</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data" class="achievement-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nim" class="form-label custom-form-label">NIM</label>
                                    <input type="text" class="form-control custom-form-input" id="nim" name="nim" value="{{ old('nim', Auth::user()->nim ?? '') }}" required>
                                    @error('nim')
                                        <div class="text-danger custom-form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="semester" class="form-label custom-form-label">Semester</label>
                                    <input type="text" class="form-control custom-form-input" id="semester" name="semester" value="{{ old('semester') }}" required>
                                    @error('semester')
                                        <div class="text-danger custom-form-error">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="class" class="form-label custom-form-label">Kelas</label>
                            <input type="text" class="form-control custom-form-input" id="class" name="class" value="{{ old('class') }}" required>
                            @error('class')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label custom-form-label">Judul Prestasi</label>
                            <input type="text" class="form-control custom-form-input" id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label custom-form-label">Penjelasan Prestasi</label>
                            <textarea class="form-control custom-form-input" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label custom-form-label">File Pendukung (PDF, DOCX, JPG, PNG)</label>
                            <input type="file" class="form-control custom-form-input" id="file" name="file">
                            @error('file')
                                <div class="text-danger custom-form-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary custom-submit-btn">Ajukan Prestasi</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
