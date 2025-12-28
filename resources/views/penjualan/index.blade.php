<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('🛒 Transaksi Kasir BangunMart') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="kasirSystem()">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Gagal!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="bg-white p-6 shadow-sm sm:rounded-lg border-t-4 border-blue-500">
                    <h3 class="font-bold mb-4 border-b pb-2 text-blue-600 uppercase">Pilih Produk</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Cari Produk Material</label>
                            <select x-model="selectedProduk" class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Pilih Barang --</option>
                                @foreach(\App\Models\Produk::where('stok', '>', 0)->get() as $p)
                                    <option value="{{ json_encode($p) }}">{{ $p->nama_produk }} (Stok: {{ $p->stok }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah (Qty)</label>
                            <input type="number" x-model="qty" min="1" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        </div>

                        <button @click="tambahKeKeranjang()" class="w-full bg-blue-600 text-white py-3 rounded-md hover:bg-blue-700 transition font-bold shadow-md">
                            + TAMBAH KE KERANJANG
                        </button>
                    </div>
                </div>

                <div class="md:col-span-2 bg-white p-6 shadow-sm sm:rounded-lg border-t-4 border-green-500">
                    <h3 class="font-bold mb-4 border-b pb-2 text-green-600 uppercase">Daftar Belanja (Nota)</h3>
                    
                    <form action="{{ route('penjualan.store') }}" method="POST" @submit="submitForm($event)">
                        @csrf
                        
                        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                            <label class="block text-sm font-medium text-gray-700">ID Pelanggan (Default: 1 untuk Umum)</label>
                            <input type="number" name="id_pelanggan" value="1" class="w-1/4 border-gray-300 rounded-md text-sm">
                        </div>

                        <table class="w-full text-left text-sm mb-6">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="p-3">Produk</th>
                                    <th class="p-3 text-right">Harga</th>
                                    <th class="p-3 text-center">Qty</th>
                                    <th class="p-3 text-right">Subtotal</th>
                                    <th class="p-3 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <template x-for="(item, index) in keranjang" :key="index">
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="p-3 font-medium" x-text="item.nama"></td>
                                        <td class="p-3 text-right" x-text="formatRupiah(item.harga)"></td>
                                        <td class="p-3 text-center">
                                            <span class="font-bold" x-text="item.qty"></span>
                                            <input type="hidden" :name="'keranjang['+index+'][id_produk]'" :value="item.id">
                                            <input type="hidden" :name="'keranjang['+index+'][qty]'" :value="item.qty">
                                        </td>
                                        <td class="p-3 text-right font-bold text-blue-600" x-text="formatRupiah(item.harga * item.qty)"></td>
                                        <td class="p-3 text-center">
                                            <button type="button" @click="hapusItem(index)" class="text-red-500 hover:text-red-700 font-bold">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <tr x-show="keranjang.length === 0">
                                    <td colspan="5" class="p-8 text-center text-gray-400 italic">Belum ada barang di keranjang.</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="flex justify-between items-center bg-gray-900 p-6 rounded-lg shadow-inner">
                            <div>
                                <h4 class="text-gray-400 text-sm uppercase">Total Pembayaran</h4>
                                <h2 class="text-3xl font-extrabold text-white" x-text="formatRupiah(totalHarga)"></h2>
                            </div>
                            <button type="submit" 
                                x-show="keranjang.length > 0" 
                                class="bg-green-500 text-white px-8 py-4 rounded-xl hover:bg-green-600 font-black text-lg transition transform hover:scale-105 shadow-lg">
                                PROSES BAYAR & CETAK (COMMIT)
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        function kasirSystem() {
            return {
                selectedProduk: '',
                qty: 1,
                keranjang: [],
                totalHarga: 0,
                
                tambahKeKeranjang() {
                    if(!this.selectedProduk) return alert('Silakan pilih produk terlebih dahulu!');
                    if(this.qty < 1) return alert('Jumlah minimal adalah 1');
                    
                    let p = JSON.parse(this.selectedProduk);
                    
                    // Cek jika produk sudah ada di keranjang, tinggal tambah qty
                    let found = this.keranjang.find(item => item.id === p.id_produk);
                    if(found) {
                        found.qty = parseInt(found.qty) + parseInt(this.qty);
                    } else {
                        this.keranjang.push({
                            id: p.id_produk,
                            nama: p.nama_produk,
                            harga: p.harga_jual,
                            qty: this.qty
                        });
                    }
                    
                    this.qty = 1;
                    this.selectedProduk = '';
                    this.hitungTotal();
                },
                
                hapusItem(index) {
                    this.keranjang.splice(index, 1);
                    this.hitungTotal();
                },
                
                hitungTotal() {
                    this.totalHarga = this.keranjang.reduce((sum, item) => sum + (item.harga * item.qty), 0);
                },
                
                formatRupiah(val) {
                    return 'Rp ' + new Intl.NumberFormat('id-ID').format(val);
                },

                submitForm(event) {
                    if (this.keranjang.length === 0) {
                        event.preventDefault();
                        alert('Keranjang masih kosong!');
                    }
                }
            }
        }
    </script>
</x-app-layout>