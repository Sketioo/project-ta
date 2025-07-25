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
            @foreach ($facilities as $index => $facility)
                <div class="row featurette-item">
                    <div class="col-md-7 {{ $index % 2 !== 0 ? 'order-md-2' : '' }}">
                        <h2 class="featurette-heading">{{ $facility->name }}</h2>
                        <p class="lead featurette-text">{{ $facility->description }}</p>
                        <p><a class="btn btn-primary" href="{{ route('facilities.show', $facility->id) }}">Lihat Detail &raquo;</a></p>
                    </div>
                    <div class="col-md-5 {{ $index % 2 !== 0 ? 'order-md-1' : '' }}">
                        <div class="featurette-image-container">
                            @if($facility->photos && !empty($facility->photos[0]))
                                <img src="{{ asset('storage/' . $facility->photos[0]) }}" class="featurette-image" alt="{{ $facility->name }}">
                            @else
                                <div class="featurette-placeholder">
                                    <span>Gambar tidak tersedia</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                @if (!$loop->last)
                    <hr class="featurette-divider">
                @endif
            @endforeach

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