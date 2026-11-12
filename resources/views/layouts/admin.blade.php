<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FAFAFB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') — IdihSebel Portfolio Studio</title>

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
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                        }
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

    @stack('styles')
</head>
<body class="h-full font-sans text-zinc-900 antialiased flex flex-col selection:bg-zinc-900 selection:text-white">

    <!-- ADMIN TOPBAR -->
    <header class="sticky top-0 z-40 bg-white border-b border-zinc-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                
                <!-- Logo & Brand -->
                <div class="flex items-center space-x-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="w-9 h-9 rounded-xl bg-zinc-950 text-white flex items-center justify-center font-bold text-sm shadow-xs group-hover:scale-105 transition-transform">
                            IS
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="font-extrabold text-base tracking-tight text-zinc-900">IdihSebel</span>
                            <span class="px-2 py-0.5 text-[10px] font-bold tracking-wider uppercase rounded-md bg-zinc-100 text-zinc-600 border border-zinc-200">Admin</span>
                        </div>
                    </a>

                    <!-- Nav Links -->
                    <nav class="hidden md:flex items-center space-x-1 text-sm font-medium text-zinc-600">
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-zinc-100 text-zinc-950 font-semibold' : 'hover:bg-zinc-50 hover:text-zinc-900' }} transition-colors">
                            Dashboard
                        </a>
                        <a href="{{ route('admin.dashboard') }}#members-section" class="px-3 py-1.5 rounded-lg hover:bg-zinc-50 hover:text-zinc-900 transition-colors">
                            Profil 6 Anggota
                        </a>
                        <a href="{{ route('admin.dashboard') }}#projects-section" class="px-3 py-1.5 rounded-lg hover:bg-zinc-50 hover:text-zinc-900 transition-colors">
                            Katalog Proyek
                        </a>
                        <a href="{{ route('admin.projects.create') }}" class="px-3 py-1.5 rounded-lg {{ request()->routeIs('admin.projects.create') ? 'bg-zinc-100 text-zinc-950 font-semibold' : 'hover:bg-zinc-50 hover:text-zinc-900' }} transition-colors">
                            + Tambah Proyek
                        </a>
                    </nav>
                </div>

                <!-- Right Side Actions & User Info -->
                <div class="flex items-center space-x-3 sm:space-x-4">
                    <!-- Link to Public Website -->
                    <a 
                        href="{{ route('portfolio.index') }}" 
                        target="_blank" 
                        class="hidden sm:inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-semibold text-zinc-600 hover:text-zinc-900 hover:bg-zinc-100 transition-colors border border-transparent hover:border-zinc-200"
                        title="Buka Website Portofolio Publik di Tab Baru"
                    >
                        <span>Lihat Web Publik</span>
                        <svg class="w-3.5 h-3.5 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>

                    <div class="h-5 w-px bg-zinc-200 hidden sm:block"></div>

                    <!-- Current Authenticated User -->
                    <div class="flex items-center space-x-3">
                        <div class="text-right hidden sm:block">
                            <div class="text-xs font-semibold text-zinc-900">{{ Auth::user()->name ?? 'Admin IdihSebel' }}</div>
                            <div class="text-[11px] text-zinc-400">{{ Auth::user()->email ?? 'admin@idihsebel.id' }}</div>
                        </div>

                        <!-- Logout Form Button -->
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button 
                                type="submit" 
                                class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-zinc-100 hover:bg-red-50 text-zinc-700 hover:text-red-600 border border-zinc-200 text-xs font-semibold transition-colors"
                                title="Keluar dari Sesi Admin"
                            >
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span>Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- FLASH MESSAGES -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
        @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                class="flex items-center justify-between p-4 mb-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-900 text-sm font-medium"
                role="alert"
            >
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-emerald-700 hover:text-emerald-900 p-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                class="flex items-center justify-between p-4 mb-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-sm font-medium"
                role="alert"
            >
                <div class="flex items-center space-x-3">
                    <svg class="w-5 h-5 text-rose-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-rose-700 hover:text-rose-900 p-1">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
        @endif

        @if (isset($errors) && $errors->any())
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                class="p-4 mb-4 rounded-xl bg-amber-50 border border-amber-200 text-amber-900 text-sm font-medium"
                role="alert"
            >
                <div class="flex items-center space-x-2 font-bold mb-2">
                    <svg class="w-5 h-5 text-amber-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <span>Terdapat beberapa kesalahan validasi input:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 text-xs text-amber-800 ml-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- MAIN BODY CONTENT -->
    <main class="flex-1 pb-16">
        @yield('content')
    </main>

    <!-- ADMIN FOOTER -->
    <footer class="bg-white border-t border-zinc-200 py-6 text-center text-xs text-zinc-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>
                &copy; {{ date('Y') }} <strong>IdihSebel</strong> — Panel Pengelolaan Portofolio & Profil (SMKN 1 Ciamis RPL)
            </div>
            <div class="text-zinc-400">
                Laravel 11 • Tailwind CSS • Secure Session Auth
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
