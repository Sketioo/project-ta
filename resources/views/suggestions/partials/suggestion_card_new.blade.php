{{-- resources/views/suggestions/partials/suggestion_card_new.blade.php --}}
<div class="suggestion-card" id="suggestion-card-{{ $suggestion->id }}">
    <div class="suggestion-card-header">
        <div class="user-info">
            <i class="fas fa-user-circle"></i>
            <span>{{ $suggestion->user->name ?? 'Pengguna Anonim' }}</span>
        </div>
        <div class="timestamp">
            <i class="far fa-clock me-1"></i>
            {{ $suggestion->created_at->diffForHumans() }}
        </div>
    </div>
    <div class="suggestion-card-body">
        {{ $suggestion->content }}
    </div>
    @if(!$is_read)
    <div class="suggestion-card-footer">
        <button class="btn mark-as-read-btn" data-id="{{ $suggestion->id }}">
            <i class="fas fa-check"></i>
            Tandai Sudah Dibaca
        </button>
    </div>
    @endif
</div>
