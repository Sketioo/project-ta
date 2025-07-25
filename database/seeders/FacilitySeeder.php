<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
            [
                'name' => 'Laboratorium Rekayasa Perangkat Lunak',
                'description' => 'Laboratorium modern yang dilengkapi dengan komputer spesifikasi tinggi dan perangkat lunak terkini untuk mendukung pengembangan aplikasi web, mobile, dan desktop.',
                'person_in_charge' => 'Dr. Eng. A. B. C., S.T., M.Kom.',
                'photos' => [
                    'facilities/dummy-lab-1.png',
                    'facilities/dummy-lab-2.png',
                ]
            ],
            [
                'name' => 'Ruang Kelas Multimedia',
                'description' => 'Ruang kelas yang nyaman dengan proyektor interaktif, sistem audio, dan koneksi internet kecepatan tinggi untuk menunjang proses belajar mengajar yang efektif.',
                'person_in_charge' => 'Drs. D. E. F., M.T.',
                'photos' => [
                    'facilities/dummy-kelas-1.png',
                    'facilities/dummy-kelas-2.png',
                    'facilities/dummy-kelas-3.png',
                ]
            ],
            [
                'name' => 'Perpustakaan & Ruang Baca',
                'description' => 'Menyediakan koleksi buku, jurnal ilmiah, dan referensi digital terbaru di bidang teknologi informasi. Dilengkapi dengan ruang baca yang tenang dan akses Wi-Fi.',
                'person_in_charge' => 'G. H. I., S.Hum., M.IP.',
                'photos' => [
                    'facilities/dummy-perpus-1.png',
                ]
            ]
        ];

        foreach ($facilities as $facilityData) {
            Facility::create($facilityData);
        }
    }
}
