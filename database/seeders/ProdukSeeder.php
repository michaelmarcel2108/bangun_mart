<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    public function run(): void
{
    $produk = [
        // id_satuan: 1=Sak, 2=Pcs, 3=Meter, 4=Batang, 5=Roll, 6=m3, 7=Kg
        ['id_kategori' => 1, 'id_satuan' => 1, 'nama_produk' => 'Semen Gresik 50kg', 'harga_jual' => 62000, 'stok' => 150, 'barcode' => 'BRC001'],
        ['id_kategori' => 1, 'id_satuan' => 2, 'nama_produk' => 'Bata Merah Press', 'harga_jual' => 800, 'stok' => 5000, 'barcode' => 'BRC002'],
        ['id_kategori' => 2, 'id_satuan' => 4, 'nama_produk' => 'Besi Beton 10mm SNI', 'harga_jual' => 85000, 'stok' => 80, 'barcode' => 'BRC003'],
        ['id_kategori' => 2, 'id_satuan' => 7, 'nama_produk' => 'Kawat Bendrat (Roll)', 'harga_jual' => 22000, 'stok' => 25, 'barcode' => 'BRC004'],
        ['id_kategori' => 3, 'id_satuan' => 2, 'nama_produk' => 'Triplek 9mm Palem', 'harga_jual' => 95000, 'stok' => 40, 'barcode' => 'BRC005'],
        ['id_kategori' => 4, 'id_satuan' => 2, 'nama_produk' => 'Genteng Metal Pasir', 'harga_jual' => 35000, 'stok' => 200, 'barcode' => 'BRC006'],
        ['id_kategori' => 5, 'id_satuan' => 5, 'nama_produk' => 'Kabel Eterna 2x1.5', 'harga_jual' => 285000, 'stok' => 10, 'barcode' => 'BRC007'],
        ['id_kategori' => 5, 'id_satuan' => 2, 'nama_produk' => 'Saklar Broco Engkel', 'harga_jual' => 18000, 'stok' => 30, 'barcode' => 'BRC008'],
        ['id_kategori' => 6, 'id_satuan' => 4, 'nama_produk' => 'Pipa Wavin 1/2 Inch', 'harga_jual' => 25000, 'stok' => 60, 'barcode' => 'BRC009'],
        ['id_kategori' => 7, 'id_satuan' => 2, 'nama_produk' => 'Palu Kambing Tekiro', 'harga_jual' => 55000, 'stok' => 12, 'barcode' => 'BRC010'],
        ['id_kategori' => 8, 'id_satuan' => 2, 'nama_produk' => 'Cat Mowilex Putih 5kg', 'harga_jual' => 210000, 'stok' => 8, 'barcode' => 'BRC011'],
        ['id_kategori' => 8, 'id_satuan' => 2, 'nama_produk' => 'Kuas Cat 3 Inch', 'harga_jual' => 15000, 'stok' => 100, 'barcode' => 'BRC012'],
        ['id_kategori' => 9, 'id_satuan' => 2, 'nama_produk' => 'Keramik 40x40 Putih', 'harga_jual' => 58000, 'stok' => 50, 'barcode' => 'BRC013'],
        ['id_kategori' => 10, 'id_satuan' => 7, 'nama_produk' => 'Paku Kayu 5cm (1kg)', 'harga_jual' => 20000, 'stok' => 30, 'barcode' => 'BRC014'],
        ['id_kategori' => 10, 'id_satuan' => 2, 'nama_produk' => 'Baut Baja Ringan', 'harga_jual' => 45000, 'stok' => 20, 'barcode' => 'BRC015'],
    ];

    foreach ($produk as $p) {
        DB::table('produk')->insert($p);
    }
}
}