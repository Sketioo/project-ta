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

    <!-- Visi Misi Section -->
    <section id="visi-misi" class="visi-misi-section" data-animation="animate__fadeInUp">
        <div class="container">
            <div class="row g-0 vm-container-box">
                <!-- Visi Column -->
                <div class="col-lg-6 vm-col vm-col-visi">
                    <div class="vm-icon-bg"><i class="fas fa-eye"></i></div>
                    <h3 class="vm-title">Visi</h3>
                    <p>Menjadi program studi Teknologi Rekayasa Perangkat Lunak yang unggul dan inovatif dalam pengembangan solusi digital cerdas, serta berdaya saing di tingkat nasional maupun internasional pada tahun 2030.</p>
                </div>
                <!-- Misi Column -->
                <div class="col-lg-6 vm-col vm-col-misi">
                    <div class="vm-icon-bg"><i class="fas fa-bullseye"></i></div>
                    <h3 class="vm-title">Misi</h3>
                    <ul>
                        <li>Menyelenggarakan pendidikan vokasi yang berkualitas di bidang rekayasa perangkat lunak dengan kurikulum yang adaptif terhadap perkembangan industri.</li>
                        <li>Melaksanakan penelitian terapan yang inovatif untuk menghasilkan produk dan solusi digital yang bermanfaat bagi masyarakat dan industri.</li>
                        <li>Menjalin kemitraan strategis dengan industri dan berbagai pihak untuk meningkatkan kompetensi lulusan dan relevansi program studi.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Prestasi Section -->
    <section id="prestasi" class="py-5" data-animation="animate__fadeInUp">
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
                                        @if($achievement->photos_dokumentasi && count($achievement->photos_dokumentasi) > 0)
                                            <img src="{{ asset('storage/' . $achievement->photos_dokumentasi[0]) }}" class="card-img-top" alt="{{ $achievement->nama_kompetisi }} - {{ $achievement->prestasi }}">
                                        @else
                                            <img src="https://via.placeholder.com/400x220.png/1a1a1a/FFD700?text=TRPL" class="card-img-top" alt="No Image">
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $achievement->nama_kompetisi }} - {{ $achievement->prestasi }}</h5>
                                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($achievement->keterangan_lomba, 100) }}</p>
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
    <section id="dokumen" class="py-5 bg-light" data-animation="animate__fadeInUp">
        <div class="container">
            <h2 class="section-title mb-5">Pusat Dokumen</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <!-- Search and Filter Controls -->
                    <div class="document-controls mb-4">
                        <div class="input-group document-search-form">
                            <input type="text" id="documentSearch" class="form-control document-search-input" placeholder="Cari dokumen...">
                            <button class="btn document-search-btn" type="button"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-filter-dropdown" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="filterDropdown">
                                <h6 class="dropdown-header">Filter Berdasarkan Kategori</h6>
                                <div id="categoryFilterCheckboxes">
                                    @if($documentCategories->isNotEmpty())
                                        @foreach($documentCategories as $category)
                                            <div class="form-check custom-form-check">
                                                <input class="form-check-input" type="checkbox" value="{{ $category->id }}" id="category-{{ $category->id }}">
                                                <label class="form-check-label" for="category-{{ $category->id }}">
                                                    {{ $category->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted px-2">Tidak ada kategori.</p>
                                    @endif
                                </div>
                                @if($documentCategories->isNotEmpty())
                                <div class="dropdown-divider"></div>
                                <div class="px-2">
                                    <button class="btn btn-primary-custom w-100" id="applyFilterBtn">Terapkan</button>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="document-list-container">
                        @if($documents->isNotEmpty())
                            <div id="documentList">
                                @foreach($documents as $document)
                                    @php
                                        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
                                        $iconClass = 'fa-file-alt'; // Default icon
                                        $fileType = strtoupper($extension);

                                        switch (strtolower($extension)) {
                                            case 'pdf': $iconClass = 'fa-file-pdf'; break;
                                            case 'doc': case 'docx': $iconClass = 'fa-file-word'; $fileType = 'Word'; break;
                                            case 'xls': case 'xlsx': $iconClass = 'fa-file-excel'; $fileType = 'Excel'; break;
                                            case 'csv': $iconClass = 'fa-file-csv'; $fileType = 'CSV'; break;
                                            case 'ppt': case 'pptx': $iconClass = 'fa-file-powerpoint'; $fileType = 'PowerPoint'; break;
                                            case 'zip': case 'rar': $iconClass = 'fa-file-archive'; break;
                                            case 'jpg': case 'jpeg': case 'png': case 'gif': $iconClass = 'fa-file-image'; $fileType = 'Gambar'; break;
                                        }
                                    @endphp
                                <div class="document-item" data-title="{{ strtolower($document->title) }}">
                                    <div class="document-item-icon">
                                        <i class="fas {{ $iconClass }}"></i>
                                    </div>
                                    <div class="document-item-content">
                                        <h5 class="document-item-title">{{ $document->title }}</h5>
                                        <p class="document-item-meta">Tipe: {{ $fileType }}</p>
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
    const documentListContainer = document.getElementById('documentList');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const documentSearchInput = document.getElementById('documentSearch');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const categoryCheckboxes = document.querySelectorAll('#categoryFilterCheckboxes .form-check-input');

    // Prevent dropdown from closing when clicking inside
    document.querySelector('.dropdown-menu').addEventListener('click', function (e) {
        e.stopPropagation();
    });

    function getFileIconInfo(filePath) {
        const extension = filePath ? filePath.split('.').pop().toLowerCase() : '';
        let iconClass = 'fa-file-alt';
        let fileType = extension.toUpperCase();
        switch (extension) {
            case 'pdf': iconClass = 'fa-file-pdf'; break;
            case 'doc': case 'docx': iconClass = 'fa-file-word'; fileType = 'Word'; break;
            case 'xls': case 'xlsx': iconClass = 'fa-file-excel'; fileType = 'Excel'; break;
            case 'csv': iconClass = 'fa-file-csv'; fileType = 'CSV'; break;
            case 'ppt': case 'pptx': iconClass = 'fa-file-powerpoint'; fileType = 'PowerPoint'; break;
            case 'zip': case 'rar': iconClass = 'fa-file-archive'; break;
            case 'jpg': case 'jpeg': case 'png': case 'gif': iconClass = 'fa-file-image'; fileType = 'Gambar'; break;
        }
        return { iconClass, fileType };
    }

    function renderDocuments(data) {
        documentListContainer.innerHTML = '';
        if (data.length > 0) {
            noResultsMessage.style.display = 'none';
            data.forEach(function (document) {
                const { iconClass, fileType } = getFileIconInfo(document.file_path);
                const documentItem = `
                    <div class="document-item" data-title="${document.title.toLowerCase()}">
                        <div class="document-item-icon"><i class="fas ${iconClass}"></i></div>
                        <div class="document-item-content">
                            <h5 class="document-item-title">${document.title}</h5>
                            <p class="document-item-meta">Tipe: ${fileType}</p>
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
    }

    function fetchDocuments(url, data) {
        $.ajax({
            url: url,
            method: 'GET',
            data: data,
            success: function (response) {
                renderDocuments(response);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                documentListContainer.innerHTML = '';
                noResultsMessage.style.display = 'block';
                noResultsMessage.querySelector('p').innerText = 'Terjadi kesalahan saat memuat dokumen.';
            }
        });
    }

    // Handler for Apply Filter button
    if (applyFilterBtn) {
        applyFilterBtn.addEventListener('click', function () {
            const selectedCategories = [];
            categoryCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    selectedCategories.push(checkbox.value);
                }
            });
            fetchDocuments('{{ route('documents.filter') }}', { category_ids: selectedCategories });
        });
    }

    // Handler for search input
    if (documentSearchInput) {
        documentSearchInput.addEventListener('keyup', function () {
            const searchTerm = this.value;
            fetchDocuments('{{ route('documents.search') }}', { search: searchTerm });
        });
    }
});
</script>
@endpush
