<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;  

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        $satuan = [
            ['nama_satuan' => 'Sak'],     // id 1
            ['nama_satuan' => 'Pcs'],     // id 2
            ['nama_satuan' => 'Meter'],   // id 3
            ['nama_satuan' => 'Batang'],  // id 4
            ['nama_satuan' => 'Roll'],    // id 5
            ['nama_satuan' => 'm3'],      // id 6
            ['nama_satuan' => 'Kg'],      // id 7
        ];

        foreach ($satuan as $s) {
            DB::table('satuan')->insert($s);
        }
    }
}