<div class="card suggestion-item-card h-100">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <strong class="d-block">{{ $suggestion->name }}</strong>
            <small class="text-muted">{{ $suggestion->created_at->diffForHumans() }}</small>
        </div>
        @if($suggestion->email)
            <a href="mailto:{{ $suggestion->email }}" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-reply me-1"></i> Balas
            </a>
        @endif
    </div>
    <div class="card-body">
        <p class="card-text">{{ $suggestion->message }}</p>
    </div>
    @if(!$is_read)
    <div class="card-footer text-end">
        <button class="btn btn-primary btn-sm mark-as-read-btn" data-id="{{ $suggestion->id }}">
            <i class="fas fa-check me-1"></i> Tandai Sudah Dibaca
        </button>
    </div>
    @endif
</div>