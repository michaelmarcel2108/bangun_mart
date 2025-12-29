<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // 1. Tambah kolom password ke tabel pegawai yang sudah ada
        Schema::table('pegawai', function (Blueprint $table) {
            $table->string('password')->after('nama_pegawai');
            $table->rememberToken();
        });

        // 2. Buat tabel Supplier (Tabel ke-8)
        Schema::create('supplier', function (Blueprint $table) {
            $table->id('id_supplier');
            $table->string('nama_supplier', 100);
            $table->string('alamat')->nullable();
            $table->string('telepon', 20);
        });

        // 3. Buat tabel Pembayaran (Tabel ke-9)
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_bayar');
            $table->foreignId('id_nota')->constrained('penjualan', 'id_nota');
            $table->enum('metode', ['tunai', 'transfer', 'qris']);
            $table->decimal('jumlah_bayar', 12, 2);
            $table->decimal('kembalian', 12, 2);
            $table->timestamp('tgl_bayar')->useCurrent();
        });

        // 4. Buat tabel Produk_Supplier (Tabel ke-10 - Pivot)
        Schema::create('produk_supplier', function (Blueprint $table) {
            $table->foreignId('id_produk')->constrained('produk', 'id_produk');
            $table->foreignId('id_supplier')->constrained('supplier', 'id_supplier');
            $table->decimal('harga_beli_terakhir', 12, 2);
            $table->primary(['id_produk', 'id_supplier']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('produk_supplier');
        Schema::dropIfExists('pembayaran');
        Schema::dropIfExists('supplier');
    }
};