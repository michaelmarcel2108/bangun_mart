<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
        // Mengambil data produk untuk pilihan di form (opsional jika dibutuhkan di view)
        $produk = Produk::all();
        return view('penjualan.index', compact('produk'));
    }

    public function store(Request $request)
    {
        // 1. Validasi awal: Keranjang tidak boleh kosong
        if (!$request->has('keranjang') || count($request->keranjang) == 0) {
            return redirect()->back()->with('error', 'Keranjang belanja masih kosong!');
        }

        // 2. Mulai Transaksi (TCL - Start Transaction)
        DB::beginTransaction();
        try {
            $totalTagihan = 0;

            // Hitung total tagihan dari keranjang
            foreach ($request->keranjang as $item) {
                $p = Produk::where('id_produk', $item['id_produk'])->first();
                if (!$p) {
                    throw new \Exception("Produk ID {$item['id_produk']} tidak ditemukan.");
                }
                $totalTagihan += ($p->harga_jual * $item['qty']);
            }

            // 3. Validasi Pembayaran: Uang bayar tidak boleh kurang dari tagihan
            if ($request->jumlah_bayar < $totalTagihan) {
                throw new \Exception("Transaksi Ditolak: Jumlah bayar (Rp " . number_format($request->jumlah_bayar) . ") kurang dari total tagihan (Rp " . number_format($totalTagihan) . ").");
            }

            // 4. Simpan Header Penjualan (Tabel Penjualan)
            // Menggunakan id_pegawai dari user yang sedang login
            $id_nota = DB::table('penjualan')->insertGetId([
                'id_pegawai'    => Auth::id(), // Mengambil id_pegawai dari session
                'id_pelanggan'  => $request->id_pelanggan ?? 1, // Default pelanggan umum
                'tgl_nota'      => now(),
                'total_bayar'   => $totalTagihan,
                'status_nota'   => 'dibayar'
            ]);

            // 5. Simpan Detail Item dan Update Stok
            foreach ($request->keranjang as $item) {
                // Lock produk untuk mencegah race condition (stok berubah saat diproses)
                $p = Produk::where('id_produk', $item['id_produk'])->lockForUpdate()->first();
                
                if ($p->stok < $item['qty']) {
                    throw new \Exception("Stok barang '{$p->nama_produk}' tidak mencukupi.");
                }

                // Masukkan ke detail_penjualan
                DB::table('detail_penjualan')->insert([
                    'id_nota'       => $id_nota,
                    'id_produk'     => $item['id_produk'],
                    'qty'           => $item['qty'],
                    'harga_satuan'  => $p->harga_jual
                ]);

                // Kurangi stok produk secara atomik
                $p->decrement('stok', $item['qty']);
            }

            // 6. Simpan Data Pembayaran (Tabel Pembayaran - Penambahan Baru)
            DB::table('pembayaran')->insert([
                'id_nota'      => $id_nota,
                'metode'       => $request->metode_pembayaran, // tunai, transfer, atau qris
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian'    => $request->jumlah_bayar - $totalTagihan,
                'tgl_bayar'    => now()
            ]);

            // 7. Selesaikan Transaksi (TCL - Commit)
            DB::commit();
            return redirect()->route('penjualan.cetak', $id_nota)->with('success', 'Transaksi Berhasil!');

        } catch (\Exception $e) {
            // 8. Batalkan semua jika ada error (TCL - Rollback)
            DB::rollBack();
            return redirect()->back()->with('error', 'Transaksi Gagal: ' . $e->getMessage());
        }
    }

    public function cetak($id)
    {
        // Join ke tabel pegawai (bukan users) sesuai skema database BangunMart
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

        if (!$penjualan) {
            return redirect()->route('penjualan.index')->with('error', 'Nota tidak ditemukan.');
        }

        return view('penjualan.cetak', compact('penjualan', 'detail'));
    }
}