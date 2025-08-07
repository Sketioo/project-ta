@extends('layouts.app')

@push('styles')
<style>
    .details-card, .form-card {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: none;
    }
    .details-card .card-header, .form-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
        font-weight: 600;
        font-size: 1.1rem;
        color: #343a40;
    }
    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 0.75rem 0;
        border-bottom: 1px solid #f1f1f1;
    }
    .detail-item:last-child { border-bottom: none; }
    .detail-item strong { color: #495057; }
    .detail-item span { color: #6c757d; }
    .status-badge {
        padding: 0.4em 0.8em;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.8rem;
    }
    .status-disetujui { background-color: #d1e7dd; color: #0f5132; }
    .status-ditolak { background-color: #f8d7da; color: #58151c; }
    .status-revisi { background-color: #fff3cd; color: #664d03; }
    .form-label-custom {
        font-weight: 600;
        margin-bottom: 0.75rem;
        color: #495057;
    }
    .status-radio-group .btn {
        width: 100%;
        margin-bottom: 0.5rem;
        border-width: 2px;
    }
    .status-radio-group input[type="radio"]:checked + .btn-outline-primary { background-color: var(--bs-primary); color: #fff; border-color: var(--bs-primary); }
    .status-radio-group input[type="radio"]:checked + .btn-outline-success { background-color: var(--bs-success); color: #fff; border-color: var(--bs-success); }
    .status-radio-group input[type="radio"]:checked + .btn-outline-danger { background-color: var(--bs-danger); color: #fff; border-color: var(--bs-danger); }
    .form-check-custom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    .form-switch .form-check-input { width: 3.5em; height: 1.75em; cursor: pointer; }
    .form-switch .form-check-input:disabled {
        cursor: not-allowed;
        background-color: #e9ecef;
        opacity: 0.7;
    }
    /* Enhanced Textarea Style */
    #keterangan_lomba {
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        background-color: #fdfdff;
    }
    #keterangan_lomba:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
</style>
@endpush

@section('content')
<div class="container-fluid full-height-layout">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4 management-page">
            <div class="page-header pt-3 mb-3">
                <h1 class="page-title">Detail & Validasi Prestasi</h1>
            </div>

            <form action="{{ route('kaprodi.achievements.update', $achievement) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="row g-4">
                    <!-- Details Column -->
                    <div class="col-lg-8">
                        <div class="card details-card">
                            <div class="card-header"><i class="fas fa-info-circle me-2"></i>Detail Pengajuan</div>
                            <div class="card-body p-4">
                                <h4 class="card-title mb-3">{{ $achievement->nama_kompetisi }} - {{ $achievement->prestasi }}</h4>
                                <div class="detail-item">
                                    <strong>Mahasiswa</strong>
                                    <span>{{ $achievement->user->name }}</span>
                                </div>
                                <div class="detail-item">
                                    <strong>NIM</strong>
                                    <span>{{ $achievement->nim }}</span>
                                </div>
                                <div class="detail-item">
                                    <strong>Status Saat Ini</strong>
                                    <span>
                                        @if($achievement->status == 'disetujui')
                                            <span class="status-badge status-disetujui">Disetujui</span>
                                        @elseif($achievement->status == 'ditolak')
                                            <span class="status-badge status-ditolak">Ditolak</span>
                                        @else
                                            <span class="status-badge status-revisi">Revisi</span>
                                        @endif
                                    </span>
                                </div>
                                <div class="pt-3">
                                    <label for="keterangan_lomba" class="form-label-custom">Keterangan Lomba (dapat diedit)</label>
                                    <textarea name="keterangan_lomba" id="keterangan_lomba" class="form-control" rows="8">{{ old('keterangan_lomba', $achievement->keterangan_lomba) }}</textarea>
                                </div>

                                @if ($achievement->file_sertifikat)
                                    <a href="{{ asset('storage/' . $achievement->file_sertifikat) }}" target="_blank" class="btn btn-outline-primary mt-3">
                                        <i class="fas fa-paperclip me-2"></i>Lihat Lampiran
                                    </a>
                                @endif

                                @if ($achievement->photos_dokumentasi && count($achievement->photos_dokumentasi) > 0)
                                    <div class="mt-4">
                                        <strong>Foto Dokumentasi</strong>
                                        <div class="row mt-2">
                                            @foreach ($achievement->photos_dokumentasi as $photoPath)
                                                <div class="col-md-4 mb-3">
                                                    <a href="{{ asset('storage/' . $photoPath) }}" target="_blank">
                                                        <img src="{{ asset('storage/' . $photoPath) }}" class="img-fluid rounded shadow-sm" alt="Dokumentasi Prestasi">
                                                    </a>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Form Column -->
                    <div class="col-lg-4">
                        <div class="card form-card">
                            <div class="card-header"><i class="fas fa-edit me-2"></i>Form Validasi</div>
                            <div class="card-body p-4">
                                <div class="mb-4">
                                    <label class="form-label-custom">Ubah Status Pengajuan</label>
                                    <div class="status-radio-group text-center">
                                        <input type="radio" class="btn-check" name="status" id="status_pending" value="pending" {{ $achievement->status == 'pending' ? 'checked' : '' }} autocomplete="off">
                                        <label class="btn btn-outline-primary" for="status_pending">Revisi</label>

                                        <input type="radio" class="btn-check" name="status" id="status_disetujui" value="disetujui" {{ $achievement->status == 'disetujui' ? 'checked' : '' }} autocomplete="off">
                                        <label class="btn btn-outline-success" for="status_disetujui">Setujui</label>

                                        <input type="radio" class="btn-check" name="status" id="status_ditolak" value="ditolak" {{ $achievement->status == 'ditolak' ? 'checked' : '' }} autocomplete="off">
                                        <label class="btn btn-outline-danger" for="status_ditolak">Tolak</label>
                                    </div>
                                </div>

                                <div class="mb-4">
                                     <label class="form-label-custom">Pengaturan Tampilan</label>
                                    <div class="form-check form-switch form-check-custom">
                                        <label class="form-check-label" for="show_on_main_page"><strong>Tampilkan di Beranda</strong></label>
                                        <input type="hidden" name="show_on_main_page" value="0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="show_on_main_page" name="show_on_main_page" value="1" {{ $achievement->show_on_main_page ? 'checked' : '' }}>
                                    </div>
                                </div>

                                <div class="d-grid gap-2 mt-4">
                                    <button type="submit" class="btn btn-warning btn-lg text-dark"><i class="fas fa-save me-2"></i>Simpan Perubahan</button>
                                    <a href="{{ route('kaprodi.achievements.index') }}" class="btn btn-light btn-lg">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusRadios = document.querySelectorAll('input[name="status"]');
    const showOnMainPageToggle = document.getElementById('show_on_main_page');

    function updateToggleState() {
        const selectedStatus = document.querySelector('input[name="status"]:checked').value;

        if (selectedStatus === 'ditolak') {
            showOnMainPageToggle.checked = false;
            showOnMainPageToggle.disabled = true;
        } else {
            showOnMainPageToggle.disabled = false;
        }
    }

    statusRadios.forEach(function(radio) {
        radio.addEventListener('change', updateToggleState);
    });

    // Initial check on page load
    updateToggleState();
});
</script>
@endpush