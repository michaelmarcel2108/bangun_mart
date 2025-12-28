<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;

class PenjualanController extends Controller
{
    public function index()
    {
        return view('penjualan.index');
    }

    public function store(Request $request)
    {
        if (!$request->has('keranjang') || count($request->keranjang) == 0) {
            return redirect()->back()->with('error', 'Keranjang belanja masih kosong!');
        }

        DB::beginTransaction();
        try {
            $totalBayar = 0;

            foreach ($request->keranjang as $item) {
                $p = Produk::where('id_produk', $item['id_produk'])->first();
                if (!$p) {
                    throw new \Exception("Produk ID {$item['id_produk']} tidak ditemukan.");
                }
                $totalBayar += ($p->harga_jual * $item['qty']);
            }

            $id_penjualan = DB::table('penjualan')->insertGetId([
                'id_pegawai'    => auth()->user()->id,
                'id_pelanggan'  => $request->id_pelanggan ?? 1, 
                'tgl_nota'      => now(),
                'total_bayar'   => $totalBayar,
                'status_nota'   => 'dibayar'
            ]);

            foreach ($request->keranjang as $item) {
                $p = Produk::where('id_produk', $item['id_produk'])->lockForUpdate()->first();
                
                if ($p->stok < $item['qty']) {
                    throw new \Exception("Stok '{$p->nama_produk}' tidak cukup.");
                }

                DB::table('detail_penjualan')->insert([
                    'id_nota'       => $id_penjualan,
                    'id_produk'     => $item['id_produk'],
                    'qty'           => $item['qty'],
                    'harga_satuan'  => $p->harga_jual
                ]);

                $p->decrement('stok', $item['qty']);
            }

            DB::commit();
            return redirect()->route('penjualan.cetak', $id_penjualan);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi Gagal: ' . $e->getMessage());
        }
    }

    public function cetak($id)
    {
        $penjualan = DB::table('penjualan')
            ->join('users', 'penjualan.id_pegawai', '=', 'users.id')
            ->where('id_nota', $id)
            ->select('penjualan.*', 'users.name as nama_pegawai')
            ->first();

        $detail = DB::table('detail_penjualan')
            ->join('produk', 'detail_penjualan.id_produk', '=', 'produk.id_produk')
            ->where('id_nota', $id)
            ->select('detail_penjualan.*', 'produk.nama_produk')
            ->get();

        if (!$penjualan) {
            return redirect()->route('penjualan.index')->with('error', 'Nota tidak ditemukan.');
        }

        return view('penjualan.cetak', compact('penjualan', 'detail'));
    }
}