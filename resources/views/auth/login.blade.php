<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-slate-800">Selamat Datang</h2>
        <p class="text-slate-500">Silakan masuk untuk mengelola stok dan transaksi.</p>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <label for="nama_pegawai" class="block font-semibold text-sm text-slate-700 mb-1">Nama Pegawai</label>
            <input id="nama_pegawai" class="input-field block mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-construction-yellow focus:ring focus:ring-yellow-200" 
                   type="text" name="nama_pegawai" :value="old('nama_pegawai')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nama_pegawai')" class="mt-2" />
        </div>

        <div class="mt-4">
            <label for="password" class="block font-semibold text-sm text-slate-700 mb-1">Password</label>
            <input id="password" class="input-field block mt-1 w-full border-slate-300 rounded-lg shadow-sm focus:border-construction-yellow focus:ring focus:ring-yellow-200"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-slate-300 text-construction-yellow shadow-sm focus:ring-construction-yellow" name="remember">
                <span class="ms-2 text-sm text-slate-600">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="flex flex-col gap-4 items-center justify-end mt-8">
            <button class="w-full btn-primary bg-construction-yellow hover:bg-yellow-500 text-construction-black font-bold py-3 rounded-xl transition-all shadow-md active:translate-y-1">
                MASUK KE SISTEM
            </button>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-slate-600 hover:text-construction-black rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-construction-yellow" href="{{ route('password.request') }}">
                    {{ __('Lupa password?') }}
                </a>
            @endif
        </div>
    </form>
</x-guest-layout>