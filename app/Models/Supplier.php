<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'supplier';

    // Primary Key tabel
    protected $primaryKey = 'id_supplier';

    // Karena di migrasi kita tidak membuat $table->timestamps()
    public $timestamps = false;

    // Kolom yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon'
    ];

    /**
     * Relasi ke ProdukSupplier (Many to Many via Pivot)
     */
    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produk_supplier', 'id_supplier', 'id_produk')
                    ->withPivot('harga_beli_terakhir');
    }
}