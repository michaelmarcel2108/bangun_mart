<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // 1. Laporan Stok Menipis (Join 3 Tabel)
        $stokMenipis = DB::table('produk')
            ->join('kategori', 'produk.id_kategori', '=', 'kategori.id_kategori')
            ->join('satuan', 'produk.id_satuan', '=', 'satuan.id_satuan')
            ->select('produk.*', 'kategori.nama_kategori', 'satuan.nama_satuan')
            ->whereRaw('produk.stok <= produk.stok_minimum')
            ->get();

        // 2. Produk Terlaris (Inner Join + Group By)
        $terlaris = DB::table('detail_penjualan')
            ->join('produk', 'detail_penjualan.id_produk', '=', 'produk.id_produk')
            ->select('produk.nama_produk', DB::raw('SUM(detail_penjualan.qty) as total_qty'))
            ->groupBy('produk.id_produk', 'produk.nama_produk')
            ->orderBy('total_qty', 'DESC')
            ->limit(10)
            ->get();

        // 3. Union: Gabungan Nama User (Pegawai) dan Pelanggan
        $kontak = DB::table('pegawai')
            ->select('nama_pegawai as nama', DB::raw("'Pegawai' as tipe"))
            ->union(
                DB::table('pelanggan')->select('nama_pelanggan as nama', DB::raw("'Pelanggan' as tipe"))
            )
            ->get();

        // 4. Rekap Penjualan Bulanan (Untuk Grafik/Tabel Rekap)
        $rekapBulanan = DB::table('penjualan')
            ->select(DB::raw('DATE(tgl_nota) as tanggal'), DB::raw('SUM(total_bayar) as total'))
            ->groupBy(DB::raw('DATE(tgl_nota)'))
            ->orderBy('tanggal', 'DESC')
            ->get();

        return view('laporan.index', compact('stokMenipis', 'terlaris', 'kontak', 'rekapBulanan'));
    }
}