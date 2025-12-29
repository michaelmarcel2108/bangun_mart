<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-construction-black leading-tight uppercase tracking-tighter">
                    MANAJEMEN <span class="text-construction-yellow">GUDANG</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium mt-1">Total inventaris bahan bangunan yang tersedia saat ini.</p>
            </div>
            <div>
                <a href="{{ route('produk.create') }}" class="btn-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    TAMBAH BARANG BARU
                </a>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg shadow-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 text-green-500">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <div class="card-base">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-construction-black text-white uppercase text-[11px] tracking-[0.2em] font-black">
                            <th class="px-6 py-4">ID</th>
                            <th class="px-6 py-4">Nama Produk</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4 text-right">Harga Jual</th>
                            <th class="px-6 py-4 text-center">Stok</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($produk as $item)
                        <tr class="hover:bg-slate-50/80 transition-colors group">
                            <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $item->id_produk }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800">{{ $item->nama_produk }}</div>
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $item->barcode }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-slate-100 text-slate-600 text-[10px] font-black uppercase rounded">
                                    {{ $item->kategori->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-black text-slate-700">
                                Rp {{ number_format($item->harga_jual, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div @class([
                                    'inline-flex items-center px-3 py-1 rounded-full text-xs font-black italic shadow-inner',
                                    'bg-red-100 text-red-600 border border-red-200' => $item->stok <= $item->stok_minimum,
                                    'bg-yellow-100 text-yellow-700 border border-yellow-200' => $item->stok > $item->stok_minimum && $item->stok <= 20,
                                    'bg-slate-100 text-slate-800 border border-slate-200' => $item->stok > 20,
                                ])>
                                    {{ $item->stok }} {{ $item->satuan->nama_satuan ?? 'Unit' }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('produk.edit', $item->id_produk) }}" 
                                       class="p-2 text-slate-400 hover:text-construction-yellow hover:bg-construction-black rounded-lg transition-all duration-200"
                                       title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                    </a>
                                    
                                    <form action="{{ route('produk.destroy', $item->id_produk) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus material ini dari gudang?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 text-slate-400 hover:text-white hover:bg-red-600 rounded-lg transition-all duration-200"
                                                title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($produk->isEmpty())
                <div class="py-20 text-center">
                    <p class="text-slate-400 font-bold uppercase tracking-widest italic">Belum ada stok barang yang terdaftar.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>