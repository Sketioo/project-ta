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
                        <button class="btn agenda-search-btn" type="button" id="agendaSearchButton"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>

        <div class="section-separator mb-5"></div>

        <div class="row g-4" id="agendaListContainer">
            @forelse($agendas as $agenda)
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
                        <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>Tanggal: {{ $agenda->date->format('d M Y') }}</small></p>
                        <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Lokasi: {{ $agenda->location }}</small></p>
                        <a href="{{ route('agenda.show.public', $agenda->id) }}" class="btn btn-outline-primary mt-auto agenda-read-more-btn">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="empty-state" id="agendaEmptyState">
                    <i class="fas fa-calendar-times empty-state-icon"></i>
                    <p class="empty-state-text">Tidak ada agenda yang tersedia saat ini.</p>
                    <p class="empty-state-subtext">Silakan cek kembali nanti!</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="d-flex justify-content-center mt-5" id="agendaPaginationLinks">
            {{ $agendas->links() }}
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const agendaSearchInput = document.getElementById('agendaSearchInput');
    const agendaListContainer = document.getElementById('agendaListContainer');
    const agendaPaginationLinks = document.getElementById('agendaPaginationLinks');
    const agendaEmptyState = document.getElementById('agendaEmptyState');

    function fetchAgendas(page = 1, searchTerm = '') {
        $.ajax({
            url: '{{ route('agenda') }}',
            method: 'GET',
            data: { page: page, search: searchTerm, ajax: 1 }, // Add ajax flag
            success: function (response) {
                agendaListContainer.innerHTML = ''; // Clear current agendas
                agendaPaginationLinks.innerHTML = ''; // Clear current pagination

                if (response.data.length > 0) {
                    agendaEmptyState.style.display = 'none';
                    response.data.forEach(function (agenda) {
                        const agendaCard = `
                            <div class="col-md-4 agenda-card-wrapper" data-animation="animate__fadeInUp">
                                <div class="card h-100 shadow-sm border-0 rounded-lg overflow-hidden agenda-card">
                                    <div class="agenda-image-container">
                                        ${agenda.images && agenda.images.length > 0
                                            ? `<img src="/storage/${agenda.images[0]}" class="card-img-top" alt="${agenda.title}">`
                                            : `<img src="https://via.placeholder.com/400x250.png/cccccc/ffffff?text=No+Image" class="card-img-top" alt="No Image">`
                                        }
                                    </div>
                                    <div class="card-body d-flex flex-column agenda-card-body">
                                        <h5 class="card-title fw-bold text-primary">${agenda.title}</h5>
                                        <p class="card-text text-muted flex-grow-1">${agenda.description.substring(0, 100)}${agenda.description.length > 100 ? '...' : ''}</p>
                                        <p class="card-text mb-1"><small class="text-muted"><i class="fas fa-calendar-alt me-1"></i>Tanggal: ${new Date(agenda.date).toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })}</small></p>
                                        <p class="card-text"><small class="text-muted"><i class="fas fa-map-marker-alt me-1"></i>Lokasi: ${agenda.location}</small></p>
                                        <a href="/agenda/${agenda.id}" class="btn btn-outline-primary mt-auto agenda-read-more-btn">Baca Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        agendaListContainer.insertAdjacentHTML('beforeend', agendaCard);
                    });

                    // Update pagination links
                    if (response.last_page > 1) {
                        let paginationHtml = '<ul class="pagination">';
                        for (let i = 1; i <= response.last_page; i++) {
                            paginationHtml += `
                                <li class="page-item ${i === response.current_page ? 'active' : ''}">
                                    <a class="page-link" href="#" data-page="${i}">${i}</a>
                                </li>
                            `;
                        }
                        paginationHtml += '</ul>';
                        agendaPaginationLinks.innerHTML = paginationHtml;
                    }

                } else {
                    agendaEmptyState.style.display = 'block';
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error: ", status, error);
                agendaListContainer.innerHTML = '';
                agendaEmptyState.style.display = 'block';
                agendaEmptyState.querySelector('.empty-state-text').innerText = 'Terjadi kesalahan saat memuat agenda.';
            }
        });
    }

    // Initial load (if search term is already present from initial page load)
    const initialSearchTerm = agendaSearchInput.value;
    if (initialSearchTerm) {
        fetchAgendas(1, initialSearchTerm);
    }

    // Event listener for search input
    agendaSearchInput.addEventListener('keyup', function () {
        fetchAgendas(1, this.value);
    });

    // Event listener for pagination links (delegated)
    $(document).on('click', '#agendaPaginationLinks .page-link', function (e) {
        e.preventDefault();
        const page = $(this).data('page');
        const searchTerm = agendaSearchInput.value;
        fetchAgendas(page, searchTerm);
    });
});
</script>
@endpush
