<section>
    <header class="mb-6">
        <h3 class="text-lg font-black text-construction-black uppercase tracking-wider italic">Informasi Personel</h3>
        <p class="text-sm text-slate-500">Perbarui identitas resmi Anda dalam sistem.</p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div>
            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Nama Lengkap Pegawai</label>
            <input type="text" name="nama_pegawai" value="{{ old('nama_pegawai', $user->nama_pegawai) }}" required autofocus
                   class="input-field py-3 font-bold text-slate-800">
            <x-input-error class="mt-2" :messages="$errors->get('nama_pegawai')" />
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400">Jabatan Saat Ini</label>
                <p class="font-black text-construction-black uppercase italic">{{ $user->jabatan }}</p>
            </div>
            <div>
                <label class="block text-[10px] font-black uppercase text-slate-400">Shift Kerja</label>
                <p class="font-black text-construction-black uppercase italic">{{ $user->shift }}</p>
            </div>
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button class="btn-primary py-2 px-8 text-xs tracking-widest uppercase">SIMPAN PERUBAHAN</button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-bold text-green-600">Berhasil diperbarui.</p>
            @endif
        </div>
    </form>
</section>