<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BangunMartSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Kategori & Satuan
        $katId = DB::table('kategori')->insertGetId(['nama_kategori' => 'Semen']);
        $satId = DB::table('satuan')->insertGetId(['nama_satuan' => 'Sak']);

        // 2. Pegawai
        DB::table('pegawai')->insert([
            ['nama_pegawai' => 'Budi Admin', 'jabatan' => 'admin', 'shift' => 'pagi'],
            ['nama_pegawai' => 'Siti Kasir', 'jabatan' => 'kasir', 'shift' => 'siang'],
        ]);

        // 3. Pelanggan
        DB::table('pelanggan')->insert(['nama_pelanggan' => 'Pelanggan Umum', 'tipe' => 'umum']);

        // 4. Produk (Input 10 Data)
        for ($i = 1; $i <= 10; $i++) {
            DB::table('produk')->insert([
                'id_kategori' => $katId,
                'id_satuan' => $satId,
                'barcode' => 'BRC00' . $i,
                'nama_produk' => 'Produk Bahan Bangunan ' . $i,
                'harga_jual' => 50000 + ($i * 1000),
                'stok' => 20,
                'stok_minimum' => 5,
            ]);
        }
    }
}