@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @include('components.sidebar')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2 page-title">Saran dan Masukan (Belum Dibaca)</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <a href="{{ route('suggestions.read') }}" class="btn btn-sm btn-outline-secondary">Lihat Saran Sudah Dibaca</a>
                </div>
            </div>

            <div class="row">
                @forelse($suggestions as $suggestion)
                <div class="col-md-6 mb-4 suggestion-card" id="suggestion-{{ $suggestion->id }}">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $suggestion->name }} <small class="text-muted">({{ $suggestion->email }})</small></h5>
                            <p class="card-text">{{ $suggestion->message }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge badge-info">{{ $suggestion->status }}</span>
                                <small class="text-muted">{{ $suggestion->created_at->format('d M Y H:i') }}</small>
                                <button class="btn btn-sm btn-primary mark-as-read-btn" data-id="{{ $suggestion->id }}">Tandai Sudah Dibaca</button>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <p>Tidak ada saran yang belum dibaca.</p>
                </div>
                @endforelse
            </div>
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.mark-as-read-btn').forEach(button => {
        button.addEventListener('click', function () {
            const suggestionId = this.dataset.id;
            const card = document.getElementById(`suggestion-${suggestionId}`);

            fetch(`/suggestions/${suggestionId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    card.style.display = 'none'; // Hide the card
                    // Optionally, you can remove the card from the DOM
                    // card.remove();
                } else {
                    alert('Gagal menandai saran sebagai sudah dibaca.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menandai saran sebagai sudah dibaca.');
            });
        });
    });
});
</script>
@endpush