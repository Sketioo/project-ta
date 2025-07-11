@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .stat-card {
        border-left: 4px solid;
        transition: transform 0.2s ease-in-out;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .border-primary { border-color: #4299e1 !important; }
    .border-success { border-color: #38a169 !important; }
    .border-info { border-color: #3182ce !important; }
    .border-warning { border-color: #f59e0b !important; }
    .border-danger { border-color: #e53e3e !important; }
    .border-secondary { border-color: #6c757d !important; }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <div class="alert alert-light shadow-sm" role="alert">
                <h4 class="alert-heading">Selamat Datang, {{ Auth::user()->name }}!</h4>
                <p>Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong>. Gunakan menu di samping untuk mengelola konten website.</p>
            </div>

            <div class="row mt-4">
                @if(in_array(Auth::user()->role, ['admin', 'kaprodi']))
                <!-- Total Suggestions Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-primary shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">Total Saran Masuk</div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['totalSuggestions'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-comments fa-2x text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Unread Suggestions Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-warning shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">Saran Belum Dibaca</div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['unreadSuggestions'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-envelope fa-2x text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 'admin')
                <!-- Total Partners Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-success shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs fw-bold text-success text-uppercase mb-1">Total Mitra</div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['totalPartners'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-handshake fa-2x text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Documents Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-info shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs fw-bold text-info text-uppercase mb-1">Total Dokumen</div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['totalDocuments'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-file-alt fa-2x text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Agendas Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-secondary shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs fw-bold text-secondary text-uppercase mb-1">Total Agenda</div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['totalAgendas'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-calendar-alt fa-2x text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 'kaprodi')
                <!-- Pending Achievements Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card stat-card border-danger shadow-sm h-100">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="text-xs fw-bold text-danger text-uppercase mb-1">Prestasi Menunggu Validasi</div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">{{ $stats['pendingAchievements'] ?? 0 }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-check-square fa-2x text-muted"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection