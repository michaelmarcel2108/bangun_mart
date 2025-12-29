<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BangunMartSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
   public function run(): void
{
    // 1. Kategori & Satuan (Gunakan updateOrInsert agar tidak duplikat)
    DB::table('kategori')->updateOrInsert(
        ['nama_kategori' => 'Semen'],
        ['nama_kategori' => 'Semen']
    );
    $katId = DB::table('kategori')->where('nama_kategori', 'Semen')->value('id_kategori');

    DB::table('satuan')->updateOrInsert(
        ['nama_satuan' => 'Sak'],
        ['nama_satuan' => 'Sak']
    );
    $satId = DB::table('satuan')->where('nama_satuan', 'Sak')->value('id_satuan');

    // 2. Pegawai (Gunakan nama_pegawai sebagai kunci pemeriksaan)
    DB::table('pegawai')->updateOrInsert(
        ['nama_pegawai' => 'Budi Admin'],
        [
            'password' => Hash::make('password123'),
            'jabatan' => 'admin',
            'shift' => 'pagi',
            'aktif' => 1
        ]
    );

    DB::table('pegawai')->updateOrInsert(
        ['nama_pegawai' => 'Siti Kasir'],
        [
            'password' => Hash::make('password123'),
            'jabatan' => 'kasir',
            'shift' => 'siang',
            'aktif' => 1
        ]
    );

    // 3. Produk (Gunakan barcode sebagai kunci pemeriksaan)
    for ($i = 1; $i <= 10; $i++) {
        DB::table('produk')->updateOrInsert(
            ['barcode' => 'BRC00' . $i], // Kunci unik
            [
                'id_kategori' => $katId,
                'id_satuan' => $satId,
                'nama_produk' => 'Produk Bahan Bangunan ' . $i,
                'harga_jual' => 50000 + ($i * 1000),
                'stok' => 20,
                'stok_minimum' => 5,
            ]
        );
    }
}
}