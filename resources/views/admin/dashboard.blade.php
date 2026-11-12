@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8" x-data="{ searchQuery: '', activeCategory: 'all' }">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-brand-200/80">
        <div>
            <div class="flex items-center space-x-2 text-xs font-medium text-brand-500 mb-1">
                <span>Rekayasa Perangkat Lunak</span>
                <span>•</span>
                <span>SMKN 1 Ciamis</span>
            </div>
            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight text-brand-950">
                Dashboard Tim
            </h1>
            <p class="text-sm text-brand-500 mt-1">
                Selamat datang di panel admin IdihSebel. Kelola profil anggota tim dan portofolio karya di sini.
            </p>
        </div>
        <div class="flex items-center space-x-2.5 shrink-0">
            <a 
                href="{{ route('admin.projects.create') }}" 
                class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-brand-950 hover:bg-brand-900 text-white text-xs font-semibold shadow-xs transition-colors cursor-pointer"
            >
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Proyek</span>
            </a>
            <a 
                href="{{ route('portfolio.index') }}" 
                target="_blank"
                class="inline-flex items-center space-x-1.5 px-4 py-2.5 rounded-xl bg-white hover:bg-brand-50 text-brand-700 border border-brand-200 text-xs font-semibold shadow-2xs transition-colors"
            >
                <span>Lihat Website</span>
                <svg class="w-3.5 h-3.5 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
            </a>
        </div>
    </div>

    <!-- STATS CARDS (CLEAN MODERN TILES) -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        
        <!-- Total Anggota -->
        <div class="bg-white rounded-2xl border border-brand-200/80 p-5 space-y-3 shadow-2xs hover:shadow-xs transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-brand-500">Total Anggota</span>
                <div class="w-8 h-8 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold tracking-tight text-brand-950">{{ $stats['total_members'] }} Orang</div>
                <div class="text-xs text-brand-500 mt-1">Tim Inti RPL SMKN 1 Ciamis</div>
            </div>
        </div>

        <!-- Proyek Portofolio -->
        <div class="bg-white rounded-2xl border border-brand-200/80 p-5 space-y-3 shadow-2xs hover:shadow-xs transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-brand-500">Portofolio Proyek</span>
                <div class="w-8 h-8 rounded-xl bg-violet-50 text-violet-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
                        <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold tracking-tight text-brand-950">{{ $stats['total_projects'] }} Proyek</div>
                <div class="text-xs text-brand-500 mt-1">Tampil di halaman depan</div>
            </div>
        </div>

        <!-- Kesiapan Tim -->
        <div class="bg-white rounded-2xl border border-brand-200/80 p-5 space-y-3 shadow-2xs hover:shadow-xs transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-brand-500">Status Kesiapan</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold tracking-tight text-emerald-600">{{ $stats['available_members'] }} dari {{ $stats['total_members'] }} Siap</div>
                <div class="text-xs text-brand-500 mt-1">Siap menerima tawaran proyek</div>
            </div>
        </div>

        <!-- Keahlian Teknologi -->
        <div class="bg-white rounded-2xl border border-brand-200/80 p-5 space-y-3 shadow-2xs hover:shadow-xs transition-shadow">
            <div class="flex items-center justify-between">
                <span class="text-xs font-medium text-brand-500">Keahlian & Tools</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                        <polyline points="2 17 12 22 22 17"></polyline>
                        <polyline points="2 12 12 17 22 12"></polyline>
                    </svg>
                </div>
            </div>
            <div>
                <div class="text-2xl font-bold tracking-tight text-brand-950">{{ $stats['total_skills'] }} Keahlian</div>
                <div class="text-xs text-brand-500 mt-1">Web, Mobile, Backend & Cloud</div>
            </div>
        </div>

    </div>

    <!-- =========================================================================
         SECTION 1: ANGGOTA TIM
         ========================================================================= -->
    <section id="members-section" class="space-y-4 pt-2">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-2 border-b border-brand-200/80">
            <div>
                <h2 class="text-lg font-bold text-brand-950 flex items-center space-x-2">
                    <span>Anggota Tim</span>
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-100 text-brand-700">
                        6 Anggota
                    </span>
                </h2>
                <p class="text-xs text-brand-500 mt-0.5">
                    Kelola foto resmi, keahlian teknologi, dan informasi kontak masing-masing anggota.
                </p>
            </div>
            <span class="text-xs text-brand-400">Tersinkronisasi ke MySQL</span>
        </div>

        <!-- 6 Member Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($members as $member)
                <div class="bg-white rounded-2xl border border-brand-200/80 p-5 flex flex-col justify-between space-y-4 shadow-2xs hover:shadow-xs hover:border-brand-300 transition-all overflow-hidden min-w-0">
                    
                    <div class="space-y-3.5 min-w-0">
                        <!-- Top Header: Avatar + Status + Name -->
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex items-center space-x-3.5 min-w-0">
                                
                                <!-- Exact Fixed Avatar Container (Never Blows Up) -->
                                <div class="relative shrink-0 w-12 h-12" style="width: 48px; height: 48px;">
                                    @if ($member->avatar_url)
                                        <img 
                                            src="{{ $member->avatar_url }}" 
                                            alt="{{ $member->name }}" 
                                            class="w-12 h-12 rounded-xl object-cover ring-2 ring-brand-100 bg-brand-50 shadow-2xs shrink-0 block"
                                            style="width: 48px; height: 48px; max-width: 48px; max-height: 48px; object-fit: cover;"
                                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=0f172a&color=ffffff&size=160';"
                                        >
                                    @else
                                        <div class="w-12 h-12 rounded-xl bg-brand-950 text-white font-bold text-sm flex items-center justify-center shadow-2xs shrink-0" style="width: 48px; height: 48px;">
                                            {{ strtoupper(substr($member->name, 0, 2)) }}
                                        </div>
                                    @endif

                                    <!-- Online Status Badge -->
                                    <span 
                                        class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full border-2 border-white {{ $member->is_available ? 'bg-emerald-500' : 'bg-brand-300' }}"
                                        title="{{ $member->is_available ? 'Siap Mengerjakan Proyek' : 'Sedang Fokus Tugas' }}"
                                    ></span>
                                </div>

                                <!-- Name & Role -->
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center space-x-1.5">
                                        <h3 class="text-sm font-bold text-brand-950 tracking-tight leading-tight truncate">
                                            {{ $member->name }}
                                        </h3>
                                        <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded-md bg-brand-100 text-brand-600 shrink-0">
                                            #{{ sprintf('%02d', $member->index_number) }}
                                        </span>
                                    </div>
                                    <div class="text-xs text-brand-600 font-medium truncate mt-0.5">
                                        {{ $member->role }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Specialization Pill -->
                        <div class="text-xs text-brand-700 bg-brand-50 px-3 py-1.5 rounded-xl border border-brand-100 truncate">
                            {{ $member->specialization }}
                        </div>

                        <!-- Short Bio -->
                        <p class="text-xs text-brand-600 line-clamp-2 leading-relaxed">
                            {{ $member->short_bio }}
                        </p>

                        <!-- Tech Stack Tags -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @foreach ($member->skills->take(3) as $skill)
                                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-brand-100 text-brand-700">
                                    {{ $skill->name }}
                                </span>
                            @endforeach
                            @if ($member->skills->count() > 3)
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-medium text-brand-400 bg-brand-50">
                                    +{{ $member->skills->count() - 3 }} lainnya
                                </span>
                            @endif
                        </div>

                        <!-- Location & Skills Count -->
                        <div class="pt-2.5 border-t border-brand-100 flex items-center justify-between text-xs text-brand-500">
                            <span>{{ $member->location }}</span>
                            <span>{{ $member->skills->count() }} Keahlian</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="pt-2 flex items-center space-x-2 border-t border-brand-100">
                        <a 
                            href="{{ route('admin.members.edit', $member) }}" 
                            class="flex-1 py-2 px-3 rounded-xl bg-brand-950 hover:bg-brand-900 text-white text-xs font-semibold text-center transition-colors flex items-center justify-center space-x-1.5 shadow-2xs cursor-pointer"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                            <span>Edit Profil & Foto</span>
                        </a>
                        <a 
                            href="{{ route('portfolio.member', $member->slug) }}" 
                            target="_blank"
                            class="p-2 rounded-xl border border-brand-200 text-brand-500 hover:text-brand-900 hover:bg-brand-50 transition-colors"
                            title="Lihat Halaman Anggota"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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

    <!-- =========================================================================
         SECTION 2: PORTOFOLIO PROYEK
         ========================================================================= -->
    <section id="projects-section" class="space-y-4 pt-4">
        
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 pb-2 border-b border-brand-200/80">
            <div>
                <h2 class="text-lg font-bold text-brand-950">
                    Portofolio Proyek
                </h2>
                <p class="text-xs text-brand-500 mt-0.5">
                    Daftar karya aplikasi, website, dan sistem yang dipamerkan kepada publik.
                </p>
            </div>
            <div class="flex items-center space-x-2">
                <a 
                    href="{{ route('admin.projects.create') }}" 
                    class="inline-flex items-center space-x-1.5 px-3.5 py-2 rounded-xl bg-brand-950 hover:bg-brand-900 text-white text-xs font-semibold shadow-xs transition-colors cursor-pointer"
                >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Proyek Baru</span>
                </a>
            </div>
        </div>

        <!-- Filter & Search Toolbar -->
        <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3 p-3 bg-white rounded-2xl border border-brand-200/80 text-xs shadow-2xs">
            <!-- Search Input -->
            <div class="relative flex-1 max-w-sm">
                <svg class="w-4 h-4 text-brand-400 absolute left-3.5 top-1/2 -translate-y-1/2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input 
                    type="text" 
                    x-model="searchQuery" 
                    placeholder="Cari judul proyek, kategori, atau teknologi..."
                    class="w-full pl-9 pr-3.5 py-2 rounded-xl border border-brand-200 text-xs text-brand-900 placeholder-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                >
            </div>

            <!-- Category Filter Pills -->
            <div class="flex items-center space-x-1.5 overflow-x-auto scrollbar-none font-medium">
                <button 
                    @click="activeCategory = 'all'" 
                    :class="activeCategory === 'all' ? 'bg-brand-950 text-white shadow-2xs' : 'text-brand-600 hover:bg-brand-100'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition-colors cursor-pointer"
                >
                    Semua ({{ count($projects) }})
                </button>
                <button 
                    @click="activeCategory = 'featured'" 
                    :class="activeCategory === 'featured' ? 'bg-brand-950 text-white shadow-2xs' : 'text-brand-600 hover:bg-brand-100'"
                    class="px-3.5 py-1.5 rounded-xl text-xs transition-colors cursor-pointer"
                >
                    Unggulan ⭐
                </button>
            </div>
        </div>

        <!-- Projects Grid / Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($projects as $project)
                <div 
                    x-show="
                        (searchQuery === '' || '{{ strtolower($project->title) }}'.includes(searchQuery.toLowerCase()) || '{{ strtolower($project->category) }}'.includes(searchQuery.toLowerCase())) &&
                        (activeCategory === 'all' || (activeCategory === 'featured' && {{ $project->is_featured ? 'true' : 'false' }}))
                    "
                    class="bg-white rounded-2xl border border-brand-200/80 overflow-hidden flex flex-col justify-between shadow-2xs hover:shadow-xs hover:border-brand-300 transition-all group min-w-0"
                >
                    <div>
                        <!-- Thumbnail Preview -->
                        <div class="relative h-44 bg-brand-100 overflow-hidden border-b border-brand-100">
                            <img 
                                src="{{ $project->thumbnail_url }}" 
                                alt="{{ $project->title }}" 
                                class="w-full h-full object-cover group-hover:scale-102 transition-transform duration-300"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=800&q=80';"
                            >
                            <div class="absolute top-2.5 left-2.5 flex items-center gap-1.5">
                                <span class="px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-brand-950/85 backdrop-blur-xs text-white">
                                    {{ $project->category }}
                                </span>
                                @if ($project->is_featured)
                                    <span class="px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-blue-600 text-white">
                                        Unggulan
                                    </span>
                                @endif
                            </div>
                            <span class="absolute top-2.5 right-2.5 px-2.5 py-1 rounded-lg text-[11px] font-semibold bg-white/95 backdrop-blur-xs text-brand-900 border border-brand-200">
                                {{ $project->year }}
                            </span>
                        </div>

                        <!-- Card Body -->
                        <div class="p-5 space-y-3 min-w-0">
                            <div class="space-y-1">
                                <div class="text-xs text-brand-400 font-medium truncate">{{ $project->client_or_context }}</div>
                                <h3 class="text-base font-bold text-brand-950 tracking-tight leading-snug truncate">
                                    {{ $project->title }}
                                </h3>
                            </div>

                            <p class="text-xs text-brand-600 line-clamp-2 leading-relaxed">
                                {{ $project->summary }}
                            </p>

                            <!-- Tech Stack Pills -->
                            @if (!empty($project->tech_stack))
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    @foreach (array_slice((array)$project->tech_stack, 0, 3) as $tech)
                                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-brand-100 text-brand-700">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                    @if (count((array)$project->tech_stack) > 3)
                                        <span class="px-2 py-0.5 rounded-full text-[11px] font-medium text-brand-400 bg-brand-50">
                                            +{{ count((array)$project->tech_stack) - 3 }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <!-- Collaborator Avatars -->
                            <div class="pt-3 border-t border-brand-100 flex items-center justify-between text-xs text-brand-500">
                                <span class="text-xs text-brand-400">Kontributor:</span>
                                <div class="flex -space-x-1.5 overflow-hidden">
                                    @forelse ($project->members as $collab)
                                        <img 
                                            class="inline-block h-6 w-6 rounded-full ring-2 ring-white object-cover bg-brand-200" 
                                            src="{{ $collab->avatar_url }}" 
                                            alt="{{ $collab->name }}"
                                            title="{{ $collab->name }} ({{ $collab->pivot->specific_role ?? 'Engineer' }})"
                                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($collab->name) }}&size=64';"
                                        >
                                    @empty
                                        <span class="text-xs text-brand-400 italic">Belum dipilih</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-5 pt-0 flex items-center space-x-2">
                        <a 
                            href="{{ route('admin.projects.edit', $project) }}" 
                            class="flex-1 py-2 px-3 rounded-xl bg-brand-100 hover:bg-brand-200 text-brand-900 font-semibold text-xs text-center transition-colors flex items-center justify-center space-x-1.5"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                            <span>Edit Proyek</span>
                        </a>

                        <a 
                            href="{{ $project->live_url ?: (route('portfolio.index') . '#works') }}" 
                            target="_blank"
                            class="p-2 rounded-xl border border-brand-200 text-brand-500 hover:text-brand-900 hover:bg-brand-50 transition-colors"
                            title="Lihat Proyek di Website"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                <polyline points="15 3 21 3 21 9"></polyline>
                                <line x1="10" y1="14" x2="21" y2="3"></line>
                            </svg>
                        </a>

                        <form 
                            action="{{ route('admin.projects.destroy', $project) }}" 
                            method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek &quot;{{ $project->title }}&quot;? Tindakan ini permanen di database.');"
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="p-2 rounded-xl border border-brand-200 text-brand-400 hover:text-rose-600 hover:bg-rose-50 hover:border-rose-200 transition-colors cursor-pointer"
                                title="Hapus Proyek"
                            >
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-brand-200">
                    <p class="text-brand-500 text-xs">Belum ada proyek portofolio yang tersimpan.</p>
                </div>
            @endforelse
        </div>
    </section>

    <!-- =========================================================================
         SECTION 3: STATUS DATABASE
         ========================================================================= -->
    <div class="p-5 rounded-2xl bg-white border border-brand-200/80 shadow-2xs flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 text-xs">
        <div class="flex items-center space-x-3.5">
            <div class="w-10 h-10 rounded-xl bg-brand-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-brand-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <ellipse cx="12" cy="5" rx="9" ry="3"></ellipse>
                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"></path>
                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"></path>
                </svg>
            </div>
            <div>
                <div class="font-bold text-brand-950 flex items-center space-x-2">
                    <span>Database MySQL: `idihsebel`</span>
                    <span class="inline-flex items-center space-x-1 px-2.5 py-0.5 rounded-full text-[11px] font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                        <span>Aktif & Tersinkron</span>
                    </span>
                </div>
                <div class="text-brand-500 text-xs mt-0.5">
                    Semua perubahan profil, foto, portofolio, dan kata sandi admin tersimpan langsung ke database.
                </div>
            </div>
        </div>

        <div class="flex items-center space-x-2 w-full sm:w-auto">
            <a 
                href="{{ route('admin.profile') }}" 
                class="w-full sm:w-auto px-4 py-2 rounded-xl bg-brand-100 hover:bg-brand-200 text-brand-900 font-semibold text-xs text-center transition-colors"
            >
                Kelola Profil Admin
            </a>
        </div>
    </div>

</div>
@endsection
