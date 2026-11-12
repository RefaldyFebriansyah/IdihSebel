@extends('layouts.admin')

@section('title', 'Edit Profil ' . $member->name)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-8">

    <!-- BREADCRUMBS & TOP HEADER -->
    <div class="space-y-2">
        <div class="flex items-center space-x-2 text-xs font-semibold text-zinc-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-zinc-900 transition-colors">Dashboard</a>
            <span>/</span>
            <a href="{{ route('admin.dashboard') }}#members-section" class="hover:text-zinc-900 transition-colors">Anggota</a>
            <span>/</span>
            <span class="text-zinc-900">#{{ sprintf('%02d', $member->index_number) }} {{ $member->name }}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-2 pb-6 border-b border-zinc-200">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600">
                    Edit Profil Anggota #{{ sprintf('%02d', $member->index_number) }}
                </span>
                <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-zinc-900">
                    {{ $member->name }}
                </h1>
                <p class="text-sm text-zinc-500 mt-0.5">
                    Spesialisasi RPL SMKN 1 Ciamis &bull; {{ $member->role }}
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <a 
                    href="{{ route('portfolio.member', $member->slug) }}" 
                    target="_blank"
                    class="px-4 py-2 rounded-xl border border-zinc-200 bg-white hover:bg-zinc-50 text-zinc-700 text-xs font-semibold transition-all inline-flex items-center space-x-1.5"
                >
                    <span>Lihat Halaman Publik</span>
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
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
        action="{{ route('admin.members.update', $member) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="space-y-8"
    >
        @csrf
        @method('PUT')

        <!-- SECTION: FOTO PROFIL & IDENTITAS UTAMA -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-6 sm:p-8 space-y-6 shadow-2xs">
            <h2 class="text-lg font-bold text-zinc-900 flex items-center space-x-2 pb-3 border-b border-zinc-100">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>Foto Profil & Identitas Utama</span>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                
                <!-- Avatar Preview & Upload Box -->
                <div class="space-y-4">
                    <label class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Foto Profil
                    </label>

                    <div class="flex flex-col items-center p-6 border-2 border-dashed border-zinc-200 rounded-2xl bg-zinc-50/50 space-y-4 text-center">
                        <div class="relative group">
                            <img 
                                id="avatar-preview-img"
                                src="{{ old('avatar_url', $member->avatar_url) }}" 
                                alt="{{ $member->name }}" 
                                class="w-28 h-28 rounded-2xl object-cover border-2 border-white shadow-md bg-zinc-200"
                                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=09090b&color=ffffff&size=256';"
                            >
                            <span class="absolute -bottom-2 -right-2 px-2 py-0.5 rounded-full bg-zinc-950 text-white font-mono text-[10px] font-bold">
                                #{{ sprintf('%02d', $member->index_number) }}
                            </span>
                        </div>

                        <div class="space-y-2 w-full">
                            <label for="avatar_file" class="block w-full py-2 px-3 rounded-xl bg-zinc-900 hover:bg-zinc-800 text-white text-xs font-bold cursor-pointer transition-colors shadow-2xs">
                                <span>Pilih Berkas Foto Baru</span>
                                <input 
                                    type="file" 
                                    name="avatar_file" 
                                    id="avatar_file" 
                                    accept="image/png,image/jpeg,image/jpg,image/webp" 
                                    class="hidden"
                                >
                            </label>
                            <div class="text-[11px] text-zinc-400">
                                Format: JPG, PNG, WEBP (Maksimal 4MB)
                            </div>
                        </div>
                    </div>

                    <!-- Direct URL Option -->
                    <div class="space-y-1.5 pt-1">
                        <label for="avatar_url" class="block text-[11px] font-semibold text-zinc-600">
                            Atau Tautan URL Gambar (Opsional):
                        </label>
                        <input 
                            type="url" 
                            name="avatar_url" 
                            id="avatar_url" 
                            value="{{ old('avatar_url', $member->avatar_url) }}" 
                            placeholder="https://..."
                            class="w-full px-3 py-2 rounded-xl border border-zinc-200 text-xs font-mono text-zinc-800 focus:outline-none focus:ring-2 focus:ring-zinc-900"
                        >
                    </div>
                </div>

                <!-- Basic Fields -->
                <div class="lg:col-span-2 space-y-5">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Full Name -->
                        <div class="space-y-1.5 sm:col-span-2">
                            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                value="{{ old('name', $member->name) }}" 
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 bg-white text-zinc-900 text-sm font-semibold focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>

                        <!-- Role -->
                        <div class="space-y-1.5">
                            <label for="role" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Jabatan / Peran Utama <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="role" 
                                id="role" 
                                value="{{ old('role', $member->role) }}" 
                                required
                                placeholder="Misal: Lead Systems Architect"
                                class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 bg-white text-zinc-900 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>

                        <!-- Specialization -->
                        <div class="space-y-1.5">
                            <label for="specialization" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Spesialisasi Keahlian <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="specialization" 
                                id="specialization" 
                                value="{{ old('specialization', $member->specialization) }}" 
                                required
                                placeholder="Misal: Distributed Backend & Cloud"
                                class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 bg-white text-zinc-900 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>

                        <!-- Location -->
                        <div class="space-y-1.5">
                            <label for="location" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                                Lokasi <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="location" 
                                id="location" 
                                value="{{ old('location', $member->location) }}" 
                                required
                                placeholder="Ciamis, Jawa Barat, Indonesia"
                                class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 bg-white text-zinc-900 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                            >
                        </div>

                        <!-- Availability Toggle -->
                        <div class="space-y-1.5 flex flex-col justify-end">
                            <label class="flex items-center space-x-3 p-3 rounded-xl border border-zinc-200 bg-zinc-50/70 cursor-pointer select-none">
                                <input 
                                    type="checkbox" 
                                    name="is_available" 
                                    id="is_available" 
                                    value="1" 
                                    {{ old('is_available', $member->is_available) ? 'checked' : '' }}
                                    class="w-4 h-4 rounded text-blue-600 border-zinc-300 focus:ring-blue-600"
                                >
                                <div class="text-xs">
                                    <div class="font-bold text-zinc-800">Status: Siap Menerima Proyek</div>
                                    <div class="text-zinc-500 text-[11px]">Tampilkan lencana hijau "Tersedia" di web</div>
                                </div>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- SECTION: KONTAK & MEDIA SOSIAL -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-6 sm:p-8 space-y-6 shadow-2xs">
            <h2 class="text-lg font-bold text-zinc-900 flex items-center space-x-2 pb-3 border-b border-zinc-100">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>Kontak & Tautan Profil</span>
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Email Resmi <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', $member->email) }}" 
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >
                </div>

                <div class="space-y-1.5">
                    <label for="phone" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Nomor Telepon / WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="phone" 
                        id="phone" 
                        value="{{ old('phone', $member->phone) }}" 
                        required
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >
                </div>

                <div class="space-y-1.5">
                    <label for="github_url" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Tautan Profil GitHub
                    </label>
                    <input 
                        type="url" 
                        name="github_url" 
                        id="github_url" 
                        value="{{ old('github_url', $member->github_url) }}" 
                        placeholder="https://github.com/username"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >
                </div>

                <div class="space-y-1.5">
                    <label for="linkedin_url" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Tautan Profil LinkedIn
                    </label>
                    <input 
                        type="url" 
                        name="linkedin_url" 
                        id="linkedin_url" 
                        value="{{ old('linkedin_url', $member->linkedin_url) }}" 
                        placeholder="https://linkedin.com/in/username"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >
                </div>

                <div class="space-y-1.5">
                    <label for="instagram_url" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Tautan Profil Instagram
                    </label>
                    <input 
                        type="url" 
                        name="instagram_url" 
                        id="instagram_url" 
                        value="{{ old('instagram_url', $member->instagram_url) }}" 
                        placeholder="https://instagram.com/username"
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >
                </div>

                <div class="space-y-1.5">
                    <label for="cv_url" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Tautan Resume / CV
                    </label>
                    <input 
                        type="url" 
                        name="cv_url" 
                        id="cv_url" 
                        value="{{ old('cv_url', $member->cv_url) }}" 
                        placeholder="https://..."
                        class="w-full px-4 py-2.5 rounded-xl border border-zinc-200 text-sm focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >
                </div>
            </div>
        </div>

        <!-- SECTION: BIOGRAFI & CERITA PERJALANAN -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-6 sm:p-8 space-y-6 shadow-2xs">
            <h2 class="text-lg font-bold text-zinc-900 flex items-center space-x-2 pb-3 border-b border-zinc-100">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <span>Biografi & Cerita Lengkap</span>
            </h2>

            <div class="space-y-5">
                <!-- Short Bio -->
                <div class="space-y-1.5">
                    <label for="short_bio" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Bio Ringkas (Maksimal 500 Karakter) <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="short_bio" 
                        id="short_bio" 
                        rows="3" 
                        maxlength="500"
                        required
                        class="w-full px-4 py-3 rounded-xl border border-zinc-200 text-sm leading-relaxed focus:outline-none focus:ring-2 focus:ring-zinc-900"
                    >{{ old('short_bio', $member->short_bio) }}</textarea>
                </div>

                <!-- Full About Story -->
                <div class="space-y-1.5">
                    <label for="about_story" class="block text-xs font-bold uppercase tracking-wider text-zinc-700">
                        Cerita Perjalanan, Etos Kerja & Keahlian Lengkap <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        name="about_story" 
                        id="about_story" 
                        rows="6" 
                        required
                        class="w-full px-4 py-3 rounded-xl border border-zinc-200 text-sm leading-relaxed focus:outline-none focus:ring-2 focus:ring-zinc-900 font-sans"
                    >{{ old('about_story', $member->about_story) }}</textarea>
                    <div class="text-[11px] text-zinc-400">
                        Dukungan paragraf biasa atau teks naratif yang tampil di halaman profil individual anggota.
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION: MATRIX KEAHLIAN / SKILLS -->
        <div class="bg-white rounded-3xl border border-zinc-200 p-6 sm:p-8 space-y-6 shadow-2xs">
            <div class="flex items-center justify-between pb-3 border-b border-zinc-100">
                <h2 class="text-lg font-bold text-zinc-900 flex items-center space-x-2">
                    <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                    <span>Keahlian & Penguasaan Teknologi (Skills)</span>
                </h2>
                <span class="text-xs text-zinc-500">Centang teknologi yang dikuasai</span>
            </div>

            @php
                $memberSkillIds = old('skills', $member->skills->pluck('id')->toArray());
                $skillsByCategory = $allSkills->groupBy('category');
            @endphp

            <div class="space-y-6">
                @foreach ($skillsByCategory as $category => $categorySkills)
                    <div class="space-y-2.5">
                        <div class="text-xs font-bold uppercase tracking-wider text-zinc-400">{{ $category }}</div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-2.5">
                            @foreach ($categorySkills as $skill)
                                <label class="flex items-center space-x-2.5 p-2.5 rounded-xl border border-zinc-200 hover:border-zinc-300 hover:bg-zinc-50/80 cursor-pointer select-none transition-colors">
                                    <input 
                                        type="checkbox" 
                                        name="skills[]" 
                                        value="{{ $skill->id }}" 
                                        {{ in_array($skill->id, $memberSkillIds) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded text-zinc-950 border-zinc-300 focus:ring-zinc-900"
                                    >
                                    <span class="text-xs font-medium text-zinc-800">{{ $skill->name }}</span>
                                </label>
                            @endforeach
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
                    <span>Simpan Perubahan Profil</span>
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    // Live avatar preview when file chosen
    const avatarInput = document.getElementById('avatar_file');
    const avatarUrlInput = document.getElementById('avatar_url');
    const avatarPreviewImg = document.getElementById('avatar-preview-img');

    if (avatarInput && avatarPreviewImg) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const url = URL.createObjectURL(file);
                avatarPreviewImg.src = url;
            }
        });
    }

    if (avatarUrlInput && avatarPreviewImg) {
        avatarUrlInput.addEventListener('input', function(e) {
            if (e.target.value.trim() !== '') {
                avatarPreviewImg.src = e.target.value.trim();
            }
        });
    }
</script>
@endpush

