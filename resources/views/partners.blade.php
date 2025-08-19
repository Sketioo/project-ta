@extends('layouts.app')

@section('title', 'Daftar Mitra - Sistem Informasi Prodi TRPL')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4">Daftar Mitra Industri</h1>
            
            <!-- Search and Filter Controls -->
            <div class="document-controls mb-4">
                <div class="input-group document-search-form">
                    <input type="text" id="partnerSearch" class="form-control document-search-input" placeholder="Cari mitra...">
                    <button class="btn document-search-btn" type="button"><i class="fas fa-search"></i></button>
                </div>
                <div class="dropdown">
                    <button class="btn btn-filter-dropdown" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-filter"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="filterDropdown">
                        <h6 class="dropdown-header">Filter Berdasarkan Kabupaten</h6>
                        <div id="regencyFilterCheckboxes">
                            <!-- Kabupaten akan diisi dengan JavaScript -->
                        </div>
                        <div class="dropdown-divider"></div>
                        <div class="px-2">
                            <button class="btn btn-primary-custom w-100" id="applyFilterBtn">Terapkan</button>
                        </div>
                    </div>
                </div>
            </div>
            
            @if($partners->isNotEmpty())
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Logo</th>
                                <th scope="col">Nama Mitra</th>
                                <th scope="col">Website</th>
                                <th scope="col">Kontak</th>
                                <th scope="col">Alamat</th>
                            </tr>
                        </thead>
                        <tbody id="partnersTableBody">
                            @foreach($partners as $partner)
                            <tr data-name="{{ strtolower($partner->name) }}" data-regency="{{ $partner->regency_id }}">
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    @if($partner->logo_path)
                                        <img src="{{ Storage::url($partner->logo_path) }}" alt="{{ $partner->name }}" class="img-fluid" style="max-height: 50px;">
                                    @else
                                        <span class="text-muted">Tidak ada logo</span>
                                    @endif
                                </td>
                                <td>{{ $partner->name }}</td>
                                <td>
                                    @if($partner->website_url)
                                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer">{{ $partner->website_url }}</a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $partner->contact_person ?? '-' }}</td>
                                <td>{{ $partner->detail_alamat ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state text-center py-5">
                    <i class="fas fa-box-open empty-state-icon"></i>
                    <p class="empty-state-text">Belum ada mitra yang terdaftar.</p>
                    <p class="empty-state-subtext">Silakan cek kembali nanti atau hubungi administrator.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const partnersTableBody = document.getElementById('partnersTableBody');
    const partnerSearchInput = document.getElementById('partnerSearch');
    const applyFilterBtn = document.getElementById('applyFilterBtn');
    const regencyFilterCheckboxes = document.getElementById('regencyFilterCheckboxes');
    
    // Prevent dropdown from closing when clicking inside
    document.querySelector('.dropdown-menu').addEventListener('click', function (e) {
        e.stopPropagation();
    });
    
    // Collect all unique regencies from partners
    const regencies = {};
    @foreach($partners as $partner)
        @if($partner->regency)
            regencies[{{ $partner->regency_id }}] = "{{ $partner->regency->name }}";
        @endif
    @endforeach
    
    // Populate regency filter checkboxes
    for (const [id, name] of Object.entries(regencies)) {
        const checkboxItem = `
            <div class="form-check custom-form-check">
                <input class="form-check-input" type="checkbox" value="${id}" id="regency-${id}">
                <label class="form-check-label" for="regency-${id}">
                    ${name}
                </label>
            </div>
        `;
        regencyFilterCheckboxes.insertAdjacentHTML('beforeend', checkboxItem);
    }
    
    // Get all checkboxes after they are created
    const regencyCheckboxes = document.querySelectorAll('#regencyFilterCheckboxes .form-check-input');
    
    function filterPartners() {
        const searchTerm = partnerSearchInput.value.toLowerCase();
        const selectedRegencies = [];
        
        regencyCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedRegencies.push(checkbox.value);
            }
        });
        
        const rows = partnersTableBody.querySelectorAll('tr');
        let visibleCount = 0;
        
        rows.forEach(row => {
            const name = row.getAttribute('data-name');
            const regency = row.getAttribute('data-regency');
            
            const matchesSearch = name.includes(searchTerm);
            const matchesRegency = selectedRegencies.length === 0 || selectedRegencies.includes(regency);
            
            if (matchesSearch && matchesRegency) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });
        
        // Show empty state if no partners match
        const emptyState = document.querySelector('.empty-state');
        if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
        }
    }
    
    // Event listeners
    if (partnerSearchInput) {
        partnerSearchInput.addEventListener('input', filterPartners);
    }
    
    if (applyFilterBtn) {
        applyFilterBtn.addEventListener('click', filterPartners);
    }
    
    // Initialize regency checkboxes
    regencyCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', filterPartners);
    });
});
</script>
@endpush