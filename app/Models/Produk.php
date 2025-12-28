<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    public $timestamps = false; // Mematikan created_at & updated_at

    protected $fillable = [
        'id_kategori', 
        'id_satuan', 
        'barcode', 
        'nama_produk', 
        'harga_jual', 
        'stok', 
        'stok_minimum'
    ];

    public function kategori() {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function satuan() {
        return $this->belongsTo(Satuan::class, 'id_satuan', 'id_satuan');
    }
}