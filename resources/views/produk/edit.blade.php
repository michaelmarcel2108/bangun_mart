<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('produk.index') }}" class="p-2 bg-white border border-slate-200 rounded-lg text-slate-400 hover:text-construction-black transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h2 class="text-3xl font-black text-construction-black leading-tight uppercase tracking-tighter">
                    MODIFIKASI <span class="text-construction-yellow">MATERIAL</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Perbarui informasi atau penyesuaian stok material gudang.</p>
            </div>
        </div>
    </x-slot>

    <div class="max-w-3xl mx-auto">
        <form action="{{ route('produk.update', $produk->id_produk) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="card-base p-8 space-y-8">
                <div class="space-y-4">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-construction-yellow bg-construction-black inline-block px-2 py-1">01. Identitas Produk</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Nama Material</label>
                            <input type="text" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required
                                   class="input-field py-3 font-bold text-slate-800">
                            <x-input-error :messages="$errors->get('nama_produk')" class="mt-1" />
                        </div>
                        
                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Kode Barcode</label>
                            <input type="text" name="barcode" value="{{ old('barcode', $produk->barcode) }}" required
                                   class="input-field py-3 font-mono text-sm">
                            <x-input-error :messages="$errors->get('barcode')" class="mt-1" />
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Kategori</label>
                            <select name="id_kategori" required class="input-field py-3 font-bold text-slate-700">
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id_kategori }}" {{ $produk->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-construction-yellow bg-construction-black inline-block px-2 py-1">02. Harga & Satuan</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Harga Jual (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 font-black text-slate-400">Rp</span>
                                <input type="number" name="harga_jual" value="{{ old('harga_jual', $produk->harga_jual) }}" required
                                       class="input-field py-3 pl-12 font-black text-slate-800">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Satuan</label>
                            <select name="id_satuan" required class="input-field py-3 font-bold text-slate-700">
                                @foreach($satuan as $s)
                                    <option value="{{ $s->id_satuan }}" {{ $produk->id_satuan == $s->id_satuan ? 'selected' : '' }}>
                                        {{ $s->nama_satuan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xs font-black uppercase tracking-[0.2em] text-construction-yellow bg-construction-black inline-block px-2 py-1">03. Inventori</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Stok Saat Ini</label>
                            <input type="number" name="stok" value="{{ old('stok', $produk->stok) }}" required
                                   class="input-field py-3 font-black text-slate-800 bg-slate-50">
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Stok Minimum (Alert)</label>
                            <input type="number" name="stok_minimum" value="{{ old('stok_minimum', $produk->stok_minimum) }}" required
                                   class="input-field py-3 font-black text-red-600">
                        </div>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-100 flex gap-4">
                    <button type="submit" class="flex-1 btn-primary py-4 text-sm tracking-widest uppercase">
                        UPDATE DATA GUDANG
                    </button>
                    <a href="{{ route('produk.index') }}" class="px-6 py-4 bg-slate-100 text-slate-500 font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-slate-200 transition-colors flex items-center">
                        BATAL
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>