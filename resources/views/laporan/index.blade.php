<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-black text-construction-black leading-tight uppercase tracking-tighter">
            ANALISIS <span class="text-construction-yellow">DATA & LAPORAN</span>
        </h2>
        <p class="text-slate-500 text-sm font-medium mt-1">Ringkasan performa penjualan dan status inventaris gudang.</p>
    </x-slot>

    <div class="space-y-10">
        
        <div class="card-base border-t-8 border-red-600">
            <div class="p-6 bg-red-50/50 border-b border-red-100 flex items-center justify-between">
                <div>
                    <h3 class="font-black text-sm uppercase tracking-widest text-red-700">Peringatan: Stok Menipis</h3>
                    <p class="text-[10px] font-bold text-red-500">SEGERA LAKUKAN PEMESANAN KE SUPPLIER</p>
                </div>
                <div class="bg-red-600 text-white px-3 py-1 rounded font-black text-xs italic">
                    {{ $stokMenipis->count() }} ITEM KRITIS
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-400">
                            <th class="px-6 py-4">Material</th>
                            <th class="px-6 py-4">Kategori / Satuan</th>
                            <th class="px-6 py-4 text-center">Stok Sisa</th>
                            <th class="px-6 py-4 text-center">Batas Min.</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($stokMenipis as $item)
                        <tr>
                            <td class="px-6 py-4 font-bold text-slate-800">{{ $item->nama_produk }}</td>
                            <td class="px-6 py-4 text-xs font-bold text-slate-500">
                                {{ $item->nama_kategori }} / {{ $item->nama_satuan }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-red-600 font-black italic">{{ $item->stok }}</span>
                            </td>
                            <td class="px-6 py-4 text-center font-bold text-slate-400 italic">
                                {{ $item->stok_minimum }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-8 text-center text-slate-400 font-bold italic uppercase">
                                Semua stok dalam kondisi aman.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="card-base">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="font-black text-sm uppercase tracking-widest text-construction-black italic">Produk Terlaris</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($terlaris as $t)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg border border-slate-100">
                            <span class="font-bold text-slate-700 uppercase text-xs">{{ $t->nama_produk }}</span>
                            <span class="bg-construction-black text-construction-yellow px-3 py-1 rounded font-black text-xs">
                                {{ $t->total_qty }} TERJUAL
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card-base">
                <div class="p-6 border-b border-slate-100">
                    <h3 class="font-black text-sm uppercase tracking-widest text-construction-black italic">Sirkulasi Personel & Pelanggan</h3>
                </div>
                <div class="overflow-y-auto max-h-[300px]">
                    <table class="w-full text-left">
                        <tbody class="divide-y divide-slate-100">
                            @foreach($kontak as $k)
                            <tr>
                                <td class="px-6 py-3 font-bold text-slate-800 text-xs">{{ $k->nama }}</td>
                                <td class="px-6 py-3 text-right">
                                    <span @class([
                                        'text-[9px] font-black uppercase px-2 py-0.5 rounded',
                                        'bg-blue-100 text-blue-700' => $k->tipe == 'Pegawai',
                                        'bg-green-100 text-green-700' => $k->tipe == 'Pelanggan',
                                    ])>
                                        {{ $k->tipe }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card-base border-t-8 border-construction-black">
            <div class="p-6 border-b border-slate-100">
                <h3 class="font-black text-sm uppercase tracking-widest text-construction-black italic">Rekapitulasi Penjualan Harian</h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    @foreach($rekapBulanan as $r)
                    <div class="p-4 bg-slate-50 rounded-xl border border-slate-100 text-center">
                        <p class="text-[9px] font-black text-slate-400 uppercase leading-none mb-2">{{ date('d M Y', strtotime($r->tanggal)) }}</p>
                        <p class="text-sm font-black text-construction-black italic leading-none">Rp {{ number_format($r->total, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-app-layout>