@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Manajemen Kurikulum</h1>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Kurikulum</h5>
                    <a href="{{ route('admin.curriculums.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Kurikulum Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="curriculumsTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Kurikulum</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($curriculums as $curriculum)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $curriculum->name }}</td>
                                        <td class="text-center">
                                            <span class="badge {{ $curriculum->is_visible ? 'bg-success' : 'bg-danger' }}">
                                                {{ $curriculum->is_visible ? 'Ditampilkan' : 'Disembunyikan' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btn-group">
                                                <a href="{{ route('admin.curriculums.edit', $curriculum) }}" class="btn btn-info" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $curriculum->id }}" data-name="{{ $curriculum->name }}" data-bs-toggle="tooltip" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </div>
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
        Apakah Anda yakin ingin menghapus kurikulum <strong id="curriculumName"></strong>?
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
            $('#curriculumsTable').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                "pageLength": 10
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            $('.delete-btn').on('click', function () {
                var curriculumId = $(this).data('id');
                var curriculumName = $(this).data('name');
                var url = "{{ route('admin.curriculums.destroy', ':id') }}";
                url = url.replace(':id', curriculumId);
                
                $('#curriculumName').text(curriculumName);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endpush
