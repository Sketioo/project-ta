@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Agenda & Kegiatan</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('agendas.create') }}" class="btn btn-primary custom-add-btn"><i class="fas fa-plus me-2"></i>Tambah Agenda Baru</a>
                </div>
            </div>

            <div class="agenda-list-container">
                @forelse($agendas as $agenda)
                <div class="agenda-list-item shadow-sm mb-3">
                    <div class="agenda-list-content">
                        <h5 class="agenda-list-title">{{ $agenda->title }}</h5>
                        <p class="agenda-list-meta text-muted">
                            <i class="fas fa-calendar-alt me-1"></i> {{ $agenda->date->format('d M Y') }}
                            <span class="mx-2">•</span>
                            <i class="fas fa-map-marker-alt me-1"></i> {{ $agenda->location }}
                        </p>
                        <p class="agenda-list-status">
                            Status: 
                            @if($agenda->is_published)
                                <span class="badge bg-success">Published</span>
                            @else
                                <span class="badge bg-warning text-dark">Draft</span>
                            @endif
                        </p>
                    </div>
                    <div class="agenda-list-actions">
                        <a href="{{ route('agendas.show', $agenda->id) }}" class="btn btn-info btn-sm agenda-icon-btn" title="Lihat"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('agendas.edit', $agenda->id) }}" class="btn btn-warning btn-sm agenda-icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('agendas.destroy', $agenda->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm agenda-icon-btn" onclick="return confirm('Apakah Anda yakin ingin menghapus agenda ini?')" title="Hapus"><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="alert alert-info text-center" role="alert">
                    Tidak ada agenda yang tersedia. Klik "Tambah Agenda Baru" untuk menambahkan.
                </div>
                @endforelse
            </div>
        </main>
    </div>
</div>
@endsection
