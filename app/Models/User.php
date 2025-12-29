<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'pegawai'; // Wajib: arahkan ke tabel pegawai
    protected $primaryKey = 'id_pegawai'; // Wajib: primary key Anda bukan 'id'

    protected $fillable = [
        'nama_pegawai',
        'password',
        'jabatan',
        'shift',
        'aktif',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}