<section>
    <header class="mb-6">
        <h3 class="text-lg font-black text-construction-black uppercase tracking-wider italic">Keamanan Sandi</h3>
        <p class="text-sm text-slate-500">Pastikan akun Anda menggunakan kata sandi yang kuat dan aman.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div>
            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Kata Sandi Saat Ini</label>
            <input type="password" name="current_password" class="input-field py-3">
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Kata Sandi Baru</label>
            <input type="password" name="password" class="input-field py-3">
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <label class="block text-xs font-black uppercase text-slate-500 mb-1">Konfirmasi Sandi Baru</label>
            <input type="password" name="password_confirmation" class="input-field py-3">
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-slate-100">
            <button class="btn-primary py-2 px-8 text-xs tracking-widest uppercase">PERBARUI SANDI</button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                   class="text-sm font-bold text-green-600 italic">Sandi berhasil diganti.</p>
            @endif
        </div>
    </form>
</section>