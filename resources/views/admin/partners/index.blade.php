@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Mitra</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">Tambah Mitra</a>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Logo</th>
                            <th>Situs Web</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($partners as $partner)
                            <tr>
                                <td>{{ $partner->name }}</td>
                                <td><img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" width="100"></td>
                                <td><a href="{{ $partner->website_url }}" target="_blank">{{ $partner->website_url }}</a></td>
                                <td>
                                    <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection
