@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Edit Mitra</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h5 class="mb-0">Form Edit Mitra</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Mitra</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $partner->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website_url" class="form-label">URL Situs Web</label>
                            <input type="url" name="website_url" id="website_url" class="form-control @error('website_url') is-invalid @enderror" value="{{ old('website_url', $partner->website_url) }}">
                            @error('website_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person (Opsional)</label>
                            <input type="text" name="contact_person" id="contact_person" class="form-control @error('contact_person') is-invalid @enderror" value="{{ old('contact_person', $partner->contact_person) }}">
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="province_id" class="form-label">Provinsi (Opsional)</label>
                                <select class="form-select @error('province_id') is-invalid @enderror" id="province_id" name="province_id">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}" {{ old('province_id', $partner->province_id) == $province->id ? 'selected' : '' }}>{{ $province->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="regency_id" class="form-label">Kabupaten/Kota (Opsional)</label>
                                <select class="form-select @error('regency_id') is-invalid @enderror" id="regency_id" name="regency_id" disabled>
                                    <option value="">Pilih Kabupaten/Kota</option>
                                </select>
                                @error('regency_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="detail_alamat" class="form-label">Detail Alamat (Opsional)</label>
                            <textarea name="detail_alamat" id="detail_alamat" class="form-control @error('detail_alamat') is-invalid @enderror" rows="3">{{ old('detail_alamat', $partner->detail_alamat) }}</textarea>
                            @error('detail_alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4">{{ old('deskripsi', $partner->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Ganti Logo Mitra (Opsional)</label>
                            <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti logo.</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div id="logo-preview-container" class="mt-3 text-center">
                                <img id="logo-preview" src="{{ Storage::url($partner->logo_path) }}" alt="Pratinjau Logo" class="img-thumbnail" style="max-width: 200px; max-height: 200px; border-radius: 8px;"/>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="is_visible" name="is_visible" value="1" {{ old('is_visible', $partner->is_visible) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_visible">Tampilkan di Halaman Utama</label>
                            </div>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-end">
                            <a href="{{ route('admin.partners.index') }}" class="btn btn-secondary me-2">
                                <i class="fas fa-times"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui Mitra
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
    $(document).ready(function() {
        $('#logo').on('change', function(event) {
            const [file] = this.files;
            if (file) {
                const previewContainer = $('#logo-preview-container');
                const previewImage = $('#logo-preview');
                
                previewImage.attr('src', URL.createObjectURL(file));
                previewContainer.show();

                previewImage.on('load', function() {
                    URL.revokeObjectURL(previewImage.attr('src')); // Free memory
                });
            }
        });

        // Dynamic dropdown for regencies
        $('#province_id').on('change', function() {
            var provinceId = $(this).val();
            var regencySelect = $('#regency_id');
            regencySelect.empty();
            regencySelect.append('<option value="">Pilih Kabupaten/Kota</option>');
            regencySelect.prop('disabled', true);

            if (provinceId) {
                $.ajax({
                    url: '/api/kabupaten/' + provinceId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $.each(data, function(key, value) {
                            regencySelect.append('<option value="' + value.id + '"' + (value.id == "{{ old('regency_id', $partner->regency_id) }}" ? 'selected' : '') + '>' + value.name + '</option>');
                        });
                        regencySelect.prop('disabled', false);
                    }
                });
            }
        });

        // Trigger change on page load if a province is already selected
        if ($('#province_id').val()) {
            $('#province_id').trigger('change');
        }
    });
</script>
@endpush
