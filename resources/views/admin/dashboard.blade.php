@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-10" x-data="{ searchQuery: '', activeCategory: 'all' }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-studio-200">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-studio-950">
                Studio Management Console
            </h1>
            <p class="text-xs sm:text-sm text-studio-500 mt-1">
                Kelola profil 6 software engineer SMKN 1 Ciamis RPL, perbarui foto, keahlian, dan portofolio proyek.
            </p>
        </div>
        <div class="flex items-center space-x-2.5">
            <a 
                href="{{ route('admin.projects.create') }}" 
                class="inline-flex items-center space-x-1.5 px-3.5 py-2 rounded-lg bg-studio-950 hover:bg-studio-900 text-white text-xs font-semibold shadow-xs transition-colors"
            >
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Proyek</span>
            </a>
            <a 
                href="{{ route('portfolio.index') }}" 
                target="_blank"
                class="inline-flex items-center space-x-1 px-3 py-2 rounded-lg bg-white hover:bg-studio-50 text-studio-700 border border-studio-200 text-xs font-medium transition-colors"
            >
                <span>Preview Web</span>
                <svg class="w-3.5 h-3.5 text-studio-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
            </a>
        </div>
    </div>

    <!-- METRIC METRICS (CLEAN SaaS STUDIO TILES) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <div class="bg-white rounded-xl border border-studio-200 p-5 space-y-2 shadow-2xs">
            <div class="text-[11px] font-mono uppercase tracking-wider text-studio-400">Anggota Kolektif</div>
            <div class="flex items-baseline space-x-2">
                <span class="text-2xl sm:text-3xl font-bold font-mono tracking-tight text-studio-950">{{ sprintf('%02d', $stats['total_members']) }}</span>
                <span class="text-xs text-studio-500 font-medium">Spesialis</span>
            </div>
            <div class="text-[11px] text-studio-500 flex items-center space-x-1.5 pt-1 border-t border-studio-100">
                <span class="w-1.5 h-1.5 rounded-full bg-studio-400"></span>
                <span>SMKN 1 Ciamis (RPL)</span>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-studio-200 p-5 space-y-2 shadow-2xs">
            <div class="text-[11px] font-mono uppercase tracking-wider text-studio-400">Proyek Portofolio</div>
            <div class="flex items-baseline space-x-2">
                <span class="text-2xl sm:text-3xl font-bold font-mono tracking-tight text-studio-950">{{ sprintf('%02d', $stats['total_projects']) }}</span>
                <span class="text-xs text-studio-500 font-medium">Sistem Terbit</span>
            </div>
            <div class="text-[11px] text-studio-500 flex items-center space-x-1.5 pt-1 border-t border-studio-100">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                <span>Web, POS, ERP & Mobile</span>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-studio-200 p-5 space-y-2 shadow-2xs">
            <div class="text-[11px] font-mono uppercase tracking-wider text-studio-400">Status Ketersediaan</div>
            <div class="flex items-baseline space-x-2">
                <span class="text-2xl sm:text-3xl font-bold font-mono tracking-tight text-emerald-600">{{ sprintf('%02d', $stats['available_members']) }}</span>
                <span class="text-xs text-studio-500 font-medium">/ 06 Tersedia</span>
            </div>
            <div class="text-[11px] text-studio-500 flex items-center space-x-1.5 pt-1 border-t border-studio-100">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                <span>Siap Kolaborasi Proyek</span>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-studio-200 p-5 space-y-2 shadow-2xs">
            <div class="text-[11px] font-mono uppercase tracking-wider text-studio-400">Matriks Keahlian</div>
            <div class="flex items-baseline space-x-2">
                <span class="text-2xl sm:text-3xl font-bold font-mono tracking-tight text-studio-950">{{ $stats['total_skills'] }}</span>
                <span class="text-xs text-studio-500 font-medium">Teknologi</span>
            </div>
            <div class="text-[11px] text-studio-500 flex items-center space-x-1.5 pt-1 border-t border-studio-100">
                <span class="w-1.5 h-1.5 rounded-full bg-studio-400"></span>
                <span>Full-Stack, Cloud & DevOps</span>
            </div>
        </div>

    </div>

    <!-- SECTION 1: 6 MEMBERS ROSTER MANAGEMENT -->
    <section id="members-section" class="space-y-4">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-studio-200">
            <div>
                <h2 class="text-base font-bold text-studio-950">
                    Profil 6 Anggota Tim
                </h2>
                <p class="text-xs text-studio-500">
                    Spesialis Rekayasa Perangkat Lunak lulusan SMKN 1 Ciamis (5 Pria, 1 Wanita).
                </p>
            </div>
            <span class="text-xs font-mono text-studio-400">6 Akun Terdaftar</span>
        </div>

        <!-- 6 Members Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($members as $member)
                <div class="bg-white rounded-xl border border-studio-200 p-5 flex flex-col justify-between space-y-4 shadow-2xs hover:border-studio-300 transition-colors">
                    
                    <div class="space-y-3">
                        <!-- Top Header: Avatar + Index + Status -->
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <!-- Avatar -->
                                <div class="relative shrink-0">
                                    @if ($member->avatar_url)
                                        <img 
                                            src="{{ $member->avatar_url }}" 
                                            alt="{{ $member->name }}" 
                                            class="w-12 h-12 rounded-lg object-cover border border-studio-200 bg-studio-100"
                                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=09090b&color=ffffff&size=128';"
                                        >
                                    @else
                                        <div class="w-12 h-12 rounded-lg bg-studio-950 text-white font-mono font-bold text-sm flex items-center justify-center">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                    @endif

                                    <!-- Status Dot -->
                                    <span 
                                        class="absolute -bottom-1 -right-1 w-3 h-3 rounded-full border-2 border-white {{ $member->is_available ? 'bg-emerald-500' : 'bg-studio-300' }}"
                                        title="{{ $member->is_available ? 'Tersedia' : 'Sibuk' }}"
                                    ></span>
                                </div>

                                <!-- Name & Role -->
                                <div>
                                    <div class="flex items-center space-x-1.5">
                                        <h3 class="text-sm font-bold text-studio-950 tracking-tight leading-tight">
                                            {{ $member->name }}
                                        </h3>
                                        <span class="font-mono text-[10px] font-semibold px-1.5 py-0.2 rounded bg-studio-100 text-studio-600 border border-studio-200">
                                            #{{ sprintf('%02d', $member->index_number) }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-studio-600 font-medium line-clamp-1 mt-0.5">
                                        {{ $member->role }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Specialization Chip -->
                        <div class="text-[11px] text-studio-500 bg-studio-50 px-2.5 py-1.5 rounded-lg border border-studio-100 line-clamp-1 font-mono">
                            {{ $member->specialization }}
                        </div>

                        <!-- Bio Excerpt -->
                        <p class="text-xs text-studio-600 line-clamp-2 leading-relaxed">
                            {{ $member->short_bio }}
                        </p>

                        <!-- Metadata Badges -->
                        <div class="pt-2 border-t border-studio-100 flex items-center justify-between text-[11px] text-studio-500 font-mono">
                            <span>{{ $member->location }}</span>
                            <span>{{ $member->skills->count() }} Tech Skills</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-2 flex items-center space-x-2 border-t border-studio-100">
                        <a 
                            href="{{ route('admin.members.edit', $member) }}" 
                            class="flex-1 py-1.5 px-3 rounded-lg bg-studio-950 hover:bg-studio-900 text-white text-xs font-medium text-center transition-colors flex items-center justify-center space-x-1.5 shadow-2xs"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                            <span>Edit Profil & Foto</span>
                        </a>
                        <a 
                            href="{{ route('portfolio.member', $member->slug) }}" 
                            target="_blank"
                            class="p-1.5 rounded-lg border border-studio-200 text-studio-500 hover:text-studio-900 hover:bg-studio-50 transition-colors"
                            title="Buka Halaman Profil Publik"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    </section>

    <!-- SECTION 2: PORTFOLIO PROJECTS MANAGEMENT -->
    <section id="projects-section" class="space-y-4 pt-4">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-studio-200">
            <div>
                <h2 class="text-base font-bold text-studio-950">
                    Katalog Portofolio & Proyek
                </h2>
                <p class="text-xs text-studio-500">
                    Daftar proyek sistem digital, web aplikasi, dan studi kasus tim.
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <a 
                    href="{{ route('admin.projects.create') }}" 
                    class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-studio-950 hover:bg-studio-900 text-white text-xs font-semibold shadow-xs transition-colors"
                >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Proyek</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 p-3 bg-white rounded-xl border border-studio-200 text-xs">
            <!-- Search Input -->
            <div class="relative flex-1 max-w-sm">
                <svg class="w-3.5 h-3.5 text-studio-400 absolute left-3 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="Cari proyek berdasarkan judul atau kategori..."
                    class="w-full pl-8 pr-3 py-1.5 rounded-lg border border-studio-200 text-xs text-studio-900 placeholder-studio-400 focus:outline-none focus:ring-1 focus:ring-studio-950 focus:border-studio-950"
                >
            </div>

            <!-- Category Pills -->
            <div class="flex items-center space-x-1 overflow-x-auto scrollbar-none font-medium">
                <button 
                    @click="activeCategory = 'all'" 
                    :class="activeCategory === 'all' ? 'bg-studio-950 text-white' : 'text-studio-600 hover:bg-studio-100'"
                    class="px-2.5 py-1 rounded text-xs transition-colors"
                >
                    Semua
                </button>
                <button 
                    @click="activeCategory = 'featured'" 
                    :class="activeCategory === 'featured' ? 'bg-studio-950 text-white' : 'text-studio-600 hover:bg-studio-100'"
                    class="px-2.5 py-1 rounded text-xs transition-colors"
                >
                    Unggulan
                </button>
            </div>
        </div>

        <!-- Projects Grid / Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($projects as $project)
                <div 
                    x-show="
                        (searchQuery === '' || '{{ strtolower($project->title) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($project->category) }}'.includes(searchQuery.toLowerCase())) &&
                        (activeCategory === 'all' || (activeCategory === 'featured' && {{ $project->is_featured ? 'true' : 'false' }}))
                    "
                    class="bg-white rounded-xl border border-studio-200 overflow-hidden flex flex-col justify-between shadow-2xs hover:border-studio-300 transition-colors"
                >
                    <div>
                        <!-- Thumbnail Preview -->
                        <div class="relative h-40 bg-studio-100 overflow-hidden border-b border-studio-100">
                            <img 
                                src="{{ $project->thumbnail_url }}" 
                                alt="{{ $project->title }}" 
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=800&q=80';"
                            >
                            <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5">
                                <span class="px-2 py-0.5 rounded text-[10px] font-mono font-semibold bg-studio-950/80 backdrop-blur-xs text-white">
                                    {{ $project->category }}
                                </span>
                                @if ($project->is_featured)
                                    <span class="px-2 py-0.5 rounded text-[10px] font-mono font-semibold bg-blue-600 text-white uppercase tracking-wider">
                                        Featured
                                    </span>
                                @endif
                            </div>
                            <span class="absolute top-2.5 right-2.5 px-2 py-0.5 rounded text-[10px] font-mono font-bold bg-white/90 backdrop-blur-xs text-studio-900 border border-studio-200">
                                {{ $project->year }}
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3">
                            <div class="space-y-1">
                                <div class="text-[11px] font-mono text-studio-400">{{ $project->client_or_context }}</div>
                                <h3 class="text-sm font-bold text-studio-950 tracking-tight leading-snug line-clamp-1">
                                    {{ $project->title }}
                                </h3>
                            </div>

                            <p class="text-xs text-studio-600 line-clamp-2 leading-relaxed">
                                {{ $project->summary }}
                            </p>

                            <!-- Tech Stack Pills -->
                            @if (!empty($project->tech_stack))
                                <div class="flex flex-wrap gap-1 pt-1">
                                    @foreach (array_slice((array)$project->tech_stack, 0, 3) as $tech)
                                        <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-studio-100 text-studio-700">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                    @if (count((array)$project->tech_stack) > 3)
                                        <span class="px-1 py-0.5 rounded text-[10px] font-mono text-studio-400">
                                            +{{ count((array)$project->tech_stack) - 3 }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <!-- Collaborator Avatars -->
                            <div class="pt-3 border-t border-studio-100 flex items-center justify-between text-xs text-studio-500">
                                <span class="text-[11px] font-mono text-studio-400">Kontributor:</span>
                                <div class="flex -space-x-1.5 overflow-hidden">
                                    @forelse ($project->members as $collab)
                                        <img 
                                            class="inline-block h-6 w-6 rounded-full ring-2 ring-white object-cover bg-studio-200" 
                                            src="{{ $collab->avatar_url }}" 
                                            alt="{{ $collab->name }}"
                                            title="{{ $collab->name }} ({{ $collab->pivot->specific_role ?? 'Engineer' }})"
                                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($collab->name) }}&size=64';"
                                        >
                                    @empty
                                        <span class="text-[11px] text-studio-400 italic">Belum ada</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-5 pt-0 flex items-center space-x-2">
                        <a 
                            href="{{ route('admin.projects.edit', $project) }}" 
                            class="flex-1 py-1.5 px-3 rounded-lg bg-studio-100 hover:bg-studio-200 text-studio-900 font-medium text-xs text-center transition-colors flex items-center justify-center space-x-1.5"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                            <span>Edit Proyek</span>
                        </a>

                        <form 
                            action="{{ route('admin.projects.destroy', $project) }}" 
                            method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek &quot;{{ $project->title }}&quot; dari portofolio? Tindakan ini permanen.');"
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="p-1.5 rounded-lg border border-studio-200 text-studio-400 hover:text-red-600 hover:bg-red-50 hover:border-red-200 transition-colors"
                                title="Hapus Proyek"
                            >
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>

                </div>
            @empty
                <div class="col-span-full py-12 text-center bg-white rounded-xl border border-studio-200">
                    <p class="text-studio-500 text-xs">Belum ada proyek portofolio yang tersimpan.</p>
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection
