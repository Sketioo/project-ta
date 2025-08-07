@extends('layouts.app')

{{-- @push('styles')
    {{-- Link ke stylesheet kustom yang baru --}}
    {{-- <link rel="stylesheet" href="{{ secure_asset('css/custom-suggestions.css') }}"> --}}
{{-- @endpush  --}}

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 management-page">
            <div class="page-header pt-3">
                <h1 class="page-title">Saran dan Masukan</h1>
            </div>

            {{-- Navigasi Tab --}}
            <ul class="nav nav-pills suggestion-tabs justify-content-center mb-4" id="suggestionTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="unread-tab" data-bs-toggle="tab" data-bs-target="#unread" type="button" role="tab" aria-controls="unread" aria-selected="true">
                        <i class="fas fa-envelope me-2"></i>
                        Belum Dibaca
                        <span class="badge rounded-pill bg-danger ms-2" id="unread-count">{{ $unreadSuggestions->count() }}</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="read-tab" data-bs-toggle="tab" data-bs-target="#read" type="button" role="tab" aria-controls="read" aria-selected="false">
                        <i class="fas fa-envelope-open-text me-2"></i>
                        Sudah Dibaca
                        <span class="badge rounded-pill bg-secondary ms-2" id="read-count">{{ $readSuggestions->count() }}</span>
                    </button>
                </li>
            </ul>

            {{-- Konten Tab --}}
            <div class="tab-content" id="suggestionTabsContent">
                {{-- Panel Saran Belum Dibaca --}}
                <div class="tab-pane fade show active" id="unread" role="tabpanel" aria-labelledby="unread-tab">
                    <div id="unread-list" class="suggestion-list">
                        @forelse($unreadSuggestions as $suggestion)
                            @include('suggestions.partials.suggestion_card_new', ['suggestion' => $suggestion, 'is_read' => false])
                        @empty
                            @include('suggestions.partials.empty_state', ['type' => 'unread'])
                        @endforelse
                    </div>
                </div>
                {{-- Panel Saran Sudah Dibaca --}}
                <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                    <div id="read-list" class="suggestion-list">
                        @forelse($readSuggestions as $suggestion)
                            @include('suggestions.partials.suggestion_card_new', ['suggestion' => $suggestion, 'is_read' => true])
                        @empty
                            @include('suggestions.partials.empty_state', ['type' => 'read'])
                        @endforelse
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('body').on('click', '.mark-as-read-btn', function() {
        const button = $(this);
        const suggestionId = button.data('id');
        const card = $(`#suggestion-card-${suggestionId}`);

        $.ajax({
            url: `/suggestions/${suggestionId}/mark-as-read`,
            method: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.success) {
                    // 1. Animasi fade out pada kartu lama
                    card.addClass('fade-out');

                    setTimeout(() => {
                        // 2. Hapus kartu dari daftar "Belum Dibaca"
                        const cardHtml = card.prop('outerHTML');
                        card.remove();

                        // 3. Perbarui jumlah
                        $('#unread-count').text(parseInt($('#unread-count').text()) - 1);
                        $('#read-count').text(parseInt($('#read-count').text()) + 1);

                        // 4. Hapus footer dari HTML kartu dan siapkan untuk daftar "Sudah Dibaca"
                        const newCardHtml = $(cardHtml).find('.suggestion-card-footer').remove().end();
                        
                        // 5. Tambahkan kartu ke daftar "Sudah Dibaca" dengan animasi fade in
                        $('#read-list').find('.empty-state-container').remove(); // Hapus pesan empty jika ada
                        $('#read-list').prepend(newCardHtml);
                        $(`#suggestion-card-${suggestionId}`).removeClass('fade-out').addClass('fade-in');

                        // 6. Tampilkan pesan empty jika daftar "Belum Dibaca" kosong
                        if ($('#unread-list').children('.suggestion-card').length === 0) {
                            $('#unread-list').html(`
                                <div class="empty-state-container">
                                    <i class="fas fa-check-circle"></i>
                                    <h4>Luar Biasa!</h4>
                                    <p>Semua saran dan masukan telah dibaca.</p>
                                </div>
                            `);
                        }
                    }, 400); // Waktu harus cocok dengan transisi CSS
                }
            },
            error: function() {
                // Ganti dengan notifikasi yang lebih baik jika ada library seperti Swal
                alert('Gagal menandai saran sebagai telah dibaca.');
            }
        });
    });
});
</script>
@endpush
