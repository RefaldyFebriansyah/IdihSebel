@extends('layouts.admin')

@section('title', 'Tambah Proyek Portofolio Baru')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-8">

    <!-- BREADCRUMBS & TOP HEADER -->
    <div class="space-y-2">
        <div class="flex items-center space-x-2 text-xs font-semibold text-zinc-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-zinc-900 transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.dashboard') }}#projects-section" class="hover:text-zinc-900 transition-colors">Portofolio</a>
            <span>/</span>
            <span class="text-zinc-900">Tambah Proyek Baru</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2 pb-6 border-b border-zinc-200">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">
                    Formulir Proyek Baru
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900">
                    Tambah Proyek Portofolio
                </h1>
                <p class="text-sm text-zinc-500 mt-0.5">
                    Publikasikan hasil karya, studi kasus teknis, dan tetapkan kontributor tim dari 6 anggota RPL.
                </p>
            </div>
        </div>
    </div>

    <!-- MAIN FORM -->
    <form 
        action="{{ route('admin.projects.store') }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="space-y-8"
    >
        @csrf

        <!-- SECTION: INFORMASI UTAMA & THUMBNAIL -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-6 sm:p-8 space-y-6 shadow-2xs">
            <h2 class="text-lg font-bold text-zinc-900 flex items-center space-x-2 pb-3 border-b border-zinc-100">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>Informasi Utama & Gambar Thumbnail</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- Thumbnail Box -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Gambar Sampul (Thumbnail)
                    </label>

                    <div class="p-4 border-2 border-dashed border-zinc-200 rounded-2xl bg-zinc-50/50 space-y-4 text-center">
                        <div class="relative h-44 rounded-xl bg-zinc-100 overflow-hidden border border-zinc-200 flex items-center justify-center">
                            <img 
                                id="thumbnail-preview-img"
                                src="https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=800&q=80" 
                                alt="Pratinjau Gambar" 
                                class="w-full h-full object-cover"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="thumbnail_file" class="block w-full py-2 px-3 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-white text-xs font-bold cursor-pointer transition-colors shadow-2xs">
                                <span>Unggah Berkas Gambar</span>
                                <input 
                                    type="file" 
                                    name="thumbnail_file" 
                                    id="thumbnail_file" 
                                    accept="image/png,image/jpeg,image/jpg,image/webp" 
                                    class="hidden"
                                >
                            </label>
                            <div class="text-[11px] text-zinc-400">
                                Rekomendasi 16:9 atau 4:3 (Maksimal 5MB)
                            </div>
                        </div>
                    </div>

                    <!-- Direct URL Option -->
                    <div class="space-y-1.5 pt-1">
                        <label for="thumbnail_url" class="block text-[11px] font-semibold text-zinc-600">
                            Atau Tautan URL Gambar:
                        </label>
                        <input 
                            type="url" 
                            name="thumbnail_url" 
                            id="thumbnail_url" 
                            value="{{ old('thumbnail_url') }}" 
                            placeholder="https://images.unsplash.com/..."
                            class="w-full px-3 py-2 rounded-xl border border-zinc-200 text-xs font-mono text-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900"
                        >
                    </div>
                </div>

                <!-- Main Fields -->
                <div class="lg:col-span-2 space-y-4">
                    <!-- Project Title -->
                    <div class="space-y-1.5">
                        <label for="title" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                            Judul Proyek <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{ old('title') }}" 
                            required
                            placeholder="Misal: OmniPoint — Smart Multi-Outlet Cloud POS & Inventory"
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 bg-white text-zinc-900 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-zinc-900"
                        >
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <!-- Year -->
                        <div class="space-y-1.5">
                            <label for="year" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Tahun Rilis <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="year" 
                                id="year" 
                                value="{{ old('year', date('Y')) }}" 
                                required
                                placeholder="2024"
                                class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>

                        <!-- Category -->
                        <div class="space-y-1.5">
                            <label for="category" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="category" 
                                id="category" 
                                value="{{ old('category') }}" 
                                required
                                placeholder="Web Application, Mobile App, etc."
                                class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>

                        <!-- Client or Context -->
                        <div class="space-y-1.5">
                            <label for="client_or_context" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Klien / Konteks <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="client_or_context" 
                                id="client_or_context" 
                                value="{{ old('client_or_context') }}" 
                                required
                                placeholder="Enterprise / Retail / Internal Demo"
                                class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>
                    </div>

                    <!-- Tech Stack Input -->
                    <div class="space-y-1.5">
                        <label for="tech_stack" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                            Tech Stack (Pisahkan dengan koma) <span class="text-red-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="tech_stack" 
                            id="tech_stack" 
                            value="{{ old('tech_stack', 'Laravel 11, Vue 3, Tailwind CSS, PostgreSQL, Redis') }}" 
                            required
                            placeholder="Laravel 11, Vue 3, Tailwind CSS, PostgreSQL"
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                        >
                        <div class="text-[11px] text-zinc-400">
                            Contoh: PHP, Laravel, Tailwind CSS, MySQL, Alpine.js
                        </div>
                    </div>

                    <!-- Featured Checkbox -->
                    <div class="pt-1">
                        <label class="flex items-center space-x-3 p-3 rounded-xl border border-zinc-200 bg-zinc-50/70 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="is_featured" 
                                id="is_featured" 
                                value="1" 
                                {{ old('is_featured', true) ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-blue-600 border-zinc-300 focus:ring-blue-600"
                            >
                            <div class="text-xs">
                                <div class="font-bold text-zinc-800">Proyek Unggulan (Featured)</div>
                                <div class="text-zinc-500 text-[11px]">Tampilkan lencana Unggulan di kartu portofolio beranda</div>
                            </div>
                        </label>
                    </div>

                </div>
            </div>
        </div>

        <!-- SECTION: RINGKASAN & STUDI KASUS LENGKAP -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-6 sm:p-8 space-y-6 shadow-2xs">
            <h2 class="text-lg font-bold text-zinc-900 flex items-center space-x-2 pb-3 border-b border-zinc-100">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>Deskripsi & Studi Kasus Teknis</span>
            </h2>

            <div class="space-y-5">
                <!-- Summary -->
                <div class="space-y-1.5">
                    <label for="summary" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Ringkasan Eksekutif (Maksimal 500 Karakter) <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="summary" 
                        id="summary" 
                        rows="3" 
                        maxlength="500"
                        required
                        placeholder="Jelaskan secara ringkas tantangan dan solusi utama produk ini..."
                        class="w-full px-4 py-3 rounded-xl border border-zinc-200 text-sm leading-relaxed focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >{{ old('summary') }}</textarea>
                </div>

                <!-- Case Study -->
                <div class="space-y-1.5">
                    <label for="case_study" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Studi Kasus Teknis & Metodologi <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="case_study" 
                        id="case_study" 
                        rows="6" 
                        required
                        placeholder="Uraikan arsitektur sistem, keputusan rekayasa, optimasi performa, dan hasil yang dicapai..."
                        class="w-full px-4 py-3 rounded-xl border border-zinc-200 text-sm leading-relaxed focus:outline-none focus:ring-2 focus:ring-zinc-900 font-sans"
                    >{{ old('case_study') }}</textarea>
                </div>

                <!-- External Links -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                    <div class="space-y-1.5">
                        <label for="live_url" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                            Tautan Demo Langsung (Live URL)
                        </label>
                        <input 
                            type="url" 
                            name="live_url" 
                            id="live_url" 
                            value="{{ old('live_url') }}" 
                            placeholder="https://..."
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="repo_url" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                            Tautan Repositori GitHub
                        </label>
                        <input 
                            type="url" 
                            name="repo_url" 
                            id="repo_url" 
                            value="{{ old('repo_url') }}" 
                            placeholder="https://github.com/..."
                            class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                        >
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION: KONTRIBUTOR TIM (DARI 6 ANGGOTA SMKN 1 CIAMIS RPL) -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-6 sm:p-8 space-y-6 shadow-2xs">
            <div class="flex items-center justify-between pb-3 border-b border-zinc-100">
                <h2 class="text-lg font-bold text-zinc-900 flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    <span>Kontributor Tim (Pilih Anggota & Peran)</span>
                </h2>
                <span class="text-xs text-zinc-500">Centang anggota yang mengerjakan proyek ini</span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($members as $member)
                    <div class="p-4 rounded-2xl border border-zinc-200 bg-zinc-50/50 space-y-3">
                        <label class="flex items-center space-x-3 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="members[]" 
                                value="{{ $member->id }}" 
                                class="w-4 h-4 rounded text-zinc-950 border-zinc-300 focus:ring-zinc-900"
                            >
                            <div class="flex items-center space-x-3">
                                <img 
                                    src="{{ $member->avatar_url }}" 
                                    alt="{{ $member->name }}" 
                                    class="w-9 h-9 rounded-xl object-cover bg-zinc-200 border border-zinc-200"
                                    onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&size=64';"
                                >
                                <div>
                                    <div class="text-xs font-bold text-zinc-900">#{{ sprintf('%02d', $member->index_number) }} {{ $member->name }}</div>
                                    <div class="text-[11px] text-zinc-500">{{ $member->role }}</div>
                                </div>
                            </div>
                        </label>

                        <div class="pl-7 space-y-1">
                            <label class="block text-[10px] font-semibold uppercase tracking-wider text-zinc-400">
                                Peran Spesifik di Proyek Ini:
                            </label>
                            <input 
                                type="text" 
                                name="member_roles[{{ $member->id }}]" 
                                value="{{ $member->role }}" 
                                placeholder="Misal: Lead Backend Developer"
                                class="w-full px-3 py-1.5 rounded-lg border border-zinc-200 bg-white text-xs text-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- STICKY ACTION BUTTON BAR -->
        <div class="sticky bottom-4 z-20 p-4 rounded-2xl bg-white/95 backdrop-blur-md border border-zinc-200 shadow-xl flex items-center justify-between gap-4">
            <a 
                href="{{ route('admin.dashboard') }}" 
                class="px-5 py-2.5 rounded-xl border border-zinc-200 text-zinc-600 hover:text-zinc-950 hover:bg-zinc-100 text-xs font-bold transition-colors"
            >
                Batal
            </a>

            <div class="flex items-center space-x-3">
                <button 
                    type="submit" 
                    class="py-2.5 px-6 rounded-xl bg-zinc-950 hover:bg-zinc-800 text-white font-bold text-xs sm:text-sm tracking-tight shadow-md hover:shadow-lg transition-all active:scale-95 flex items-center space-x-2"
                >
                    <svg class="w-4 h-4 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    <span>Simpan & Terbitkan Proyek</span>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    // Live thumbnail preview when file chosen
    const thumbInput = document.getElementById('thumbnail_file');
    const thumbUrlInput = document.getElementById('thumbnail_url');
    const thumbPreviewImg = document.getElementById('thumbnail-preview-img');

    if (thumbInput && thumbPreviewImg) {
        thumbInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                thumbPreviewImg.src = url;
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

