@extends('layouts.app')

@section('title', 'Sistem Informasi Prodi')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-white text-center py-5">
        <div class="container">
            <h1 class="display-4 fw-bold mb-3">Program Studi Teknik Informatika</h1>
            <p class="lead mb-4">Mencetak talenta digital yang kreatif, inovatif, dan berdaya saing global.</p>
            <a href="#contact" class="btn btn-light btn-lg rounded-pill">Hubungi Kami</a>
        </div>
    </section>

    <!-- Mitra Section -->
    <section id="mitra" class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Mitra Program Studi</h2>
            <div class="row align-items-center justify-content-center g-4">
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <img src="https://via.placeholder.com/150x80.png/cccccc/ffffff?text=Mitra+1" alt="Mitra 1" class="img-fluid mx-auto">
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <img src="https://via.placeholder.com/150x80.png/cccccc/ffffff?text=Mitra+2" alt="Mitra 2" class="img-fluid mx-auto">
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <img src="https://via.placeholder.com/150x80.png/cccccc/ffffff?text=Mitra+3" alt="Mitra 3" class="img-fluid mx-auto">
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <img src="https://via.placeholder.com/150x80.png/cccccc/ffffff?text=Mitra+4" alt="Mitra 4" class="img-fluid mx-auto">
                </div>
                <div class="col-6 col-md-4 col-lg-2 text-center">
                    <img src="https://via.placeholder.com/150x80.png/cccccc/ffffff?text=Mitra+5" alt="Mitra 5" class="img-fluid mx-auto">
                </div>
            </div>
        </div>
    </section>

    <!-- Prestasi Section -->
    <section id="prestasi" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Prestasi Mahasiswa</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Juara 1 Lomba Web Design Nasional</h5>
                            <p class="card-text text-muted">Tim kami berhasil meraih juara pertama dalam kompetisi desain web tingkat nasional yang diselenggarakan oleh Kemendikbud.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Finalis Kompetisi Aplikasi Mobile</h5>
                            <p class="card-text text-muted">Aplikasi "EduLearn" karya mahasiswa kami berhasil menjadi finalis dalam ajang kompetisi aplikasi mobile tingkat Asia Tenggara.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">Juara 2 Lomba Competitive Programming</h5>
                            <p class="card-text text-muted">Mahasiswa kami menunjukkan kemampuannya dengan meraih juara kedua dalam kompetisi pemrograman kompetitif.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dokumen Section -->
    <section id="dokumen" class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Dokumen Penting</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Panduan Akademik 2025
                                    <a href="#" class="btn btn-sm btn-outline-secondary">Download</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Kalender Akademik 2025/2026
                                    <a href="#" class="btn btn-sm btn-outline-secondary">Download</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Formulir KRS
                                    <a href="#" class="btn btn-sm btn-outline-secondary">Download</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section id="contact" class="bg-light py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Saran & Keluhan</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="message" rows="5"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary-custom btn-lg rounded-pill">Kirim Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
