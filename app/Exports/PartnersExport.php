<?php

namespace App\Exports;

use App\Models\Partner;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PartnersExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Partner::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Mitra',
            'Alamat',
            'Nomor Telepon',
            'Email',
            'Website',
            'Deskripsi',
            'Terlihat',
            'Dibuat Pada',
            'Diperbarui Pada',
        ];
    }

    /**
     * @var Partner $partner
     */
    public function map($partner): array
    {
        return [
            $partner->id,
            $partner->name,
            $partner->address,
            $partner->phone_number,
            $partner->email,
            $partner->website_url,
            $partner->description,
            $partner->is_visible ? 'Ya' : 'Tidak',
            $partner->created_at,
            $partner->updated_at,
        ];
    }
}
