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
                <h1 class="page-title">Manajemen Mitra</h1>
            </div>

            <div class="card mb-4">
    <div class="card-header">
        <h5 class="mb-0">Filter Mitra</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.partners.index') }}" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="province_id" class="form-label">Provinsi</label>
                    <select class="form-select" id="province_id" name="province_id">
                        <option value="">Pilih Provinsi</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province->id }}" {{ request('province_id') == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="regency_id" class="form-label">Kabupaten/Kota</label>
                    <select class="form-select" id="regency_id" name="regency_id" disabled>
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Mitra</h5>
                    <a href="{{ route('admin.partners.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Mitra Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="partnersTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center">Logo</th>
                                    <th>Nama Mitra</th>
                                    <th>Contact Person</th>
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
                                            @if($partner->logo_path)
                                                <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" class="img-thumbnail" width="100" style="border-radius: 8px;">
                                            @else
                                                <span class="text-muted">No Logo</span>
                                            @endif
                                        </td>
                                        <td data-bs-toggle="tooltip" title="{{ $partner->deskripsi }}">{{ $partner->name }}</td>
                                        <td>{{ $partner->contact_person ?? '-' }}</td>
                                        <td><a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" style="color: #007bff;">{{ $partner->website_url }}</a></td>
                                        <td class="text-center">
                                            <form action="{{ route('admin.partners.toggleVisibility', $partner) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="badge {{ $partner->is_visible ? 'bg-success' : 'bg-danger' }}" style="border: none; cursor: pointer; padding: 0.5em 0.75em; border-radius: 0.35rem; font-weight: bold;">
                                                    {{ $partner->is_visible ? 'Ditampilkan' : 'Disembunyikan' }}
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-center">
                                            <div class="action-btn-group">
                                                <a href="{{ route('admin.partners.edit', $partner) }}" class="btn btn-info" data-bs-toggle="tooltip" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $partner->id }}" data-name="{{ $partner->name }}" data-bs-toggle="tooltip" title="Hapus">
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
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                "pageLength": 10,
                "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
            });

            // Initialize Bootstrap tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })

            $('.delete-btn').on('click', function () {
                var partnerId = $(this).data('id');
                var partnerName = $(this).data('name');
                var url = "{{ route('admin.partners.destroy', ':id') }}";
                url = url.replace(':id', partnerId);
                
                $('#partnerName').text(partnerName);
                $('#deleteForm').attr('action', url);
            });

            // Dynamic dropdown for regencies
            $('#province_id').on('change', function() {
                var provinceId = $(this).val();
                var regencySelect = $('#regency_id');
                regencySelect.empty();
                regencySelect.append('<option value="">Pilih Kabupaten/Kota</option>');
                regencySelect.prop('disabled', true);

                if (provinceId) {
                    $.ajax({
                        url: '/api/kabupaten/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                regencySelect.append('<option value="' + value.id + '"' + (value.id == "{{ request('regency_id') }}" ? 'selected' : '') + '>' + value.name + '</option>');
                            });
                            regencySelect.prop('disabled', false);
                        }
                    });
                }
            });

            // Trigger change on page load if a province is already selected
            if ($('#province_id').val()) {
                $('#province_id').trigger('change');
            }
        });
    </script>
@endpush
