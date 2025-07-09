<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class KaprodiUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Kaprodi',
            'username' => 'kaprodi',
            'email' => 'kaprodi@example.com',
            'password' => Hash::make('password'),
            'role' => 'kaprodi',
        ]);
    }
}
