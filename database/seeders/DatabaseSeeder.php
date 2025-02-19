<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin account
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'status' => 'approved',
        ]);

        // Create UMKM account
        User::create([
            'name' => 'UMKM User',
            'email' => 'umkm@umkm.com', 
            'password' => Hash::make('umkm123'),
            'role' => 'umkm',
            'status' => 'approved',
            'jenis_usaha' => 'Food and Beverage',
            'jumlah_karyawan' => 5,
            'tahun_berdiri' => 2023,
            'alamat_usaha' => 'Jln. Raya Pakuan Kab. Bogor'
        ]);

        $this->call([
            NewsSeeder::class,
        ]);
    }
}