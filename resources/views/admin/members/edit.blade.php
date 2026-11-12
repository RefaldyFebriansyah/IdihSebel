@extends('layouts.admin')

@section('title', 'Edit Profil — ' . $member->name)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 space-y-8">

    <!-- HEADER -->
    <div class="space-y-3 pb-6 border-b border-brand-200/80">
        <div class="flex items-center space-x-2 text-xs font-medium text-brand-500">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-brand-900 transition-colors">IdihSebel</a>
            <span>/</span>
            <a href="{{ route('admin.dashboard') }}#members-section" class="hover:text-brand-900 transition-colors">Anggota Tim</a>
            <span>/</span>
            <span class="text-brand-950 font-semibold">{{ $member->name }}</span>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-brand-950">
                    Edit Profil: {{ $member->name }}
                </h1>
                <p class="text-xs sm:text-sm text-brand-500 mt-1">
                    {{ $member->role }} &bull; Anggota #{{ sprintf('%02d', $member->index_number) }}
                </p>
            </div>
            <div>
                <a 
                    href="{{ route('portfolio.member', $member->slug) }}" 
                    target="_blank"
                    class="inline-flex items-center space-x-1.5 px-3.5 py-2 rounded-xl border border-brand-200 bg-white hover:bg-brand-50 text-brand-700 text-xs font-semibold transition-colors"
                >
                    <span>Lihat Halaman Publik</span>
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
        action="{{ route('admin.members.update', $member) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="space-y-8"
    >
        @csrf
        @method('PUT')

        <!-- SECTION 1: FOTO & IDENTITAS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Foto & Identitas</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Informasi nama, peran, dan foto profil yang tampil pada website.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-6 shadow-2xs">
                
                <!-- Avatar Upload Field -->
                <div class="space-y-3">
                    <label class="block text-xs font-semibold text-brand-700">Foto Profil</label>
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-5">
                        <div class="relative shrink-0">
                            <img 
                                id="avatar-preview-img"
                                src="{{ old('avatar_url', $member->avatar_url) }}" 
                                alt="{{ $member->name }}" 
                                class="w-20 h-20 rounded-2xl object-cover ring-2 ring-brand-100 bg-brand-50 shadow-2xs"
                                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name={{ urlencode($member->name) }}&background=0f172a&color=ffffff&size=160';"
                            >
                            <span class="absolute -bottom-1 -right-1 px-1.5 py-0.5 rounded-md bg-brand-950 text-white text-[10px] font-bold">
                                #{{ sprintf('%02d', $member->index_number) }}
                            </span>
                        </div>

                        <div class="space-y-2 flex-1">
                            <label for="avatar_file" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl bg-brand-100 hover:bg-brand-200 text-brand-900 text-xs font-medium cursor-pointer transition-colors border border-brand-200">
                                <svg class="w-4 h-4 text-brand-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                                <span>Pilih Berkas Foto Baru</span>
                                <input 
                                    type="file" 
                                    name="avatar_file" 
                                    id="avatar_file" 
                                    accept="image/png,image/jpeg,image/jpg,image/webp" 
                                    class="hidden"
                                >
                            </label>
                            <div class="text-[11px] text-brand-400">
                                Format: JPG, PNG, WEBP (maksimal 4MB)
                            </div>
                            <div class="pt-1">
                                <input 
                                    type="url" 
                                    name="avatar_url" 
                                    id="avatar_url" 
                                    value="{{ old('avatar_url', $member->avatar_url) }}" 
                                    placeholder="Atau masukkan URL foto langsung: https://..."
                                    class="w-full px-3.5 py-2 rounded-xl border border-brand-200 text-xs text-brand-800 placeholder-brand-400 focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-px bg-brand-100"></div>

                <!-- Text Fields -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Full Name -->
                    <div class="space-y-1.5 sm:col-span-2">
                        <label for="name" class="block text-xs font-semibold text-brand-700">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            value="{{ old('name', $member->name) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 bg-white text-brand-900 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950 font-medium"
                        >
                    </div>

                    <!-- Role -->
                    <div class="space-y-1.5">
                        <label for="role" class="block text-xs font-semibold text-brand-700">
                            Posisi / Peran <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="role" 
                            id="role" 
                            value="{{ old('role', $member->role) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <!-- Specialization -->
                    <div class="space-y-1.5">
                        <label for="specialization" class="block text-xs font-semibold text-brand-700">
                            Fokus Keahlian <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="specialization" 
                            id="specialization" 
                            value="{{ old('specialization', $member->specialization) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <!-- Location -->
                    <div class="space-y-1.5">
                        <label for="location" class="block text-xs font-semibold text-brand-700">
                            Kota / Domisili <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="location" 
                            id="location" 
                            value="{{ old('location', $member->location) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <!-- Availability -->
                    <div class="space-y-1.5 flex flex-col justify-end">
                        <label class="flex items-center space-x-2.5 p-2.5 rounded-xl border border-brand-200 bg-brand-50 cursor-pointer select-none">
                            <input 
                                type="checkbox" 
                                name="is_available" 
                                id="is_available" 
                                value="1" 
                                {{ old('is_available', $member->is_available) ? 'checked' : '' }}
                                class="w-4 h-4 rounded text-brand-950 border-brand-300 focus:ring-brand-950"
                            >
                            <span class="text-xs font-medium text-brand-800">Status Tersedia untuk Menerima Proyek</span>
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="border-t border-brand-200/80"></div>

        <!-- SECTION 2: KONTAK -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Kontak & Sosial Media</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Informasi kontak dan tautan profil media sosial anggota.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-4 shadow-2xs">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1.5">
                        <label for="email" class="block text-xs font-semibold text-brand-700">
                            Email <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', $member->email) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="phone" class="block text-xs font-semibold text-brand-700">
                            Nomor WhatsApp / HP <span class="text-rose-500">*</span>
                        </label>
                        <input 
                            type="text" 
                            name="phone" 
                            id="phone" 
                            value="{{ old('phone', $member->phone) }}" 
                            required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="github_url" class="block text-xs font-semibold text-brand-700">
                            Profil GitHub
                        </label>
                        <input 
                            type="url" 
                            name="github_url" 
                            id="github_url" 
                            value="{{ old('github_url', $member->github_url) }}" 
                            placeholder="https://github.com/..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="linkedin_url" class="block text-xs font-semibold text-brand-700">
                            Profil LinkedIn
                        </label>
                        <input 
                            type="url" 
                            name="linkedin_url" 
                            id="linkedin_url" 
                            value="{{ old('linkedin_url', $member->linkedin_url) }}" 
                            placeholder="https://linkedin.com/in/..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="instagram_url" class="block text-xs font-semibold text-brand-700">
                            Instagram
                        </label>
                        <input 
                            type="url" 
                            name="instagram_url" 
                            id="instagram_url" 
                            value="{{ old('instagram_url', $member->instagram_url) }}" 
                            placeholder="https://instagram.com/..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>

                    <div class="space-y-1.5">
                        <label for="cv_url" class="block text-xs font-semibold text-brand-700">
                            Tautan CV / Resume
                        </label>
                        <input 
                            type="url" 
                            name="cv_url" 
                            id="cv_url" 
                            value="{{ old('cv_url', $member->cv_url) }}" 
                            placeholder="https://..."
                            class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                        >
                    </div>
                </div>
            </div>
        </div>

        <div class="border-t border-brand-200/80"></div>

        <!-- SECTION 3: BIOGRAFI -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Bio & Cerita Singkat</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Deskripsi singkat yang tampil pada kartu profil di website.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-4 shadow-2xs">
                <div class="space-y-1.5">
                    <label for="short_bio" class="block text-xs font-semibold text-brand-700">
                        Bio Ringkas (maksimal 500 karakter) <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        name="short_bio" 
                        id="short_bio" 
                        rows="3" 
                        maxlength="500"
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs leading-relaxed focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950"
                    >{{ old('short_bio', $member->short_bio) }}</textarea>
                </div>

                <div class="space-y-1.5">
                    <label for="about_story" class="block text-xs font-semibold text-brand-700">
                        Cerita Lengkap & Pengalaman <span class="text-rose-500">*</span>
                    </label>
                    <textarea 
                        name="about_story" 
                        id="about_story" 
                        rows="6" 
                        required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-brand-200 text-xs leading-relaxed focus:outline-none focus:ring-2 focus:ring-brand-950/10 focus:border-brand-950 font-sans"
                    >{{ old('about_story', $member->about_story) }}</textarea>
                </div>
            </div>
        </div>

        <div class="border-t border-brand-200/80"></div>

        <!-- SECTION 4: KEAHLIAN / SKILLS -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="space-y-1">
                <h2 class="text-sm font-bold text-brand-950">Keahlian Teknologi</h2>
                <p class="text-xs text-brand-500 leading-relaxed">
                    Centang teknologi yang dikuasai oleh anggota ini.
                </p>
            </div>

            <div class="md:col-span-2 bg-white rounded-2xl border border-brand-200/80 p-6 space-y-6 shadow-2xs">
                @php
                    $memberSkillIds = old('skills', $member->skills->pluck('id')->toArray());
                    $skillsByCategory = $allSkills->groupBy('category');
                @endphp

                @foreach ($skillsByCategory as $category => $categorySkills)
                    <div class="space-y-2">
                        <div class="text-xs font-bold text-brand-500 uppercase tracking-wider">{{ $category }}</div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                            @foreach ($categorySkills as $skill)
                                <label class="flex items-center space-x-2.5 p-2 rounded-xl border border-brand-200 hover:bg-brand-50 cursor-pointer select-none transition-colors">
                                    <input 
                                        type="checkbox" 
                                        name="skills[]" 
                                        value="{{ $skill->id }}" 
                                        {{ in_array($skill->id, $memberSkillIds) ? 'checked' : '' }}
                                        class="w-4 h-4 rounded text-brand-950 border-brand-300 focus:ring-brand-950"
                                    >
                                    <span class="text-xs text-brand-800 font-medium">{{ $skill->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                @endforeach
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
    const avatarInput = document.getElementById('avatar_file');
    const avatarUrlInput = document.getElementById('avatar_url');
    const avatarPreviewImg = document.getElementById('avatar-preview-img');

    if (avatarInput && avatarPreviewImg) {
        avatarInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                avatarPreviewImg.src = URL.createObjectURL(file);
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
