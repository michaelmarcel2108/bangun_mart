<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = DB::table('produk')->count();
        
        $stokKritis = DB::table('produk')
            ->whereRaw('stok <= stok_minimum')
            ->count();

        // Omzet Hari Ini (Menggunakan whereDate agar jam tidak berpengaruh)
        $pendapatanHariIni = DB::table('penjualan')
            ->whereDate('tgl_nota', '=', date('Y-m-d'))
            ->sum('total_bayar');

        $transaksiTerakhir = DB::table('penjualan')
            ->orderBy('id_nota', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard', compact('totalProduk', 'stokKritis', 'pendapatanHariIni', 'transaksiTerakhir'));
    }
}