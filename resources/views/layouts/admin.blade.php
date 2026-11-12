<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F8F9FA]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Console') — IdihSebel Studio</title>

    <!-- Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Play CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                    },
                    colors: {
                        studio: {
                            50: '#fafafa',
                            100: '#f4f4f5',
                            200: '#e4e4e7',
                            300: '#d4d4d8',
                            400: '#a1a1aa',
                            500: '#71717a',
                            600: '#52525b',
                            700: '#3f3f46',
                            800: '#27272a',
                            900: '#18181b',
                            950: '#09090b',
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
        body { 
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
            letter-spacing: -0.012em;
        }
    </style>

    @stack('styles')
</head>
<body class="h-full font-sans text-studio-900 bg-[#F8F9FA] antialiased flex flex-col selection:bg-studio-950 selection:text-white">

    <!-- CONSOLE HEADER (LINEAR / VERCEL STYLE APP SHELL) -->
    <header class="sticky top-0 z-40 bg-white border-b border-studio-200">
        
        <!-- Primary App Bar -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">
                
                <!-- Brand & Workspace Path -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2.5">
                        <div class="w-7 h-7 rounded-lg bg-studio-950 text-white flex items-center justify-center font-bold text-xs font-mono tracking-tight shadow-xs">
                            IS
                        </div>
                        <span class="font-bold text-sm tracking-tight text-studio-950">IdihSebel</span>
                    </a>
                    
                    <span class="text-studio-300 font-mono text-sm">/</span>
                    
                    <div class="flex items-center space-x-2">
                        <span class="text-xs font-semibold text-studio-600">Console</span>
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-mono font-medium bg-studio-100 text-studio-600 border border-studio-200">
                            Studio v1.0
                        </span>
                    </div>
                </div>

                <!-- Right Actions -->
                <div class="flex items-center space-x-2 sm:space-x-3">
                    <!-- Live Web Preview Link -->
                    <a 
                        href="{{ route('portfolio.index') }}" 
                        target="_blank" 
                        class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-studio-600 hover:text-studio-950 hover:bg-studio-100 border border-studio-200 transition-colors"
                        title="Buka Website Portofolio Publik"
                    >
                        <span>Web Publik</span>
                        <svg class="w-3.5 h-3.5 text-studio-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>

                    <div class="h-4 w-px bg-studio-200 hidden sm:block"></div>

                    <!-- User Account & Session -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('admin.profile') }}" class="text-right hidden md:block hover:opacity-80 transition-opacity" title="Kelola Kredensial & Profil Admin">
                            <div class="text-xs font-semibold text-studio-900 leading-tight">{{ Auth::user()->name ?? 'Admin IdihSebel' }}</div>
                            <div class="text-[11px] font-mono text-studio-400 leading-tight">{{ Auth::user()->email ?? 'admin@idihsebel.id' }}</div>
                        </a>

                        <!-- Logout Button -->
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button 
                                type="submit" 
                                class="inline-flex items-center space-x-1 px-2.5 py-1.5 rounded-lg text-xs font-medium text-studio-600 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-200 transition-colors"
                                title="Keluar dari sesi admin"
                            >
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="hidden sm:inline">Keluar</span>
                            </button>
                        </form>
                    </div>

                </div>

            </div>
        </div>

        <!-- Secondary Navigation Tab Bar (Clean Studio Tabs) -->
        <div class="border-t border-studio-100 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex space-x-6 text-xs font-medium overflow-x-auto scrollbar-none" aria-label="Tabs">
                    <a 
                        href="{{ route('admin.dashboard') }}" 
                        class="py-3 px-1 border-b-2 {{ request()->routeIs('admin.dashboard') ? 'border-studio-950 text-studio-950 font-semibold' : 'border-transparent text-studio-500 hover:text-studio-900 hover:border-studio-300' }} transition-colors whitespace-nowrap"
                    >
                        Ringkasan Dashboard
                    </a>
                    <a 
                        href="{{ route('admin.dashboard') }}#members-section" 
                        class="py-3 px-1 border-b-2 border-transparent text-studio-500 hover:text-studio-900 hover:border-studio-300 transition-colors whitespace-nowrap"
                    >
                        6 Anggota Tim
                    </a>
                    <a 
                        href="{{ route('admin.dashboard') }}#projects-section" 
                        class="py-3 px-1 border-b-2 border-transparent text-studio-500 hover:text-studio-900 hover:border-studio-300 transition-colors whitespace-nowrap"
                    >
                        Portofolio Proyek
                    </a>
                    <a 
                        href="{{ route('admin.projects.create') }}" 
                        class="py-3 px-1 border-b-2 {{ request()->routeIs('admin.projects.create') ? 'border-studio-950 text-studio-950 font-semibold' : 'border-transparent text-studio-500 hover:text-studio-900 hover:border-studio-300' }} transition-colors whitespace-nowrap flex items-center space-x-1"
                    >
                        <svg class="w-3 h-3 text-studio-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Tambah Proyek</span>
                    </a>
                    <a 
                        href="{{ route('admin.profile') }}" 
                        class="py-3 px-1 border-b-2 {{ request()->routeIs('admin.profile') ? 'border-studio-950 text-studio-950 font-semibold' : 'border-transparent text-studio-500 hover:text-studio-900 hover:border-studio-300' }} transition-colors whitespace-nowrap"
                    >
                        Akun Pengelola
                    </a>
                </nav>
            </div>
        </div>

    </header>

    <!-- NOTIFICATION SYSTEM -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 w-full">
        @if (session('success'))
            <div 
                x-data="{ show: true }" 
                x-show="show" 
                class="flex items-center justify-between p-3.5 mb-2 rounded-lg bg-white border border-emerald-200 text-studio-900 text-xs shadow-xs"
                role="alert"
            >
                <div class="flex items-center space-x-2.5">
                    <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-200">
                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span class="font-medium text-studio-800">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="text-studio-400 hover:text-studio-700 p-1">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                class="flex items-center justify-between p-3.5 mb-2 rounded-lg bg-white border border-rose-200 text-studio-900 text-xs shadow-xs"
                role="alert"
            >
                <div class="flex items-center space-x-2.5">
                    <div class="w-5 h-5 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 border border-rose-200">
                        <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </div>
                    <span class="font-medium text-studio-800">{{ session('error') }}</span>
                </div>
                <button @click="show = false" class="text-studio-400 hover:text-studio-700 p-1">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                class="p-4 mb-2 rounded-lg bg-white border border-amber-300 text-studio-900 text-xs shadow-xs space-y-1.5"
                role="alert"
            >
                <div class="flex items-center space-x-2 font-semibold text-amber-800">
                    <svg class="w-4 h-4 text-amber-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>Periksa kesalahan input berikut:</span>
                </div>
                <ul class="list-disc list-inside space-y-0.5 text-studio-600 ml-4 font-mono text-[11px]">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- MAIN CONSOLE WORKSPACE -->
    <main class="flex-1 pb-20">
        @yield('content')
    </main>

    <!-- MINIMAL CONSOLE FOOTER -->
    <footer class="bg-white border-t border-studio-200 py-5 text-xs text-studio-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
            <div class="flex items-center space-x-2">
                <span class="font-bold text-studio-900">IdihSebel</span>
                <span class="text-studio-300">•</span>
                <span>Software & Design Studio (SMKN 1 Ciamis RPL)</span>
            </div>
            <div class="font-mono text-[11px] text-studio-400">
                Studio Console • PHP {{ PHP_VERSION }} • Laravel 11
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
