@extends('layouts.admin')

@section('title', 'Tambah Proyek — IdihSebel')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-8">

    <!-- BREADCRUMBS & TOP HEADER -->
    <div class="space-y-3 pb-6 border-b border-studio-200">
        <div class="flex items-center space-x-2 text-xs font-mono text-studio-400">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-studio-900 transition-colors">Console</a>
            <span>/</span>
            <a href="{{ route('admin.dashboard') }}#projects-section" class="hover:text-studio-900 transition-colors">Portofolio</a>
            <span>/</span>
            <span class="text-studio-950 font-semibold">Proyek Baru</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold tracking-tight text-studio-950">
                    Tambah Proyek Portofolio
                </h1>
                <p class="text-xs text-studio-500 mt-1 font-mono">
                    Publikasikan studi kasus teknis dan tetapkan kontributor dari 6 rekan tim RPL.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN FORM (SETTINGS TWO-COLUMN GRID) -->
    <form 
        action="{{ route('admin.projects.store') }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="space-y-10"
    >
        @csrf

        <!-- SECTION 1: INFORMASI PROYEK & THUMBNAIL -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-studio-950">Informasi & Sampul</h2>
                <p class="text-xs text-studio-500 leading-relaxed">
                    Judul karya, tahun peluncuran, kategori produk, serta gambar sampul representatif.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-xl border border-studio-200 p-6 space-y-6 shadow-2xs">
                
                <!-- Thumbnail Upload -->
                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-studio-700">Gambar Sampul Proyek</label>
                    <div class="space-y-3">
                        <div class="relative h-40 rounded-lg overflow-hidden border border-studio-200 bg-studio-100 flex items-center justify-center">
                            <img 
                                id="thumbnail-preview-img"
                                src="https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=800&q=80" 
                                alt="Pratinjau Sampul" 
                                class="w-full h-full object-cover"
                            >
                        </div>

                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <label for="thumbnail_file" class="inline-flex items-center space-x-1.5 px-3 py-1.5 rounded-lg bg-studio-100 hover:bg-studio-200 text-studio-900 text-xs font-medium cursor-pointer transition-colors border border-studio-200">
                                <svg class="w-3.5 h-3.5 text-studio-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <span>Unggah Berkas Gambar</span>
                                <input 
                                    type="file" 
                                    name="thumbnail_file" 
                                    id="thumbnail_file" 
                                    accept="image/png,image/jpeg,image/jpg,image/webp" 
                                    class="hidden"
                                >
                            </label>
                            <span class="text-[11px] text-studio-400 font-mono">JPG, PNG, WEBP (maks. 5MB)</span>
                        </div>

                        <div>
                            <input 
                                type="url" 
                                name="thumbnail_url" 
                                id="thumbnail_url" 
                                value="{{ old('thumbnail_url') }}" 
                                placeholder="Atau tautan URL gambar sampul: https://..."
                                class="w-full px-3 py-1.5 rounded-lg border border-studio-200 text-xs font-mono text-studio-800 placeholder-studio-400 focus:outline-none focus:ring-1 focus:ring-studio-950"
                            >
                        </div>
                    </div>
                </div>

                <div class="h-px bg-studio-100"></div>

                <!-- Text Fields -->
                <div class="space-y-4">
                    <div class="space-y-1.5">
                        <label for="title" class="block text-xs font-semibold text-studio-700">
                            Judul Proyek <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title') }}" 
                            required
                            placeholder="Misal: OmniPoint — Smart Multi-Outlet Cloud POS & Inventory"
                            class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs focus:outline-none focus:ring-1 focus:ring-studio-950 font-medium"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="space-y-1.5">
                            <label for="year" class="block text-xs font-semibold text-studio-700">
                                Tahun Rilis <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="year" 
                                id="year" 
                                value="{{ old('year', date('Y')) }}" 
                                required
                                class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs focus:outline-none focus:ring-1 focus:ring-studio-950 font-mono"
                            >
                        </div>

                        <div class="space-y-1.5">
                            <label for="category" class="block text-xs font-semibold text-studio-700">
                                Kategori <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="category" 
                                id="category" 
                                value="{{ old('category') }}" 
                                required
                                placeholder="Web Application, Mobile, etc."
                                class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs focus:outline-none focus:ring-1 focus:ring-studio-950"
                            >
                        </div>

                        <div class="space-y-1.5">
                            <label for="client_or_context" class="block text-xs font-semibold text-studio-700">
                                Klien / Konteks <span class="text-rose-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="client_or_context" 
                                id="client_or_context" 
                                value="{{ old('client_or_context') }}" 
                                required
                                placeholder="Retail / SMKN 1 Ciamis / Demo"
                                class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs focus:outline-none focus:ring-1 focus:ring-studio-950"
                            >
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="tech_stack" class="block text-xs font-semibold text-studio-700">
                            Tech Stack (pisahkan dengan koma) <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="tech_stack" 
                            id="tech_stack" 
                            value="{{ old('tech_stack', 'Laravel 11, Vue 3, Tailwind CSS, PostgreSQL, Redis') }}" 
                            required
                            class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs focus:outline-none focus:ring-1 focus:ring-studio-950 font-mono"
                        >
                    </div>

                    <div class="pt-1">
                        <label class="flex items-center space-x-2.5 p-2 rounded-lg border border-studio-200 bg-studio-50 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="is_featured" 
                                id="is_featured" 
                                value="1" 
                                {{ old('is_featured', true) ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-studio-950 border-studio-300 focus:ring-studio-950"
                            >
                            <span class="text-xs font-medium text-studio-800">Tampilkan sebagai Proyek Unggulan (Featured)</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="border-t border-studio-200"></div>

        <!-- SECTION 2: DESKRIPSI & STUDI KASUS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-studio-950">Studi Kasus Teknis</h2>
                <p class="text-xs text-studio-500 leading-relaxed">
                    Ringkasan eksekutif dan penjelasan keputusan arsitektur sistem perangkat lunak.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-xl border border-studio-200 p-6 space-y-4 shadow-2xs">
                <div class="space-y-1.5">
                    <label for="summary" class="block text-xs font-semibold text-studio-700">
                        Ringkasan Eksekutif (maksimal 500 karakter) <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        name="summary" 
                        id="summary" 
                        rows="3" 
                        maxlength="500"
                        required
                        placeholder="Uraikan tujuan dan hasil utama produk..."
                        class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs leading-relaxed focus:outline-none focus:ring-1 focus:ring-studio-950"
                    >{{ old('summary') }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label for="case_study" class="block text-xs font-semibold text-studio-700">
                        Studi Kasus & Analisis Rekayasa <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        name="case_study" 
                        id="case_study" 
                        rows="6" 
                        required
                        placeholder="Jelaskan arsitektur backend, skema basis data, dan optimalisasi sistem..."
                        class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs leading-relaxed focus:outline-none focus:ring-1 focus:ring-studio-950 font-sans"
                    >{{ old('case_study') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-1">
                    <div class="space-y-1.5">
                        <label for="live_url" class="block text-xs font-semibold text-studio-700">
                            Tautan Demo Langsung (Live URL)
                        </label>
                        <input 
                            type="url" 
                            name="live_url" 
                            id="live_url" 
                            value="{{ old('live_url') }}" 
                            placeholder="https://..."
                            class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs focus:outline-none focus:ring-1 focus:ring-studio-950 font-mono"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="repo_url" class="block text-xs font-semibold text-studio-700">
                            Tautan Repositori GitHub
                        </label>
                        <input 
                            type="url" 
                            name="repo_url" 
                            id="repo_url" 
                            value="{{ old('repo_url') }}" 
                            placeholder="https://github.com/..."
                            class="w-full px-3 py-2 rounded-lg border border-studio-200 text-xs focus:outline-none focus:ring-1 focus:ring-studio-950 font-mono"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-studio-200"></div>

        <!-- SECTION 3: KONTRIBUTOR TIM -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-studio-950">Kontributor Tim</h2>
                <p class="text-xs text-studio-500 leading-relaxed">
                    Tentukan rekan tim RPL yang terlibat dan tentukan peran spesifik pada proyek ini.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-xl border border-studio-200 p-6 space-y-4 shadow-2xs">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    @foreach ($members as $member)
                        <div class="p-3 rounded-lg border border-studio-200 bg-studio-50/50 space-y-2">
                            <label class="flex items-center space-x-2.5 cursor-pointer select-none">
                                <input 
                                    type="checkbox" 
                                    name="members[]" 
                                    value="{{ $member->id }}" 
                                    class="w-3.5 h-3.5 rounded text-studio-950 border-studio-300 focus:ring-studio-950"
                                >
                                <div class="flex items-center space-x-2">
                                    <img 
                                        src="{{ $member->avatar_url }}" 
                                        alt="{{ $member->name }}" 
                                        class="w-7 h-7 rounded-md object-cover bg-studio-200 border border-studio-200 shrink-0"
                                        onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=64';"
                                    >
                                    <div>
                                        <div class="text-xs font-bold text-studio-900 leading-tight">#{{ sprintf('%02d', $member->index_number) }} {{ $member->name }}</div>
                                        <div class="text-[10px] text-studio-500 font-mono line-clamp-1">{{ $member->role }}</div>
                                    </div>
                                </div>
                            </label>

                            <div class="pl-6">
                                <input 
                                    type="text" 
                                    name="member_roles[{{ $member->id }}]" 
                                    value="{{ $member->role }}" 
                                    placeholder="Peran spesifik..."
                                    class="w-full px-2.5 py-1 rounded border border-studio-200 bg-white text-[11px] text-studio-800 focus:outline-none focus:ring-1 focus:ring-studio-950 font-mono"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- STICKY ACTION BAR -->
        <div class="sticky bottom-4 z-20 p-3.5 rounded-xl bg-white/95 backdrop-blur-md border border-studio-200 shadow-md flex items-center justify-between">
            <a 
                href="{{ route('admin.dashboard') }}" 
                class="px-3.5 py-1.5 rounded-lg border border-studio-200 text-studio-600 hover:text-studio-950 hover:bg-studio-100 text-xs font-medium transition-colors"
            >
                Batal
            </a>

            <button 
                type="submit" 
                class="py-1.5 px-4 rounded-lg bg-studio-950 hover:bg-studio-900 text-white font-semibold text-xs tracking-tight shadow-xs transition-colors flex items-center space-x-1.5"
            >
                <svg class="w-3.5 h-3.5 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"></polyline>
                </svg>
                <span>Terbitkan Proyek</span>
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
