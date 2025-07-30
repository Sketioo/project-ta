@extends('layouts.app')

@section('title', 'Fasilitas Program Studi')

@section('content')
<section class="facility-section">
    <div class="container">

        <div class="section-title-container">
            <h2>Fasilitas Unggulan</h2>
            <p>Kami menyediakan lingkungan belajar yang modern dan lengkap untuk mendukung kesuksesan akademik dan praktis mahasiswa.</p>
        </div>

        @if($facilities->isNotEmpty())
            <div class="facility-grid">
                @foreach ($facilities as $facility)
                    <div class="facility-card">
                        <div class="card-img-container">
                            @if($facility->photos && !empty($facility->photos[0]))
                                <img src="{{ asset('storage/' . $facility->photos[0]) }}" class="card-img" alt="{{ $facility->name }}">
                            @else
                                <div class="facility-placeholder">
                                    <span>Gambar tidak tersedia</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">{{ $facility->name }}</h3>
                            <p class="card-text">{{ Str::limit($facility->description, 120) }}</p>
                            <a href="{{ route('facilities.show', $facility->id) }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($facilities->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $facilities->links() }}
                </div>
            @endif
        @else
            <div class="empty-state-container">
                <div class="icon">
                    <i class="fas fa-building-circle-xmark"></i>
                </div>
                <h3>Fasilitas Belum Tersedia</h3>
                <p>Saat ini belum ada data fasilitas yang dapat ditampilkan. Kami akan segera memperbaruinya.</p>
            </div>
        @endif

    </div>
</section>
@endsection