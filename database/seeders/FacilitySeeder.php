<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a directory for dummy images if it doesn't exist
        if (!Storage::exists('public/facilities')) {
            Storage::makeDirectory('public/facilities');
        }

        $facilities = [
            [
                'name' => 'Laboratorium Rekayasa Perangkat Lunak',
                'description' => 'Laboratorium modern yang dilengkapi dengan komputer spesifikasi tinggi dan perangkat lunak terkini untuk mendukung pengembangan aplikasi web, mobile, dan desktop.',
                'person_in_charge' => 'Dr. Eng. A. B. C., S.T., M.Kom.',
                'photos' => [
                    'https://via.placeholder.com/800x600.png/007bff/ffffff?text=Lab+RPL+1',
                    'https://via.placeholder.com/800x600.png/28a745/ffffff?text=Lab+RPL+2',
                ]
            ],
            [
                'name' => 'Ruang Kelas Multimedia',
                'description' => 'Ruang kelas yang nyaman dengan proyektor interaktif, sistem audio, dan koneksi internet kecepatan tinggi untuk menunjang proses belajar mengajar yang efektif.',
                'person_in_charge' => 'Drs. D. E. F., M.T.',
                'photos' => [
                    'https://via.placeholder.com/800x600.png/ffc107/ffffff?text=Kelas+1',
                    'https://via.placeholder.com/800x600.png/fd7e14/ffffff?text=Kelas+2',
                    'https://via.placeholder.com/800x600.png/dc3545/ffffff?text=Kelas+3',
                ]
            ],
            [
                'name' => 'Perpustakaan & Ruang Baca',
                'description' => 'Menyediakan koleksi buku, jurnal ilmiah, dan referensi digital terbaru di bidang teknologi informasi. Dilengkapi dengan ruang baca yang tenang dan akses Wi-Fi.',
                'person_in_charge' => 'G. H. I., S.Hum., M.IP.',
                'photos' => [
                    'https://via.placeholder.com/800x600.png/17a2b8/ffffff?text=Perpus+1',
                ]
            ]
        ];

        foreach ($facilities as $facilityData) {
            $facility = Facility::create([
                'name' => $facilityData['name'],
                'description' => $facilityData['description'],
                'person_in_charge' => $facilityData['person_in_charge'],
            ]);

            foreach ($facilityData['photos'] as $photoUrl) {
                // We are just storing the URL as the path for this seeder
                // In a real scenario, you would download the image and store it
                $facility->photos()->create(['photo_path' => $photoUrl]);
            }
        }
    }
}
