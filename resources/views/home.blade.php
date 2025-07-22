@extends('layouts.app')

@section('title', 'Sistem Informasi Prodi TRPL')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="animate__animated animate__fadeInDown">Teknologi Rekayasa Perangkat Lunak</h1>
                    <p class="lead mb-5 animate__animated animate__fadeInUp">Mencetak talenta digital yang kreatif, inovatif, dan berdaya saing global.</p>
                    <a href="#prestasi" class="btn animate__animated animate__pulse">Lihat Prestasi</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Mitra Section -->
    <section id="mitra" class="py-5" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="section-title mb-5">Mitra Industri</h2>
            @if($partners->isNotEmpty())
                <div id="mitraCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @php
                            $chunkedPartners = $partners->chunk(6); // 6 logos per slide
                        @endphp

                        @foreach ($chunkedPartners as $key => $chunk)
                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                            <div class="row justify-content-center align-items-center g-4">
                                @foreach ($chunk as $partner)
                                <div class="col-6 col-md-4 col-lg-2 text-center  p-3">
                                    <div class="partner-logo-wrapper">
                                        <a href="{{ $partner->website_url ?? '#' }}" target="_blank" rel="noopener noreferrer" title="{{ $partner->name }}">
                                            <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" class="img-fluid mx-auto">
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @if(count($chunkedPartners) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#mitraCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#mitraCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    @endif
                </div>
            @else
                <p class="text-center text-muted mb-3 mt-3">Belum ada mitra yang terdaftar.</p>
            @endif
        </div>
    </section>

    <!-- Prestasi Section -->
    <section id="prestasi" class="py-5 bg-light" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="section-title mb-5">Prestasi Mahasiswa</h2>
            @if($achievements->isNotEmpty())
            <div id="achievementCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @php
                        $chunkedAchievements = $achievements->chunk(3); // 3 cards per slide
                    @endphp

                    @foreach ($chunkedAchievements as $key => $chunk)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <div class="row g-4 justify-content-center">
                            @foreach ($chunk as $achievement)
                            <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                                <div class="card achievement-card w-100">
                                    <div class="achievement-image-container">
                                        @if($achievement->photo_path)
                                            <img src="{{ asset('storage/' . $achievement->photo_path) }}" class="card-img-top" alt="{{ $achievement->title }}">
                                        @else
                                            <img src="https://via.placeholder.com/400x220.png/1a1a1a/FFD700?text=TRPL" class="card-img-top" alt="No Image">
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $achievement->title }}</h5>
                                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($achievement->description, 100) }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#achievementCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#achievementCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
            @else
            <div class="text-center">
                <p>Belum ada prestasi mahasiswa yang ditampilkan.</p>
            </div>
            @endif
        </div>
    </section>

    <!-- Dokumen Section -->
    <section id="dokumen" class="py-5" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="section-title mb-5">Pusat Dokumen</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Search Bar -->
                    <div class="mb-4">
                        <form action="#" method="GET" class="d-flex document-search-form">
                            <div class="input-group">
                                <input type="text" id="documentSearch" class="form-control document-search-input" placeholder="Cari dokumen...">
                                <button class="btn document-search-btn" type="button"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                    </div>

                    <div class="document-list-container">
                        @if($documents->isNotEmpty())
                            <div id="documentList">
                                @foreach($documents as $document)
                                <div class="document-item" data-title="{{ strtolower($document->title) }}">
                                    <div class="document-item-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="document-item-content">
                                        <h5 class="document-item-title">{{ $document->title }}</h5>
                                        <p class="document-item-meta">Tipe: PDF</p>
                                    </div>
                                    <div class="document-item-action">
                                        <a href="{{ Storage::url($document->file_path) }}" class="btn document-download-btn" download>
                                            <i class="fas fa-download me-2"></i>Download
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div id="noResultsMessage" class="text-center p-4" style="display: none;">
                                <p class="mb-0">Dokumen tidak ditemukan.</p>
                            </div>
                        @else
                            <div class="text-center p-4">
                                <p class="mb-0">Belum ada dokumen yang tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="section-title mb-5">Frequently Asked Questions (FAQ)</h2>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion" id="faqAccordion">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    Bagaimana cara mendaftar di prodi TRPL?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Pendaftaran untuk program studi Teknologi Rekayasa Perangkat Lunak (TRPL) mengikuti jadwal dan prosedur penerimaan mahasiswa baru di tingkat institusi. Anda dapat menemukan semua informasi terkait, termasuk tanggal penting, persyaratan, dan alur pendaftaran, di situs web resmi penerimaan mahasiswa baru kami.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Apa saja prospek karir setelah lulus dari TRPL?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Lulusan TRPL memiliki prospek karir yang sangat luas di industri teknologi. Beberapa peran yang umum diisi oleh lulusan kami antara lain: Software Developer, Mobile App Developer, Web Developer (Front-end & Back-end), UI/UX Designer, Quality Assurance Engineer, dan DevOps Engineer. Kami juga membekali mahasiswa dengan keterampilan kewirausahaan untuk memulai startup teknologi mereka sendiri.
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Item 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Apakah ada program magang atau kerja praktik?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, program magang atau kerja praktik industri merupakan bagian wajib dari kurikulum kami. Kami telah menjalin kemitraan dengan berbagai perusahaan teknologi terkemuka untuk memberikan mahasiswa pengalaman kerja nyata di lingkungan profesional. Program ini dirancang untuk menjembatani teori yang dipelajari di kelas dengan praktik di industri.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Script for Document Search
    const searchInput = document.getElementById('documentSearch');
    const documentList = document.getElementById('documentList');
    
    if (searchInput && documentList) {
        const documentItems = documentList.querySelectorAll('.document-item');
        const noResultsMessage = document.getElementById('noResultsMessage');

        searchInput.addEventListener('keyup', function () {
            const searchTerm = searchInput.value.toLowerCase();
            let visibleCount = 0;

            documentItems.forEach(function (item) {
                const title = item.getAttribute('data-title');
                if (title.includes(searchTerm)) {
                    item.style.display = '';
                    visibleCount++;
                } else {
                    item.style.display = 'none';
                }
            });

            if (visibleCount === 0) {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
        });
    }

    // Script for FAQ Accordion Icon Toggle
    const faqAccordion = document.getElementById('faqAccordion');
    if (faqAccordion) {
        const accordionItems = faqAccordion.querySelectorAll('.accordion-item');
        accordionItems.forEach(item => {
            const button = item.querySelector('.accordion-button');
            button.addEventListener('click', () => {
                // The 'collapsed' class is managed by Bootstrap automatically.
                // The CSS handles the icon change based on the presence of '.collapsed' class.
                // No extra JS is needed to toggle icons if using the CSS ::after pseudo-element approach.
            });
        });
    }
});
</script>
@endpush
