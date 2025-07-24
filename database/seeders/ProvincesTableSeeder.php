<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provincesData = [
            ['id' => 3, 'name' => 'Banten'],
            ['id' => 6, 'name' => 'DKI Jakarta'],
            ['id' => 10, 'name' => 'Jawa Barat'],
            ['id' => 11, 'name' => 'Jawa Tengah'],
            ['id' => 12, 'name' => 'DI Yogyakarta'],
            ['id' => 13, 'name' => 'Jawa Timur'],
        ];

        DB::table('provinces')->insert($provincesData);
    }
}
