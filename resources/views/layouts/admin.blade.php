<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F8F9FA] scroll-smooth">
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
        .scrollbar-none::-webkit-scrollbar { display: none; }
        .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    @stack('styles')
</head>
<body 
    x-data="{ sidebarOpen: false }" 
    class="h-full font-sans text-studio-900 bg-[#F8F9FA] antialiased flex flex-col selection:bg-studio-950 selection:text-white"
>

    <!-- MOBILE SIDEBAR BACKDROP OVERLAY -->
    <div 
        x-show="sidebarOpen" 
        x-cloak 
        @click="sidebarOpen = false" 
        class="fixed inset-0 z-40 bg-studio-950/40 backdrop-blur-xs lg:hidden transition-opacity"
        aria-hidden="true"
    ></div>

    <!-- =========================================================================
         MODERN FIXED LEFT SIDEBAR NAVIGATION
         ========================================================================= -->
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-studio-200 flex flex-col justify-between transition-transform duration-250 ease-in-out shadow-xs lg:shadow-none"
    >
        <!-- Top Half: Branding, DB Status & Nav Links -->
        <div class="flex flex-col h-full overflow-y-auto scrollbar-none">
            
            <!-- Sidebar Header: Brand & Environment -->
            <div class="p-4 border-b border-studio-100 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-9 h-9 rounded-xl bg-studio-950 text-white flex items-center justify-center font-mono font-bold text-xs shadow-xs ring-1 ring-studio-800 group-hover:scale-105 transition-transform">
                        IS
                    </div>
                    <div>
                        <div class="font-bold text-sm tracking-tight text-studio-950 leading-tight flex items-center space-x-1.5">
                            <span>IdihSebel</span>
                            <span class="text-[9px] font-mono font-semibold px-1.5 py-0.2 rounded bg-studio-100 text-studio-600 border border-studio-200">ADMIN</span>
                        </div>
                        <div class="text-[11px] font-mono text-studio-400 leading-tight mt-0.5">Studio Console</div>
                    </div>
                </a>

                <!-- Close Button on Mobile -->
                <button 
                    @click="sidebarOpen = false" 
                    class="lg:hidden p-1.5 rounded-lg text-studio-400 hover:text-studio-700 hover:bg-studio-100 transition-colors"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Database Status Indicator -->
            <div class="px-4 py-2 bg-studio-50/80 border-b border-studio-100 flex items-center justify-between text-[11px] font-mono text-studio-600">
                <div class="flex items-center space-x-2">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                    </span>
                    <span class="font-semibold text-studio-700">MySQL: idihsebel</span>
                </div>
                <span class="text-studio-400 text-[10px]">127.0.0.1</span>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3.5 space-y-6 flex-1 text-xs font-medium">
                
                <!-- Section 1: Dashboard -->
                <div class="space-y-1">
                    <div class="px-2 pb-1.5 text-[10px] font-mono font-semibold uppercase tracking-wider text-studio-400">
                        Menu Utama
                    </div>
                    <a 
                        href="{{ route('admin.dashboard') }}" 
                        @click="if(window.location.pathname === '{{ route('admin.dashboard', [], false) }}') { window.scrollTo({ top: 0, behavior: 'smooth' }); sidebarOpen = false; }"
                        class="flex items-center space-x-2.5 px-3 py-2 rounded-xl transition-all {{ request()->routeIs('admin.dashboard') && !request()->routeIs('admin.members.*') && !request()->routeIs('admin.projects.*') ? 'bg-studio-950 text-white font-semibold shadow-xs' : 'text-studio-600 hover:bg-studio-100 hover:text-studio-950' }}"
                    >
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                        <span>Dashboard Overview</span>
                    </a>
                </div>

                <!-- Section 2: Tim & Anggota -->
                <div class="space-y-1">
                    <div class="px-2 pb-1.5 text-[10px] font-mono font-semibold uppercase tracking-wider text-studio-400">
                        Kolektif Studio
                    </div>
                    <a 
                        href="{{ route('admin.dashboard') }}#members-section" 
                        @click="sidebarOpen = false"
                        class="flex items-center justify-between px-3 py-2 rounded-xl transition-all {{ request()->routeIs('admin.members.*') ? 'bg-studio-950 text-white font-semibold shadow-xs' : 'text-studio-600 hover:bg-studio-100 hover:text-studio-950' }}"
                    >
                        <div class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-studio-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>6 Anggota Tim RPL</span>
                        </div>
                        <span class="px-1.5 py-0.2 rounded font-mono text-[10px] font-bold {{ request()->routeIs('admin.members.*') ? 'bg-studio-800 text-white' : 'bg-studio-100 text-studio-600 border border-studio-200' }}">
                            6
                        </span>
                    </a>
                </div>

                <!-- Section 3: Portofolio Proyek -->
                <div class="space-y-1">
                    <div class="px-2 pb-1.5 text-[10px] font-mono font-semibold uppercase tracking-wider text-studio-400">
                        Portofolio & Karya
                    </div>
                    <a 
                        href="{{ route('admin.dashboard') }}#projects-section" 
                        @click="sidebarOpen = false"
                        class="flex items-center justify-between px-3 py-2 rounded-xl transition-all {{ request()->routeIs('admin.projects.edit') ? 'bg-studio-950 text-white font-semibold shadow-xs' : 'text-studio-600 hover:bg-studio-100 hover:text-studio-950' }}"
                    >
                        <div class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-studio-500 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                            <span>Katalog Proyek</span>
                        </div>
                        <span class="px-1.5 py-0.2 rounded font-mono text-[10px] font-bold bg-studio-100 text-studio-600 border border-studio-200">
                            {{ rescue(fn() => \App\Models\Project::count(), 4) }}
                        </span>
                    </a>
                    <a 
                        href="{{ route('admin.projects.create') }}" 
                        @click="sidebarOpen = false"
                        class="flex items-center space-x-2.5 px-3 py-2 rounded-xl transition-all {{ request()->routeIs('admin.projects.create') ? 'bg-studio-950 text-white font-semibold shadow-xs' : 'text-studio-600 hover:bg-studio-100 hover:text-studio-950' }}"
                    >
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <span>Tambah Proyek Baru</span>
                    </a>
                </div>

                <!-- Section 4: Akun & Konfigurasi -->
                <div class="space-y-1">
                    <div class="px-2 pb-1.5 text-[10px] font-mono font-semibold uppercase tracking-wider text-studio-400">
                        Pengaturan
                    </div>
                    <a 
                        href="{{ route('admin.profile') }}" 
                        @click="sidebarOpen = false"
                        class="flex items-center space-x-2.5 px-3 py-2 rounded-xl transition-all {{ request()->routeIs('admin.profile') ? 'bg-studio-950 text-white font-semibold shadow-xs' : 'text-studio-600 hover:bg-studio-100 hover:text-studio-950' }}"
                    >
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Akun Pengelola</span>
                    </a>
                    <a 
                        href="{{ route('portfolio.index') }}" 
                        target="_blank" 
                        class="flex items-center justify-between px-3 py-2 rounded-xl text-studio-600 hover:bg-studio-100 hover:text-studio-950 transition-colors"
                    >
                        <div class="flex items-center space-x-2.5">
                            <svg class="w-4 h-4 text-studio-400 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                            <span>Lihat Web Publik</span>
                        </div>
                        <svg class="w-3.5 h-3.5 text-studio-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                </div>

            </nav>
        </div>

        <!-- Sidebar Footer: Authenticated User Info & Logout -->
        <div class="p-3 border-t border-studio-200 bg-studio-50/70">
            <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-white border border-studio-200/90 shadow-2xs">
                
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-2.5 min-w-0 flex-1 hover:opacity-85 transition-opacity" title="Kelola Akun Admin">
                    <div class="w-8 h-8 rounded-lg bg-studio-950 text-white font-mono font-bold text-xs flex items-center justify-center shrink-0 shadow-xs">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-xs font-bold text-studio-900 truncate leading-tight">
                            {{ Auth::user()->name ?? 'Admin IdihSebel' }}
                        </div>
                        <div class="text-[10px] font-mono text-studio-400 truncate leading-tight mt-0.5">
                            {{ Auth::user()->email ?? 'admin@idihsebel.id' }}
                        </div>
                    </div>
                </a>

                <!-- Logout Form -->
                <form action="{{ route('admin.logout') }}" method="POST" class="shrink-0" onsubmit="return confirm('Apakah Anda yakin ingin keluar dari sesi admin?');">
                    @csrf
                    <button 
                        type="submit" 
                        class="p-1.5 rounded-lg text-studio-400 hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                        title="Keluar dari sesi admin"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                </form>

            </div>
        </div>

    </aside>

    <!-- =========================================================================
         MAIN APPLICATION AREA (OFFSET FOR FIXED SIDEBAR ON DESKTOP)
         ========================================================================= -->
    <div class="lg:pl-64 flex flex-col flex-1 min-h-screen">
        
        <!-- Top App Bar (Breadcrumb & Mobile Hamburger) -->
        <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-md border-b border-studio-200 h-14 flex items-center justify-between px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center space-x-3">
                <!-- Hamburger Trigger for Mobile Drawer -->
                <button 
                    @click="sidebarOpen = true" 
                    type="button"
                    class="lg:hidden p-2 rounded-lg border border-studio-200 text-studio-600 hover:text-studio-950 hover:bg-studio-50 transition-colors"
                    aria-label="Buka menu sidebar"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <!-- Breadcrumb Path -->
                <div class="flex items-center space-x-2 text-xs font-mono text-studio-500">
                    <a href="{{ route('admin.dashboard') }}" class="text-studio-400 hover:text-studio-800 transition-colors">Console</a>
                    <span>/</span>
                    <span class="font-semibold text-studio-950">@yield('title', 'Dashboard')</span>
                </div>
            </div>

            <!-- Top Right Action Controls -->
            <div class="flex items-center space-x-2.5">
                
                <!-- Database badge -->
                <div class="hidden sm:inline-flex items-center space-x-1.5 px-2.5 py-1 rounded-md text-[11px] font-mono bg-studio-100 text-studio-600 border border-studio-200">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    <span>MySQL Synced</span>
                </div>

                <!-- Direct Link to Public Web -->
                <a 
                    href="{{ route('portfolio.index') }}" 
                    target="_blank" 
                    class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg text-xs font-medium text-studio-700 hover:text-studio-950 hover:bg-studio-50 border border-studio-200 shadow-2xs transition-colors"
                >
                    <span>Web Publik</span>
                    <svg class="w-3.5 h-3.5 text-studio-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>

        </header>

        <!-- FLASH NOTIFICATION TOASTS -->
        <div class="px-4 sm:px-6 lg:px-8 pt-4 w-full">
            @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    class="flex items-center justify-between p-3.5 mb-2 rounded-xl bg-white border border-emerald-300 text-studio-900 text-xs shadow-xs"
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
                    <button @click="show = false" class="text-studio-400 hover:text-studio-700 p-1 cursor-pointer">
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
                    class="flex items-center justify-between p-3.5 mb-2 rounded-xl bg-white border border-rose-300 text-studio-900 text-xs shadow-xs"
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
                    <button @click="show = false" class="text-studio-400 hover:text-studio-700 p-1 cursor-pointer">
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
                    class="p-4 mb-2 rounded-xl bg-white border border-amber-300 text-studio-900 text-xs shadow-xs space-y-1.5"
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

        <!-- MAIN VIEW SLOT -->
        <main class="flex-1 pb-16">
            @yield('content')
        </main>

        <!-- SUBTLE FOOTER -->
        <footer class="border-t border-studio-200 bg-white py-4 px-4 sm:px-6 lg:px-8 text-xs text-studio-400 flex flex-col sm:flex-row items-center justify-between gap-2 font-mono text-[11px]">
            <div>&copy; {{ date('Y') }} <strong>IdihSebel</strong> — Studio Rekayasa Perangkat Lunak (SMKN 1 Ciamis RPL)</div>
            <div>Database: MySQL (idihsebel) • Laravel 11</div>
        </footer>

    </div>

    @stack('scripts')
</body>
</html>
