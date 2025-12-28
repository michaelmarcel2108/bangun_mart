<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    // 1. Menampilkan Daftar Produk (Halaman Index)
    public function index()
    {
        // Mengambil data produk beserta kategori dan satuannya menggunakan Eager Loading
        $produk = Produk::with(['kategori', 'satuan'])->get();
        return view('produk.index', compact('produk'));
    }

    // 2. Menampilkan Form Tambah Produk (Halaman Create)
    public function create()
    {
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        return view('produk.create', compact('kategori', 'satuan'));
    }

    // 3. Menyimpan Data Produk Baru ke Database (Proses Store)
    public function store(Request $request)
    {
        $request->validate([
            'barcode' => 'required|unique:produk,barcode',
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        Produk::create([
            'barcode' => $request->barcode,
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'id_satuan' => $request->id_satuan,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'stok_minimum' => $request->stok_minimum ?? 5,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk material berhasil ditambahkan!');
    }

    // 4. Menampilkan Form Edit Produk (Halaman Edit)
    public function edit($id)
    {
        // Mencari produk berdasarkan Primary Key id_produk
        $produk = Produk::findOrFail($id);
        
        // Mengambil data pendukung untuk pilihan dropdown
        $kategori = Kategori::all();
        $satuan = Satuan::all();

        return view('produk.edit', compact('produk', 'kategori', 'satuan'));
    }

    // 5. Memperbarui Data Produk di Database (Proses Update)
    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        // Validasi: Abaikan pengecekan unik barcode untuk ID yang sedang diedit
        $request->validate([
            'barcode' => 'required|unique:produk,barcode,' . $id . ',id_produk',
            'nama_produk' => 'required',
            'id_kategori' => 'required',
            'id_satuan' => 'required',
            'harga_jual' => 'required|numeric',
            'stok' => 'required|numeric',
        ]);

        $produk->update([
            'barcode' => $request->barcode,
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'id_satuan' => $request->id_satuan,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
            'stok_minimum' => $request->stok_minimum ?? 5,
        ]);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    // 6. Menghapus Produk dari Database (Proses Destroy)
    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}