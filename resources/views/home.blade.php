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
                <div class="empty-state">
                    <i class="fas fa-box-open empty-state-icon"></i>
                    <p class="empty-state-text">Belum ada mitra yang terdaftar.</p>
                    <p class="empty-state-subtext">Silakan cek kembali nanti atau hubungi administrator.</p>
                </div>
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
            <div class="empty-state">
                <i class="fas fa-frown empty-state-icon"></i>
                <p class="empty-state-text">Belum ada prestasi mahasiswa yang ditampilkan.</p>
                <p class="empty-state-subtext">Tetap semangat dan terus berkarya!</p>
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
                            <div id="noResultsMessage" class="empty-state" style="display: none;">
                                <i class="fas fa-search-minus empty-state-icon"></i>
                                <p class="empty-state-text">Dokumen tidak ditemukan.</p>
                                <p class="empty-state-subtext">Coba kata kunci lain atau periksa kembali ejaan Anda.</p>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-folder-open empty-state-icon"></i>
                                <p class="empty-state-text">Belum ada dokumen yang tersedia.</p>
                                <p class="empty-state-subtext">Silakan cek kembali nanti.</p>
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
                    @if($faqs->isNotEmpty())
                    <div class="accordion" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $index }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                    {{ $faq->question }}
                                </button>
                            </h2>
                            <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    {{ $faq->answer }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="empty-state">
                        <i class="fas fa-question-circle empty-state-icon"></i>
                        <p class="empty-state-text">Belum ada FAQ yang tersedia.</p>
                        <p class="empty-state-subtext">Silakan cek kembali nanti atau tambahkan FAQ baru.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Script for Document Search (AJAX)
    const documentSearchInput = document.getElementById('documentSearch');
    const documentListContainer = document.getElementById('documentList');
    const noResultsMessage = document.getElementById('noResultsMessage');

    if (documentSearchInput && documentListContainer) {
        documentSearchInput.addEventListener('keyup', function () {
            const searchTerm = this.value;

            $.ajax({
                url: '{{ route('documents.search') }}',
                method: 'GET',
                data: { search: searchTerm },
                success: function (data) {
                    documentListContainer.innerHTML = ''; // Clear previous results
                    if (data.length > 0) {
                        noResultsMessage.style.display = 'none';
                        data.forEach(function (document) {
                            const documentItem = `
                                <div class="document-item" data-title="${document.title.toLowerCase()}">
                                    <div class="document-item-icon">
                                        <i class="fas fa-file-pdf"></i>
                                    </div>
                                    <div class="document-item-content">
                                        <h5 class="document-item-title">${document.title}</h5>
                                        <p class="document-item-meta">Tipe: PDF</p>
                                    </div>
                                    <div class="document-item-action">
                                        <a href="/storage/${document.file_path}" class="btn document-download-btn" download>
                                            <i class="fas fa-download me-2"></i>Download
                                        </a>
                                    </div>
                                </div>
                            `;
                            documentListContainer.insertAdjacentHTML('beforeend', documentItem);
                        });
                    } else {
                        noResultsMessage.style.display = 'block';
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: ", status, error);
                    documentListContainer.innerHTML = '';
                    noResultsMessage.style.display = 'block';
                    noResultsMessage.querySelector('p').innerText = 'Terjadi kesalahan saat mencari dokumen.';
                }
            });
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
