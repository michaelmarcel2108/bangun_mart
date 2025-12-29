<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            ['nama_kategori' => 'Material Dasar'],
            ['nama_kategori' => 'Besi & Baja'],
            ['nama_kategori' => 'Kayu & Papan'],
            ['nama_kategori' => 'Atap & Plafon'],
            ['nama_kategori' => 'Kelistrikan'],
            ['nama_kategori' => 'Pipa & Sanitasi'],
            ['nama_kategori' => 'Alat Pertukangan'],
            ['nama_kategori' => 'Cat & Finishing'],
            ['nama_kategori' => 'Keramik & Granit'],
            ['nama_kategori' => 'Baut & Paku'],
        ];

        foreach ($kategori as $k) {
            DB::table('kategori')->insert($k);
        }
    }
}