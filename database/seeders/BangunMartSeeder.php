<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class BangunMartSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Master Kategori & Satuan
        DB::table('kategori')->updateOrInsert(['nama_kategori' => 'Material Utama'], ['nama_kategori' => 'Material Utama']);
        $katId = DB::table('kategori')->where('nama_kategori', 'Material Utama')->value('id_kategori');

        DB::table('satuan')->updateOrInsert(['nama_satuan' => 'Unit'], ['nama_satuan' => 'Unit']);
        $satId = DB::table('satuan')->where('nama_satuan', 'Unit')->value('id_satuan');

        // 2. Data Pegawai (Autentikasi)
        DB::table('pegawai')->updateOrInsert(['nama_pegawai' => 'Budi Admin'], [
            'password' => Hash::make('password123'),
            'jabatan' => 'admin', 'shift' => 'pagi', 'aktif' => 1
        ]);
        DB::table('pegawai')->updateOrInsert(['nama_pegawai' => 'Siti Kasir'], [
            'password' => Hash::make('password123'),
            'jabatan' => 'kasir', 'shift' => 'siang', 'aktif' => 1
        ]);

        // 3. Data Pelanggan
        DB::table('pelanggan')->updateOrInsert(['nama_pelanggan' => 'Pelanggan Umum'], ['tipe' => 'umum']);

        // 4. Data Supplier (Baru - Tabel ke-8)
        $suppliers = [
            ['nama_supplier' => 'PT Semen Indonesia', 'telepon' => '0811223344'],
            ['nama_supplier' => 'CV Baja Perkasa', 'telepon' => '0855667788'],
            ['nama_supplier' => 'Toko Cat Abadi', 'telepon' => '0899001122'],
        ];
        foreach ($suppliers as $s) {
            DB::table('supplier')->updateOrInsert(['nama_supplier' => $s['nama_supplier']], $s);
        }

        // 5. Data 12 Produk Material
        $produkMaterial = [
            'Semen Tiga Roda 50kg', 'Pasir Pasang Per Kubik', 'Bata Merah Press', 'Besi Beton 8mm SNI',
            'Cat Tembok Putih 5kg', 'Pipa PVC 1/2 inch', 'Keramik Lantai 40x40', 'Genteng Tanah Liat', 
            'Kayu Kaso 4x6', 'Paku Kayu 5cm', 'Triplek 9mm', 'Kawat Ikat Beton'
        ];

        foreach ($produkMaterial as $index => $nama) {
            $idProduk = DB::table('produk')->updateOrInsert(
                ['barcode' => 'BRC00' . ($index + 1)],
                [
                    'id_kategori' => $katId, 'id_satuan' => $satId,
                    'nama_produk' => $nama, 'harga_jual' => 25000 + (($index + 1) * 5000),
                    'stok' => 50, 'stok_minimum' => 10,
                ]
            );

            // 6. Data Produk_Supplier (Baru - Tabel ke-10 - Pivot)
            // Menghubungkan setiap produk secara acak ke salah satu supplier
            $idActualProduk = DB::table('produk')->where('barcode', 'BRC00' . ($index + 1))->value('id_produk');
            $idActualSupplier = DB::table('supplier')->inRandomOrder()->value('id_supplier');
            
            DB::table('produk_supplier')->updateOrInsert(
                ['id_produk' => $idActualProduk, 'id_supplier' => $idActualSupplier],
                ['harga_beli_terakhir' => 20000 + (($index + 1) * 4000)]
            );
        }
    }
}