<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        // Mengambil data produk lengkap dengan satuan agar view tidak error
        $produk = Produk::with('satuan')->get();
        return view('penjualan.index', compact('produk'));
    }

    public function store(Request $request)
    {
        if (!$request->has('keranjang') || count($request->keranjang) == 0) {
            return redirect()->back()->with('error', 'Keranjang belanja masih kosong!');
        }

        DB::beginTransaction();
        try {
            $totalTagihan = 0;

            foreach ($request->keranjang as $item) {
                if ($item['qty'] > 0) {
                    $p = Produk::find($item['id_produk']);
                    if (!$p || $p->stok < $item['qty']) {
                        throw new \Exception("Stok barang '{$p->nama_produk}' tidak mencukupi.");
                    }
                    $totalTagihan += ($p->harga_jual * $item['qty']);
                }
            }

            if ($request->jumlah_bayar < $totalTagihan) {
                throw new \Exception("Uang bayar kurang.");
            }

            $id_nota = DB::table('penjualan')->insertGetId([
                'id_pegawai'    => Auth::user()->id_pegawai,
                'id_pelanggan'  => $request->id_pelanggan ?? 1,
                'tgl_nota'      => now(),
                'total_bayar'   => $totalTagihan,
                'status_nota'   => 'dibayar'
            ]);

            foreach ($request->keranjang as $item) {
                if ($item['qty'] > 0) {
                    $p = Produk::find($item['id_produk']);
                    
                    // PERBAIKAN: Hapus kolom 'subtotal' karena tidak ada di migrasi Anda
                    DB::table('detail_penjualan')->insert([
                        'id_nota'       => $id_nota,
                        'id_produk'     => $item['id_produk'],
                        'qty'           => $item['qty'],
                        'harga_satuan'  => $p->harga_jual
                        // 'subtotal' dihapus disini
                    ]);

                    $p->decrement('stok', $item['qty']);
                }
            }

            DB::table('pembayaran')->insert([
                'id_nota'      => $id_nota,
                'metode'       => $request->metode_pembayaran ?? 'tunai',
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian'    => $request->jumlah_bayar - $totalTagihan,
                'tgl_bayar'    => now()
            ]);

            DB::commit();
            return redirect()->route('penjualan.cetak', $id_nota)->with('success', 'Transaksi Berhasil!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function cetak($id)
    {
        $penjualan = DB::table('penjualan')
            ->join('pegawai', 'penjualan.id_pegawai', '=', 'pegawai.id_pegawai')
            ->join('pembayaran', 'penjualan.id_nota', '=', 'pembayaran.id_nota')
            ->where('penjualan.id_nota', $id)
            ->select('penjualan.*', 'pegawai.nama_pegawai', 'pembayaran.metode', 'pembayaran.jumlah_bayar', 'pembayaran.kembalian')
            ->first();

        $detail = DB::table('detail_penjualan')
            ->join('produk', 'detail_penjualan.id_produk', '=', 'produk.id_produk')
            ->where('id_nota', $id)
            ->select('detail_penjualan.*', 'produk.nama_produk')
            ->get();

        return view('penjualan.cetak', compact('penjualan', 'detail'));
    }
}