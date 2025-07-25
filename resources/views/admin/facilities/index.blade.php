@extends('layouts.app')

@section('title', 'Manajemen Fasilitas')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3 mb-4">
                <h1 class="page-title">Manajemen Fasilitas</h1>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Fasilitas</h5>
                    <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Fasilitas
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="facilitiesTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Foto Utama</th>
                                    <th>Nama Fasilitas</th>
                                    <th>Penanggung Jawab</th>
                                    <th class="text-center">Jumlah Foto</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($facilities as $facility)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        @if($facility->photos->isNotEmpty())
                                            <img src="{{ asset('storage/' . $facility->photos->first()->photo_path) }}" alt="{{ $facility->name }}" class="img-thumbnail" width="100" style="border-radius: 8px;">
                                        @else
                                            <span class="text-muted">No Logo</span>
                                        @endif
                                    </td>
                                    <td>{{ $facility->name }}</td>
                                    <td>{{ $facility->person_in_charge ?? '-' }}</td>
                                    <td class="text-center"><span class="badge bg-secondary">{{ $facility->photos->count() }}</span></td>
                                    <td class="text-center">
                                        <div class="action-btn-group">
                                            <a href="{{ route('admin.facilities.edit', $facility->id) }}" class="btn btn-info" data-bs-toggle="tooltip" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $facility->id }}" data-name="{{ $facility->name }}" data-bs-toggle="tooltip" title="Hapus">
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
        Apakah Anda yakin ingin menghapus fasilitas <strong id="facilityName"></strong>? Semua foto yang terkait juga akan dihapus.
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
            $('#facilitiesTable').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                "pageLength": 10,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ],
                "columnDefs": [
                    { "orderable": false, "targets": [1, 5] } // Disable sorting for photo and action columns
                ]
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            $('.delete-btn').on('click', function () {
                var facilityId = $(this).data('id');
                var facilityName = $(this).data('name');
                var url = "{{ route('admin.facilities.destroy', ':id') }}";
                url = url.replace(':id', facilityId);
                
                $('#facilityName').text(facilityName);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endpush
