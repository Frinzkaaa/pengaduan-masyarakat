<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Petugas;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::create([
            'nama_petugas' => 'Administrator',
            'username'     => 'admin',
            'password'     => 'admin123', // bisa diubah sesuai kebutuhan
            'telp'         => '081234567890',
            'level'        => 'admin'
        ]);
    }
}
