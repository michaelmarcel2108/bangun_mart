<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-3xl font-black text-construction-black leading-tight">
                    PANEL <span class="text-construction-yellow">KONTROL</span>
                </h2>
                <p class="text-slate-500 text-sm font-medium">Selamat bekerja, {{ Auth::user()->nama_pegawai }}. Pantau pergerakan gudang Anda.</p>
            </div>
            <div class="flex gap-2">
                <span class="px-4 py-2 bg-construction-black text-construction-yellow text-xs font-bold rounded-full uppercase tracking-widest shadow-sm">
                    Sesi: {{ Auth::user()->shift }}
                </span>
            </div>
        </div>
    </x-slot>

    <div class="space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="card-base p-6 border-l-8 border-construction-yellow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Total Produk</p>
                        <h3 class="text-4xl font-black text-construction-black italic">1,240</h3>
                    </div>
                    <div class="bg-yellow-50 p-3 rounded-xl text-construction-yellow">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-bold text-green-600">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 10l7-7 7 7M12 3v18" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    +12 Barang Baru Hari Ini
                </div>
            </div>

            <div class="card-base p-6 border-l-8 border-construction-black">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Omzet Hari Ini</p>
                        <h3 class="text-4xl font-black text-construction-black italic">Rp 4.5M</h3>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl text-construction-black">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/></svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-xs font-bold text-construction-yellow bg-construction-black px-2 py-1 rounded inline-flex">
                    TARGET TERCAPAI 85%
                </div>
            </div>

            <div class="card-base p-6 border-l-8 border-red-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-xs font-bold uppercase tracking-wider mb-1">Stok Menipis</p>
                        <h3 class="text-4xl font-black text-red-600 italic">08</h3>
                    </div>
                    <div class="bg-red-50 p-3 rounded-xl text-red-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                </div>
                <a href="{{ route('laporan.index') }}" class="mt-4 text-xs font-black text-red-600 hover:underline uppercase flex items-center gap-1">
                    Lihat Detail Peringatan &rarr;
                </a>
            </div>
        </div>

        <div class="card-base">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h4 class="font-bold text-slate-800 uppercase text-sm tracking-widest">Aktivitas Gudang Terbaru</h4>
                <button class="text-xs font-bold text-construction-black hover:text-yellow-600">LIHAT SEMUA</button>
            </div>
            <div class="p-6 text-center py-12">
                <div class="bg-slate-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <p class="text-slate-400 font-medium">Belum ada transaksi diproses hari ini.</p>
            </div>
        </div>
    </div>
</x-app-layout>