<x-app-layout>
    <x-slot name="header">
        <h2 class="text-3xl font-black text-construction-black leading-tight uppercase tracking-tighter">
            PENGATURAN <span class="text-construction-yellow">AKUN</span>
        </h2>
        <p class="text-slate-500 text-sm font-medium mt-1">Kelola informasi personel dan keamanan akses sistem.</p>
    </x-slot>

    <div class="space-y-8 max-w-4xl">
        <div class="card-base p-8 border-t-8 border-construction-yellow">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card-base p-8 border-t-8 border-construction-black">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card-base p-8 border-t-8 border-red-600 bg-red-50/30">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>