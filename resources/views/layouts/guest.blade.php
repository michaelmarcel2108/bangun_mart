<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BangunMart') }} - Login</title>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-construction-black">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="mb-8">
                <a href="/">
                    <div class="flex items-center gap-3">
                        <div class="bg-construction-yellow p-3 rounded-xl rotate-3 shadow-lg">
                            <x-application-logo class="w-12 h-12 fill-current text-construction-black" />
                        </div>
                        <h1 class="text-4xl font-extrabold text-white tracking-tighter">
                            BANGUN<span class="text-construction-yellow">MART</span>
                        </h1>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border-t-8 border-construction-yellow">
                {{ $slot }}
            </div>

            <p class="mt-8 text-slate-500 text-sm">
                &copy; {{ date('Y') }} BangunMart System. Professional Construction Supply.
            </p>
        </div>
    </body>
</html>