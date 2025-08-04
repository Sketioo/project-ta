<x-mail::message>
# Pembaruan Status Pengajuan Prestasi

Halo **{{ $achievement->user->name }}**,

Kami ingin memberitahukan bahwa status pengajuan prestasi Anda telah diperbarui oleh Kaprodi.

<x-mail::panel>
**Judul Kompetisi:** {{ $achievement->nama_kompetisi }} <br>
**Prestasi yang Diraih:** {{ $achievement->prestasi }}
</x-mail::panel>

@if($achievement->status == 'disetujui')
<div style="background-color: #d4edda; border-left: 6px solid #155724; color: #155724; padding: 20px; text-align: center; margin: 20px 0; border-radius: 8px;">
    <h2 style="margin: 0; font-size: 24px; font-weight: bold;">Disetujui</h2>
</div>
<p style="text-align: center; font-size: 16px;">
    Selamat! Pengajuan prestasi Anda telah disetujui. Terima kasih telah berkontribusi dalam mengharumkan nama program studi.
</p>
@elseif($achievement->status == 'ditolak')
<div style="background-color: #f8d7da; border-left: 6px solid #721c24; color: #721c24; padding: 20px; text-align: center; margin: 20px 0; border-radius: 8px;">
    <h2 style="margin: 0; font-size: 24px; font-weight: bold;">Ditolak</h2>
</div>
<p style="text-align: center; font-size: 16px;">
    Mohon maaf, setelah peninjauan, pengajuan prestasi Anda ditolak. Jika Anda merasa ada kekeliruan, silakan hubungi pihak program studi untuk informasi lebih lanjut.
</p>
@endif

Terima kasih atas perhatian Anda.

Salam hormat,<br>
{{ config('app.name') }}
</x-mail::message>

