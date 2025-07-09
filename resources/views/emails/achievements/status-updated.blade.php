<x-mail::message>
# Pembaruan Status Prestasi Anda

Halo {{ $achievement->user->name }},

Kami ingin memberitahukan bahwa status pengajuan prestasi Anda telah diperbarui.

**Judul Prestasi:** {{ $achievement->title }}

**Deskripsi:** {{ $achievement->description }}

**Status Terbaru:** {{ ucfirst($achievement->status) }}

@if ($achievement->status == 'validated')
Prestasi Anda telah **diterima**! Selamat atas pencapaian Anda.
@elseif ($achievement->status == 'rejected')
Mohon maaf, prestasi Anda telah **ditolak**. Silakan periksa kembali detail pengajuan Anda.
@endif

Terima kasih atas partisipasi Anda.

Salam hormat,<br>
{{ config('app.name') }}
</x-mail::message>
