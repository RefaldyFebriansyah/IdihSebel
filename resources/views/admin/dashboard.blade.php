@extends('layouts.admin')

@section('title', 'Dashboard Overview')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-12">

    <!-- PAGE HEADER -->
    <div class="flex flex-col md:flex-row md:items-center justify-between pb-6 border-b border-zinc-200 gap-4">
        <div>
            <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">
                Panel Kontrol IdihSebel
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900">
                Ringkasan & Pengelolaan Portofolio
            </h1>
            <p class="text-sm text-zinc-500 mt-1">
                Perbarui data 6 anggota tim SMKN 1 Ciamis RPL, unggah foto baru, serta kelola proyek portofolio.
            </p>
        </div>
        <div class="flex items-center space-x-3">
            <a 
                href="{{ route('admin.projects.create') }}" 
                class="inline-flex items-center space-x-2 px-5 py-2.5 rounded-xl bg-zinc-950 hover:bg-zinc-800 text-white text-xs sm:text-sm font-bold shadow-xs hover:shadow-md transition-all active:scale-95"
            >
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                <span>Tambah Proyek Baru</span>
            </a>
            <a 
                href="{{ route('portfolio.index') }}" 
                target="_blank"
                class="inline-flex items-center space-x-2 px-4 py-2.5 rounded-xl bg-white hover:bg-zinc-50 text-zinc-700 border border-zinc-200 text-xs sm:text-sm font-semibold transition-all"
            >
                <span>Lihat Web Portofolio</span>
                <span>↗</span>
            </a>
        </div>
    </div>

    <!-- METRIC STATS OVERVIEW -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white rounded-2xl border border-zinc-200 p-6 space-y-1 shadow-2xs">
            <div class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Anggota Terdaftar</div>
            <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-zinc-950">{{ sprintf('%02d', $stats['total_members']) }}</div>
            <div class="text-xs text-zinc-500">SMKN 1 Ciamis (RPL)</div>
        </div>

        <div class="bg-white rounded-2xl border border-zinc-200 p-6 space-y-1 shadow-2xs">
            <div class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Total Proyek Portofolio</div>
            <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-zinc-950">{{ sprintf('%02d', $stats['total_projects']) }}</div>
            <div class="text-xs text-zinc-500">Web, Sistem & Mobile</div>
        </div>

        <div class="bg-white rounded-2xl border border-zinc-200 p-6 space-y-1 shadow-2xs">
            <div class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Status Ketersediaan</div>
            <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-emerald-600">{{ sprintf('%02d', $stats['available_members']) }} / 06</div>
            <div class="text-xs text-zinc-500">Siap Terima Proyek Baru</div>
        </div>

        <div class="bg-white rounded-2xl border border-zinc-200 p-6 space-y-1 shadow-2xs">
            <div class="text-xs font-semibold uppercase tracking-wider text-zinc-400">Total Keahlian & Stack</div>
            <div class="text-3xl sm:text-4xl font-extrabold tracking-tight text-blue-600">{{ $stats['total_skills'] }}</div>
            <div class="text-xs text-zinc-500">PHP, Laravel, JS, Vue, Flutter, dll</div>
        </div>
    </div>

    <!-- SECTION 1: 6 MEMBERS PROFILE MANAGEMENT -->
    <section id="members-section" class="space-y-6 pt-4">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 pb-3 border-b border-zinc-200">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Manajemen Anggota</span>
                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-zinc-900">
                    Profil 6 Anggota Tim IdihSebel
                </h2>
            </div>
            <p class="text-xs sm:text-sm text-zinc-500">
                Pilih anggota di bawah ini untuk mengubah foto profil, biografi, keahlian, dan kontak.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($members as $member)
                <div class="bg-white rounded-3xl border border-zinc-200 p-6 flex flex-col justify-between space-y-5 shadow-2xs hover:shadow-md hover:border-zinc-300 transition-all">
                    
                    <!-- Member Card Top -->
                    <div class="space-y-4">
                        <div class="flex items-start justify-between">
                            <!-- Avatar Preview -->
                            <div class="relative">
                                @if ($member->avatar_url)
                                    <img 
                                        src="{{ $member->avatar_url }}" 
                                        alt="{{ $member->name }}" 
                                        class="w-16 h-16 rounded-2xl object-cover border border-zinc-200 shadow-2xs bg-zinc-100"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=09090b&color=ffffff&size=128';"
                                    >
                                @else
                                    <div class="w-16 h-16 rounded-2xl bg-zinc-900 text-white font-extrabold text-xl flex items-center justify-center">
                                        {{ strtoupper(substr($member->name, 0, 2)) }}
                                    </div>
                                @endif
                                <span class="absolute -top-2 -right-2 px-2 py-0.5 rounded-full bg-zinc-900 text-white font-mono text-[10px] font-bold">
                                    #{{ sprintf('%02d', $member->index_number) }}
                                </span>
                            </div>

                            <!-- Availability Badge -->
                            <div>
                                @if ($member->is_available)
                                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        <span>Tersedia</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-zinc-100 text-zinc-600 border border-zinc-200">
                                        <span>Sibuk</span>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Info Details -->
                        <div class="space-y-1">
                            <h3 class="text-base font-extrabold text-zinc-900 tracking-tight">
                                {{ $member->name }}
                            </h3>
                            <div class="text-xs font-semibold text-blue-600">
                                {{ $member->role }}
                            </div>
                            <div class="text-xs text-zinc-500">
                                {{ $member->specialization }}
                            </div>
                        </div>

                        <!-- Bio Snippet -->
                        <p class="text-xs text-zinc-600 line-clamp-2 leading-relaxed">
                            {{ $member->short_bio }}
                        </p>

                        <!-- Meta Info -->
                        <div class="pt-2 border-t border-zinc-100 flex items-center justify-between text-[11px] text-zinc-500 font-medium">
                            <div class="flex items-center space-x-1">
                                <svg class="w-3.5 h-3.5 text-zinc-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                                <span>{{ $member->location }}</span>
                            </div>
                            <div class="text-zinc-400">
                                {{ $member->skills->count() }} Keahlian
                            </div>
                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="pt-2 flex items-center gap-2">
                        <a 
                            href="{{ route('admin.members.edit', $member) }}" 
                            class="flex-1 py-2.5 px-3 rounded-xl bg-zinc-950 hover:bg-zinc-800 text-white font-bold text-xs tracking-tight text-center transition-all shadow-2xs flex items-center justify-center space-x-1.5"
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
                            class="p-2.5 rounded-xl border border-zinc-200 bg-white hover:bg-zinc-50 text-zinc-600 hover:text-zinc-900 transition-colors"
                            title="Buka Halaman Portofolio Anggota Ini"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
    <section id="projects-section" class="space-y-6 pt-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 pb-3 border-b border-zinc-200">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">Katalog Proyek</span>
                <h2 class="text-xl sm:text-2xl font-extrabold tracking-tight text-zinc-900">
                    Daftar Portofolio Proyek
                </h2>
            </div>
            <div class="flex items-center space-x-3">
                <a 
                    href="{{ route('admin.projects.create') }}" 
                    class="inline-flex items-center space-x-1.5 px-4 py-2 rounded-xl bg-zinc-950 hover:bg-zinc-800 text-white text-xs font-bold shadow-2xs transition-all"
                >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    <span>Tambah Proyek Baru</span>
                </a>
            </div>
        </div>

        <!-- Project Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($projects as $project)
                <div class="bg-white rounded-3xl border border-zinc-200 overflow-hidden flex flex-col justify-between shadow-2xs hover:shadow-md hover:border-zinc-300 transition-all">
                    
                    <div>
                        <!-- Project Thumbnail -->
                        <div class="relative h-48 bg-zinc-100 overflow-hidden border-b border-zinc-100">
                            <img 
                                src="{{ $project->thumbnail_url }}" 
                                alt="{{ $project->title }}" 
                                class="w-full h-full object-cover"
                                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=800&q=80';"
                            >
                            <div class="absolute top-3 left-3 flex items-center gap-1.5">
                                <span class="px-2.5 py-1 rounded-md bg-zinc-950/80 backdrop-blur-xs text-white text-[11px] font-bold">
                                    {{ $project->category }}
                                </span>
                                @if ($project->is_featured)
                                    <span class="px-2 py-0.5 rounded-md bg-blue-600 text-white text-[10px] font-bold uppercase tracking-wider">
                                        Unggulan
                                    </span>
                                @endif
                            </div>
                            <span class="absolute top-3 right-3 px-2 py-1 rounded-md bg-white/90 backdrop-blur-xs text-zinc-900 font-mono text-[11px] font-bold">
                                {{ $project->year }}
                            </span>
                        </div>

                        <!-- Project Body Info -->
                        <div class="p-6 space-y-3">
                            <div class="space-y-1">
                                <div class="text-xs text-zinc-400 font-medium">{{ $project->client_or_context }}</div>
                                <h3 class="text-base font-extrabold text-zinc-900 tracking-tight">
                                    {{ $project->title }}
                                </h3>
                            </div>

                            <p class="text-xs text-zinc-600 line-clamp-2 leading-relaxed">
                                {{ $project->summary }}
                            </p>

                            <!-- Tech Stack Pills -->
                            @if (!empty($project->tech_stack))
                                <div class="flex flex-wrap gap-1 pt-1">
                                    @foreach (array_slice((array)$project->tech_stack, 0, 4) as $tech)
                                        <span class="px-2 py-0.5 rounded-md bg-zinc-100 text-zinc-700 text-[10px] font-medium">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                    @if (count((array)$project->tech_stack) > 4)
                                        <span class="px-1.5 py-0.5 rounded-md bg-zinc-50 text-zinc-400 text-[10px]">
                                            +{{ count((array)$project->tech_stack) - 4 }}
                                        </span>
                                    @endif
                                </div>
                            @endif

                            <!-- Team Collaborators Assigned -->
                            <div class="pt-3 border-t border-zinc-100 flex items-center justify-between text-xs text-zinc-500">
                                <span class="text-[11px] font-semibold text-zinc-400">Kontributor:</span>
                                <div class="flex -space-x-1.5 overflow-hidden">
                                    @forelse ($project->members as $collab)
                                        <img 
                                            class="inline-block h-6 w-6 rounded-full ring-2 ring-white object-cover bg-zinc-200" 
                                            src="{{ $collab->avatar_url }}" 
                                            alt="{{ $collab->name }}"
                                            title="{{ $collab->name }} ({{ $collab->pivot->specific_role ?? 'Engineer' }})"
                                            onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($collab->name) }}&size=64';"
                                        >
                                    @empty
                                        <span class="text-[11px] text-zinc-400 italic">Belum ditentukan</span>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Project Card Footer Actions -->
                    <div class="p-6 pt-0 flex items-center gap-2">
                        <a 
                            href="{{ route('admin.projects.edit', $project) }}" 
                            class="flex-1 py-2 px-3 rounded-xl bg-zinc-100 hover:bg-zinc-200 text-zinc-900 font-bold text-xs text-center transition-all flex items-center justify-center space-x-1"
                        >
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                            <span>Edit Proyek</span>
                        </a>

                        <!-- Delete Project Form -->
                        <form 
                            action="{{ route('admin.projects.destroy', $project) }}" 
                            method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus proyek &quot;{{ $project->title }}&quot; dari portofolio? Tindakan ini tidak dapat dibatalkan.');"
                            class="inline"
                        >
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="p-2 rounded-xl border border-zinc-200 bg-white hover:bg-red-50 text-zinc-400 hover:text-red-600 transition-colors"
                                title="Hapus Proyek Ini"
                            >
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
                <div class="col-span-full py-12 text-center bg-white rounded-3xl border border-zinc-200">
                    <p class="text-zinc-500 text-sm">Belum ada proyek portofolio. Silakan tambahkan proyek pertama.</p>
                </div>
            @endforelse
        </div>
    </section>

</div>
@endsection

