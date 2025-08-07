@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    /* Reusing admin stat card styles for consistency */
    .stat-card-v2 {
        background-color: #fff;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .stat-card-v2:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 20px;
        font-size: 24px;
        color: #fff;
    }
    .stat-icon.icon-primary { background: linear-gradient(135deg, #0d6efd, #0a58ca); }
    .stat-icon.icon-success { background: linear-gradient(135deg, #198754, #146c43); }
    .stat-icon.icon-warning { background: linear-gradient(135deg, #ffc107, #d39e00); }

    /* Badge styles */
    .status-badge {
        padding: 0.5em 0.75em;
        border-radius: 0.375rem;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
    }
    .status-menunggu-validasi { background-color: #cfe2ff; color: #084298; }
    .status-approved { background-color: #d1e7dd; color: #0f5132; }
    .status-rejected { background-color: #f8d7da; color: #842029; }
    .status-pending { background-color: #fff3cd; color: #664d03; } /* This is for Kaprodi's "Revisi" */
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Dashboard</h1>
            </div>

            <!-- Welcome Header -->
            <div class="dashboard-header mb-4">
                <div class="welcome-text">
                    <h4>Selamat Datang Kembali, {{ Auth::user()->name }}!</h4>
                    <p>Pantau ringkasan dan riwayat prestasi yang telah Anda laporkan di sini.</p>
                </div>
                <div class="welcome-icon">
                    <i class="fas fa-user-graduate"></i>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Total Prestasi Dilaporkan</div>
                            <div class="stat-number">{{ $stats['total'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Prestasi Disetujui</div>
                            <div class="stat-number">{{ $stats['approved'] }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Menunggu Validasi</div>
                            <div class="stat-number">{{ $stats['pending'] }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Achievements Table -->
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-history me-2"></i>Riwayat Pelaporan Prestasi</h5>
                    <a href="{{ route('achievements.create') }}" class="btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus-circle fa-fw me-1"></i>
                        Lapor Prestasi Baru
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Kompetisi</th>
                                    <th scope="col">Tingkat</th>
                                    <th scope="col">Prestasi</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col" class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($achievements as $index => $achievement)
                                <tr>
                                    <th scope="row">{{ $achievements->firstItem() + $index }}</th>
                                    <td>{{ $achievement->nama_kompetisi }}</td>
                                    <td>{{ $achievement->tingkat }}</td>
                                    <td>{{ $achievement->prestasi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($achievement->tanggal_pelaksanaan)->translatedFormat('d F Y') }}</td>
                                    <td class="text-center">
                                        <span class="status-badge status-{{ str_replace(' ', '-', strtolower($achievement->status)) }}">
                                            {{-- Display "Menunggu Validasi" for 'pending' status --}}
                                            @if($achievement->status == 'pending')
                                                Menunggu Validasi
                                            @else
                                                {{ ucfirst($achievement->status) }}
                                            @endif
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <h5 class="text-muted">Anda belum melaporkan prestasi apapun.</h5>
                                            <p>Klik tombol "Lapor Prestasi Baru" di pojok kanan atas untuk memulai.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($achievements->hasPages())
                <div class="card-footer bg-white">
                    {{ $achievements->links() }}
                </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection