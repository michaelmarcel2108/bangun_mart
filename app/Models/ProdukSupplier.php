<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukSupplier extends Model
{
    protected $table = 'produk_supplier';

    /**
     * Tabel ini menggunakan Primary Key Gabungan (id_produk + id_supplier).
     * Eloquent tidak mendukung auto-increment pada primary key gabungan.
     */
    protected $primaryKey = ['id_produk', 'id_supplier'];
    public $incrementing = false;
    
    public $timestamps = false;

    protected $fillable = [
        'id_produk',
        'id_supplier',
        'harga_beli_terakhir'
    ];

    /**
     * Relasi balik ke Produk
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    /**
     * Relasi balik ke Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier', 'id_supplier');
    }
}