@extends('layouts.admin')

@section('title', 'Profil Admin')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-8">

    <!-- HEADER -->
    <div class="space-y-3 pb-6 border-b border-brand-200/80">
        <div class="flex items-center space-x-2 text-xs font-medium text-brand-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-900 transition-colors">IdihSebel</a>
            <span>/</span>
            <span class="text-brand-950 font-semibold">Profil Admin</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-brand-950">
                    Pengaturan Akun Admin
                </h1>
                <p class="text-xs sm:text-sm text-brand-500 mt-1">
                    Kelola nama pengelola, alamat email login, serta kata sandi akun admin.
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Tersimpan di MySQL</span>
                </span>
            </div>
        </div>
    </div>

    <!-- MAIN FORM -->
    <form 
        action="{{ route('admin.profile.update') }}" 
        method="POST" 
        class="space-y-8"
    >
        @csrf
        @method('PUT')

        <!-- SECTION 1: IDENTITAS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Informasi Akun</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Nama dan email yang digunakan untuk masuk ke halaman login admin.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-5 shadow-2xs">
                
                <!-- Admin Name -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-semibold text-brand-700">
                        Nama Pengelola <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $admin->name) }}" 
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 bg-white text-brand-900 text-xs focus:outline-none focus:border-brand-950 focus:ring-3 focus:ring-brand-950/5 font-medium transition-all"
                    >
                </div>

                <!-- Admin Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-semibold text-brand-700">
                        Alamat Email Login <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $admin->email) }}" 
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 bg-white text-brand-900 text-xs focus:outline-none focus:border-brand-950 focus:ring-3 focus:ring-brand-950/5 transition-all"
                    >
                    <p class="text-[11px] text-brand-400">
                        Email ini digunakan saat masuk di halaman login admin.
                    </p>
                </div>

            </div>
        </div>

        <div class="border-t border-brand-200/80"></div>

        <!-- SECTION 2: GANTI KATA SANDI -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Ganti Kata Sandi</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Biarkan kolom di samping kosong jika Anda tidak ingin mengganti kata sandi saat ini.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-5 shadow-2xs">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- New Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-semibold text-brand-700">
                            Kata Sandi Baru (Opsional)
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            autocomplete="new-password"
                            placeholder="Minimal 6 karakter"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 bg-white text-brand-900 text-xs focus:outline-none focus:border-brand-950 focus:ring-3 focus:ring-brand-950/5 transition-all"
                        >
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-xs font-semibold text-brand-700">
                            Konfirmasi Kata Sandi Baru
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            autocomplete="new-password"
                            placeholder="Ketik ulang kata sandi baru"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 bg-white text-brand-900 text-xs focus:outline-none focus:border-brand-950 focus:ring-3 focus:ring-brand-950/5 transition-all"
                        >
                    </div>
                </div>

                <div class="p-3 bg-brand-50 rounded-xl border border-brand-200/60 text-xs text-brand-600 flex items-start space-x-2">
                    <svg class="w-4 h-4 text-brand-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <span>
                        Kata sandi bawaan awal adalah <strong class="text-brand-800">admin123</strong>. Jika diganti, gunakan kata sandi baru untuk login berikutnya.
                    </span>
                </div>

            </div>
        </div>

        <!-- ACTION BAR -->
        <div class="sticky bottom-4 z-20 p-3.5 rounded-2xl bg-white/95 backdrop-blur-md border border-brand-200 shadow-md flex items-center justify-between">
            <a 
                href="{{ route('admin.dashboard') }}" 
                class="px-4 py-2 rounded-xl border border-brand-200 text-brand-600 hover:text-brand-950 hover:bg-brand-50 text-xs font-medium transition-colors"
            >
                Kembali
            </a>

            <button 
                type="submit" 
                class="py-2 px-5 rounded-xl bg-brand-950 hover:bg-brand-900 text-white font-semibold text-xs tracking-tight shadow-xs transition-colors flex items-center space-x-1.5 cursor-pointer"
            >
                <svg class="w-3.5 h-3.5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Simpan Perubahan Akun</span>
            </button>
        </div>

    </form>

</div>
@endsection
