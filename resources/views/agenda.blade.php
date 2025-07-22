@extends('layouts.app')

@section('title', 'Agenda & Kegiatan')

@section('content')
    <div class="container py-5">
        <h1 class="section-title mb-5">Agenda & Kegiatan</h1>

        <!-- Search Bar -->
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 col-md-10">
                <form action="{{ route('agenda') }}" method="GET" class="d-flex agenda-search-form">
                    <div class="input-group">
                        <input type="text" name="search" id="agendaSearchInput" class="form-control agenda-search-input" placeholder="Cari agenda..." value="{{ request('search') }}">
                        <button class="btn agenda-search-btn" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="section-separator mb-5"></div>

        @if($agendas->isEmpty() && !request()->has('search'))
            <div class="empty-state">
                <i class="fas fa-calendar-times empty-state-icon"></i>
                <p class="empty-state-text">Tidak ada agenda yang tersedia saat ini.</p>
                <p class="empty-state-subtext">Silakan cek kembali nanti!</p>
            </div>
        @else
            <div class="row g-4" id="agendaListContainer">
                @foreach($agendas as $agenda)
                <div class="col-md-4 agenda-card-wrapper" data-animation="animate__fadeInUp">
                    <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden agenda-card">
                        <div class="agenda-image-container">
                            @if($agenda->images && count($agenda->images) > 0)
                                <img src="{{ asset('storage/' . $agenda->images[0]) }}" class="card-img-top" alt="{{ $agenda->title }}">
                            @else
                                <img src="https://via.placeholder.com/400x250.png/cccccc/ffffff?text=No+Image" class="card-img-top" alt="No Image">
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column agenda-card-body">
                            <h5 class="card-title fw-bold text-primary">{{ $agenda->title }}</h5>
                            <p class="card-text text-muted flex-grow-1">{{ Str::limit($agenda->description, 100) }}</p>
                            <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>Tanggal: {{ \Carbon\Carbon::parse($agenda->date)->translatedFormat('d M Y') }}</small></p>
                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Lokasi: {{ $agenda->location }}</small></p>
                            <a href="{{ route('agenda.show.public', $agenda->id) }}" class="btn btn-outline-primary mt-auto agenda-read-more-btn">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty state for search results -->
            <div id="noResultsMessage" class="empty-state" style="display: none;">
                <i class="fas fa-search-minus empty-state-icon"></i>
                <p class="empty-state-text">Agenda tidak ditemukan.</p>
                <p class="empty-state-subtext">Coba kata kunci lain atau periksa kembali ejaan Anda.</p>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center mt-5" id="agendaPaginationLinks">
                {{ $agendas->links() }}
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('agendaSearchInput');
    const listContainer = document.getElementById('agendaListContainer');
    const noResultsMessage = document.getElementById('noResultsMessage');
    const paginationLinks = document.getElementById('agendaPaginationLinks');

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
                url: '{{ route('agenda') }}',
                method: 'GET',
                data: { search: searchTerm },
                success: function (data) {
                    listContainer.innerHTML = ''; // Clear previous results

                    if (data.length > 0) {
                        noResultsMessage.style.display = 'none';
                        listContainer.style.display = 'flex'; // Make sure container is visible

                        data.forEach(function (agenda) {
                            const agendaDate = new Date(agenda.date);
                            const formattedDate = agendaDate.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' });
                            const description = agenda.description.length > 100 ? agenda.description.substring(0, 100) + '...' : agenda.description;
                            const imageUrl = agenda.images && agenda.images.length > 0
                                ? `/storage/${agenda.images[0]}`
                                : `https://via.placeholder.com/400x250.png/cccccc/ffffff?text=No+Image`;

                            const agendaCard = `
                                <div class="col-md-4 agenda-card-wrapper" data-animation="animate__fadeInUp">
                                    <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden agenda-card">
                                        <div class="agenda-image-container">
                                            <img src="${imageUrl}" class="card-img-top" alt="${agenda.title}">
                                        </div>
                                        <div class="card-body d-flex flex-column agenda-card-body">
                                            <h5 class="card-title fw-bold text-primary">${agenda.title}</h5>
                                            <p class="card-text text-muted flex-grow-1">${description}</p>
                                            <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>Tanggal: ${formattedDate}</small></p>
                                            <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Lokasi: ${agenda.location}</small></p>
                                            <a href="/agenda/${agenda.id}" class="btn btn-outline-primary mt-auto agenda-read-more-btn">Baca Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            `;
                            listContainer.insertAdjacentHTML('beforeend', agendaCard);
                        });
                    } else {
                        listContainer.style.display = 'none'; // Hide container
                        noResultsMessage.style.display = 'flex'; // Show no results message
                    }
                },
                error: function (xhr, status, error) {
                    console.error("AJAX Error: ", status, error);
                    listContainer.style.display = 'none';
                    noResultsMessage.style.display = 'flex';
                    noResultsMessage.querySelector('.empty-state-text').innerText = 'Terjadi kesalahan saat mencari agenda.';
                }
            });
        }, 300); // Debounce for 300ms
    });
});
</script>
@endpush
