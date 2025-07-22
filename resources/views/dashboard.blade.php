@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
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
            <div class="dashboard-header">
                <div class="welcome-text">
                    <h4>Selamat Datang Kembali, {{ Auth::user()->name }}!</h4>
                    <p>Anda login sebagai <strong>{{ ucfirst(Auth::user()->role) }}</strong>. Kelola konten website dengan mudah melalui menu di samping.</p>
                </div>
                <div class="welcome-icon">
                    <i class="fas fa-rocket"></i>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4">
                @if(in_array(Auth::user()->role, ['admin', 'kaprodi']))
                <!-- Total Suggestions Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-primary">
                            <i class="fas fa-comments"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Total Saran Masuk</div>
                            <div class="stat-number">{{ $stats['totalSuggestions'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>

                <!-- Unread Suggestions Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-warning">
                            <i class="fas fa-envelope-open"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Saran Belum Dibaca</div>
                            <div class="stat-number">{{ $stats['unreadSuggestions'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 'admin')
                <!-- Total Partners Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-success">
                            <i class="fas fa-handshake"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Total Mitra</div>
                            <div class="stat-number">{{ $stats['totalPartners'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>

                <!-- Total Documents Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-info">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Total Dokumen</div>
                            <div class="stat-number">{{ $stats['totalDocuments'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>

                <!-- Total Agendas Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-secondary">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Total Agenda</div>
                            <div class="stat-number">{{ $stats['totalAgendas'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                @endif

                @if(Auth::user()->role == 'kaprodi')
                <!-- Pending Achievements Card -->
                <div class="col-lg-4 col-md-6">
                    <div class="stat-card-v2">
                        <div class="stat-icon icon-danger">
                            <i class="fas fa-check-square"></i>
                        </div>
                        <div class="stat-info">
                            <div class="stat-label">Prestasi Menunggu Validasi</div>
                            <div class="stat-number">{{ $stats['pendingAchievements'] ?? 0 }}</div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </main>
    </div>
</div>
@endsection
