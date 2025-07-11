<div class="card shadow-sm h-100">
    <div class="card-body d-flex flex-column">
        <div class="d-flex justify-content-between">
            <h5 class="card-title mb-1">{{ $suggestion->name }}</h5>
            @if(!$is_read)
            <button class="btn btn-light btn-sm mark-as-read-btn" data-id="{{ $suggestion->id }}" title="Tandai Sudah Dibaca">
                <i class="fas fa-check"></i>
            </button>
            @endif
        </div>
        @if($suggestion->email)
        <small class="text-muted mb-2">{{ $suggestion->email }}</small>
        @endif
        <p class="card-text flex-grow-1">{{ $suggestion->message }}</p>
        <small class="text-muted text-end">{{ $suggestion->created_at->diffForHumans() }}</small>
    </div>
</div>
