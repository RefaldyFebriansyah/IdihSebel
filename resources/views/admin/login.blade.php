<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FAFAFB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk Admin — IdihSebel Portfolio Studio</title>

    <!-- Google Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Play CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', '-apple-system', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-feature-settings: "cv02", "cv03", "cv04", "cv11"; }
    </style>
</head>
<body class="h-full font-sans text-zinc-900 antialiased flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 selection:bg-zinc-900 selection:text-white">

    <div class="w-full max-w-md space-y-8 my-auto py-12">
        
        <!-- Header Branding -->
        <div class="text-center space-y-3">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center space-x-3 group">
                <div class="w-12 h-12 rounded-2xl bg-zinc-950 text-white flex items-center justify-center font-bold text-lg shadow-sm group-hover:scale-105 transition-transform">
                    IS
                </div>
                <div class="text-left">
                    <span class="block font-extrabold text-xl tracking-tight text-zinc-900">IdihSebel</span>
                    <span class="block text-xs text-zinc-500 font-medium">Panel Masuk Admin</span>
                </div>
            </a>
            <h1 class="text-2xl font-extrabold tracking-tight text-zinc-900 pt-3">
                Masuk ke Dashboard Admin
            </h1>
            <p class="text-sm text-zinc-500 max-w-sm mx-auto">
                Kelola profil 6 anggota tim SMKN 1 Ciamis RPL, perbarui foto, keahlian, dan portofolio proyek.
            </p>
        </div>

        <!-- Card Container -->
        <div class="bg-white rounded-3xl border border-zinc-200 shadow-[0_4px_24px_rgba(0,0,0,0.04)] p-8 sm:p-10 space-y-6">

            <!-- Flash Error Message -->
            @if (isset($errors) && $errors->any())
                <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-sm font-medium space-y-1">
                    <div class="flex items-center space-x-2 font-semibold">
                        <svg class="w-4 h-4 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>Gagal Masuk</span>
                    </div>
                    <ul class="list-disc list-inside text-xs text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- 1-Click Auto-Fill Demo Helper -->
            <div class="p-3.5 bg-zinc-50 rounded-2xl border border-zinc-200/80 flex items-center justify-between gap-3 text-xs">
                <div class="space-y-0.5">
                    <div class="font-bold text-zinc-800">Akun Admin Default</div>
                    <div class="text-zinc-500 font-mono text-[11px]">admin@idihsebel.id &bull; admin123</div>
                </div>
                <button 
                    type="button" 
                    id="btn-autofill"
                    class="px-3 py-1.5 rounded-lg bg-white border border-zinc-200 hover:border-zinc-300 hover:bg-zinc-100 text-zinc-800 font-semibold text-xs shadow-2xs transition-all active:scale-95"
                >
                    Isi Otomatis
                </button>
            </div>

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Alamat Email Admin
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', 'admin@idihsebel.id') }}" 
                        required 
                        autocomplete="email"
                        class="w-full px-4 py-3 rounded-xl border border-zinc-200 bg-white text-zinc-900 text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all font-medium"
                        placeholder="admin@idihsebel.id"
                    >
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                            Kata Sandi
                        </label>
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        value="admin123"
                        required 
                        autocomplete="current-password"
                        class="w-full px-4 py-3 rounded-xl border border-zinc-200 bg-white text-zinc-900 text-sm placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-zinc-900 focus:border-zinc-900 transition-all font-medium"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center space-x-2 cursor-pointer select-none">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            checked
                            class="w-4 h-4 rounded text-zinc-900 border-zinc-300 focus:ring-zinc-900"
                        >
                        <span class="text-zinc-600 font-medium">Ingat Sesi Masuk Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-4 rounded-xl bg-zinc-950 hover:bg-zinc-800 text-white font-bold text-sm tracking-tight shadow-md hover:shadow-lg transition-all active:scale-[0.99] flex items-center justify-center space-x-2"
                >
                    <span>Masuk ke Dashboard</span>
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

        </div>

        <!-- Back to Website Link -->
        <div class="text-center">
            <a 
                href="{{ route('portfolio.index') }}" 
                class="inline-flex items-center space-x-1.5 text-xs font-medium text-zinc-500 hover:text-zinc-900 transition-colors"
            >
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Kembali ke Website Portofolio Publik</span>
            </a>
        </div>

    </div>

    <script>
        document.getElementById('btn-autofill')?.addEventListener('click', function() {
            document.getElementById('email').value = 'admin@idihsebel.id';
            document.getElementById('password').value = 'admin123';
        });
    </script>
</body>
</html>
