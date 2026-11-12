@extends('layouts.admin')

@section('title', 'Akun Pengelola Admin — IdihSebel')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-8">

    <!-- BREADCRUMBS & TOP HEADER -->
    <div class="space-y-3 pb-6 border-b border-studio-200">
        <div class="flex items-center space-x-2 text-xs font-mono text-studio-400">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-studio-900 transition-colors">Console</a>
            <span>/</span>
            <span class="text-studio-950 font-semibold">Pengaturan Akun Admin</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-studio-950">
                    Pengaturan Akun Pengelola (Admin)
                </h1>
                <p class="text-xs text-studio-500 mt-1 font-mono">
                    Ubah data nama, alamat email login, serta kata sandi akun admin IdihSebel.
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center space-x-1.5 px-3 py-1 rounded-full text-xs font-mono bg-emerald-50 text-emerald-700 border border-emerald-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span>Basis Data: MySQL (`idihsebel`)</span>
                </span>
            </div>
        </div>
    </div>

    <!-- MAIN FORM (SETTINGS TWO-COLUMN GRID) -->
    <form 
        action="{{ route('admin.profile.update') }}" 
        method="POST" 
        class="space-y-10"
    >
        @csrf
        @method('PUT')

        <!-- SECTION 1: IDENTITAS & EMAIL LOGIN -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-studio-950">Kredensial & Identitas</h2>
                <p class="text-xs text-studio-500 leading-relaxed">
                    Alamat email ini digunakan untuk masuk (*login*) ke portal `/loginadmin`. Perubahan akan langsung disimpan ke database MySQL.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-xl border border-studio-200 p-6 space-y-5 shadow-2xs">
                
                <!-- Admin Name -->
                <div class="space-y-1.5">
                    <label for="name" class="block text-xs font-semibold text-studio-700">
                        Nama Pengelola / Admin <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        value="{{ old('name', $admin->name) }}" 
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-studio-200 bg-white text-studio-900 text-xs focus:outline-none focus:border-studio-950 focus:ring-3 focus:ring-studio-950/5 font-medium transition-all"
                    >
                </div>

                <!-- Admin Email -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-semibold text-studio-700">
                        Alamat Email Login <span class="text-rose-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $admin->email) }}" 
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-studio-200 bg-white text-studio-900 text-xs focus:outline-none focus:border-studio-950 focus:ring-3 focus:ring-studio-950/5 font-mono transition-all"
                    >
                    <p class="text-[11px] text-studio-400">
                        Gunakan email ini saat masuk di halaman <code class="text-studio-600 bg-studio-100 px-1 py-0.5 rounded">/loginadmin</code>.
                    </p>
                </div>

            </div>
        </div>

        <div class="border-t border-studio-200"></div>

        <!-- SECTION 2: GANTI KATA SANDI -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-studio-950">Keamanan & Kata Sandi</h2>
                <p class="text-xs text-studio-500 leading-relaxed">
                    Kosongkan kolom ini jika Anda tidak bermaksud mengubah kata sandi akun admin saat ini.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-xl border border-studio-200 p-6 space-y-5 shadow-2xs">
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- New Password -->
                    <div class="space-y-1.5">
                        <label for="password" class="block text-xs font-semibold text-studio-700">
                            Kata Sandi Baru (Opsional)
                        </label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            autocomplete="new-password"
                            placeholder="Minimal 6 karakter"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-studio-200 bg-white text-studio-900 text-xs focus:outline-none focus:border-studio-950 focus:ring-3 focus:ring-studio-950/5 transition-all font-mono"
                        >
                    </div>

                    <!-- Password Confirmation -->
                    <div class="space-y-1.5">
                        <label for="password_confirmation" class="block text-xs font-semibold text-studio-700">
                            Konfirmasi Kata Sandi Baru
                        </label>
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            id="password_confirmation" 
                            autocomplete="new-password"
                            placeholder="Ketik ulang kata sandi baru"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-studio-200 bg-white text-studio-900 text-xs focus:outline-none focus:border-studio-950 focus:ring-3 focus:ring-studio-950/5 transition-all font-mono"
                        >
                    </div>
                </div>

                <div class="p-3 bg-studio-50 rounded-xl border border-studio-200/80 text-[11px] text-studio-600 flex items-start space-x-2">
                    <svg class="w-4 h-4 text-studio-400 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <span>
                        Kata sandi default seeder adalah <code class="font-mono font-semibold text-studio-800">admin123</code>. Jika Anda mengganti kata sandi di sini, gunakan kata sandi baru tersebut untuk login berikutnya.
                    </span>
                </div>

            </div>
        </div>

        <!-- STICKY ACTION BAR -->
        <div class="sticky bottom-4 z-20 p-3.5 rounded-xl bg-white/95 backdrop-blur-md border border-studio-200 shadow-md flex items-center justify-between">
            <a 
                href="{{ route('admin.dashboard') }}" 
                class="px-3.5 py-1.5 rounded-lg border border-studio-200 text-studio-600 hover:text-studio-950 hover:bg-studio-100 text-xs font-medium transition-colors"
            >
                Kembali ke Dashboard
            </a>

            <button 
                type="submit" 
                class="py-1.5 px-4 rounded-lg bg-studio-950 hover:bg-studio-900 text-white font-semibold text-xs tracking-tight shadow-xs transition-colors flex items-center space-x-1.5 cursor-pointer"
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

