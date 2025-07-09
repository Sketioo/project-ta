@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 page-title">Saran dan Masukan (Sudah Dibaca)</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('suggestions.index') }}" class="btn btn-sm btn-outline-secondary">Lihat Saran Belum Dibaca</a>
                </div>
            </div>

            <div class="row">
                @forelse($suggestions as $suggestion)
                <div class="col-md-6 mb-4 suggestion-card">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $suggestion->name }} <small class="text-muted">({{ $suggestion->email }})</small></h5>
                            <p class="card-text">{{ $suggestion->message }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-success">Sudah Dibaca</span> {{-- Changed badge color --}}
                                <small class="text-muted">{{ $suggestion->created_at->format('d M Y H:i') }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Tidak ada saran yang sudah dibaca.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>
</div>
@endsection