@extends('layouts.app')

@push('styles')
<style>
    .validation-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    .filter-nav .btn {
        border-radius: 50px;
        padding: 0.5rem 1.2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    .filter-nav .btn.active {
        background-color: var(--primary-color);
        color: var(--dark-color);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .achievement-card-kaprodi {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .achievement-card-kaprodi:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .card-header-kaprodi {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .status-badge {
        font-size: 0.9rem;
        font-weight: 700;
        padding: 0.4em 0.8em;
        border-radius: 50px;
    }
    .status-pending { background-color: #ffc107; color: #333; }
    .status-validated { background-color: #28a745; color: #fff; }
    .status-rejected { background-color: #dc3545; color: #fff; }

    .card-body-kaprodi {
        padding: 1.5rem;
    }
    .student-info {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    .student-info img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 1rem;
        object-fit: cover;
    }
    .action-buttons .btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 0.25rem;
    }
    .pagination-wrapper .pagination {
        justify-content: center;
    }
    .pagination-wrapper .page-link {
        color: var(--dark-color);
        border-radius: 50px !important;
        margin: 0 5px;
        border: none;
    }
    .pagination-wrapper .page-item.active .page-link {
        background-color: var(--primary-color);
        color: var(--dark-color);
        font-weight: bold;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="pt-3 pb-2 mb-3 border-bottom validation-header">
                <h1 class="h2">Validasi Prestasi</h1>
                <div class="filter-nav btn-group" role="group">
                    <a href="{{ route('kaprodi.achievements.index') }}" class="btn {{ !request('status') || request('status') == 'all' ? 'active' : 'btn-light' }}">Semua</a>
                    <a href="{{ route('kaprodi.achievements.index', ['status' => 'pending']) }}" class="btn {{ request('status') == 'pending' ? 'active' : 'btn-light' }}">Pending</a>
                    <a href="{{ route('kaprodi.achievements.index', ['status' => 'validated']) }}" class="btn {{ request('status') == 'validated' ? 'active' : 'btn-light' }}">Validated</a>
                    <a href="{{ route('kaprodi.achievements.index', ['status' => 'rejected']) }}" class="btn {{ request('status') == 'rejected' ? 'active' : 'btn-light' }}">Rejected</a>
                </div>
            </div>

            <div class="row">
                @forelse ($achievements as $achievement)
                <div class="col-lg-6 col-md-12 mb-4">
                    <div class="achievement-card-kaprodi">
                        <div class="card-header-kaprodi">
                            <h5 class="mb-0">{{ Str::limit($achievement->title, 35) }}</h5>
                            <span class="status-badge status-{{$achievement->status}}">{{ ucfirst($achievement->status) }}</span>
                        </div>
                        <div class="card-body-kaprodi">
                            <div class="student-info">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($achievement->user->name) }}&background=ffd700&color=1a1a1a" alt="Avatar">
                                <div>
                                    <h6 class="mb-0">{{ $achievement->user->name }}</h6>
                                    <small class="text-muted">{{ $achievement->nim }} - Kelas {{ $achievement->class }}</small>
                                </div>
                            </div>
                            <p>{{ $achievement->description }}</p>
                        </div>
                        <div class="card-footer bg-white text-end action-buttons">
                            <a href="{{ route('kaprodi.achievements.show', $achievement->id) }}" class="btn btn-outline-info" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if ($achievement->status == 'pending' || $achievement->status == 'rejected')
                            <form action="{{ route('kaprodi.achievements.update', $achievement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="validated">
                                <button type="submit" class="btn btn-outline-success" title="Validasi">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif
                            @if ($achievement->status == 'pending' || $achievement->status == 'validated')
                            <form action="{{ route('kaprodi.achievements.update', $achievement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-outline-danger" title="Tolak">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                    <h4 class="text-muted">Tidak ada data prestasi untuk status ini.</h4>
                </div>
                @endforelse
            </div>

            <div class="pagination-wrapper mt-4">
                {{ $achievements->appends(request()->query())->links() }}
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Check for success message and display SweetAlert
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
