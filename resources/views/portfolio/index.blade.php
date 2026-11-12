@extends('layouts.app')

@section('title', 'IdihSebel — Portofolio Tim Software Engineer & Desainer Produk (SMKN 1 Ciamis RPL)')
@section('meta_description', 'Portofolio tim 6 software engineer & product designer IdihSebel (SMKN 1 Ciamis RPL). Solusi web, sistem enterprise, dan mobile app modern.')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-2 sm:pt-4 pb-16 space-y-16 sm:space-y-24">

    <!-- =========================================================================
         1. HERO SECTION WITH INTERACTIVE 3D MODEL BACKGROUND (SEAMLESS - NO CARD)
         ========================================================================= -->
    <section class="space-y-10">
        <div class="relative min-h-[calc(100vh-6rem)] max-h-[760px] flex items-center py-4 sm:py-6 overflow-visible">
            
            <!-- 3D WebGL Background Canvas Container (Seamless with Bleed - Never Clipped) -->
            <div id="hero-3d-canvas-wrap" class="absolute -top-10 -bottom-10 -left-8 -right-8 lg:-right-24 xl:-right-36 z-0 pointer-events-auto cursor-grab active:cursor-grabbing overflow-visible"></div>

            <!-- Foreground Hero Content (Constrained to Left to Keep Space for 3D Core) -->
            <div class="relative z-10 max-w-xl lg:max-w-xl xl:max-w-xl space-y-6 pointer-events-auto">
                <!-- Main Heading -->
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight text-zinc-900 leading-[1.15]">
                    Membangun produk digital & sistem perangkat lunak yang andal.
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-zinc-600 leading-relaxed max-w-lg">
                    Kami adalah tim 6 software engineer & desainer produk lulusan SMKN 1 Ciamis (Rekayasa Perangkat Lunak). Menggabungkan keahlian desain antarmuka, backend Laravel & MySQL, rekayasa full-stack, serta aplikasi mobile native dan cross-platform.
                </p>

                <!-- Action CTAs -->
                <div class="flex flex-wrap items-center gap-3 pt-2">
                    <a
                        href="#roster"
                        class="px-6 py-3 rounded-full bg-zinc-950 hover:bg-zinc-800 text-white text-sm font-semibold tracking-tight shadow-[0_2px_8px_rgba(0,0,0,0.12)] hover:shadow-[0_4px_16px_rgba(0,0,0,0.2)] transition-all inline-flex items-center space-x-2 active:scale-98"
                    >
                        <span>Kenali 6 Anggota Tim</span>
                        <span>↓</span>
                    </a>
                    <a
                        href="#works"
                        class="px-6 py-3 rounded-full bg-white hover:bg-zinc-50 text-zinc-900 border border-zinc-200/90 text-sm font-semibold tracking-tight shadow-[0_1px_2px_rgba(0,0,0,0.04)] hover:border-zinc-300 transition-all inline-flex items-center space-x-2 active:scale-98"
                    >
                        <span>Lihat Portofolio Demo</span>
                        <span>→</span>
                    </a>
                    <button
                        @click="contactModalOpen = true"
                        class="px-5 py-3 rounded-full text-zinc-600 hover:text-zinc-950 hover:bg-zinc-100/80 text-sm font-medium transition-all"
                    >
                        Konsultasi Kebutuhan Anda
                    </button>
                </div>
            </div>
        </div>

        <!-- Metric Stat Cards (Minimalist, Elevated, Clean) -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6 pt-2">
            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 space-y-1 shadow-[0_1px_3px_rgba(0,0,0,0.03)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.05)] hover:border-zinc-300 transition-all duration-300">
                <div class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400">Anggota Tim</div>
                <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-zinc-950">06</div>
                <div class="text-xs text-zinc-500 font-medium">Spesialis SMKN 1 Ciamis</div>
            </div>

            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 space-y-1 shadow-[0_1px_3px_rgba(0,0,0,0.03)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.05)] hover:border-zinc-300 transition-all duration-300">
                <div class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400">Proyek Demo</div>
                <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-zinc-950">{{ sprintf('%02d', $stats['total_projects']) }}</div>
                <div class="text-xs text-zinc-500 font-medium">Web, Sistem & Mobile App</div>
            </div>

            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 space-y-1 shadow-[0_1px_3px_rgba(0,0,0,0.03)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.05)] hover:border-zinc-300 transition-all duration-300">
                <div class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400">Fokus Keahlian</div>
                <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-blue-600">RPL</div>
                <div class="text-xs text-zinc-500 font-medium">Rekayasa Perangkat Lunak</div>
            </div>

            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 space-y-1 shadow-[0_1px_3px_rgba(0,0,0,0.03)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.05)] hover:border-zinc-300 transition-all duration-300">
                <div class="text-[11px] font-semibold uppercase tracking-wider text-zinc-400">Kategori Solusi</div>
                <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-blue-600">04</div>
                <div class="text-xs text-zinc-500 font-medium">Web, POS, UI/UX, & Mobile</div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         2. THE 6-PERSON ROSTER GRID (#roster)
         ========================================================================= -->
    <section id="roster" class="scroll-mt-24 space-y-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between pb-4 border-b border-zinc-200 gap-4">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">
                    Profil Anggota Tim (Lulusan SMKN 1 Ciamis RPL)
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-zinc-900">
                    6 Rekan Spesialis Rekayasa Perangkat Lunak
                </h2>
            </div>
            <p class="text-sm text-zinc-500 max-w-md leading-relaxed">
                5 Rekan Pria & 1 Rekan Wanita lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL), Ciamis, Jawa Barat. Klik profil untuk melihat keahlian dan rekam jejak masing-masing.
            </p>
        </div>

        <!-- 3-Column Modern Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($members as $member)
                <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 sm:p-7 flex flex-col justify-between shadow-[0_1px_3px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_32px_rgba(0,0,0,0.07)] hover:border-zinc-300 hover:-translate-y-0.5 transition-all duration-300 group">
                    <div>
                        <!-- Top Bar: Index & Origin -->
                        <div class="flex items-center justify-between pb-3.5 border-b border-zinc-100">
                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-md bg-zinc-100 text-zinc-700 text-xs font-bold font-mono">
                                #{{ $member->index_number }}
                            </span>
                            <span class="text-xs text-zinc-400 font-medium">
                                SMKN 1 Ciamis (RPL)
                            </span>
                        </div>

                        <!-- Portrait Photo (Clean Minimalist Frame, No Clutter) -->
                        <a href="{{ route('portfolio.member', $member->slug) }}" class="block mt-4 mb-4 overflow-hidden rounded-xl bg-zinc-100 aspect-[4/5] relative">
                            <img
                                src="{{ $member->avatar_url }}"
                                alt="{{ $member->name }}"
                                class="w-full h-full object-cover object-top grayscale-[15%] group-hover:grayscale-0 group-hover:scale-103 transition-all duration-500"
                                loading="lazy"
                            >
                        </a>

                        <!-- Name & Role -->
                        <div class="space-y-1.5">
                            <div class="text-xs font-semibold text-blue-600 uppercase tracking-wide">
                                {{ $member->role }}
                            </div>
                            <h3 class="text-xl font-bold tracking-tight text-zinc-950 group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('portfolio.member', $member->slug) }}">
                                    {{ $member->name }}
                                </a>
                            </h3>
                            <p class="text-xs sm:text-sm text-zinc-500 leading-relaxed pt-0.5 line-clamp-3">
                                {{ $member->specialization }}
                            </p>
                        </div>
                    </div>

                    <!-- Bottom: Top Skills & CTA Link -->
                    <div class="mt-6 pt-4 border-t border-zinc-100 space-y-4">
                        <div class="flex flex-wrap gap-1.5">
                            @foreach($member->skills->take(4) as $skill)
                                <span class="px-2.5 py-1 rounded-md bg-zinc-50 border border-zinc-200/70 text-zinc-600 text-[11px] font-medium">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                            @if($member->skills->count() > 4)
                                <span class="px-1.5 py-1 text-zinc-400 text-[11px] font-medium">
                                    +{{ $member->skills->count() - 4 }}
                                </span>
                            @endif
                        </div>

                        <div class="flex items-center justify-between pt-1 text-xs">
                            <span class="text-zinc-400 font-medium">
                                Ciamis, Jawa Barat
                            </span>
                            <a
                                href="{{ route('portfolio.member', $member->slug) }}"
                                class="inline-flex items-center space-x-1.5 font-bold text-zinc-900 hover:text-blue-600 transition-colors"
                            >
                                <span>Lihat Profil</span>
                                <span class="group-hover:translate-x-0.5 transition-transform">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- =========================================================================
         3. INTERACTIVE COLLECTIVE WORKS DIRECTORY (#works)
         ========================================================================= -->
    <section
        id="works"
        class="scroll-mt-24 space-y-8"
        x-data="{
            activeDiscipline: 'ALL',
            activeContributor: 'ALL',
            searchQuery: '',
            selectedProject: null,
            filterProjects(project) {
                const matchDiscipline = (this.activeDiscipline === 'ALL') || (project.category === this.activeDiscipline);
                const matchContributor = (this.activeContributor === 'ALL') || project.member_indexes.includes(this.activeContributor);
                const matchSearch = (this.searchQuery === '') ||
                    project.title.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    project.summary.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    project.tech_stack.some(t => t.toLowerCase().includes(this.searchQuery.toLowerCase()));
                return matchDiscipline && matchContributor && matchSearch;
            }
        }"
    >
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between pb-4 border-b border-zinc-200 gap-4">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">
                    Portofolio Terpilih [Demo Showcase]
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-zinc-900">
                    Karya & Sistem Demo Kami
                </h2>
            </div>
            <p class="text-sm text-zinc-500 max-w-md leading-relaxed">
                Koleksi 4 proyek demo dan prototipe aplikasi untuk simulasi portofolio tim RPL SMKN 1 Ciamis. Filter berdasarkan kategori atau anggota tim yang berkontribusi.
            </p>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="bg-white rounded-2xl border border-zinc-200/80 p-5 space-y-4 shadow-xs">
            <!-- Row 1: Filter Kategori -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-3 pb-3 border-b border-zinc-100">
                <span class="text-xs font-bold text-zinc-700 uppercase tracking-wider">Kategori:</span>
                <div class="flex flex-wrap gap-2 text-xs sm:text-sm font-medium">
                    <button
                        @click="activeDiscipline = 'ALL'"
                        :class="activeDiscipline === 'ALL' ? 'bg-zinc-900 text-white shadow-xs' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'"
                        class="px-4 py-1.5 rounded-full transition-all"
                    >
                        Semua Proyek ({{ $projects->count() }})
                    </button>
                    <button
                        @click="activeDiscipline = 'Web Application'"
                        :class="activeDiscipline === 'Web Application' ? 'bg-zinc-900 text-white shadow-xs' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'"
                        class="px-4 py-1.5 rounded-full transition-all"
                    >
                        Web Application
                    </button>
                    <button
                        @click="activeDiscipline = 'UI/UX Design'"
                        :class="activeDiscipline === 'UI/UX Design' ? 'bg-zinc-900 text-white shadow-xs' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'"
                        class="px-4 py-1.5 rounded-full transition-all"
                    >
                        UI/UX Design
                    </button>
                    <button
                        @click="activeDiscipline = 'System & POS'"
                        :class="activeDiscipline === 'System & POS' ? 'bg-zinc-900 text-white shadow-xs' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'"
                        class="px-4 py-1.5 rounded-full transition-all"
                    >
                        System & POS
                    </button>
                    <button
                        @click="activeDiscipline = 'Mobile App'"
                        :class="activeDiscipline === 'Mobile App' ? 'bg-zinc-900 text-white shadow-xs' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'"
                        class="px-4 py-1.5 rounded-full transition-all"
                    >
                        Mobile App
                    </button>
                </div>
            </div>

            <!-- Row 2: Filter Kontributor & Input Pencarian -->
            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-1.5 text-xs">
                    <span class="font-bold text-zinc-700 uppercase tracking-wider mr-1">Kontributor:</span>
                    <button
                        @click="activeContributor = 'ALL'"
                        :class="activeContributor === 'ALL' ? 'bg-blue-600 text-white' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'"
                        class="px-3 py-1 rounded-full font-semibold transition-colors"
                    >
                        Semua Tim
                    </button>
                    @foreach($members as $m)
                        <button
                            @click="activeContributor = '{{ $m->index_number }}'"
                            :class="activeContributor === '{{ $m->index_number }}' ? 'bg-blue-600 text-white' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200'"
                            class="px-3 py-1 rounded-full font-medium transition-colors"
                            title="{{ $m->name }} ({{ $m->role }})"
                        >
                            {{ Str::words($m->name, 2, '') }}
                        </button>
                    @endforeach
                </div>

                <!-- Search Input -->
                <div class="relative w-full lg:w-72">
                    <input
                        type="text"
                        x-model="searchQuery"
                        placeholder="Cari judul, teknologi, klien..."
                        class="w-full px-4 py-2 bg-zinc-50 border border-zinc-200 rounded-xl text-xs sm:text-sm text-zinc-900 placeholder-zinc-400 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:bg-white"
                    >
                    <span x-show="searchQuery.length > 0" @click="searchQuery = ''" class="absolute right-3 top-2.5 cursor-pointer text-zinc-400 hover:text-zinc-700 text-xs">✕</span>
                </div>
            </div>
        </div>

        <!-- Catalog JSON Data -->
        @php
            $projectCatalog = $projects->map(function ($p, $idx) {
                return [
                    'id' => $p->id,
                    'index' => sprintf('%02d', $idx + 1),
                    'title' => $p->title,
                    'slug' => $p->slug,
                    'year' => $p->year,
                    'category' => $p->category,
                    'client' => $p->client_or_context,
                    'thumbnail' => $p->thumbnail_url,
                    'summary' => $p->summary,
                    'case_study' => $p->case_study,
                    'tech_stack' => $p->tech_stack,
                    'live_url' => $p->live_url,
                    'repo_url' => $p->repo_url,
                    'is_featured' => $p->is_featured,
                    'member_indexes' => $p->members->pluck('index_number')->toArray(),
                    'members' => $p->members->map(function ($m) {
                        return [
                            'index' => $m->index_number,
                            'name' => $m->name,
                            'slug' => $m->slug,
                            'avatar' => $m->avatar_url,
                            'role' => $m->pivot->specific_role,
                        ];
                    })->toArray(),
                ];
            });
        @endphp

        <script>
            window.collectiveProjects = @json($projectCatalog);
        </script>

        <!-- Project Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8" x-data="{ projectsList: window.collectiveProjects }">
            <template x-for="project in projectsList" :key="project.id">
                <div
                    x-show="filterProjects(project)"
                    x-transition.opacity.duration.200ms
                    class="bg-white rounded-2xl border border-zinc-200/70 overflow-hidden shadow-[0_1px_3px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_36px_rgba(0,0,0,0.07)] hover:border-zinc-300 transition-all duration-300 flex flex-col justify-between group"
                >
                    <div class="space-y-4">
                        <!-- Thumbnail Image (Clean, No Obscuring Floating Badges) -->
                        <div
                            @click="selectedProject = project"
                            class="relative aspect-video overflow-hidden bg-zinc-100 cursor-pointer"
                        >
                            <img
                                :src="project.thumbnail"
                                :alt="project.title"
                                class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500"
                                loading="lazy"
                            >
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 sm:p-7 space-y-3">
                            <div class="flex items-center justify-between text-xs font-medium pb-1">
                                <span class="text-blue-600 font-semibold tracking-wider uppercase text-[11px]" x-text="project.category"></span>
                                <span class="text-zinc-400 font-mono text-xs" x-text="project.year"></span>
                            </div>

                            <h3
                                @click="selectedProject = project"
                                class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-950 hover:text-blue-600 transition-colors cursor-pointer"
                                x-text="project.title"
                            ></h3>

                            <div class="text-xs text-zinc-400 font-medium">
                                Konteks: <span class="text-zinc-700 font-semibold" x-text="project.client"></span>
                            </div>

                            <p class="text-xs sm:text-sm text-zinc-500 leading-relaxed font-sans line-clamp-3" x-text="project.summary"></p>

                            <!-- Tech Stack Pills -->
                            <div class="flex flex-wrap gap-1.5 pt-2">
                                <template x-for="tech in project.tech_stack" :key="tech">
                                    <span class="px-2.5 py-1 rounded-md bg-zinc-50 border border-zinc-200/70 text-zinc-600 text-[11px] font-medium" x-text="tech"></span>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Bottom: Attributed Team & Actions -->
                    <div class="p-6 sm:p-7 pt-0 border-t border-zinc-100 mt-4 space-y-4">
                        <div class="pt-4">
                            <div class="text-xs font-semibold text-zinc-500 uppercase tracking-wider mb-2">
                                Anggota Tim yang Mengerjakan:
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <template x-for="m in project.members" :key="m.index">
                                    <a
                                        :href="'/member/' + m.slug"
                                        class="inline-flex items-center space-x-2 px-3 py-1.5 rounded-xl bg-zinc-50 hover:bg-zinc-100 border border-zinc-200 transition-colors"
                                        :title="m.name + ' (' + m.role + ')'"
                                    >
                                        <img :src="m.avatar" :alt="m.name" class="w-5 h-5 rounded-full object-cover">
                                        <span class="text-xs font-semibold text-zinc-800" x-text="m.name"></span>
                                    </a>
                                </template>
                            </div>
                        </div>

                        <div class="flex items-center justify-between pt-2">
                            <button
                                @click="selectedProject = project"
                                class="text-sm font-bold text-blue-600 hover:text-blue-700 hover:underline"
                            >
                                Lihat Studi Kasus Lengkap →
                            </button>

                            <template x-if="project.live_url">
                                <a
                                    :href="project.live_url"
                                    target="_blank"
                                    rel="noopener"
                                    class="inline-flex items-center space-x-1 px-3.5 py-1.5 rounded-lg bg-zinc-100 hover:bg-zinc-200 text-zinc-800 text-xs font-semibold transition-colors"
                                >
                                    <span>Demo Live</span>
                                    <span>↗</span>
                                </a>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
        </div>

        <!-- Project Detail Modal -->
        <div
            x-show="selectedProject !== null"
            x-cloak
            class="fixed inset-0 z-50 overflow-y-auto"
            role="dialog"
            aria-modal="true"
        >
            <div @click="selectedProject = null" class="fixed inset-0 bg-zinc-900/60 backdrop-blur-xs transition-opacity"></div>

            <div class="flex items-center justify-center min-h-screen px-4 py-8">
                <div class="relative bg-white rounded-2xl max-w-2xl w-full shadow-2xl overflow-hidden border border-zinc-200">
                    <!-- Modal Header -->
                    <div class="p-6 sm:p-8 border-b border-zinc-100 flex items-start justify-between">
                        <div class="space-y-1">
                            <span class="px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold" x-text="selectedProject ? selectedProject.category : ''"></span>
                            <h3 class="text-xl sm:text-2xl font-bold text-zinc-900 pt-1" x-text="selectedProject ? selectedProject.title : ''"></h3>
                            <div class="text-xs text-zinc-500">
                                Klien: <span class="font-medium text-zinc-700" x-text="selectedProject ? selectedProject.client : ''"></span> • Tahun: <span x-text="selectedProject ? selectedProject.year : ''"></span>
                            </div>
                        </div>
                        <button @click="selectedProject = null" class="text-zinc-400 hover:text-zinc-600 p-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 sm:p-8 space-y-6 max-h-[75vh] overflow-y-auto">
                        <div class="aspect-video rounded-xl overflow-hidden bg-zinc-100">
                            <img :src="selectedProject ? selectedProject.thumbnail : ''" class="w-full h-full object-cover">
                        </div>

                        <div class="space-y-2">
                            <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Uraian & Solusi Rekayasa</h4>
                            <p class="text-sm text-zinc-600 leading-relaxed whitespace-pre-line" x-text="selectedProject ? selectedProject.case_study : ''"></p>
                        </div>

                        <div class="space-y-2">
                            <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Teknologi yang Digunakan</h4>
                            <div class="flex flex-wrap gap-1.5">
                                <template x-for="tech in (selectedProject ? selectedProject.tech_stack : [])" :key="tech">
                                    <span class="px-3 py-1 rounded-lg bg-zinc-100 text-zinc-800 text-xs font-semibold" x-text="tech"></span>
                                </template>
                            </div>
                        </div>

                        <div class="space-y-2 pt-2 border-t border-zinc-100">
                            <h4 class="text-xs font-bold text-zinc-900 uppercase tracking-wider">Peran Anggota Tim</h4>
                            <div class="space-y-2">
                                <template x-for="m in (selectedProject ? selectedProject.members : [])" :key="m.index">
                                    <div class="flex items-center justify-between p-3 rounded-xl bg-zinc-50 border border-zinc-200/80">
                                        <div class="flex items-center space-x-3">
                                            <img :src="m.avatar" class="w-8 h-8 rounded-full object-cover">
                                            <span class="text-xs font-bold text-zinc-900" x-text="m.name"></span>
                                        </div>
                                        <span class="text-xs text-blue-700 font-medium" x-text="m.role"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="p-6 bg-zinc-50 border-t border-zinc-100 flex items-center justify-between">
                        <template x-if="selectedProject && selectedProject.live_url">
                            <a
                                :href="selectedProject.live_url"
                                target="_blank"
                                rel="noopener"
                                class="px-5 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs sm:text-sm font-semibold transition-colors inline-flex items-center space-x-2"
                            >
                                <span>Kunjungi Sistem Live</span>
                                <span>↗</span>
                            </a>
                        </template>
                        <button @click="selectedProject = null" class="text-xs font-medium text-zinc-600 hover:text-zinc-900 ml-auto">
                            Tutup Jendela
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================================
         4. COLLECTIVE TECH MATRIX (#specs)
         ========================================================================= -->
    <section id="specs" class="scroll-mt-24 space-y-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between pb-4 border-b border-zinc-200 gap-4">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">
                    Keahlian & Ekosistem Teknologi
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight text-zinc-900">
                    Matriks Penguasaan Stack Tim
                </h2>
            </div>
            <p class="text-sm text-zinc-500 max-w-md leading-relaxed">
                Pemetaan penguasaan bahasa pemrograman, framework, dan tools produksi di antara 6 spesialis kami.
            </p>
        </div>

        <!-- Modern Clean Table Card -->
        <div class="bg-white rounded-2xl border border-zinc-200/80 overflow-hidden shadow-xs">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm divide-y divide-zinc-200">
                    <thead class="bg-zinc-50 text-zinc-800 text-xs font-bold">
                        <tr class="divide-x divide-zinc-200">
                            <th class="py-4 px-6 w-72">Teknologi & Toolchain</th>
                            @foreach($members as $m)
                                <th class="py-4 px-3 text-center uppercase tracking-wider w-28 hover:bg-zinc-100 transition-colors">
                                    <a href="{{ route('portfolio.member', $m->slug) }}" class="block">
                                        <div class="font-bold text-zinc-900">{{ Str::words($m->name, 1, '') }}</div>
                                        <div class="text-[10px] text-zinc-500 font-normal">#{{ $m->index_number }}</div>
                                    </a>
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 text-xs">
                        @foreach($skillsByCategory as $category => $categorySkills)
                            <tr class="bg-zinc-100/70">
                                <td colspan="7" class="py-2.5 px-6 font-bold text-zinc-900 uppercase text-[11px] tracking-wider">
                                    {{ $category }}
                                </td>
                            </tr>
                            @foreach($categorySkills as $skill)
                                <tr class="divide-x divide-zinc-200 hover:bg-zinc-50 transition-colors">
                                    <td class="py-3 px-6 flex items-center space-x-3 text-zinc-900 font-medium">
                                        <svg class="w-4 h-4 text-zinc-600 fill-current shrink-0" viewBox="0 0 24 24">
                                            <path d="{{ $skill->svg_path }}"></path>
                                        </svg>
                                        <span>{{ $skill->name }}</span>
                                    </td>
                                    @foreach($members as $m)
                                        @php
                                            $hasSkill = $m->skills->contains('id', $skill->id);
                                        @endphp
                                        <td class="py-3 px-3 text-center">
                                            @if($hasSkill)
                                                <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-blue-50 text-blue-700 font-bold text-xs" title="{{ $m->name }} menguasai {{ $skill->name }}">
                                                    ✓
                                                </span>
                                            @else
                                                <span class="text-zinc-300">—</span>
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('hero-3d-canvas-wrap');
    if (!container || typeof THREE === 'undefined') return;

    // 1. Scene, Camera, Renderer
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    camera.position.z = 11.5;

    const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.shadowMap.enabled = true;
    container.appendChild(renderer.domElement);

    // 2. Multi-Point Studio Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 1.1);
    scene.add(ambientLight);

    const dirLight1 = new THREE.DirectionalLight(0xffffff, 2.2);
    dirLight1.position.set(8, 10, 8);
    scene.add(dirLight1);

    const dirLight2 = new THREE.DirectionalLight(0x2563eb, 3.2); // Brand Klein Blue accent rim light
    dirLight2.position.set(-8, -5, -4);
    scene.add(dirLight2);

    const dirLight3 = new THREE.DirectionalLight(0x38bdf8, 2.0); // Cyan rim light
    dirLight3.position.set(5, -6, -5);
    scene.add(dirLight3);

    const centerPointLight = new THREE.PointLight(0x60a5fa, 2.5, 14);
    centerPointLight.position.set(0, 0, 0);
    scene.add(centerPointLight);

    // 3. Central Kinetic 3D Group
    const modelGroup = new THREE.Group();
    scene.add(modelGroup);

    // Dynamic Position & Large Scale Offset (Shifted to Right - Zero Collision with Text & Viewport)
    let basePosX = 3.5;
    let basePosY = 0;
    let basePosZ = 0;
    let baseScale = 0.98;

    function updateModelPosition() {
        if (window.innerWidth >= 1280) {
            basePosX = 3.5;
            basePosY = 0;
            basePosZ = 0;
            baseScale = 0.98;
        } else if (window.innerWidth >= 1024) {
            basePosX = 3.1;
            basePosY = 0;
            basePosZ = -0.2;
            baseScale = 0.90;
        } else if (window.innerWidth >= 768) {
            basePosX = 2.2;
            basePosY = 0;
            basePosZ = -0.6;
            baseScale = 0.80;
        } else {
            basePosX = 0;
            basePosY = 0.2;
            basePosZ = -1.2;
            baseScale = 0.65;
        }
        modelGroup.position.set(basePosX, basePosY, basePosZ);
        modelGroup.scale.set(baseScale, baseScale, baseScale);
    }
    updateModelPosition();

    // 4. Kinetic 3D Sculptural Components
    // A. Outer Polyhedron Crystalline Shell (Midnight Obsidian with Mirror Speculars)
    const coreGeo = new THREE.IcosahedronGeometry(1.55, 1);
    const coreMat = new THREE.MeshPhysicalMaterial({
        color: 0x0f172a,
        metalness: 0.9,
        roughness: 0.15,
        clearcoat: 1.0,
        clearcoatRoughness: 0.1,
        reflectivity: 1.0,
        flatShading: true,
    });
    const coreMesh = new THREE.Mesh(coreGeo, coreMat);
    modelGroup.add(coreMesh);

    // B. Inner Glowing Chromatic Core
    const innerGeo = new THREE.OctahedronGeometry(1.0, 0);
    const innerMat = new THREE.MeshStandardMaterial({
        color: 0x1d4ed8,
        emissive: 0x3b82f6,
        emissiveIntensity: 0.95,
        metalness: 0.8,
        roughness: 0.2,
    });
    const innerMesh = new THREE.Mesh(innerGeo, innerMat);
    modelGroup.add(innerMesh);

    // C. Multi-Layered Neon Wireframe Lattice
    const wireframeGeo1 = new THREE.WireframeGeometry(coreGeo);
    const wireframeMat1 = new THREE.LineBasicMaterial({
        color: 0x60a5fa,
        transparent: true,
        opacity: 0.75,
    });
    const wireframe1 = new THREE.LineSegments(wireframeGeo1, wireframeMat1);
    wireframe1.scale.set(1.035, 1.035, 1.035);
    modelGroup.add(wireframe1);

    const wireframeGeo2 = new THREE.WireframeGeometry(new THREE.DodecahedronGeometry(2.05, 0));
    const wireframeMat2 = new THREE.LineBasicMaterial({
        color: 0x3b82f6,
        transparent: true,
        opacity: 0.35,
    });
    const wireframe2 = new THREE.LineSegments(wireframeGeo2, wireframeMat2);
    modelGroup.add(wireframe2);

    // D. Multi-Axis Gyroscopic Rings
    // Ring 1 (Polished Dark Chrome)
    const ring1Radius = 2.45;
    const ring1Geo = new THREE.TorusGeometry(ring1Radius, 0.045, 16, 120);
    const ring1Mat = new THREE.MeshStandardMaterial({
        color: 0x27272a,
        metalness: 0.95,
        roughness: 0.15,
    });
    const ring1 = new THREE.Mesh(ring1Geo, ring1Mat);
    ring1.rotation.x = Math.PI / 3;
    modelGroup.add(ring1);

    // Ring 2 (Electric Klein Blue)
    const ring2Radius = 2.85;
    const ring2Geo = new THREE.TorusGeometry(ring2Radius, 0.04, 16, 120);
    const ring2Mat = new THREE.MeshStandardMaterial({
        color: 0x2563eb,
        metalness: 0.85,
        roughness: 0.2,
    });
    const ring2 = new THREE.Mesh(ring2Geo, ring2Mat);
    ring2.rotation.y = Math.PI / 4;
    ring2.rotation.z = Math.PI / 6;
    modelGroup.add(ring2);

    // Ring 3 (Platinum Silver)
    const ring3Radius = 3.2;
    const ring3Geo = new THREE.TorusGeometry(ring3Radius, 0.03, 16, 120);
    const ring3Mat = new THREE.MeshStandardMaterial({
        color: 0xa1a1aa,
        metalness: 0.95,
        roughness: 0.1,
    });
    const ring3 = new THREE.Mesh(ring3Geo, ring3Mat);
    ring3.rotation.x = -Math.PI / 4;
    ring3.rotation.y = Math.PI / 3;
    modelGroup.add(ring3);

    // E. Orbiting Satellite Nodes (Beads Traveling Along the Rings)
    const satelliteGeo = new THREE.SphereGeometry(0.11, 16, 16);
    const satelliteMat = new THREE.MeshStandardMaterial({
        color: 0x93c5fd,
        emissive: 0x3b82f6,
        emissiveIntensity: 0.9,
        metalness: 0.9,
        roughness: 0.1,
    });

    const sat1 = new THREE.Mesh(satelliteGeo, satelliteMat);
    ring1.add(sat1);

    const sat2 = new THREE.Mesh(satelliteGeo, satelliteMat);
    ring2.add(sat2);

    const sat3 = new THREE.Mesh(satelliteGeo, satelliteMat);
    ring3.add(sat3);

    // 5. Constellation Micro-Particle Cloud (200 Particles)
    const particleCount = 200;
    const particleGeo = new THREE.BufferGeometry();
    const particlePositions = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount * 3; i += 3) {
        const radius = 2.0 + Math.random() * 3.0;
        const theta = Math.random() * Math.PI * 2;
        const phi = Math.acos((Math.random() * 2) - 1);
        particlePositions[i] = radius * Math.sin(phi) * Math.cos(theta);
        particlePositions[i + 1] = radius * Math.sin(phi) * Math.sin(theta);
        particlePositions[i + 2] = radius * Math.cos(phi);
    }

    particleGeo.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));
    const particleMat = new THREE.PointsMaterial({
        color: 0x3b82f6,
        size: 0.055,
        transparent: true,
        opacity: 0.75
    });
    const particles = new THREE.Points(particleGeo, particleMat);
    modelGroup.add(particles);

    // 6. Mouse Parallax & Interactive Drag
    let mouseX = 0;
    let mouseY = 0;
    let targetRotationX = 0;
    let targetRotationY = 0;
    let isDragging = false;
    let previousMousePosition = { x: 0, y: 0 };

    window.addEventListener('mousemove', function (e) {
        const rect = container.getBoundingClientRect();
        mouseX = ((e.clientX - rect.left) / container.clientWidth) * 2 - 1;
        mouseY = -(((e.clientY - rect.top) / container.clientHeight) * 2 - 1);
    });

    container.addEventListener('mousedown', function (e) {
        isDragging = true;
        previousMousePosition = { x: e.clientX, y: e.clientY };
    });

    window.addEventListener('mouseup', function () {
        isDragging = false;
    });

    window.addEventListener('mousemove', function (e) {
        if (!isDragging) return;
        const deltaX = e.clientX - previousMousePosition.x;
        const deltaY = e.clientY - previousMousePosition.y;

        targetRotationY += deltaX * 0.008;
        targetRotationX += deltaY * 0.008;

        previousMousePosition = { x: e.clientX, y: e.clientY };
    });

    // Touch Support
    container.addEventListener('touchstart', function (e) {
        if (e.touches.length === 1) {
            isDragging = true;
            previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
        }
    }, { passive: true });

    window.addEventListener('touchend', function () {
        isDragging = false;
    });

    window.addEventListener('touchmove', function (e) {
        if (!isDragging || e.touches.length !== 1) return;
        const deltaX = e.touches[0].clientX - previousMousePosition.x;
        const deltaY = e.touches[0].clientY - previousMousePosition.y;

        targetRotationY += deltaX * 0.008;
        targetRotationX += deltaY * 0.008;

        previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
    }, { passive: true });

    // 7. Window Resize Handler
    function onResize() {
        if (!container) return;
        const width = container.clientWidth;
        const height = container.clientHeight;
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
        updateModelPosition();
    }
    window.addEventListener('resize', onResize);

    // 8. Render Animation Loop
    const clock = new THREE.Clock();

    function animate() {
        requestAnimationFrame(animate);
        const elapsedTime = clock.getElapsedTime();

        if (!isDragging) {
            targetRotationY += 0.0035;
            targetRotationX = Math.sin(elapsedTime * 0.4) * 0.12 + (mouseY * 0.25);
            modelGroup.rotation.y += (targetRotationY + (mouseX * 0.25) - modelGroup.rotation.y) * 0.06;
            modelGroup.rotation.x += (targetRotationX - modelGroup.rotation.x) * 0.06;
        } else {
            modelGroup.rotation.y += (targetRotationY - modelGroup.rotation.y) * 0.15;
            modelGroup.rotation.x += (targetRotationX - modelGroup.rotation.x) * 0.15;
        }

        // Kinetic components relative rotation
        coreMesh.rotation.y = elapsedTime * 0.2;
        innerMesh.rotation.x = elapsedTime * 0.35;
        innerMesh.rotation.y = -elapsedTime * 0.4;
        wireframe1.rotation.y = -elapsedTime * 0.15;
        wireframe2.rotation.x = elapsedTime * 0.12;
        wireframe2.rotation.z = -elapsedTime * 0.18;
        ring1.rotation.z = elapsedTime * 0.25;
        ring2.rotation.x = -elapsedTime * 0.22;
        ring3.rotation.y = elapsedTime * 0.16;
        particles.rotation.y = -elapsedTime * 0.035;

        // Satellite beads orbital travel along the rings
        sat1.position.set(ring1Radius * Math.cos(elapsedTime * 1.6), ring1Radius * Math.sin(elapsedTime * 1.6), 0);
        sat2.position.set(ring2Radius * Math.cos(elapsedTime * -1.3), ring2Radius * Math.sin(elapsedTime * -1.3), 0);
        sat3.position.set(ring3Radius * Math.cos(elapsedTime * 1.0), ring3Radius * Math.sin(elapsedTime * 1.0), 0);

        // Subtle floating bobbing effect around base position
        modelGroup.position.y = basePosY + Math.sin(elapsedTime * 1.1) * 0.08;
        modelGroup.position.x = basePosX;
        modelGroup.position.z = basePosZ;

        renderer.render(scene, camera);
    }
    animate();
});
</script>
@endpush
@endsection
