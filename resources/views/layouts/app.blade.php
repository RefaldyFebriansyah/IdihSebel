<!DOCTYPE html>
<html lang="id" class="scroll-smooth antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'IdihSebel — Studio Rekayasa Perangkat Lunak & Desain Produk')</title>
    <meta name="description" content="@yield('meta_description', 'Portofolio kolektif dan individual 6 software engineer & product designer IdihSebel (SMKN 1 Ciamis RPL). Membangun aplikasi web, mobile, dan sistem informasi modern.')">

    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
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

    <!-- Three.js (3D Graphics Engine) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
        }
    </style>

    @stack('styles')
</head>
<body
    class="bg-[#FAFAFB] text-zinc-900 font-sans min-h-screen flex flex-col selection:bg-zinc-900 selection:text-white"
    x-data="{
        mobileMenuOpen: false,
        contactModalOpen: false,
        selectedMemberContact: ''
    }"
    @keydown.escape.window="contactModalOpen = false; mobileMenuOpen = false"
>

    <!-- MODERN HEADER BAR -->
    <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md border-b border-zinc-200/80 transition-all">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('portfolio.index') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-zinc-900 to-zinc-800 text-white flex items-center justify-center font-bold text-base shadow-sm group-hover:scale-105 transition-transform">
                        IS
                    </div>
                    <div class="flex flex-col">
                        <span class="font-extrabold text-base tracking-tight text-zinc-900 group-hover:text-blue-600 transition-colors">
                            IdihSebel
                        </span>
                        <span class="text-xs text-zinc-500 font-medium">
                            Software & Design Studio
                        </span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-1 lg:space-x-2 text-sm font-medium text-zinc-600">
                    <a href="{{ route('portfolio.index') }}" class="px-3.5 py-2 rounded-lg hover:text-zinc-900 hover:bg-zinc-100 transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('portfolio.index') }}#roster" class="px-3.5 py-2 rounded-lg hover:text-zinc-900 hover:bg-zinc-100 transition-colors">
                        Tim Kami
                    </a>
                    <a href="{{ route('portfolio.index') }}#works" class="px-3.5 py-2 rounded-lg hover:text-zinc-900 hover:bg-zinc-100 transition-colors">
                        Proyek Pilihan
                    </a>
                    <a href="{{ route('portfolio.index') }}#specs" class="px-3.5 py-2 rounded-lg hover:text-zinc-900 hover:bg-zinc-100 transition-colors">
                        Keahlian & Stack
                    </a>
                </nav>

                <!-- Actions -->
                <div class="flex items-center space-x-3">
                    <button
                        @click="contactModalOpen = true"
                        class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-full bg-zinc-900 hover:bg-zinc-800 text-white text-xs sm:text-sm font-semibold shadow-xs hover:shadow-md transition-all active:scale-95"
                    >
                        <span>Hubungi Kami</span>
                        <svg class="w-4 h-4 text-zinc-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="7" y1="17" x2="17" y2="7"></line>
                            <polyline points="7 7 17 7 17 17"></polyline>
                        </svg>
                    </button>

                    <!-- Mobile Menu Hamburger -->
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="md:hidden p-2.5 rounded-xl border border-zinc-200 bg-white text-zinc-700 hover:bg-zinc-50"
                        aria-label="Buka Menu"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" x-cloak class="md:hidden border-t border-zinc-200 bg-white px-4 pt-3 pb-6 space-y-2 text-sm font-medium">
            <a href="{{ route('portfolio.index') }}" @click="mobileMenuOpen = false" class="block px-3 py-2.5 rounded-lg text-zinc-800 hover:bg-zinc-100">
                Beranda
            </a>
            <a href="{{ route('portfolio.index') }}#roster" @click="mobileMenuOpen = false" class="block px-3 py-2.5 rounded-lg text-zinc-800 hover:bg-zinc-100">
                Tim Kami (6 Spesialis)
            </a>
            <a href="{{ route('portfolio.index') }}#works" @click="mobileMenuOpen = false" class="block px-3 py-2.5 rounded-lg text-zinc-800 hover:bg-zinc-100">
                Proyek Pilihan (8 Sistem)
            </a>
            <a href="{{ route('portfolio.index') }}#specs" @click="mobileMenuOpen = false" class="block px-3 py-2.5 rounded-lg text-zinc-800 hover:bg-zinc-100">
                Keahlian & Stack
            </a>
            <div class="pt-2">
                <button
                    @click="contactModalOpen = true; mobileMenuOpen = false"
                    class="w-full text-center py-2.5 rounded-lg bg-zinc-900 text-white font-semibold"
                >
                    Mulai Diskusi Proyek
                </button>
            </div>
        </div>
    </header>

    <!-- MAIN BODY CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- CLEAN MODERN FOOTER -->
    <footer class="bg-white border-t border-zinc-200 mt-20 text-zinc-600 text-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-10 pb-12 border-b border-zinc-100">
                <!-- Col 1: Identity & Intro -->
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-xl bg-zinc-900 text-white flex items-center justify-center font-bold text-sm">
                            IS
                        </div>
                        <span class="font-extrabold text-base text-zinc-900">IdihSebel</span>
                    </div>
                    <p class="text-zinc-500 text-sm leading-relaxed max-w-sm">
                        Kolektif 6 software engineer & desainer produk lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Membangun solusi aplikasi web, mobile, dan sistem informasi modern.
                    </p>
                    <div class="text-xs text-zinc-400">
                        Ciamis, Jawa Barat, Indonesia • SMKN 1 Ciamis (RPL)
                    </div>
                </div>

                <!-- Col 2: Navigasi Cepat -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-zinc-500">
                        <li><a href="{{ route('portfolio.index') }}" class="hover:text-zinc-900 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('portfolio.index') }}#roster" class="hover:text-zinc-900 transition-colors">Profil Anggota Tim</a></li>
                        <li><a href="{{ route('portfolio.index') }}#works" class="hover:text-zinc-900 transition-colors">Katalog Proyek (Demo)</a></li>
                        <li><a href="{{ route('portfolio.index') }}#specs" class="hover:text-zinc-900 transition-colors">Matriks Keahlian</a></li>
                    </ul>
                </div>

                <!-- Col 3: Roster Langsung -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Profil Tim RPL</h4>
                    <ul class="space-y-2 text-sm text-zinc-500">
                        <li><a href="{{ route('portfolio.member', 'rasya-syahreza') }}" class="hover:text-zinc-900 transition-colors">01. Rasya Syahreza</a></li>
                        <li><a href="{{ route('portfolio.member', 'm-fathin') }}" class="hover:text-zinc-900 transition-colors">02. M. Fathin</a></li>
                        <li><a href="{{ route('portfolio.member', 'refaldy-febriansyah') }}" class="hover:text-zinc-900 transition-colors">03. Refaldy Febriansyah</a></li>
                        <li><a href="{{ route('portfolio.member', 'surya-aditya') }}" class="hover:text-zinc-900 transition-colors">04. Surya Aditya</a></li>
                        <li><a href="{{ route('portfolio.member', 'leonard') }}" class="hover:text-zinc-900 transition-colors">05. Leonard</a></li>
                        <li><a href="{{ route('portfolio.member', 'fadhila') }}" class="hover:text-zinc-900 transition-colors">06. Fadhila</a></li>
                    </ul>
                </div>

                <!-- Col 4: Kontak & Diskusi -->
                <div class="space-y-3">
                    <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Kontak Langsung</h4>
                    <p class="text-zinc-500 text-sm">
                        Punya ide produk atau kebutuhan sistem untuk bisnis Anda? Mari diskusikan bersama kami.
                    </p>
                    <div class="space-y-1">
                        <a href="mailto:halo@idihsebel.id" class="text-blue-600 font-medium hover:underline block">
                            halo@idihsebel.id
                        </a>
                        <span class="text-xs text-zinc-400 block">+62 812-3456-7800</span>
                    </div>
                </div>
            </div>

            <!-- Bottom Row -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-zinc-400 gap-4">
                <div>
                    &copy; {{ date('Y') }} IdihSebel. Seluruh hak cipta dilindungi undang-undang.
                </div>
                <div class="flex items-center space-x-6 text-zinc-500">
                    <span>Dibangun dengan Laravel 11, Tailwind CSS & Alpine.js</span>
                    <a href="{{ route('admin.login') }}" class="hover:text-zinc-900 transition-colors inline-flex items-center space-x-1 text-zinc-400 hover:text-zinc-700">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                        <span>Login Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- MODERN CONTACT MODAL -->
    <div x-show="contactModalOpen" x-cloak class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
            <!-- Backdrop -->
            <div @click="contactModalOpen = false" class="fixed inset-0 bg-zinc-900/60 backdrop-blur-xs transition-opacity"></div>

            <!-- Dialog Box -->
            <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-zinc-200">
                <div class="p-6 sm:p-8 space-y-6">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-zinc-900">Mulai Kolaborasi & Diskusi Proyek</h3>
                            <p class="text-sm text-zinc-500 mt-1">
                                Tim kami siap membantu merealisasikan kebutuhan website, sistem aplikasi, atau desain produk digital Anda.
                            </p>
                        </div>
                        <button @click="contactModalOpen = false" class="text-zinc-400 hover:text-zinc-600 p-1 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-3 p-4 bg-zinc-50 rounded-xl border border-zinc-200/80 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="text-zinc-500">Email Utama:</span>
                            <span class="font-semibold text-zinc-900 select-all">halo@idihsebel.id</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-zinc-500">WhatsApp Triage:</span>
                            <span class="font-semibold text-zinc-900 select-all">+62 812-3456-7800</span>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-zinc-700 uppercase tracking-wider">Ingin Berdiskusi dengan Spesialis Tertentu?</label>
                        <select x-model="selectedMemberContact" class="w-full border border-zinc-300 rounded-xl p-3 text-sm bg-white text-zinc-900 focus:outline-none focus:ring-2 focus:ring-blue-600">
                            <option value="">Semua Tim (Diskusi Umum Proyek)</option>
                            <option value="Rasya Syahreza">01. Rasya Syahreza — Front-End & UI Specialist</option>
                            <option value="M. Fathin">02. M. Fathin — Back-End & Database Engineer</option>
                            <option value="Refaldy Febriansyah">03. Refaldy Febriansyah — Full-Stack Web Developer</option>
                            <option value="Surya Aditya">04. Surya Aditya — UI/UX Designer & Product Specialist</option>
                            <option value="Leonard">05. Leonard — Mobile Application Developer</option>
                            <option value="Fadhila">06. Fadhila — QA Engineer & Technical Documentation</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end space-x-3 pt-2">
                        <button @click="contactModalOpen = false" class="px-5 py-2.5 rounded-xl border border-zinc-300 text-sm font-medium text-zinc-700 hover:bg-zinc-50">
                            Tutup
                        </button>
                        <a
                            :href="'mailto:halo@idihsebel.id?subject=' + encodeURIComponent('Inquiry Proyek Baru' + (selectedMemberContact ? ' untuk ' + selectedMemberContact : ''))"
                            class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold transition-colors inline-flex items-center space-x-2"
                        >
                            <span>Kirim Pesan Email</span>
                            <span>→</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
