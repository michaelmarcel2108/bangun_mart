<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $primaryKey = 'id_bayar';

    public $timestamps = false;

    protected $fillable = [
        'id_nota',
        'metode',
        'jumlah_bayar',
        'kembalian',
        'tgl_bayar'
    ];

    /**
     * Relasi ke Penjualan (Setiap pembayaran milik satu nota)
     */
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'id_nota', 'id_nota');
    }
}