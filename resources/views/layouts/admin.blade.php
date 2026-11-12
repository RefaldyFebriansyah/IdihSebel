<!DOCTYPE html>
<html lang="id" class="h-full bg-[#F8F9FA] scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin') — IdihSebel</title>

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
                        brand: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                            950: '#020617',
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
            letter-spacing: -0.011em;
        }
        .scrollbar-none::-webkit-scrollbar { display: none; }
        .scrollbar-none { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    @stack('styles')
</head>
<body 
    x-data="{ sidebarOpen: false }" 
    class="h-full font-sans text-brand-900 bg-[#F8F9FA] antialiased flex flex-col selection:bg-brand-950 selection:text-white overflow-x-hidden"
>

    <!-- MOBILE SIDEBAR BACKDROP OVERLAY -->
    <div 
        x-show="sidebarOpen" 
        x-cloak 
        @click="sidebarOpen = false" 
        class="fixed inset-0 z-40 bg-brand-950/30 backdrop-blur-xs lg:hidden transition-opacity"
        aria-hidden="true"
    ></div>

    <!-- =========================================================================
         MODERN SIDEBAR NAVIGATION (STANDARD APP SAAS STYLE)
         ========================================================================= -->
    <aside 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-brand-200/80 flex flex-col justify-between transition-transform duration-200 ease-in-out shadow-xs lg:shadow-none"
    >
        <!-- Top Section: Brand + Navigation -->
        <div class="flex flex-col h-full overflow-y-auto scrollbar-none">
            
            <!-- Workspace / Brand Header -->
            <div class="p-4 border-b border-brand-100 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 group">
                    <div class="w-9 h-9 rounded-xl bg-brand-950 text-white flex items-center justify-center font-bold text-sm shadow-xs group-hover:scale-105 transition-transform">
                        IS
                    </div>
                    <div>
                        <div class="font-bold text-sm text-brand-950 leading-tight flex items-center space-x-1.5">
                            <span>IdihSebel</span>
                            <span class="text-[10px] font-medium px-1.5 py-0.5 rounded-md bg-brand-100 text-brand-600">Admin</span>
                        </div>
                        <div class="text-xs text-brand-500 leading-tight mt-0.5">Tim RPL SMKN 1 Ciamis</div>
                    </div>
                </a>

                <!-- Mobile Close Button -->
                <button 
                    @click="sidebarOpen = false" 
                    class="lg:hidden p-1.5 rounded-lg text-brand-400 hover:text-brand-700 hover:bg-brand-100 transition-colors"
                >
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-3 space-y-6 flex-1 text-xs font-medium">
                
                <!-- Group 1: Menu Utama -->
                <div class="space-y-1">
                    <div class="px-3 pb-1.5 text-[11px] font-semibold text-brand-400">
                        Menu Utama
                    </div>
                    <a 
                        href="{{ route('admin.dashboard') }}" 
                        @click="if(window.location.pathname === '{{ route('admin.dashboard', [], false) }}') { window.scrollTo({ top: 0, behavior: 'smooth' }); sidebarOpen = false; }"
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') && !request()->routeIs('admin.members.*') && !request()->routeIs('admin.projects.*') ? 'bg-brand-950 text-white font-semibold shadow-xs' : 'text-brand-700 hover:bg-brand-100 hover:text-brand-950' }}"
                    >
                        <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="3" width="7" height="7" rx="1.5"></rect>
                            <rect x="14" y="14" width="7" height="7" rx="1.5"></rect>
                            <rect x="3" y="14" width="7" height="7" rx="1.5"></rect>
                        </svg>
                        <span>Dashboard</span>
                    </a>
                </div>

                <!-- Group 2: Tim & Konten -->
                <div class="space-y-1">
                    <div class="px-3 pb-1.5 text-[11px] font-semibold text-brand-400">
                        Kelola Konten
                    </div>
                    
                    <!-- Anggota Tim -->
                    <a 
                        href="{{ route('admin.dashboard') }}#members-section" 
                        @click="sidebarOpen = false"
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.members.*') ? 'bg-brand-950 text-white font-semibold shadow-xs' : 'text-brand-700 hover:bg-brand-100 hover:text-brand-950' }}"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 shrink-0 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>Anggota Tim</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ request()->routeIs('admin.members.*') ? 'bg-brand-800 text-white' : 'bg-brand-100 text-brand-600' }}">
                            6
                        </span>
                    </a>

                    <!-- Portofolio Proyek -->
                    <a 
                        href="{{ route('admin.dashboard') }}#projects-section" 
                        @click="sidebarOpen = false"
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.projects.edit') ? 'bg-brand-950 text-white font-semibold shadow-xs' : 'text-brand-700 hover:bg-brand-100 hover:text-brand-950' }}"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 shrink-0 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                            </svg>
                            <span>Daftar Proyek</span>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-brand-100 text-brand-600">
                            {{ rescue(fn() => \App\Models\Project::count(), 4) }}
                        </span>
                    </a>

                    <!-- Tambah Proyek -->
                    <a 
                        href="{{ route('admin.projects.create') }}" 
                        @click="sidebarOpen = false"
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.projects.create') ? 'bg-brand-950 text-white font-semibold shadow-xs' : 'text-brand-700 hover:bg-brand-100 hover:text-brand-950' }}"
                    >
                        <svg class="w-4 h-4 shrink-0 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="16"></line>
                            <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                        <span>Tambah Proyek</span>
                    </a>
                </div>

                <!-- Group 3: Pengaturan -->
                <div class="space-y-1">
                    <div class="px-3 pb-1.5 text-[11px] font-semibold text-brand-400">
                        Pengaturan
                    </div>
                    <a 
                        href="{{ route('admin.profile') }}" 
                        @click="sidebarOpen = false"
                        class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.profile') ? 'bg-brand-950 text-white font-semibold shadow-xs' : 'text-brand-700 hover:bg-brand-100 hover:text-brand-950' }}"
                    >
                        <svg class="w-4 h-4 shrink-0 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span>Profil Admin</span>
                    </a>
                    
                    <a 
                        href="{{ route('portfolio.index') }}" 
                        target="_blank" 
                        class="flex items-center justify-between px-3 py-2.5 rounded-xl text-brand-700 hover:bg-brand-100 hover:text-brand-950 transition-colors"
                    >
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 shrink-0 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                            </svg>
                            <span>Lihat Website</span>
                        </div>
                        <svg class="w-3.5 h-3.5 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>
                </div>

            </nav>
        </div>

        <!-- Sidebar Footer: User Card & Status -->
        <div class="p-3 border-t border-brand-200/80 bg-brand-50/50 space-y-2">
            
            <!-- User Box -->
            <div class="flex items-center justify-between gap-2 p-2 rounded-xl bg-white border border-brand-200/80 shadow-2xs">
                <a href="{{ route('admin.profile') }}" class="flex items-center space-x-2.5 min-w-0 flex-1 hover:opacity-85 transition-opacity" title="Kelola Profil Admin">
                    <div class="w-8 h-8 rounded-lg bg-brand-950 text-white font-bold text-xs flex items-center justify-center shrink-0">
                        {{ strtoupper(substr(Auth::user()->name ?? 'AD', 0, 2)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <div class="text-xs font-semibold text-brand-950 truncate leading-tight">
                            {{ Auth::user()->name ?? 'Admin IdihSebel' }}
                        </div>
                        <div class="text-[11px] text-brand-500 truncate leading-tight mt-0.5">
                            {{ Auth::user()->email ?? 'admin@idihsebel.id' }}
                        </div>
                    </div>
                </a>

                <!-- Logout Button -->
                <form action="{{ route('admin.logout') }}" method="POST" class="shrink-0" onsubmit="return confirm('Yakin ingin keluar dari akun admin?');">
                    @csrf
                    <button 
                        type="submit" 
                        class="p-1.5 rounded-lg text-brand-400 hover:text-rose-600 hover:bg-rose-50 transition-colors cursor-pointer"
                        title="Keluar"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </button>
                </form>
            </div>

            <!-- Database status -->
            <div class="px-2 py-1 flex items-center justify-between text-[11px] text-brand-500">
                <div class="flex items-center space-x-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    <span>Database MySQL</span>
                </div>
                <span class="text-brand-400 text-[10px]">Tersambung</span>
            </div>

        </div>

    </aside>

    <!-- =========================================================================
         MAIN APPLICATION AREA
         ========================================================================= -->
    <div class="lg:pl-64 flex flex-col flex-1 min-h-screen overflow-x-hidden min-w-0">
        
        <!-- Top App Bar -->
        <header class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-brand-200/80 h-14 flex items-center justify-between px-4 sm:px-6 lg:px-8">
            
            <div class="flex items-center space-x-3">
                <!-- Mobile Hamburger Toggle -->
                <button 
                    @click="sidebarOpen = true" 
                    type="button"
                    class="lg:hidden p-2 rounded-xl border border-brand-200 text-brand-700 hover:text-brand-950 hover:bg-brand-50 transition-colors cursor-pointer"
                    aria-label="Buka menu navigasi"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <!-- Breadcrumb Path -->
                <div class="flex items-center space-x-2 text-xs font-medium text-brand-500">
                    <a href="{{ route('admin.dashboard') }}" class="text-brand-400 hover:text-brand-800 transition-colors">IdihSebel</a>
                    <span>/</span>
                    <span class="font-semibold text-brand-950">@yield('title', 'Dashboard')</span>
                </div>
            </div>

            <!-- Top Right Action Controls -->
            <div class="flex items-center space-x-2.5">
                <!-- Website Preview Button -->
                <a 
                    href="{{ route('portfolio.index') }}" 
                    target="_blank" 
                    class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-xl text-xs font-semibold text-brand-700 hover:text-brand-950 hover:bg-brand-50 border border-brand-200 shadow-2xs transition-colors"
                >
                    <span>Lihat Website</span>
                    <svg class="w-3.5 h-3.5 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>

        </header>

        <!-- FLASH NOTIFICATIONS -->
        <div class="px-4 sm:px-6 lg:px-8 pt-4 w-full">
            @if (session('success'))
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    class="flex items-center justify-between p-3.5 mb-2 rounded-xl bg-white border border-emerald-300 text-brand-900 text-xs shadow-xs"
                    role="alert"
                >
                    <div class="flex items-center space-x-2.5">
                        <div class="w-5 h-5 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-200">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                        </div>
                        <span class="font-medium text-brand-800">{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-brand-400 hover:text-brand-700 p-1 cursor-pointer">
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
                    class="flex items-center justify-between p-3.5 mb-2 rounded-xl bg-white border border-rose-300 text-brand-900 text-xs shadow-xs"
                    role="alert"
                >
                    <div class="flex items-center space-x-2.5">
                        <div class="w-5 h-5 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 border border-rose-200">
                            <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                        <span class="font-medium text-brand-800">{{ session('error') }}</span>
                    </div>
                    <button @click="show = false" class="text-brand-400 hover:text-brand-700 p-1 cursor-pointer">
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
                    class="p-4 mb-2 rounded-xl bg-white border border-amber-300 text-brand-900 text-xs shadow-xs space-y-1.5"
                    role="alert"
                >
                    <div class="flex items-center space-x-2 font-semibold text-amber-800">
                        <svg class="w-4 h-4 text-amber-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>Silakan periksa input berikut:</span>
                    </div>
                    <ul class="list-disc list-inside space-y-0.5 text-brand-600 ml-4 text-[12px]">
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

        <!-- FOOTER -->
        <footer class="border-t border-brand-200/80 bg-white py-4 px-4 sm:px-6 lg:px-8 text-xs text-brand-400 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>&copy; {{ date('Y') }} <strong>IdihSebel</strong> — Rekayasa Perangkat Lunak SMKN 1 Ciamis</div>
            <div class="flex items-center space-x-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span>Tersimpan di MySQL</span>
            </div>
        </footer>

    </div>

    @stack('scripts')
</body>
</html>
