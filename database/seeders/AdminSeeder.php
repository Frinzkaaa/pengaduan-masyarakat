<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('admins')->insert([
            'nama' => 'Administrator',
            'username' => 'ucup',
            'password' => 'admin123', // plain text sesuai instruksi
        ]);
    }
}
