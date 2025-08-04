<x-mail::message>
# Pembaruan Status Pengajuan Prestasi

Halo **{{ $achievement->user->name }}**,

Kami ingin memberitahukan bahwa status pengajuan prestasi Anda telah diperbarui oleh Kaprodi.

<x-mail::panel>
**Judul Kompetisi:** {{ $achievement->nama_kompetisi }} <br>
**Prestasi yang Diraih:** {{ $achievement->prestasi }} <br>
**Status Saat Ini:** **{{ ucfirst($achievement->status) }}**
</x-mail::panel>

@if($achievement->status == 'disetujui')
Selamat! Pengajuan prestasi Anda telah **Disetujui**. Terima kasih telah berkontribusi dalam mengharumkan nama program studi. 🎉
@elseif($achievement->status == 'ditolak')
Mohon maaf, setelah peninjauan, pengajuan prestasi Anda **Ditolak**. Jika Anda merasa ada kekeliruan, silakan hubungi pihak program studi untuk informasi lebih lanjut. 😔
@endif

Terima kasih atas perhatian Anda.

Salam hormat,<br>
{{ config('app.name') }}
</x-mail::message>
