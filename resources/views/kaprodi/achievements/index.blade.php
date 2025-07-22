@extends('layouts.app')

@push('styles')
<style>
    .validation-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        padding-bottom: 1rem;
    }
    .filter-pills .nav-link {
        border-radius: 50px;
        padding: 0.6rem 1.3rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #6c757d;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        margin: 0 5px;
    }
    .filter-pills .nav-link.active {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
        box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
    }
    .achievement-card-kaprodi {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .achievement-card-kaprodi:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }
    .card-header-kaprodi {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        background-color: #f8f9fa;
    }
    .card-header-kaprodi h6 {
        margin: 0;
        font-weight: 600;
        color: #343a40;
    }
    .card-body-kaprodi {
        padding: 1.5rem;
        flex-grow: 1;
    }
    .student-info {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    .student-info img {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        margin-right: 1rem;
        object-fit: cover;
    }
    .student-info h6 {
        font-weight: 600;
    }
    .card-footer-kaprodi {
        padding: 1rem 1.5rem;
        background-color: #fff;
        border-top: 1px solid #f0f0f0;
        text-align: right;
    }
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 12px;
    }
    .empty-state i {
        font-size: 4rem;
        color: #ced4da;
    }
    .empty-state h4 {
        margin-top: 1.5rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4">
            <div class="validation-header border-bottom">
                <h1 class="h2">Validasi Prestasi</h1>
                <ul class="nav nav-pills filter-pills">
                    <li class="nav-item">
                        <a href="{{ route('kaprodi.achievements.index', ['status' => 'all']) }}" class="nav-link {{ !request('status') || request('status') == 'all' ? 'active' : '' }}">Semua</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kaprodi.achievements.index', ['status' => 'pending']) }}" class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kaprodi.achievements.index', ['status' => 'disetujui']) }}" class="nav-link {{ request('status') == 'disetujui' ? 'active' : '' }}">Disetujui</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kaprodi.achievements.index', ['status' => 'ditolak']) }}" class="nav-link {{ request('status') == 'ditolak' ? 'active' : '' }}">Ditolak</a>
                    </li>
                </ul>
            </div>

            <div class="row mt-4">
                @forelse ($achievements as $achievement)
                <div class="col-lg-6 mb-4">
                    <div class="achievement-card-kaprodi">
                        <div class="card-header-kaprodi">
                            <h6>{{ Str::limit($achievement->title, 45) }}</h6>
                        </div>
                        <div class="card-body-kaprodi">
                            <div class="student-info">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($achievement->user->name) }}&background=0D6EFD&color=fff" alt="Avatar">
                                <div>
                                    <h6 class="mb-0">{{ $achievement->user->name }}</h6>
                                    <small class="text-muted">{{ $achievement->nim }} - Kelas {{ $achievement->class }}</small>
                                </div>
                            </div>
                            <p class="text-muted">{{ Str::limit($achievement->description, 120) }}</p>
                        </div>
                        <div class="card-footer-kaprodi d-flex justify-content-between align-items-center">
                             <span>
                                @if($achievement->status == 'disetujui')
                                    <span class="badge rounded-pill bg-success">Disetujui</span>
                                @elseif($achievement->status == 'ditolak')
                                    <span class="badge rounded-pill bg-danger">Ditolak</span>
                                @else
                                    <span class="badge rounded-pill bg-warning text-dark">Pending</span>
                                @endif
                            </span>
                            <a href="{{ route('kaprodi.achievements.show', $achievement->id) }}" class="btn btn-primary btn-sm">
                                Detail & Validasi <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <h4>Tidak ada data prestasi untuk kategori ini.</h4>
                    </div>
                </div>
                @endforelse
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $achievements->appends(request()->query())->links() }}
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>
@endpush
