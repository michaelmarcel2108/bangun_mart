<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    // 1. MASTER DATA (Tabel yang tidak punya Foreign Key)
    Schema::create('kategori', function ($table) {
        $table->id('id_kategori');
        $table->string('nama_kategori', 60);
    });

    Schema::create('satuan', function ($table) {
        $table->id('id_satuan');
        $table->string('nama_satuan', 20);
    });

    Schema::create('pegawai', function ($table) {
        $table->id('id_pegawai');
        $table->string('nama_pegawai', 100);
        $table->enum('jabatan', ['kasir','gudang','admin']);
        $table->enum('shift', ['pagi','siang','malam']);
        $table->boolean('aktif')->default(1);
    });

    Schema::create('pelanggan', function ($table) {
        $table->id('id_pelanggan');
        $table->string('nama_pelanggan', 100);
        $table->enum('tipe', ['umum','member','proyek'])->default('umum');
    });

    // 2. DATA PRODUK (Tabel yang merujuk ke Master)
    Schema::create('produk', function ($table) {
        $table->id('id_produk');
        $table->foreignId('id_kategori')->constrained('kategori', 'id_kategori');
        $table->foreignId('id_satuan')->constrained('satuan', 'id_satuan');
        $table->string('barcode')->unique();
        $table->string('nama_produk');
        $table->decimal('harga_jual', 12, 2);
        $table->integer('stok');
        $table->integer('stok_minimum')->default(5);
    });

    // 3. TRANSAKSI (Tabel yang merujuk ke Pegawai & Produk)
    Schema::create('penjualan', function ($table) {
        $table->id('id_nota');
        $table->timestamp('tgl_nota')->useCurrent();
        $table->foreignId('id_pegawai')->constrained('pegawai', 'id_pegawai');
        $table->foreignId('id_pelanggan')->nullable()->constrained('pelanggan', 'id_pelanggan');
        $table->enum('status_nota', ['baru','dibayar','batal'])->default('baru');
    });

    Schema::create('detail_penjualan', function ($table) {
        $table->foreignId('id_nota')->constrained('penjualan', 'id_nota');
        $table->foreignId('id_produk')->constrained('produk', 'id_produk');
        $table->integer('qty');
        $table->decimal('harga_satuan', 12, 2);
        $table->primary(['id_nota', 'id_produk']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bangunmart_system');
    }
};
