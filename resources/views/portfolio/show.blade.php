@extends('layouts.app')

@section('title', $member->name . ' — ' . $member->role . ' [IdihSebel]')
@section('meta_description', $member->name . ' (' . $member->role . '): ' . $member->short_bio)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12 space-y-12">

    <!-- =========================================================================
         1. BREADCRUMB & TEAM SWITCHER
         ========================================================================= -->
    <section class="space-y-4 pb-6 border-b border-zinc-200">
        <!-- Breadcrumb -->
        <div class="flex flex-wrap items-center space-x-2 text-xs sm:text-sm text-zinc-500 font-medium">
            <a href="{{ route('portfolio.index') }}" class="hover:text-zinc-900 transition-colors">Beranda</a>
            <span>/</span>
            <a href="{{ route('portfolio.index') }}#roster" class="hover:text-zinc-900 transition-colors">Profil Tim</a>
            <span>/</span>
            <span class="text-zinc-900 font-bold">{{ $member->name }}</span>
        </div>

        <!-- Quick Switcher Bar -->
        <div class="bg-white rounded-2xl border border-zinc-200/80 p-3 sm:p-4 flex flex-wrap items-center justify-between gap-3 shadow-xs">
            <span class="text-xs font-bold text-zinc-500 uppercase tracking-wider px-1">
                Pilih Profil Anggota:
            </span>
            <div class="flex flex-wrap items-center gap-1.5 text-xs font-medium">
                @foreach($allMembers as $other)
                    @php $isActive = ($other->id === $member->id); @endphp
                    <a
                        href="{{ route('portfolio.member', $other->slug) }}"
                        class="px-3.5 py-1.5 rounded-full transition-all {{ $isActive ? 'bg-zinc-900 text-white font-bold shadow-xs' : 'bg-zinc-100 text-zinc-700 hover:bg-zinc-200 hover:text-zinc-900' }}"
                        title="{{ $other->name }} ({{ $other->role }})"
                    >
                        <span>#{{ $other->index_number }}</span>
                        <span class="ml-1">{{ Str::words($other->name, 2, '') }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- =========================================================================
         2. PROFILE HEADER & DETAILS
         Left Column (Sticky Profile Card) + Right Column (About, Skills, Timeline)
         ========================================================================= -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">

        <!-- LEFT COLUMN: STICKY PROFILE CARD -->
        <aside class="lg:col-span-4 lg:sticky lg:top-24 space-y-6">
            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 sm:p-7 space-y-6 shadow-[0_1px_3px_rgba(0,0,0,0.03)]">
                <!-- Portrait Image -->
                <div class="relative overflow-hidden rounded-xl bg-zinc-100 aspect-[4/5] group">
                    <img
                        src="{{ $member->avatar_url }}"
                        alt="{{ $member->name }}"
                        class="w-full h-full object-cover object-top grayscale-[15%] group-hover:grayscale-0 group-hover:scale-102 transition-all duration-500"
                    >
                    <div class="absolute top-3 left-3 px-2.5 py-1 rounded-md bg-zinc-950 text-white text-xs font-bold font-mono">
                        #{{ $member->index_number }}
                    </div>
                </div>

                <!-- Info Header -->
                <div class="space-y-2">
                    <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900">
                        {{ $member->name }}
                    </h1>

                    <div class="text-xs sm:text-sm font-semibold text-blue-600 uppercase tracking-wide">
                        {{ $member->role }}
                    </div>

                    <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed pt-1">
                        {{ $member->specialization }}
                    </p>
                </div>

                <!-- Contact Coordinates -->
                <div class="space-y-3 pt-5 border-t border-zinc-100 text-xs sm:text-sm">
                    <div class="flex items-center justify-between text-zinc-600">
                        <span class="text-zinc-500">Lokasi:</span>
                        <span class="font-semibold text-zinc-900">{{ $member->location }}</span>
                    </div>
                    <div class="flex items-center justify-between text-zinc-600">
                        <span class="text-zinc-500">Email:</span>
                        <a href="mailto:{{ $member->email }}" class="text-blue-600 font-medium hover:underline truncate max-w-[200px]">
                            {{ $member->email }}
                        </a>
                    </div>
                    <div class="flex items-center justify-between text-zinc-600">
                        <span class="text-zinc-500">WhatsApp:</span>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $member->phone) }}" target="_blank" rel="noopener" class="text-zinc-900 hover:text-blue-600 font-semibold">
                            {{ $member->phone }}
                        </a>
                    </div>
                </div>

                <!-- Official Social Profiles -->
                <div class="pt-5 border-t border-zinc-100 space-y-3">
                    <div class="text-xs font-semibold text-zinc-500 uppercase tracking-wider">
                        Profil & Saluran Terverifikasi:
                    </div>
                    <div class="flex items-center space-x-3">
                        @if($member->github_url)
                            <a href="{{ $member->github_url }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl border border-zinc-200 text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 transition-colors" title="GitHub">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
                                </svg>
                            </a>
                        @endif

                        @if($member->linkedin_url)
                            <a href="{{ $member->linkedin_url }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl border border-zinc-200 text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 transition-colors" title="LinkedIn">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451c.979 0 1.778-.773 1.778-1.729V1.73C24 .774 23.205 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                        @endif

                        @if($member->instagram_url)
                            <a href="{{ $member->instagram_url }}" target="_blank" rel="noopener" class="p-2.5 rounded-xl border border-zinc-200 text-zinc-600 hover:text-zinc-900 hover:bg-zinc-50 transition-colors" title="Instagram">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Download CV Action -->
                <div class="pt-2">
                    <a
                        href="{{ $member->cv_url ?? '#' }}"
                        target="_blank"
                        rel="noopener"
                        class="w-full inline-flex items-center justify-center space-x-2 py-3 px-4 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-white font-semibold text-xs sm:text-sm transition-colors shadow-xs"
                    >
                        <span>Unduh Curriculum Vitae (PDF)</span>
                        <span>↓</span>
                    </a>
                </div>
            </div>
        </aside>

        <!-- RIGHT COLUMN: NARRATIVE, COMPETENCIES & CHRONOLOGY -->
        <div class="lg:col-span-8 space-y-8">

            <!-- 1. About Narrative Section -->
            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 sm:p-8 space-y-4 shadow-[0_1px_3px_rgba(0,0,0,0.03)]">
                <div class="text-xs font-bold text-blue-600 uppercase tracking-wider">
                    Profil Profesional & Latar Belakang
                </div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900">
                    Filosofi Kerja & Pendekatan Rekayasa
                </h2>
                <div class="text-sm sm:text-base text-zinc-600 leading-relaxed font-sans space-y-4 whitespace-pre-line">
                    {{ $member->about_story }}
                </div>
            </div>

            <!-- 2. Core Competencies Grouped by Category -->
            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 sm:p-8 space-y-6 shadow-[0_1px_3px_rgba(0,0,0,0.03)]">
                <div class="text-xs font-bold text-blue-600 uppercase tracking-wider">
                    Keahlian & Penguasaan Teknologi
                </div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900">
                    Stack & Tools yang Dikuasai
                </h2>

                <div class="space-y-6">
                    @foreach($memberSkillsByCategory as $category => $categorySkills)
                        <div class="space-y-3">
                            <div class="text-xs font-bold text-zinc-500 uppercase tracking-wider border-b border-zinc-100 pb-1.5 flex items-center justify-between">
                                <span>{{ $category }}</span>
                                <span class="text-zinc-400 font-normal">{{ $categorySkills->count() }} Kemampuan</span>
                            </div>
                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                                @foreach($categorySkills as $skill)
                                    <div class="flex items-center space-x-2.5 p-3 rounded-xl bg-zinc-50 border border-zinc-200/80 hover:border-zinc-400 transition-colors">
                                        <svg class="w-4 h-4 text-zinc-700 fill-current shrink-0" viewBox="0 0 24 24">
                                            <path d="{{ $skill->svg_path }}"></path>
                                        </svg>
                                        <div class="flex flex-col">
                                            <span class="text-xs font-bold text-zinc-900">{{ $skill->name }}</span>
                                            @if($skill->pivot->is_primary)
                                                <span class="text-[10px] text-blue-600 font-semibold uppercase">Fokus Utama</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- 3. Chronological Education & Experience Timeline -->
            <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 sm:p-8 space-y-6 shadow-[0_1px_3px_rgba(0,0,0,0.03)]">
                <div class="text-xs font-bold text-blue-600 uppercase tracking-wider">
                    Jejak Karier & Pendidikan
                </div>
                <h2 class="text-xl sm:text-2xl font-bold tracking-tight text-zinc-900">
                    Riwayat Pengalaman & Akademik
                </h2>

                <div class="border-l-2 border-zinc-200 ml-2 pl-6 space-y-8 relative">
                    @foreach($member->experiences as $exp)
                        <div class="relative group">
                            <!-- Timeline Dot -->
                            <div class="absolute -left-[31px] top-1.5 w-3 h-3 rounded-full bg-white border-2 border-zinc-900 group-hover:bg-blue-600 group-hover:border-blue-600 transition-colors"></div>

                            <div class="space-y-1">
                                <div class="flex flex-wrap items-center space-x-2 text-xs">
                                    <span class="text-blue-600 font-bold">{{ $exp->period }}</span>
                                    <span class="text-zinc-300">•</span>
                                    <span class="px-2 py-0.5 rounded-md bg-zinc-100 text-zinc-700 text-[11px] font-semibold">{{ $exp->type }}</span>
                                </div>
                                <h3 class="text-base font-bold text-zinc-900">
                                    {{ $exp->title }}
                                </h3>
                                <div class="text-xs font-medium text-zinc-600">
                                    {{ $exp->organization }}
                                </div>
                                <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed pt-1">
                                    {{ $exp->description }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <!-- =========================================================================
         3. MEMBER'S SHIPPED PRODUCTION WORKS
         ========================================================================= -->
    <section class="space-y-6 pt-6 border-t border-zinc-200">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between pb-4 border-b border-zinc-200 gap-4">
            <div>
                <div class="text-xs font-bold uppercase tracking-wider text-blue-600 mb-1">
                    Kontribusi Karya Nyata
                </div>
                <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900">
                    Proyek yang Dikerjakan oleh {{ Str::words($member->name, 2, '') }}
                </h2>
            </div>
            <div class="text-xs text-zinc-500 font-semibold">
                {{ $member->projects->count() }} Proyek Dikerjakan
            </div>
        </div>

        <!-- Project Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($member->projects as $project)
                <div class="bg-white rounded-2xl border border-zinc-200/70 p-6 sm:p-7 flex flex-col justify-between shadow-[0_1px_3px_rgba(0,0,0,0.03)] hover:shadow-[0_12px_36px_rgba(0,0,0,0.07)] hover:border-zinc-300 transition-all duration-300 space-y-6 group">
                    <div class="space-y-4">
                        <!-- Thumbnail (Clean Frame, No Floating Badges) -->
                        <div class="relative aspect-video rounded-xl overflow-hidden bg-zinc-100">
                            <img
                                src="{{ $project->thumbnail_url }}"
                                alt="{{ $project->title }}"
                                class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500"
                            >
                        </div>

                        <!-- Category & Year Bar -->
                        <div class="flex items-center justify-between text-xs font-medium pt-1">
                            <span class="text-blue-600 font-semibold tracking-wider uppercase text-[11px]">
                                {{ $project->category }}
                            </span>
                            <span class="text-zinc-400 font-mono text-xs">
                                {{ $project->year }}
                            </span>
                        </div>

                        <!-- Specific Role Highlight -->
                        <div class="p-3.5 rounded-xl bg-blue-50 border border-blue-200/60 space-y-1">
                            <div class="text-[11px] uppercase text-blue-700 font-bold">Peran Spesifik pada Proyek:</div>
                            <div class="text-zinc-900 font-bold text-xs sm:text-sm">
                                {{ $project->pivot->specific_role }}
                            </div>
                        </div>

                        <!-- Title & Summary -->
                        <div class="space-y-1.5">
                            <div class="text-xs text-zinc-500">
                                Klien: <span class="font-medium text-zinc-800">{{ $project->client_or_context }}</span>
                            </div>
                            <h3 class="text-lg sm:text-xl font-bold text-zinc-900 group-hover:text-blue-600 transition-colors">
                                {{ $project->title }}
                            </h3>
                            <p class="text-xs sm:text-sm text-zinc-600 leading-relaxed line-clamp-3">
                                {{ $project->summary }}
                            </p>
                        </div>

                        <!-- Tech Stack Tags -->
                        <div class="flex flex-wrap gap-1.5 pt-1">
                            @foreach($project->tech_stack as $t)
                                <span class="px-2.5 py-1 rounded-md bg-zinc-100 text-zinc-700 text-xs font-medium">
                                    {{ $t }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Links & Actions -->
                    <div class="pt-4 border-t border-zinc-100 flex items-center justify-between text-xs">
                        <div class="flex items-center space-x-3">
                            @if($project->live_url)
                                <a href="{{ $project->live_url }}" target="_blank" rel="noopener" class="font-bold text-blue-600 hover:text-blue-700 hover:underline inline-flex items-center space-x-1">
                                    <span>Kunjungi Demo</span>
                                    <span>↗</span>
                                </a>
                            @endif
                            @if($project->repo_url)
                                <a href="{{ $project->repo_url }}" target="_blank" rel="noopener" class="text-zinc-500 hover:text-zinc-800">
                                    Lihat Repositori
                                </a>
                            @endif
                        </div>

                        <a href="{{ route('portfolio.index') }}#works" class="text-zinc-500 hover:text-zinc-900 font-medium">
                            ← Kembali ke Semua Proyek
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

</div>
@endsection
