@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Validasi Prestasi Mahasiswa</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('kaprodi.achievements.index', ['status' => 'all']) }}" class="btn btn-sm {{ request('status', 'all') == 'all' ? 'btn-primary' : 'btn-outline-primary' }}">Semua</a>
                    <a href="{{ route('kaprodi.achievements.index', ['status' => 'pending']) }}" class="btn btn-sm {{ request('status') == 'pending' ? 'btn-primary' : 'btn-outline-primary' }} ms-2">Menunggu Validasi</a>
                    <a href="{{ route('kaprodi.achievements.index', ['status' => 'validated']) }}" class="btn btn-sm {{ request('status') == 'validated' ? 'btn-primary' : 'btn-outline-primary' }} ms-2">Divalidasi</a>
                    <a href="{{ route('kaprodi.achievements.index', ['status' => 'rejected']) }}" class="btn btn-sm {{ request('status') == 'rejected' ? 'btn-primary' : 'btn-outline-primary' }} ms-2">Ditolak</a>
                </div>
            </div>

            @if (session('success'))
            @endif

            <div class="row justify-content-center">
                <div class="col-md-10">
                @forelse ($achievements as $achievement)
                <div class="achievement-item card shadow-sm mb-3">
                    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="achievement-details flex-grow-1 mb-3 mb-md-0">
                            <h5 class="card-title mb-1">{{ $achievement->title }}</h5>
                            <p class="card-text text-muted mb-1">
                                <i class="fas fa-user me-1"></i> {{ $achievement->user->name }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-id-card me-1"></i> {{ $achievement->nim }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-book me-1"></i> Semester {{ $achievement->semester }}
                                <span class="mx-2">•</span>
                                <i class="fas fa-graduation-cap me-1"></i> Kelas {{ $achievement->class }}
                            </p>
                            <p class="card-text"><strong>Deskripsi:</strong> {{ Str::limit($achievement->description, 100) }}</p>
                            <p class="card-text mb-0">
                                <strong>File:</strong>
                                @if ($achievement->file_path)
                                    <a href="{{ asset('storage/' . $achievement->file_path) }}" target="_blank">Lihat File</a>
                                @else
                                    Tidak ada file
                                @endif
                            </p>
                        </div>
                        <div class="achievement-actions d-flex flex-wrap gap-2 justify-content-end">
                            <a href="{{ route('kaprodi.achievements.show', $achievement->id) }}" class="btn btn-info btn-sm" title="Lihat Detail">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if ($achievement->status == 'pending')
                            <form action="{{ route('kaprodi.achievements.update', $achievement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="validated">
                                <button type="submit" class="btn btn-success btn-sm" title="Validasi">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>

                            <form action="{{ route('kaprodi.achievements.update', $achievement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-sm" title="Tolak">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </form>
                            @elseif ($achievement->status == 'validated')
                            <form action="{{ route('kaprodi.achievements.update', $achievement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit" class="btn btn-danger btn-sm" title="Batalkan Validasi / Tolak">
                                    <i class="fas fa-times-circle"></i>
                                </button>
                            </form>
                            @elseif ($achievement->status == 'rejected')
                            <form action="{{ route('kaprodi.achievements.update', $achievement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" value="validated">
                                <button type="submit" class="btn btn-success btn-sm" title="Validasi Ulang">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif

                            <form action="{{ route('kaprodi.achievements.update', $achievement->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="show_on_main_page" value="{{ $achievement->show_on_main_page ? '0' : '1' }}">
                                <button type="submit" class="btn btn-secondary btn-sm" title="{{ $achievement->show_on_main_page ? 'Sembunyikan dari Halaman Utama' : 'Tampilkan di Halaman Utama' }}">
                                    <i class="fas fa-{{ $achievement->show_on_main_page ? 'eye-slash' : 'eye' }}"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <p class="card-text mb-0"><strong>Status:</strong> <span class="badge bg-{{ $achievement->status == 'validated' ? 'success' : ($achievement->status == 'rejected' ? 'danger' : 'warning text-dark') }}">{{ ucfirst($achievement->status) }}</span></p>
                        <p class="card-text mb-0"><strong>Tampil di Utama:</strong> <span class="badge bg-{{ $achievement->show_on_main_page ? 'success' : 'secondary' }}">{{ $achievement->show_on_main_page ? 'Ya' : 'Tidak' }}</span></p>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-4">
                    <p class="text-muted">Tidak ada prestasi yang perlu divalidasi.</p>
                </div>
                @endforelse
                </div>
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