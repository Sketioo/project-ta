@extends('layouts.app')

@push('styles')
<style>
    /* Palet Warna Baru: Biru Lembut & Modern */
    .kurikulum-body {
        background-color: #f4f7fc;
        background-image: linear-gradient(170deg, rgba(244, 247, 252, 0.95) 0%, rgba(255, 255, 255, 0.95) 100%), url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='52' height='52' viewBox='0 0 52 52'%3E%3Cpath fill='%23d8e1ef' fill-opacity='0.3' d='M0 17.83V0h17.83a3 3 0 0 1-2.12 5.12L3 7.24V15a3 3 0 0 1-3 2.83zm0 16.34a3 3 0 0 1 3-2.83h12.24l-2.12-2.12a3 3 0 0 1 2.12-5.12H0v10.07zm17.83 17.83a3 3 0 0 1-5.12-2.12L14.83 35H3a3 3 0 0 1-2.83 3v14h17.66a3 3 0 0 1-2.12-5.12zM52 0v17.83a3 3 0 0 1-3 2.83H36.76l2.12 2.12a3 3 0 0 1-2.12 5.12H52V0zm0 34.17a3 3 0 0 1-3 2.83H34.76l2.12 2.12a3 3 0 0 1-2.12 5.12H52V34.17zM34.17 0a3 3 0 0 1 5.12 2.12L37.17 15H49a3 3 0 0 1 2.83-3V0H34.17z'/%3E%3C/svg%3E");
        padding: 3rem 0;
    }
    .kurikulum-title-container {
        text-align: center;
        margin-bottom: 2.5rem;
    }
    .kurikulum-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a253c; /* Warna gelap yang lebih pekat */
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }
    .kurikulum-title::after {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        bottom: 0;
        width: 100px;
        height: 4px;
        background-color: var(--primary-color);
        border-radius: 2px;
    }
    .kurikulum-description {
        font-size: 1.1rem;
        color: #5a6782; /* Warna abu-biru yang lebih lembut */
        margin-top: 1rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .page-content-container {
        background-color: #fff;
        padding: 2.5rem;
        border-radius: 15px;
        box-shadow: 0 10px 40px rgba(41, 82, 122, 0.08);
        height: 100%;
    }
    .kurikulum-image-card {
        margin-bottom: 2rem;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.05);
        border: 1px solid #e9ecef;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .kurikulum-image-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(41, 82, 122, 0.1);
    }
    .kurikulum-image-card .card-body {
        padding: 0;
    }
    .kurikulum-image-card img {
        width: 100%;
        height: auto;
        display: block;
    }
    .empty-state-kurikulum {
        text-align: center;
        padding: 3rem;
    }

    /* Style untuk Sidebar dan Info Box */
    .info-box {
        background-color: #ffffff;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #e8eef7;
        box-shadow: 0 5px 25px rgba(41, 82, 122, 0.06);
        transition: all 0.3s ease;
    }
    .info-box:hover {
        border-left: 4px solid var(--primary-color);
        transform: translateX(5px);
    }
    .info-box-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 1rem;
        position: relative;
        padding-left: 1.8rem;
    }
    .info-box-title::before {
        content: '❖';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.1rem;
        color: var(--primary-color);
    }
    .info-box-content p, .info-box-content ul {
        font-size: 0.95rem;
        color: #3e4a61; /* Warna teks konten yang lebih gelap dan kontras */
        line-height: 1.6;
    }
    .info-box-content ul {
        padding-left: 1.2rem;
        margin-top: 0.5rem;
    }
    .info-box-content li {
        margin-bottom: 0.4rem;
    }
</style>
@endpush

@section('content')
<div class="kurikulum-body">
    <div class="container">
        <div class="kurikulum-title-container">
            <h1 class="kurikulum-title">{{ $curriculum->name }}</h1>
            @if($curriculum->description)
                <p class="kurikulum-description">{{ $curriculum->description }}</p>
            @endif
        </div>

        <div class="row">
            {{-- Kolom Utama untuk Konten Kurikulum --}}
            <div class="col-lg-8">
                <div class="page-content-container">
                    @if($curriculum->images->isNotEmpty())
                        <div class="kurikulum-gallery">
                            @foreach($curriculum->images as $index => $image)
                                <div class="card kurikulum-image-card">
                                    <div class="card-body">
                                        <a href="{{ Storage::url($image->image_path) }}" data-toggle="lightbox" data-gallery="kurikulum-gallery">
                                            <img src="{{ Storage::url($image->image_path) }}" class="img-fluid" alt="Gambar Kurikulum {{ $curriculum->name }} bagian {{ $index + 1 }}">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state-kurikulum">
                            <p class="h5 text-muted">Tidak ada gambar struktur kurikulum yang tersedia saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Kolom Sidebar untuk Informasi Tambahan --}}
            <div class="col-lg-4">
                <div class="sidebar">
                    <div class="info-box">
                        <h5 class="info-box-title">Tujuan Program Studi</h5>
                        <div class="info-box-content">
                            <p>Menghasilkan lulusan yang kompeten, mampu beradaptasi dengan perkembangan teknologi, dan memiliki jiwa wirausaha.</p>
                        </div>
                    </div>

                    <div class="info-box">
                        <h5 class="info-box-title">Profil Lulusan</h5>
                        <div class="info-box-content">
                           <ul>
                                <li>Software Developer</li>
                                <li>System Analyst</li>
                                <li>Data Scientist</li>
                                <li>IT Consultant</li>
                                <li>Technopreneur</li>
                           </ul>
                        </div>
                    </div>

                    <div class="info-box">
                        <h5 class="info-box-title">Metode Pembelajaran</h5>
                        <div class="info-box-content">
                            <p>Kami menerapkan metode inovatif, termasuk studi kasus, project-based learning, dan workshop interaktif untuk pemahaman mendalam.</p>
                        </div>
                    </div>

                    <div class="info-box">
                        <h5 class="info-box-title">Sertifikasi Profesional</h5>
                        <div class="info-box-content">
                            <p>Mahasiswa didorong meraih sertifikasi industri (misal: Oracle, Cisco, Microsoft) untuk meningkatkan daya saing di pasar global.</p>
                        </div>
                    </div>

                    <div class="info-box">
                        <h5 class="info-box-title">Kegiatan Pendukung</h5>
                        <div class="info-box-content">
                            <p>Tersedia seminar, kuliah tamu dari praktisi, dan UKM untuk mendukung pengembangan soft skills dan jaringan profesional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>
@endpush