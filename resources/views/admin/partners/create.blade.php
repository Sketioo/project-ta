@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Tambah Mitra</h1>
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

            <form action="{{ route('admin.partners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" name="logo" id="logo" class="form-control-file" required>
                    <small class="form-text text-muted">Gambar harus berukuran antara 100x100 dan 500x500 piksel.</small>
                </div>
                <div class="form-group">
                    <label for="website_url">URL Situs Web</label>
                    <input type="url" name="website_url" id="website_url" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Tambah Mitra</button>
            </form>
        </main>
    </div>
</div>
@endsection
