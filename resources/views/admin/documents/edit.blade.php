@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .card-header { background-color: #4a5568; color: white; }
    .btn-primary { background-color: #4299e1; border-color: #4299e1; }
    .btn-secondary { background-color: #6c757d; border-color: #6c757d; }
    .category-suggestion-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 8px;
    }
    .category-suggestion-tag {
        background-color: #e9ecef;
        border: 1px solid #ced4da;
        color: #495057;
        padding: 4px 10px;
        border-radius: 15px;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        font-size: 0.85rem;
    }
    .category-suggestion-tag:hover {
        background-color: var(--primary-color);
        color: var(--dark-color);
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="dashboard-title">Manajemen Dokumen</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Edit Dokumen</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Dokumen</label>
                                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $document->title) }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="kode_dokumen" class="form-label">Kode Dokumen (Opsional)</label>
                                    <input type="text" name="kode_dokumen" id="kode_dokumen" class="form-control @error('kode_dokumen') is-invalid @enderror" value="{{ old('kode_dokumen', $document->kode_dokumen) }}">
                                    @error('kode_dokumen')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori</label>
                            <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $document->category->name ?? '') }}" required autocomplete="off">
                            <div id="category-suggestions" class="category-suggestion-container"></div>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="document_file" class="form-label">Ganti File Dokumen (Opsional)</label>
                            <input type="file" name="document_file" id="document_file" class="form-control @error('document_file') is-invalid @enderror">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti file yang sudah ada.</small>
                            <small class="form-text text-muted">File saat ini: <a href="{{ Storage::url($document->file_path) }}" target="_blank">Lihat Dokumen</a></small>
                            @error('document_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status Dokumen</label>
                                    <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                        <option value="berlaku" {{ old('status', $document->status) == 'berlaku' ? 'selected' : '' }}>Berlaku</option>
                                        <option value="tidak berlaku" {{ old('status', $document->status) == 'tidak berlaku' ? 'selected' : '' }}>Tidak Berlaku</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3 pt-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" {{ old('is_visible', $document->is_visible) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_visible">Tampilkan di Halaman Utama</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.documents.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const categoryInput = document.getElementById('category');
    const suggestionsContainer = document.getElementById('category-suggestions');
    
    const categories = @json($categories->pluck('name'));

    function renderSuggestions(filter = '') {
        suggestionsContainer.innerHTML = '';
        const filteredCategories = categories.filter(c => c.toLowerCase().includes(filter.toLowerCase()));
        
        filteredCategories.forEach(categoryName => {
            const tag = document.createElement('div');
            tag.classList.add('category-suggestion-tag');
            tag.textContent = categoryName;
            tag.addEventListener('click', () => {
                categoryInput.value = categoryName;
                suggestionsContainer.innerHTML = '';
            });
            suggestionsContainer.appendChild(tag);
        });
    }

    categoryInput.addEventListener('focus', () => {
        renderSuggestions(categoryInput.value);
    });

    categoryInput.addEventListener('keyup', () => {
        renderSuggestions(categoryInput.value);
    });

    document.addEventListener('click', function(event) {
        if (!suggestionsContainer.contains(event.target) && event.target !== categoryInput) {
            suggestionsContainer.innerHTML = '';
        }
    });

    // Initial render in case of old input
    if (categoryInput.value) {
        renderSuggestions(categoryInput.value);
    }
});
</script>
@endpush