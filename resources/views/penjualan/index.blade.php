<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-3xl font-black text-construction-black leading-tight uppercase tracking-tighter">
                TERMINAL <span class="text-construction-yellow">KASIR</span>
            </h2>
            <div class="flex items-center gap-2 text-slate-500 font-bold text-xs uppercase tracking-widest">
                <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                Sistem Penjualan Aktif
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        @if(session('error'))
            <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
            </div>
        @endif

        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            <div class="flex flex-col lg:flex-row gap-8">
                <div class="lg:w-2/3 space-y-6">
                    <div class="card-base p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($produk as $p)
                            <div class="flex items-center p-4 border-2 border-slate-50 rounded-xl hover:border-construction-yellow transition-all group">
                                <div class="bg-construction-black text-construction-yellow p-3 rounded-lg font-black text-xs rotate-2 group-hover:rotate-0 transition-transform uppercase">
                                    {{ $p->satuan->nama_satuan ?? 'PCS' }}
                                </div>
                                <div class="ml-4 flex-1">
                                    <h4 class="font-bold text-slate-800 leading-tight">{{ $p->nama_produk }}</h4>
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $p->barcode }}</p>
                                    <div class="mt-2 flex justify-between items-center">
                                        <span class="text-sm font-black text-construction-black italic">Rp {{ number_format($p->harga_jual, 0, ',', '.') }}</span>
                                        <div class="flex items-center gap-2">
                                            <input type="hidden" name="keranjang[{{ $loop->index }}][id_produk]" value="{{ $p->id_produk }}">
                                            <input type="number" name="keranjang[{{ $loop->index }}][qty]" value="0" min="0" max="{{ $p->stok }}"
                                                   class="w-16 h-8 text-center rounded-md border-slate-200 font-black text-sm focus:border-construction-yellow">
                                        </div>
                                    </div>
                                    <p class="text-[9px] font-bold text-slate-400 mt-1">Stok Tersedia: {{ $p->stok }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/3">
                    <div class="card-base sticky top-28 border-t-8 border-construction-black shadow-xl">
                        <div class="p-6 bg-slate-50 border-b border-slate-100">
                            <h3 class="font-black text-sm uppercase tracking-widest">Ringkasan Sesi</h3>
                        </div>
                        <div class="p-6 bg-construction-black text-white space-y-5">
                            <div>
                                <label class="block text-[10px] font-black uppercase text-slate-400 mb-2 tracking-widest">Input Nominal Bayar (Rp)</label>
                                <input type="number" name="jumlah_bayar" required
                                       class="w-full bg-slate-800 border-none rounded-xl py-4 font-black text-2xl text-construction-yellow focus:ring-2 focus:ring-construction-yellow placeholder-slate-600 shadow-inner"
                                       placeholder="0">
                            </div>
                            <button type="submit" class="w-full btn-primary py-5 text-sm tracking-[0.2em] shadow-lg">
                                PROSES TRANSAKSI
                            </button>
                        </div>
                        <div class="p-4 bg-slate-100 text-center text-[9px] font-bold text-slate-400 uppercase">
                            Operator: {{ Auth::user()->nama_pegawai }}
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>