@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        .filter-container {
            max-width: 250px;
        }
        .status-badge {
            padding: 0.4em 0.8em;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        .status-disetujui { background-color: #d1e7dd; color: #0f5132; }
        .status-ditolak { background-color: #f8d7da; color: #58151c; }
        .status-pending { background-color: #fff3cd; color: #664d03; }
        .action-btn-group .btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
@endpush

@section('content')
<div class="container-fluid full-height-layout">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Validasi Prestasi</h1>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Daftar Pengajuan Prestasi</h5>
                    <div class="filter-container">
                        <form id="filterForm" action="{{ route('kaprodi.achievements.index') }}" method="GET">
                            <select name="status" class="form-select" onchange="document.getElementById('filterForm').submit()">
                                <option value="all" {{ request('status', 'all') == 'all' ? 'selected' : '' }}>Semua Status</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="achievementsTable" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Kompetisi</th>
                                    <th>Prestasi</th>
                                    <th class="text-center">Tanggal Pengajuan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($achievements as $achievement)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $achievement->user->name }}</td>
                                        <td>{{ Str::limit($achievement->nama_kompetisi, 40) }}</td>
                                        <td>{{ Str::limit($achievement->prestasi, 40) }}</td>
                                        <td class="text-center">{{ $achievement->created_at->format('d M Y') }}</td>
                                        <td class="text-center">
                                            <span class="status-badge status-{{ str_replace(' ', '-', strtolower($achievement->status)) }}">
                                                {{ ucfirst($achievement->status) }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('kaprodi.achievements.show', $achievement->id) }}" class="btn btn-primary me-2" data-bs-toggle="tooltip" title="Lihat Detail & Validasi">
                                                <i class="fas fa-search-plus"></i>
                                            </a>
                                            <form action="{{ route('kaprodi.achievements.destroy', $achievement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prestasi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" data-bs-toggle="tooltip" title="Hapus Prestasi">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
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
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#achievementsTable').DataTable({
                "language": { "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json" },
                "pageLength": 10,
                "searching": true,
                "ordering": true
            });

            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
@endpush
