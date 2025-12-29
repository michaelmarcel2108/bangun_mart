<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-black text-construction-black leading-tight uppercase tracking-tighter">
                TERMINAL <span class="text-construction-yellow">KASIR</span>
            </h2>
            <div class="flex items-center gap-2 text-slate-500 font-bold text-[10px] uppercase tracking-widest">
                <span class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></span>
                Sistem Penjualan Aktif
            </div>
        </div>
    </x-slot>

    <div x-data="posSystem()" class="py-4">
        @if(session('error'))
            <div class="mb-6 flex items-center p-4 bg-red-50 border-2 border-red-100 rounded-2xl shadow-sm animate-bounce-short">
                <div class="flex-shrink-0 bg-red-500 p-2 rounded-xl shadow-lg shadow-red-200">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-[10px] font-black text-red-800 uppercase tracking-[0.2em]">Peringatan Sistem</h3>
                    <p class="text-xs font-bold text-red-600 mt-0.5 italic">{{ session('error') }}</p>
                </div>
                <button type="button" @click="$el.parentElement.remove()" class="ml-auto text-red-300 hover:text-red-500 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        <form action="{{ route('penjualan.store') }}" method="POST">
            @csrf
            <div class="flex flex-col lg:flex-row gap-6">
                
                <div class="lg:w-3/4 space-y-4">
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-slate-400 group-focus-within:text-construction-yellow transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input 
                            x-model="search" 
                            type="text" 
                            placeholder="CARI NAMA MATERIAL ATAU SCAN BARCODE..." 
                            class="w-full bg-white border-2 border-slate-100 rounded-2xl py-4 pl-11 pr-4 text-[11px] font-black uppercase tracking-widest focus:border-construction-yellow focus:ring-0 transition-all shadow-sm placeholder-slate-300"
                        >
                    </div>

                    <div class="card-base p-4 bg-white/50 backdrop-blur-sm">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach($produk as $p)
                            <div 
                                x-show="search === '' || '{{ strtolower($p->nama_produk) }}'.includes(search.toLowerCase()) || '{{ strtolower($p->barcode) }}'.includes(search.toLowerCase())"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-95"
                                x-transition:enter-end="opacity-100 scale-100"
                                @click="addToCart({ id: {{ $p->id_produk }}, nama: '{{ $p->nama_produk }}', harga: {{ $p->harga_jual }}, stok: {{ $p->stok }} })"
                                class="flex flex-col p-4 border-2 border-slate-50 rounded-2xl hover:border-construction-yellow hover:bg-yellow-50/30 cursor-pointer transition-all active:scale-95 group relative overflow-hidden bg-white shadow-sm">
                                
                                <div class="absolute top-0 right-0 p-3 opacity-0 group-hover:opacity-100 transition-all translate-x-2 group-hover:translate-x-0">
                                    <div class="bg-construction-yellow text-construction-black p-1.5 rounded-lg shadow-md">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                                    </div>
                                </div>

                                <h4 class="font-bold text-slate-800 text-sm leading-tight mb-1">{{ $p->nama_produk }}</h4>
                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-4">{{ $p->barcode }}</p>
                                
                                <div class="mt-auto flex justify-between items-end">
                                    <div class="flex flex-col">
                                        <span class="text-[8px] font-black text-slate-400 uppercase tracking-tighter">Harga Satuan</span>
                                        <span class="text-sm font-black text-construction-black italic">Rp {{ number_format($p->harga_jual, 0, ',', '.') }}</span>
                                    </div>
                                    <span class="text-[8px] font-bold px-2 py-1 rounded-full bg-slate-100 text-slate-500 border border-slate-200 italic">Stok: {{ $p->stok }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/4">
                    <div class="card-base sticky top-24 border-t-4 border-construction-black shadow-2xl flex flex-col max-h-[85vh] bg-white">
                        <div class="p-4 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="font-black text-[10px] uppercase tracking-[0.2em] text-construction-black italic">Item Terpilih</h3>
                            <span class="bg-construction-black text-construction-yellow text-[9px] font-black px-2 py-0.5 rounded-md shadow-sm" x-text="cart.length"></span>
                        </div>

                        <div class="flex-1 overflow-y-auto p-3 space-y-3 min-h-[120px]">
                            <template x-for="(item, index) in cart" :key="item.id">
                                <div class="bg-slate-50/80 p-3 rounded-xl border border-slate-100 group relative shadow-sm hover:shadow-md transition-all">
                                    <div class="flex justify-between items-start mb-2 pr-6">
                                        <p class="text-[10px] font-black text-slate-700 leading-tight uppercase tracking-tight" x-text="item.nama"></p>
                                        
                                        <button type="button" @click="removeFromCart(index)" 
                                                class="absolute top-3 right-3 text-construction-black hover:text-red-600 transition-all active:scale-75">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-1.5 bg-white p-1 rounded-lg border border-slate-200 scale-90 origin-left shadow-inner">
                                            <button type="button" @click="decreaseQty(item.id)" class="w-5 h-5 flex items-center justify-center text-slate-400 hover:text-red-500 transition-colors font-black">-</button>
                                            <span class="w-6 text-center text-[11px] font-black text-construction-black" x-text="item.qty"></span>
                                            <button type="button" @click="increaseQty(item.id)" class="w-5 h-5 flex items-center justify-center text-slate-400 hover:text-green-600 transition-colors font-black">+</button>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-[10px] font-black text-construction-black italic" x-text="'Rp' + formatNumber(item.harga * item.qty)"></p>
                                        </div>
                                    </div>

                                    <input type="hidden" :name="'keranjang['+index+'][id_produk]'" :value="item.id">
                                    <input type="hidden" :name="'keranjang['+index+'][qty]'" :value="item.qty">
                                </div>
                            </template>

                            <template x-if="cart.length === 0">
                                <div class="text-center py-12 opacity-30">
                                    <div class="bg-slate-100 w-12 h-12 mx-auto rounded-2xl flex items-center justify-center mb-3">
                                        <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                    </div>
                                    <p class="text-[9px] font-black uppercase tracking-[0.3em] text-slate-500">Nota Kosong</p>
                                </div>
                            </template>
                        </div>

                        <div class="p-4 bg-construction-black text-white rounded-b-xl shadow-inner">
                            <div class="flex justify-between items-center mb-4 px-1">
                                <div class="flex flex-col">
                                    <span class="text-[8px] font-black uppercase tracking-widest text-slate-500">Total Pembayaran</span>
                                    <span class="text-xl font-black text-construction-yellow italic" x-text="'Rp' + formatNumber(calculateTotal())"></span>
                                </div>
                                <svg class="w-6 h-6 text-slate-700" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"/><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"/></svg>
                            </div>

                            <div class="mb-5">
                                <label class="block text-[8px] font-black uppercase text-slate-500 mb-1.5 tracking-widest ml-1">Nominal Tunai (Cash)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-construction-yellow font-black text-xs">Rp</span>
                                    <input type="number" name="jumlah_bayar" required
                                           class="w-full bg-slate-900 border-none rounded-xl py-3 pl-8 pr-3 font-black text-base text-construction-yellow focus:ring-1 focus:ring-construction-yellow shadow-inner placeholder-slate-700"
                                           placeholder="0">
                                </div>
                            </div>

                            <button type="submit" 
                                    :disabled="cart.length === 0"
                                    class="w-full py-4 bg-construction-yellow text-construction-black font-black text-[11px] uppercase tracking-[0.25em] rounded-xl hover:bg-white transition-all shadow-lg active:scale-95 disabled:opacity-20 disabled:grayscale">
                                KONFIRMASI NOTA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function posSystem() {
            return {
                search: '', // State untuk pencarian
                cart: [],
                addToCart(produk) {
                    const existing = this.cart.find(item => item.id === produk.id);
                    if (existing) {
                        if (existing.qty < produk.stok) existing.qty++;
                        else alert('Maaf, stok material ini sudah habis di gudang!');
                    } else {
                        if (produk.stok > 0) this.cart.push({ ...produk, qty: 1 });
                        else alert('Stok produk ini sedang kosong!');
                    }
                },
                increaseQty(id) {
                    const item = this.cart.find(i => i.id === id);
                    if (item && item.qty < item.stok) item.qty++;
                },
                decreaseQty(id) {
                    const idx = this.cart.findIndex(i => i.id === id);
                    if (idx !== -1) {
                        if (this.cart[idx].qty > 1) this.cart[idx].qty--;
                        else this.removeFromCart(idx);
                    }
                },
                removeFromCart(index) {
                    this.cart.splice(index, 1);
                },
                calculateTotal() {
                    return this.cart.reduce((t, i) => t + (i.harga * i.qty), 0);
                },
                formatNumber(n) {
                    return new Intl.NumberFormat('id-ID').format(n);
                }
            }
        }
    </script>
</x-app-layout>