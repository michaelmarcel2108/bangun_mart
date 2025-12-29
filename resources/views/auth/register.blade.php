<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800 uppercase tracking-tighter">Registrasi <span class="text-construction-yellow">Pegawai</span></h2>
        <p class="text-slate-500 text-sm">Daftarkan personel baru ke dalam sistem BangunMart.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Nama Lengkap</label>
            <input type="text" name="nama_pegawai" value="{{ old('nama_pegawai') }}" required autofocus class="input-field py-3 font-bold">
            <x-input-error :messages="$errors->get('nama_pegawai')" class="mt-1" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-1">Jabatan</label>
                <select name="jabatan" required class="input-field py-3 font-bold text-xs uppercase">
                    <option value="kasir">Kasir</option>
                    <option value="gudang">Gudang</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-black uppercase text-slate-500 mb-1">Shift Kerja</label>
                <select name="shift" required class="input-field py-3 font-bold text-xs uppercase">
                    <option value="pagi">Pagi</option>
                    <option value="siang">Siang</option>
                    <option value="malam">Malam</option>
                </select>
            </div>
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Password</label>
            <input type="password" name="password" required autocomplete="new-password" class="input-field py-3">
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" required class="input-field py-3">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="pt-4 flex flex-col gap-4 items-center">
            <button class="w-full btn-primary py-4 text-xs tracking-widest uppercase shadow-xl">
                DAFTARKAN PEGAWAI
            </button>
            <a class="text-sm text-slate-600 hover:text-construction-black font-bold" href="{{ route('login') }}">
                Sudah punya akun? Login di sini
            </a>
        </div>
    </form>
</x-guest-layout>