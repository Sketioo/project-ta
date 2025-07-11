@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .card-header { background-color: #4a5568; color: white; }
        .btn-primary { background-color: #4299e1; border-color: #4299e1; }
        .btn-danger { background-color: #e53e3e; border-color: #e53e3e; }
        .btn-info { background-color: #3182ce; border-color: #3182ce; }
        .btn-warning { background-color: #f59e0b; border-color: #f59e0b; }
        .btn-success { background-color: #38a169; border-color: #38a169; }
        .btn-secondary { background-color: #6c757d; border-color: #6c757d; }
    </style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Manajemen Agenda</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Agenda</h5>
                    <a href="{{ route('admin.agendas.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Agenda Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="agendasTable" class="table table-hover table-bordered" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Judul Agenda</th>
                                    <th>Tanggal</th>
                                    <th>Lokasi</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendas as $agenda)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $agenda->title }}</td>
                                        <td>{{ $agenda->date->format('d M Y') }}</td>
                                        <td>{{ $agenda->location }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.agendas.togglePublication', $agenda) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm {{ $agenda->is_published ? 'btn-success' : 'btn-warning text-dark' }}">
                                                    {{ $agenda->is_published ? 'Published' : 'Draft' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.agendas.edit', $agenda) }}" class="btn btn-info btn-sm" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $agenda->id }}" data-title="{{ $agenda->title }}" title="Hapus">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus agenda <strong id="agendaTitle"></strong>?
      </div>
      <div class="modal-footer">
        <form id="deleteForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Ya, Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#agendasTable').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                "pageLength": 10
            });

            $('.delete-btn').on('click', function () {
                var agendaId = $(this).data('id');
                var agendaTitle = $(this).data('title');
                var url = "{{ route('admin.agendas.destroy', ':id') }}";
                url = url.replace(':id', agendaId);
                
                $('#agendaTitle').text(agendaTitle);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endpush