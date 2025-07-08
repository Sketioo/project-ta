@extends('layouts.app')

@section('title', 'Sistem Informasi Prodi')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section text-white text-center d-flex align-items-center justify-content-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4 animate__animated animate__fadeInDown">Teknologi Rekayasa Perangkat Lunak</h1>
            <p class="lead mb-5 animate__animated animate__fadeInUp">Mencetak talenta digital yang kreatif, inovatif, dan berdaya saing global.</p>
            <a href="#contact" class="btn btn-light btn-lg rounded-pill animate__animated animate__zoomIn">Hubungi Kami</a>
        </div>
    </section>

    <!-- Mitra Section -->
    <section id="mitra" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center section-title mb-5">Mitra Program Studi</h2>
            <div id="mitraCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center align-items-center g-4">
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ffd700/333333?text=Mitra+A" alt="Mitra A" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ffd700/333333?text=Mitra+B" alt="Mitra B" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ffd700/333333?text=Mitra+C" alt="Mitra C" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ffd700/333333?text=Mitra+D" alt="Mitra D" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ffd700/333333?text=Mitra+E" alt="Mitra E" class="img-fluid mx-auto">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center align-items-center g-4">
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ff8f00/ffffff?text=Mitra+F" alt="Mitra F" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ff8f00/ffffff?text=Mitra+G" alt="Mitra G" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ff8f00/ffffff?text=Mitra+H" alt="Mitra H" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ff8f00/ffffff?text=Mitra+I" alt="Mitra I" class="img-fluid mx-auto">
                            </div>
                            <div class="col-6 col-md-4 col-lg-2 text-center">
                                <img src="https://via.placeholder.com/150x80/ff8f00/ffffff?text=Mitra+J" alt="Mitra J" class="img-fluid mx-auto">
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#mitraCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#mitraCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Prestasi Section -->
    <section id="prestasi" class="py-5">
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
    <section id="dokumen" class="py-5 bg-light">
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
    <section id="contact" class="py-5">
        <div class="container">
            <h2 class="text-center section-title mb-5">Saran & Keluhan</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card contact-card">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="name" class="form-label contact-label">Nama</label>
                                    <input type="text" class="form-control contact-input" id="name">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label contact-label">Email</label>
                                    <input type="email" class="form-control contact-input" id="email">
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label contact-label">Pesan</label>
                                    <textarea class="form-control contact-textarea" id="message" rows="5"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary contact-button">Kirim Pesan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection