@extends('layouts.app')

@push('styles')
<style>
    .suggestions-container {
        max-width: 900px;
        margin: auto;
    }
    .filter-pills .nav-link {
        border-radius: 50px;
        padding: 0.6rem 1.3rem;
        font-weight: 600;
        transition: all 0.3s ease;
        color: #6c757d;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        margin: 0 5px;
    }
    .filter-pills .nav-link.active {
        color: #fff;
        background-color: var(--bs-primary);
        border-color: var(--bs-primary);
        box-shadow: 0 4px 12px rgba(var(--bs-primary-rgb), 0.3);
    }
    .suggestion-item-card .card-footer .btn {
        background-color: var(--bs-success);
        border-color: var(--bs-success);
        color: #fff;
    }
    .suggestion-item-card .card-footer .btn:hover {
        opacity: 0.9;
    }
    .suggestion-item-card {
        border: 1px solid #e9ecef;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
    }
    .suggestion-item-card .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    .suggestion-item-card .card-footer {
        background-color: #fff;
        border-top: 1px solid #e9ecef;
    }
    .suggestion-list .suggestion-card {
        transition: opacity 0.5s ease-out, transform 0.5s ease-out;
    }
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
        text-align: center;
        background-color: #f8f9fa;
        border-radius: 12px;
    }
    .empty-state i {
        font-size: 4rem;
        color: #ced4da;
    }
    .empty-state h4 {
        margin-top: 1.5rem;
        color: #6c757d;
    }
</style>
@endpush

@section('content')
<div class="container-fluid full-height-layout">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 py-4">
            <div class="page-header pt-3">
                <h1 class="page-title">Saran dan Masukan</h1>
            </div>

            <div class="suggestions-container">
                <ul class="nav nav-pills filter-pills justify-content-center mb-4" id="suggestionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="unread-tab" data-bs-toggle="tab" data-bs-target="#unread" type="button" role="tab" aria-controls="unread" aria-selected="true">
                            <i class="fas fa-envelope me-2"></i>Belum Dibaca <span class="badge bg-danger ms-2" id="unread-count">{{ $unreadSuggestions->count() }}</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="read-tab" data-bs-toggle="tab" data-bs-target="#read" type="button" role="tab" aria-controls="read" aria-selected="false">
                            <i class="fas fa-envelope-open-text me-2"></i>Sudah Dibaca <span class="badge bg-light text-dark ms-2" id="read-count">{{ $readSuggestions->count() }}</span>
                        </button>
                    </li>
                </ul>

                <div class="tab-content" id="suggestionTabsContent">
                    <!-- Unread Suggestions Panel -->
                    <div class="tab-pane fade show active" id="unread" role="tabpanel" aria-labelledby="unread-tab">
                        <div id="unread-list" class="vstack gap-3 suggestion-list">
                            @forelse($unreadSuggestions as $suggestion)
                            <div class="suggestion-card" id="suggestion-{{ $suggestion->id }}">
                                @include('suggestions.partials.suggestion_card', ['suggestion' => $suggestion, 'is_read' => false])
                            </div>
                            @empty
                            <div class="empty-state" id="empty-unread">
                                <i class="fas fa-check-circle"></i>
                                <h4>Tidak ada saran baru.</h4>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <!-- Read Suggestions Panel -->
                    <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="read-tab">
                        <div id="read-list" class="vstack gap-3 suggestion-list">
                            @forelse($readSuggestions as $suggestion)
                            <div class="suggestion-card" id="suggestion-{{ $suggestion->id }}">
                                @include('suggestions.partials.suggestion_card', ['suggestion' => $suggestion, 'is_read' => true])
                            </div>
                            @empty
                            <div class="empty-state" id="empty-read">
                                <i class="fas fa-folder-open"></i>
                                <h4>Belum ada saran yang dibaca.</h4>
                            </div>
                            @endforelse
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
        const cardWrapper = $(`#suggestion-${suggestionId}`);

        $.ajax({
            url: `/suggestions/${suggestionId}/mark-as-read`,
            method: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
                if (response.success) {
                    cardWrapper.css({'opacity': '0', 'transform': 'translateX(50px)'});
                    
                    setTimeout(() => {
                        const cardHtml = cardWrapper.html();
                        cardWrapper.remove();
                        
                        const newCardHtml = $(cardHtml).find('.card-footer').remove().end().prop('outerHTML');
                        
                        $('#read-list').find('.empty-state').remove();
                        $('#read-list').prepend(`<div class="suggestion-card" id="suggestion-${suggestionId}" style="opacity:0; transform: translateX(-50px);">${newCardHtml}</div>`);
                        $(`#suggestion-${suggestionId}`).css({'opacity': '1', 'transform': 'translateX(0)'});

                        $('#unread-count').text(parseInt($('#unread-count').text()) - 1);
                        $('#read-count').text(parseInt($('#read-count').text()) + 1);

                        if ($('#unread-list').children('.suggestion-card').length === 0) {
                            $('#unread-list').html('<div class="empty-state" id="empty-unread"><i class="fas fa-check-circle"></i><h4>Tidak ada saran baru.</h4></div>');
                        }
                    }, 500);
                }
            },
            error: function() {
                Swal.fire('Error', 'Gagal menandai saran.', 'error');
            }
        });
    });
});
</script>
@endpush
