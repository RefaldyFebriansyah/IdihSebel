@extends('layouts.admin')

@section('title', 'Edit Proyek — ' . $project->title)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-8">

    <!-- HEADER -->
    <div class="space-y-3 pb-6 border-b border-brand-200/80">
        <div class="flex items-center space-x-2 text-xs font-medium text-brand-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-900 transition-colors">IdihSebel</a>
            <span>/</span>
            <a href="{{ route('admin.dashboard') }}#projects-section" class="hover:text-brand-900 transition-colors">Daftar Proyek</a>
            <span>/</span>
            <span class="text-brand-950 font-semibold">{{ $project->title }}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-brand-950">
                    Edit Proyek: {{ $project->title }}
                </h1>
                <p class="text-xs sm:text-sm text-brand-500 mt-1">
                    {{ $project->category }} &bull; Rilis {{ $project->year }} &bull; {{ $project->client_or_context }}
                </p>
            </div>
            <div>
                <a 
                    href="{{ $project->live_url ?: (route('portfolio.index') . '#works') }}" 
                    target="_blank"
                    class="inline-flex items-center space-x-1.5 px-3.5 py-2 rounded-xl border border-brand-200 bg-white hover:bg-brand-50 text-brand-700 text-xs font-semibold transition-colors"
                >
                    <span>Lihat di Website</span>
                    <svg class="w-3.5 h-3.5 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                        <polyline points="15 3 21 3 21 9"></polyline>
                        <line x1="10" y1="14" x2="21" y2="3"></line>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- MAIN FORM -->
    <form 
        action="{{ route('admin.projects.update', $project) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="space-y-8"
    >
        @csrf
        @method('PUT')

        <!-- SECTION 1: INFORMASI PROYEK & THUMBNAIL -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Sampul & Info Dasar</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Perbarui judul, gambar sampul, tahun rilis, dan kategori proyek.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-6 shadow-2xs">
                
                <!-- Thumbnail Upload -->
                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-brand-700">Gambar Sampul Proyek</label>
                    <div class="space-y-3">
                        <div class="relative h-44 rounded-2xl overflow-hidden border border-brand-200 bg-brand-50 flex items-center justify-center">
                            <img 
                                id="thumbnail-preview-img"
                                src="{{ old('thumbnail_url', $project->thumbnail_url) }}" 
                                alt="{{ $project->title }}" 
                                class="w-full h-full object-cover"
                            >
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <label for="thumbnail_file" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-brand-100 hover:bg-brand-200 text-brand-900 text-xs font-medium cursor-pointer transition-colors border border-brand-200">
                                <svg class="w-4 h-4 text-brand-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <span>Pilih Gambar Sampul Baru</span>
                                <input 
                                    type="file" 
                                    name="thumbnail_file" 
                                    id="thumbnail_file" 
                                    accept="image/png,image/jpeg,image/jpg,image/webp" 
                                    class="hidden"
                                >
                            </label>
                            <span class="text-[11px] text-brand-400">Format: JPG, PNG, WEBP (maksimal 5MB)</span>
                        </div>

                        <div>
                            <input 
                                type="url" 
                                name="thumbnail_url" 
                                id="thumbnail_url" 
                                value="{{ old('thumbnail_url', $project->thumbnail_url) }}" 
                                placeholder="Atau tempel URL gambar sampul: https://..."
                                class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs text-brand-800 placeholder-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                            >
                        </div>
                    </div>
                </div>

                <div class="h-px bg-brand-100"></div>

                <!-- Text Fields -->
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label for="title" class="block text-xs font-semibold text-brand-700">
                            Judul Proyek <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title', $project->title) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950 font-medium"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label for="year" class="block text-xs font-semibold text-brand-700">
                                Tahun Rilis <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="year" 
                                id="year" 
                                value="{{ old('year', $project->year) }}" 
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                            >
                        </div>

                        <div class="space-y-1.5">
                            <label for="category" class="block text-xs font-semibold text-brand-700">
                                Kategori <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="category" 
                                id="category" 
                                value="{{ old('category', $project->category) }}" 
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                            >
                        </div>

                        <div class="space-y-1.5">
                            <label for="client_or_context" class="block text-xs font-semibold text-brand-700">
                                Klien / Instansi <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="client_or_context" 
                                id="client_or_context" 
                                value="{{ old('client_or_context', $project->client_or_context) }}" 
                                required
                                class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                            >
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="tech_stack" class="block text-xs font-semibold text-brand-700">
                            Teknologi yang Digunakan (pisahkan dengan koma) <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="tech_stack" 
                            id="tech_stack" 
                            value="{{ old('tech_stack', is_array($project->tech_stack) ? implode(', ', $project->tech_stack) : $project->tech_stack) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <div class="pt-1">
                        <label class="flex items-center space-x-2.5 p-2.5 rounded-xl border border-brand-200 bg-brand-50 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="is_featured" 
                                id="is_featured" 
                                value="1" 
                                {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-brand-950 border-brand-300 focus:ring-brand-950"
                            >
                            <span class="text-xs font-medium text-brand-800">Tampilkan sebagai Proyek Unggulan (Featured) ⭐</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="border-t border-brand-200/80"></div>

        <!-- SECTION 2: DESKRIPSI & STUDI KASUS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Deskripsi & Tautan</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Perbarui ringkasan, studi kasus, serta tautan demo dan repositori GitHub.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-4 shadow-2xs">
                <div class="space-y-1.5">
                    <label for="summary" class="block text-xs font-semibold text-brand-700">
                        Ringkasan Proyek (maksimal 500 karakter) <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        name="summary" 
                        id="summary" 
                        rows="3" 
                        maxlength="500"
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs leading-relaxed focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                    >{{ old('summary', $project->summary) }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label for="case_study" class="block text-xs font-semibold text-brand-700">
                        Studi Kasus Lengkap <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        name="case_study" 
                        id="case_study" 
                        rows="7" 
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs leading-relaxed focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950 font-sans"
                    >{{ old('case_study', $project->case_study) }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="space-y-1.5">
                        <label for="live_url" class="block text-xs font-semibold text-brand-700">
                            Tautan Demo / Live Website
                        </label>
                        <input 
                            type="url" 
                            name="live_url" 
                            id="live_url" 
                            value="{{ old('live_url', $project->live_url) }}" 
                            placeholder="https://..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="repo_url" class="block text-xs font-semibold text-brand-700">
                            Tautan GitHub / Repositori
                        </label>
                        <input 
                            type="url" 
                            name="repo_url" 
                            id="repo_url" 
                            value="{{ old('repo_url', $project->repo_url) }}" 
                            placeholder="https://github.com/..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-brand-200/80"></div>

        <!-- SECTION 3: KONTRIBUTOR TIM -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Kontributor Tim</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Pilih anggota tim yang berkontribusi dalam proyek ini.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-4 shadow-2xs">
                @php
                    $attachedMembers = $project->members->pluck('id')->toArray();
                    $memberPivotRoles = [];
                    foreach ($project->members as $m) {
                        $memberPivotRoles[$m->id] = $m->pivot->specific_role ?? '';
                    }
                @endphp

                <div class="space-y-3">
                    @foreach ($members as $member)
                        @php
                            $isSelected = in_array($member->id, old('members', $attachedMembers));
                            $currentRole = old('member_roles.' . $member->id, $memberPivotRoles[$member->id] ?? '');
                        @endphp
                        <div class="p-3.5 rounded-xl border border-brand-200 hover:border-brand-300 transition-colors flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                            <label class="flex items-center space-x-3 cursor-pointer select-none">
                                <input 
                                    type="checkbox" 
                                    name="members[]" 
                                    value="{{ $member->id }}" 
                                    {{ $isSelected ? 'checked' : '' }}
                                    class="w-4 h-4 rounded text-brand-950 border-brand-300 focus:ring-brand-950"
                                >
                                <div class="flex items-center space-x-2.5">
                                    <img 
                                        src="{{ $member->avatar_url }}" 
                                        alt="{{ $member->name }}" 
                                        class="w-7 h-7 rounded-lg object-cover ring-1 ring-brand-200"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=64';"
                                    >
                                    <div>
                                        <div class="text-xs font-semibold text-brand-950">{{ $member->name }}</div>
                                        <div class="text-[11px] text-brand-500">{{ $member->role }}</div>
                                    </div>
                                </div>
                            </label>

                            <div class="w-full sm:w-auto">
                                <input 
                                    type="text" 
                                    name="member_roles[{{ $member->id }}]" 
                                    value="{{ $currentRole }}"
                                    placeholder="Peran spesifik (misal: UI Designer)" 
                                    class="w-full sm:w-60 px-3 py-1.5 rounded-lg border border-brand-200 text-xs focus:outline-none focus:ring-1 focus:ring-brand-950"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- STICKY ACTION BAR -->
        <div class="sticky bottom-4 z-20 p-3.5 rounded-2xl bg-white/95 backdrop-blur-md border border-brand-200 shadow-md flex items-center justify-between">
            <a 
                href="{{ route('admin.dashboard') }}" 
                class="px-4 py-2 rounded-xl border border-brand-200 text-brand-600 hover:text-brand-950 hover:bg-brand-50 text-xs font-medium transition-colors"
            >
                Batal
            </a>

            <button 
                type="submit" 
                class="py-2 px-5 rounded-xl bg-brand-950 hover:bg-brand-900 text-white font-semibold text-xs tracking-tight shadow-xs transition-colors flex items-center space-x-1.5 cursor-pointer"
            >
                <svg class="w-3.5 h-3.5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Simpan Perubahan</span>
            </button>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    const thumbInput = document.getElementById('thumbnail_file');
    const thumbUrlInput = document.getElementById('thumbnail_url');
    const thumbPreviewImg = document.getElementById('thumbnail-preview-img');

    if (thumbInput && thumbPreviewImg) {
        thumbInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                thumbPreviewImg.src = URL.createObjectURL(file);
            }
        });
    }

    if (thumbUrlInput && thumbPreviewImg) {
        thumbUrlInput.addEventListener('input', function(e) {
            if (e.target.value.trim() !== '') {
                thumbPreviewImg.src = e.target.value.trim();
            }
        });
    }
</script>
@endpush
