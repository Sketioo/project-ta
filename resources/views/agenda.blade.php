@extends('layouts.app')

@section('title', 'Agenda & Kegiatan')

@section('content')
    <div class="container py-5">
        <h1 class="text-center section-title mb-5">Agenda & Kegiatan</h1>
        <div class="row g-4">
            <!-- Agenda Item -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x250.png/ff8f00/ffffff?text=Kampus+Merdeka" class="card-img-top" alt="Kampus Merdeka">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Sosialisasi Program Kampus Merdeka 2025</h5>
                        <p class="card-text text-muted">Persiapkan diri Anda untuk mengikuti program magang dan studi independen bersertifikat dari Kemendikbud.</p>
                        <p class="card-text"><small class="text-muted">Tanggal: 1 Agustus 2025</small></p>
                    </div>
                </div>
            </div>
            <!-- Agenda Item -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x250.png/ff8f00/ffffff?text=Guest+Lecture" class="card-img-top" alt="Guest Lecture">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Kuliah Tamu: Masa Depan AI</h5>
                        <p class="card-text text-muted">Dapatkan wawasan dari praktisi industri mengenai perkembangan terbaru di dunia kecerdasan buatan.</p>
                        <p class="card-text"><small class="text-muted">Tanggal: 15 September 2025</small></p>
                    </div>
                </div>
            </div>
            <!-- Agenda Item -->
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="https://via.placeholder.com/400x250.png/ff8f00/ffffff?text=Workshop" class="card-img-top" alt="Workshop">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Workshop Pengembangan Aplikasi Mobile</h5>
                        <p class="card-text text-muted">Pelatihan intensif selama 2 hari untuk membangun aplikasi mobile cross-platform dengan Flutter.</p>
                        <p class="card-text"><small class="text-muted">Tanggal: 5-6 Oktober 2025</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection