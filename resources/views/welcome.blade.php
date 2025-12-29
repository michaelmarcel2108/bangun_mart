<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BangunMart - Solusi Konstruksi Profesional</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .bg-pattern {
                background-color: #0F172A;
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FACC15' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="antialiased font-sans bg-pattern">
        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-construction-yellow selection:text-construction-black">
            
            <div class="absolute top-0 left-0 w-full h-4 bg-construction-yellow shadow-lg"></div>
            <div class="absolute bottom-0 left-0 w-full h-4 bg-construction-yellow shadow-lg"></div>

            <div class="max-w-7xl mx-auto px-6 py-12 text-center">
                <div class="mb-12 flex flex-col items-center animate-fade-in-down">
                    <div class="bg-construction-yellow p-4 rounded-2xl shadow-2xl rotate-3 mb-6">
                        <x-application-logo class="w-16 h-16 fill-current text-construction-black" />
                    </div>
                    <h1 class="text-6xl md:text-8xl font-black text-white tracking-tighter leading-none uppercase">
                        BANGUN<span class="text-construction-yellow italic">MART</span>
                    </h1>
                    <div class="mt-4 flex items-center gap-4">
                        <span class="h-1 w-12 bg-construction-yellow"></span>
                        <p class="text-slate-400 font-bold uppercase tracking-[0.4em] text-xs md:text-sm">Industrial Supply Management</p>
                        <span class="h-1 w-12 bg-construction-yellow"></span>
                    </div>
                </div>

                <div class="max-w-2xl mx-auto mb-16">
                    <p class="text-lg md:text-xl text-slate-300 font-medium leading-relaxed">
                        Sistem manajemen stok dan transaksi terintegrasi untuk efisiensi bisnis bahan bangunan Anda. 
                        <span class="text-construction-yellow font-black">Cepat. Tangguh. Presisi.</span>
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn-primary px-12 py-5 text-lg tracking-widest uppercase">
                                KE DASHBOARD UTAMA
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-primary px-12 py-5 text-lg tracking-widest uppercase shadow-yellow-500/20 shadow-2xl">
                                MASUK KE SISTEM
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white hover:text-construction-yellow font-black text-sm uppercase tracking-widest transition-colors border-b-2 border-transparent hover:border-construction-yellow pb-1">
                                    Registrasi Pegawai
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>

                <div class="mt-24 grid grid-cols-2 md:grid-cols-4 gap-8 border-t border-slate-800 pt-12">
                    <div class="text-center">
                        <div class="text-construction-yellow text-2xl font-black">10+</div>
                        <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Tabel SQL</div>
                    </div>
                    <div class="text-center">
                        <div class="text-construction-yellow text-2xl font-black">2+</div>
                        <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Akses Role</div>
                    </div>
                    <div class="text-center">
                        <div class="text-construction-yellow text-2xl font-black">TCL</div>
                        <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Commit Active</div>
                    </div>
                    <div class="text-center">
                        <div class="text-construction-yellow text-2xl font-black">JOIN</div>
                        <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest">Optimization</div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-slate-600 text-[10px] font-bold uppercase tracking-widest">
                Developed by Michael for UAS Project &bull; Version 2.0.0
            </div>
        </div>
    </body>
</html>