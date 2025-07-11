@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<style>
    .card-header { background-color: #4a5568; color: white; }
    .nav-tabs .nav-link.active {
        background-color: #4a5568;
        color: white;
        border-color: #4a5568;
    }
    .nav-tabs .nav-link { color: #4a5568; }
    .suggestion-card {
        transition: opacity 0.5s ease-out;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Saran dan Masukan</h1>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="suggestionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="unread-tab" data-bs-toggle="tab" data-bs-target="#unread" type="button" role="tab" aria-controls="unread" aria-selected="true">
                                Belum Dibaca <span class="badge bg-warning text-dark" id="unread-count">{{ $unreadSuggestions->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="read-tab" data-bs-toggle="tab" data-bs-target="#read" type="button" role="tab" aria-controls="read" aria-selected="false">
                                Sudah Dibaca <span class="badge bg-light text-dark" id="read-count">{{ $readSuggestions->count() }}</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="suggestionTabsContent">
                        <!-- Unread Suggestions Panel -->
                        <div class="tab-pane fade show active" id="unread" role="tabpanel" aria-labelledby="unread-tab">
                            <div id="unread-list" class="row">
                                @forelse($unreadSuggestions as $suggestion)
                                <div class="col-md-6 mb-4 suggestion-card" id="suggestion-{{ $suggestion->id }}">
                                    @include('suggestions.partials.suggestion_card', ['suggestion' => $suggestion, 'is_read' => false])
                                </div>
                                @empty
                                <div class="col-12 text-center py-5" id="empty-unread">
                                    <i class="fas fa-check-circle fa-3x text-success"></i>
                                    <p class="mt-3 text-muted">Tidak ada saran yang belum dibaca.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
                        <!-- Read Suggestions Panel -->
                        <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                            <div id="read-list" class="row">
                                @forelse($readSuggestions as $suggestion)
                                <div class="col-md-6 mb-4 suggestion-card" id="suggestion-{{ $suggestion->id }}">
                                    @include('suggestions.partials.suggestion_card', ['suggestion' => $suggestion, 'is_read' => true])
                                </div>
                                @empty
                                <div class="col-12 text-center py-5" id="empty-read">
                                    <i class="fas fa-folder-open fa-3x text-muted"></i>
                                    <p class="mt-3 text-muted">Tidak ada saran yang sudah dibaca.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>
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
        const card = $(`#suggestion-${suggestionId}`);

        $.ajax({
            url: `/suggestions/${suggestionId}/mark-as-read`,
            method: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.success) {
                    // Animate and move card
                    card.css('opacity', '0');
                    setTimeout(() => {
                        const cardHtml = card.html();
                        card.remove();
                        
                        // Update the card content for the "read" state
                        const newCard = $(cardHtml).find('.mark-as-read-btn').remove().end();
                        $('#read-list').prepend(`<div class="col-md-6 mb-4 suggestion-card" id="suggestion-${suggestionId}" style="opacity:0;">${newCard.html()}</div>`);
                        $(`#suggestion-${suggestionId}`).css('opacity', '1');

                        // Update counts
                        $('#unread-count').text(parseInt($('#unread-count').text()) - 1);
                        $('#read-count').text(parseInt($('#read-count').text()) + 1);

                        // Show empty message if needed
                        if ($('#unread-list').children('.suggestion-card').length === 0) {
                            $('#unread-list').html('<div class="col-12 text-center py-5" id="empty-unread"><i class="fas fa-check-circle fa-3x text-success"></i><p class="mt-3 text-muted">Tidak ada saran yang belum dibaca.</p></div>');
                        }
                        $('#empty-read').remove(); // Remove empty message from read list
                    }, 500);
                }
            },
            error: function() {
                alert('Terjadi kesalahan.');
            }
        });
    });
});
</script>
@endpush
