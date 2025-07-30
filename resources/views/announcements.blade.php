@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
    <div class="container py-5">
        <h1 class="section-title mb-5">Pengumuman</h1>

        <!-- Search Bar -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 col-md-10">
                <form action="{{ route('announcements.public.index') }}" method="GET" class="d-flex agenda-search-form">
                    <div class="input-group">
                        <input type="text" name="search" id="announcementSearchInput" class="form-control agenda-search-input" placeholder="Cari pengumuman..." value="{{ request('search') }}">
                        <button class="btn agenda-search-btn" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="section-separator mb-5"></div>

        @if($announcements->isEmpty() && !request()->has('search'))
            <div class="empty-state">
                <i class="fas fa-bullhorn empty-state-icon"></i>
                <p class="empty-state-text">Tidak ada pengumuman yang tersedia saat ini.</p>
                <p class="empty-state-subtext">Silakan cek kembali nanti!</p>
            </div>
        @else
            <div class="row g-4" id="announcementListContainer">
                @foreach($announcements as $announcement)
                <div class="col-md-4 agenda-card-wrapper" data-animation="animate__fadeInUp">
                    <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden agenda-card">
                        <div class="agenda-image-container">
                            @if($announcement->photos_path && count($announcement->photos_path) > 0)
                                <img src="{{ asset('storage/' . $announcement->photos_path[0]) }}" class="card-img-top" alt="{{ $announcement->title }}">
                            @else
                                <img src="https://via.placeholder.com/400x250.png/cccccc/ffffff?text=No+Image" class="card-img-top" alt="No Image">
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column agenda-card-body">
                            <h5 class="card-title fw-bold text-primary">{{ $announcement->title }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($announcement->content, 100) }}</p>
                            <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-tag me-1"></i>Kategori: {{ ucfirst($announcement->category) }}</small></p>
                            <a href="{{ route('announcements.public.show', $announcement->id) }}" class="btn btn-outline-primary mt-auto agenda-read-more-btn">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty state for search results -->
            <div id="noResultsMessage" class="empty-state" style="display: none;">
                <i class="fas fa-search-minus empty-state-icon"></i>
                <p class="empty-state-text">Pengumuman tidak ditemukan.</p>
                <p class="empty-state-subtext">Coba kata kunci lain atau periksa kembali ejaan Anda.</p>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-5" id="announcementPaginationLinks">
                {{ $announcements->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('announcementSearchInput');
    const listContainer = document.getElementById('announcementListContainer');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const paginationLinks = document.getElementById('announcementPaginationLinks');

    let searchTimeout;

    searchInput.addEventListener('keyup', function () {
        clearTimeout(searchTimeout);
        const searchTerm = this.value;

        // Hide pagination during search
        if (paginationLinks) {
            paginationLinks.style.display = 'none';
        }

        searchTimeout = setTimeout(() => {
            $.ajax({
                url: '{{ route('announcements.public.index') }}',
                method: 'GET',
                data: { search: searchTerm },
                success: function (data) {
                    listContainer.innerHTML = ''; // Clear previous results

                    if (data.length > 0) {
                        noResultsMessage.style.display = 'none';
                        listContainer.style.display = 'flex'; // Make sure container is visible

                        data.forEach(function (announcement) {
                            const content = announcement.content.length > 100 ? announcement.content.substring(0, 100) + '...' : announcement.content;
                            const imageUrl = announcement.photos_path && announcement.photos_path.length > 0
                                ? `/storage/${announcement.photos_path[0]}`
                                : `https://via.placeholder.com/400x250.png/cccccc/ffffff?text=No+Image`;

                            const announcementCard = `
                                <div class="col-md-4 agenda-card-wrapper" data-animation="animate__fadeInUp">
                                    <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden agenda-card">
                                        <div class="agenda-image-container">
                                            <img src="${imageUrl}" class="card-img-top" alt="${announcement.title}">
                                        </div>
                                        <div class="card-body d-flex flex-column agenda-card-body">
                                            <h5 class="card-title fw-bold text-primary">${announcement.title}</h5>
                                            <p class="card-text text-muted flex-grow-1">${content}</p>
                                            <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-tag me-1"></i>Kategori: ${announcement.category.charAt(0).toUpperCase() + announcement.category.slice(1)}</small></p>
                                            <a href="/announcements/${announcement.id}" class="btn btn-outline-primary mt-auto agenda-read-more-btn">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            listContainer.insertAdjacentHTML('beforeend', announcementCard);
                        });
                    } else {
                        listContainer.style.display = 'none'; // Hide container
                        noResultsMessage.style.display = 'block'; // Show no results message
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: ", status, error);
                    listContainer.style.display = 'none';
                    noResultsMessage.style.display = 'block';
                    noResultsMessage.querySelector('.empty-state-text').innerText = 'Terjadi kesalahan saat mencari pengumuman.';
                }
            });
        }, 300); // Debounce for 300ms
    });
});
</script>
@endpush
