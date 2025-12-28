<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                {{-- Form Error Handling --}}
                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Barcode --}}
                        <div>
                            <x-input-label for="barcode" :value="__('Barcode / Kode Barang')" />
                            <x-text-input id="barcode" class="block mt-1 w-full" type="text" name="barcode" :value="old('barcode')" required autofocus />
                        </div>

                        {{-- Nama Produk --}}
                        <div>
                            <x-input-label for="nama_produk" :value="__('Nama Produk (Contoh: Semen Gresik 50kg)')" />
                            <x-text-input id="nama_produk" class="block mt-1 w-full" type="text" name="nama_produk" :value="old('nama_produk')" required />
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <x-input-label for="id_kategori" :value="__('Kategori')" />
                            <select name="id_kategori" id="id_kategori" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Satuan --}}
                        <div>
                            <x-input-label for="id_satuan" :value="__('Satuan')" />
                            <select name="id_satuan" id="id_satuan" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Satuan --</option>
                                @foreach($satuan as $s)
                                    <option value="{{ $s->id_satuan }}">{{ $s->nama_satuan }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Harga Jual --}}
                        <div>
                            <x-input-label for="harga_jual" :value="__('Harga Jual (Rp)')" />
                            <x-text-input id="harga_jual" class="block mt-1 w-full" type="number" name="harga_jual" :value="old('harga_jual')" required />
                        </div>

                        {{-- Stok --}}
                        <div>
                            <x-input-label for="stok" :value="__('Stok Awal')" />
                            <x-text-input id="stok" class="block mt-1 w-full" type="number" name="stok" :value="old('stok')" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('produk.index') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                        <x-primary-button>
                            {{ __('Simpan Produk') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>