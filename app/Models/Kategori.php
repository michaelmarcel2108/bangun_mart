<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
protected $primaryKey = 'id_kategori';
public $timestamps = false; // Matikan timestamps jika tabel tidak punya created_at
}
