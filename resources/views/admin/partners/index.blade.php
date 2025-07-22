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
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="dashboard-title">Manajemen Mitra</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Mitra</h5>
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Mitra Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="partnersTable" class="table table-hover table-bordered" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Logo</th>
                                    <th>Nama Mitra</th>
                                    <th>Website</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($partners as $partner)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" class="img-thumbnail" width="80">
                                        </td>
                                        <td>{{ $partner->name }}</td>
                                        <td><a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer">{{ $partner->website_url }}</a></td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.partners.toggleVisibility', $partner) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm {{ $partner->is_visible ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ $partner->is_visible ? 'Ditampilkan' : 'Disembunyikan' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-sm delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $partner->id }}" data-name="{{ $partner->name }}">
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
        Apakah Anda yakin ingin menghapus mitra <strong id="partnerName"></strong>?
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
            $('#partnersTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "pageLength": 10,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            });

            $('.delete-btn').on('click', function () {
                var partnerId = $(this).data('id');
                var partnerName = $(this).data('name');
                var url = "{{ route('admin.partners.destroy', ':id') }}";
                url = url.replace(':id', partnerId);
                
                $('#partnerName').text(partnerName);
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endpush
