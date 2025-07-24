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
                <h1 class="page-title">Manajemen Pengumuman</h1>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pengumuman</h5>
                    <a href="{{ route('admin.announcements.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Pengumuman Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="announcementsTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Judul Pengumuman</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($announcements as $announcement)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ ucfirst($announcement->category) }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.announcements.togglePublication', $announcement) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="badge {{ $announcement->is_published ? 'bg-success' : 'bg-danger' }}" style="border: none; cursor: pointer; padding: 0.5em 0.75em; border-radius: 0.35rem; font-weight: bold;">
                                                    {{ $announcement->is_published ? 'Published' : 'Draft' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btn-group">
                                                <a href="{{ route('admin.announcements.edit', $announcement) }}" class="btn btn-info" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $announcement->id }}" data-title="{{ $announcement->title }}" data-bs-toggle="tooltip" title="Hapus">
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
        Apakah Anda yakin ingin menghapus pengumuman <strong id="announcementTitle"></strong>?
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
            $('#announcementsTable').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                "pageLength": 10
            });

            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            $('.delete-btn').on('click', function () {
                var announcementId = $(this).data('id');
                var announcementTitle = $(this).data('title');
                var url = "{{ route('admin.announcements.destroy', ':id') }}";
                url = url.replace(':id', announcementId);
                
                $('#announcementTitle').text(announcementTitle);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endpush
