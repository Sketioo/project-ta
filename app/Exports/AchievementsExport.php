<?php

namespace App\Exports;

use App\Models\Achievement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AchievementsExport implements FromCollection, WithHeadings, WithMapping, WithStrictNullComparison, WithColumnFormatting
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Achievement::with('user', 'validator')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'NIM',
            'Nama Mahasiswa',
            'Nama Kompetisi',
            'Tingkat Kompetisi',
            'Penyelenggara',
            'Prestasi',
            'Tanggal Pelaksanaan',
            'Dosen Pembimbing',
            'Keterangan Lomba',
            'Status',
            'Divalidasi Oleh',
            'Tanggal Validasi',
            'Tampilkan di Beranda',
            'Dibuat Pada',
            'Diperbarui Pada',
        ];
    }

    /**
     * @var Achievement $achievement
     */
    public function map($achievement): array
    {
        return [
            $achievement->id,
            $achievement->nim,
            $achievement->user->name ?? 'N/A',
            $achievement->nama_kompetisi,
            $achievement->tingkat_kompetisi,
            $achievement->penyelenggara,
            $achievement->prestasi,
            Date::dateTimeToExcel($achievement->tanggal_pelaksanaan),
            $achievement->dosen_pembimbing,
            $achievement->keterangan_lomba,
            $achievement->status,
            $achievement->validator->name ?? 'N/A',
            $achievement->validated_at ? Date::dateTimeToExcel($achievement->validated_at) : null,
            $achievement->show_on_main_page ? 'Ya' : 'Tidak',
            Date::dateTimeToExcel($achievement->created_at),
            Date::dateTimeToExcel($achievement->updated_at),
        ];
    }

    public function columnFormats(): array
    {
        return [
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'O' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'P' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
