<nav x-data="{ open: false }" class="bg-white border-b-4 border-construction-yellow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <div class="bg-construction-black p-2 rounded-lg rotate-2">
                            <x-application-logo class="block h-6 w-auto fill-current text-construction-yellow" />
                        </div>
                        <span class="text-xl font-black tracking-tighter text-construction-black">BANGUN<span class="text-yellow-500">MART</span></span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-xs font-black uppercase tracking-widest">
                        {{ __('Overview') }}
                    </x-nav-link>

                    @if(Auth::user()->jabatan == 'admin')
                        <x-nav-link :href="route('produk.index')" :active="request()->routeIs('produk.*')" class="text-xs font-black uppercase tracking-widest">
                            {{ __('Gudang') }}
                        </x-nav-link>
                        <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')" class="text-xs font-black uppercase tracking-widest">
                            {{ __('Laporan') }}
                        </x-nav-link>
                    @endif

                    @if(Auth::user()->jabatan == 'kasir' || Auth::user()->jabatan == 'admin')
                        <x-nav-link :href="route('penjualan.index')" :active="request()->routeIs('penjualan.*')" class="text-xs font-black uppercase tracking-widest">
                            {{ __('Kasir') }}
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="flex flex-col items-end mr-4">
                    <span class="text-sm font-black text-construction-black uppercase leading-none">{{ Auth::user()->nama_pegawai }}</span>
                    <span class="text-[10px] font-bold px-2 py-0.5 mt-1 rounded bg-construction-yellow text-construction-black uppercase">
                        {{ Auth::user()->jabatan }}
                    </span>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex text-sm border-2 border-construction-black rounded-full focus:outline-none transition">
                            <img class="h-10 w-10 rounded-full object-cover" src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nama_pegawai) }}&background=0F172A&color=FACC15&bold=true" alt="Avatar">
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="font-bold text-xs uppercase tracking-wider">
                            {{ __('Profile Saya') }}
                        </x-dropdown-link>
                        <div class="border-t border-slate-100"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-red-600 font-black text-xs uppercase tracking-wider">
                                {{ __('Keluar Sistem') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>