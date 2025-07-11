@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Agenda & Kegiatan</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('admin.agendas.create') }}" class="btn btn-primary custom-add-btn"><i class="fas fa-plus me-2"></i>Tambah Agenda Baru</a>
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
                        <a href="{{ route('admin.agendas.show', $agenda->id) }}" class="btn btn-info btn-sm agenda-icon-btn" title="Lihat"><i class="fas fa-eye"></i></a>
                        <a href="{{ route('admin.agendas.edit', $agenda->id) }}" class="btn btn-warning btn-sm agenda-icon-btn" title="Edit"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.agendas.destroy', $agenda->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm agenda-icon-btn delete-agenda-btn" title="Hapus"><i class="fas fa-trash"></i></button>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-agenda-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault(); // Prevent default form submission

                const form = this.closest('form');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    backdrop: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
