{{-- resources/views/suggestions/partials/empty_state.blade.php --}}
<div class="empty-state-container">
    @if($type == 'unread')
        <i class="fas fa-check-circle"></i>
        <h4>Luar Biasa!</h4>
        <p>Semua saran dan masukan telah dibaca.</p>
    @else
        <i class="fas fa-folder-open"></i>
        <h4>Kotak Masuk Kosong</h4>
        <p>Belum ada saran yang masuk ke dalam kategori ini.</p>
    @endif
</div>
