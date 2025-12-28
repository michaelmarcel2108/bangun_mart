<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('penjualan', function (Blueprint $table) {
        // HANYA tambahkan total_bayar jika belum ada
        if (!Schema::hasColumn('penjualan', 'total_bayar')) {
            $table->decimal('total_bayar', 15, 2)->default(0)->after('tgl_nota');
        }
    });
}

public function down(): void
{
    Schema::table('penjualan', function (Blueprint $table) {
        $table->dropColumn('total_bayar');
    });
}
};
