<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\Member;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with complete collective data.
     */
    public function run(): void
    {
        // Clear existing tables in sequence
        DB::statement('PRAGMA foreign_keys = OFF;');
        Experience::truncate();
        DB::table('member_project')->truncate();
        DB::table('member_skill')->truncate();
        Project::truncate();
        Skill::truncate();
        Member::truncate();
        DB::statement('PRAGMA foreign_keys = ON;');

        // Create Default Admin User
        User::updateOrCreate(
            ['email' => 'admin@idihsebel.id'],
            [
                'name' => 'Admin IdihSebel',
                'password' => Hash::make('admin123'),
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | 1. SKILLS CATALOG (Official Monochrome SimpleIcons SVG Paths)
        |--------------------------------------------------------------------------
        */
        $skillsData = [
            // Frontend
            [
                'name' => 'HTML5',
                'slug' => 'html5',
                'category' => 'Frontend',
                'svg_path' => 'M1.5 0h21l-1.91 21.563L11.977 24l-8.565-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059-.001.248-2.719L5.474 4.312l.713 8.156h8.468l-.299 3.281-2.378.641-2.38-.641-.153-1.703H6.71l.298 3.531 4.969 1.379 4.97-1.379.664-7.487H8.531z',
            ],
            [
                'name' => 'CSS3',
                'slug' => 'css3',
                'category' => 'Frontend',
                'svg_path' => 'M1.5 0h21l-1.91 21.563L11.977 24l-8.564-2.438L1.5 0zm7.031 9.75l-.232-2.718 10.059-.001.249-2.719L5.474 4.312l.713 8.156h8.468l-.299 3.281-2.378.641-2.38-.641-.153-1.703H6.71l.298 3.531 4.969 1.379 4.97-1.379.664-7.487H8.531z',
            ],
            [
                'name' => 'JavaScript',
                'slug' => 'javascript',
                'category' => 'Frontend',
                'svg_path' => 'M0 0h24v24H0V0zm22.034 18.276c-.175-1.095-.888-2.015-3.003-2.873-.736-.345-1.554-.585-1.797-1.14-.091-.33-.105-.51-.046-.705.15-.646.915-.84 1.515-.66.39.12.75.42.976.9 1.034-.676 1.034-.676 1.755-1.125-.27-.42-.404-.601-.586-.78-.63-.705-1.469-1.065-2.834-1.034l-.705.089c-.676.165-1.32.525-1.71 1.005-1.14 1.291-.811 3.541.569 4.471 1.365 1.02 3.361 1.244 3.616 2.221.24 1.02-.45 1.485-1.635 1.485-1.246 0-1.89-.585-2.43-1.41l-1.8 1.11c.42.795.96 1.365 1.635 1.74 1.11.585 2.61.645 3.84.18 1.41-.54 2.145-1.71 1.83-3.465l-.015.015zm-8.249-8.491h-2.385v7.697c0 1.575-.075 2.37-.42 3.015-.435.795-1.29 1.29-2.34 1.29-.69 0-1.245-.195-1.74-.585l.795-1.47c.3.24.615.39.99.39.525 0 .84-.33.84-1.215V9.785z',
            ],
            [
                'name' => 'Tailwind CSS',
                'slug' => 'tailwindcss',
                'category' => 'Frontend',
                'svg_path' => 'M12.001 4.8c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624C13.666 10.618 15.027 12 18.001 12c3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C16.337 6.182 14.976 4.8 12.001 4.8zm-6 7.2c-3.2 0-5.2 1.6-6 4.8 1.2-1.6 2.6-2.2 4.2-1.8.913.228 1.565.89 2.288 1.624 1.177 1.194 2.538 2.576 5.512 2.576 3.2 0 5.2-1.6 6-4.8-1.2 1.6-2.6 2.2-4.2 1.8-.913-.228-1.565-.89-2.288-1.624C10.337 13.382 8.976 12 6.001 12z',
            ],
            [
                'name' => 'Bootstrap',
                'slug' => 'bootstrap',
                'category' => 'Frontend',
                'svg_path' => 'M20.407 4.148C18.665 2.247 16.035 1.5 12 1.5 7.965 1.5 5.335 2.247 3.593 4.148 1.852 6.05 1.5 8.953 1.5 12s.352 5.95 2.093 7.852C5.335 21.753 7.965 22.5 12 22.5c4.035 0 6.665-.747 8.407-2.648C22.148 17.95 22.5 15.047 22.5 12s-.352-5.95-2.093-7.852zM12.91 16.273h-3.9v-8.55h3.9c1.644 0 2.668.794 2.668 2.062 0 .848-.54 1.536-1.396 1.802v.078c1.077.24 1.777 1.054 1.777 2.19 0 1.488-1.155 2.418-3.049 2.418zm-.952-5.265h-1.365v-1.84h1.365c.78 0 1.258.337 1.258.92 0 .6-.478.92-1.258.92zm.172 3.824h-1.537v-2.074h1.537c.883 0 1.43.376 1.43 1.037 0 .662-.547 1.037-1.43 1.037z',
            ],

            // Backend
            [
                'name' => 'PHP',
                'slug' => 'php',
                'category' => 'Backend',
                'svg_path' => 'M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm-5.7 15.3l.7-4.2h1.5c1.4 0 2.2.6 2 2-.2 1.4-1.2 2.2-2.6 2.2H6.3zm1.1-2.4h.8c.6 0 1-.3 1.1-.9.1-.5-.2-.9-.8-.9h-.8l-.3 1.8zm6 2.4l.7-4.2h1.5c1.4 0 2.2.6 2 2-.2 1.4-1.2 2.2-2.6 2.2h-1.6zm1.1-2.4h.8c.6 0 1-.3 1.1-.9.1-.5-.2-.9-.8-.9h-.8l-.3 1.8zm-3.8 2.4l1.4-8.4h1.6l-.4 2.6h2.2c1.9 0 3.3.9 3 2.9-.3 1.9-1.9 2.9-3.8 2.9H9.6z',
            ],
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'category' => 'Backend',
                'svg_path' => 'M8.7 0L0 5.023l8.7 5.023 8.7-5.023L8.7 0zm15.3 5.023L15.3 0l-3.3 1.905 8.7 5.023 3.3-1.905zm-.3 1.905l-8.7 5.023v9.041l8.7-5.023V6.928zm-9.3 5.37l-8.7-5.023V15.97l8.7 5.023V12.298z',
            ],
            [
                'name' => 'MySQL',
                'slug' => 'mysql',
                'category' => 'Backend',
                'svg_path' => 'M17.477 15.334c-.456-.22-.93-.34-1.398-.363-.448-.023-.9.047-1.309.208-.41.16-.763.415-1.02.737-.257.322-.408.71-.433 1.119-.025.408.077.813.297 1.163.22.35.54.62.915.776.376.155.787.193 1.182.11.395-.084.752-.275 1.026-.55.088-.088.163-.186.223-.291.06-.106.103-.22.128-.339.025-.12.032-.243.02-.365-.011-.122-.041-.241-.09-.352a1.86 1.86 0 0 0-.2-.317 1.84 1.84 0 0 0-.295-.257l-.369-.234c-.26-.144-.475-.347-.624-.59-.148-.242-.218-.523-.203-.805.015-.282.115-.55.289-.773.174-.222.413-.384.686-.465.274-.082.565-.07.837.034.272.103.504.288.665.53.078.118.136.248.171.385l1.631-.476a3.86 3.86 0 0 0-.503-.984c-.26-.37-.59-.66-.975-.86a3.52 3.52 0 0 0-1.288-.335c-.47-.024-.942.046-1.378.204-.436.159-.817.417-1.107.751-.29.334-.48.736-.551 1.169-.071.433-.023.878.14 1.288.163.41.436.76.788 1.01.353.25.776.386 1.218.39.378.004.752-.08 1.085-.244.334-.165.617-.41.82-.713.203-.304.309-.662.308-1.03-.001-.368-.11-.724-.316-1.026zm-7.653-7.52L5.8 15.666h2.155l.805-2.062h3.428l.799 2.062h2.203L11.18 7.814H9.824zm.843 2.502l1.246 3.238h-2.51l1.264-3.238z',
            ],
            [
                'name' => 'REST API',
                'slug' => 'rest-api',
                'category' => 'Backend',
                'svg_path' => 'M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm0-8h-2V7h2v2zm4 8h-2v-4h2v4zm0-6h-2v-2h2v2z',
            ],
            [
                'name' => 'System Architecture',
                'slug' => 'system-architecture',
                'category' => 'Backend',
                'svg_path' => 'M4 2h16a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2zm0 12h16a2 2 0 0 1 2 2v4a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2zm2-8h.01M6 18h.01',
            ],

            // UI/UX & Design
            [
                'name' => 'Figma',
                'slug' => 'figma',
                'category' => 'UI/UX & Design',
                'svg_path' => 'M15.85 6.643c0-1.846-1.498-3.343-3.343-3.343H7.507v6.686h5c1.845 0 3.343-1.498 3.343-3.343zm0 6.714c0-1.846-1.498-3.343-3.343-3.343h-5v6.686h5c1.845 0 3.343-1.498 3.343-3.343zM7.507 3.3c-1.845 0-3.343 1.497-3.343 3.343 0 1.845 1.498 3.343 3.343 3.343h.007V3.3zm0 6.714c-1.845 0-3.343 1.498-3.343 3.343 0 1.846 1.498 3.343 3.343 3.343h.007v-6.686zm3.343 6.715c0 1.845-1.498 3.343-3.343 3.343-1.845 0-3.343-1.498-3.343-3.343 0-1.846 1.498-3.343 3.343-3.343h3.343v3.343z',
            ],
            [
                'name' => 'Design System',
                'slug' => 'design-system',
                'category' => 'UI/UX & Design',
                'svg_path' => 'M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5',
            ],
            [
                'name' => 'Wireframing',
                'slug' => 'wireframing',
                'category' => 'UI/UX & Design',
                'svg_path' => 'M3 3h18v18H3V3zm2 2v4h6V5H5zm8 0v4h6V5h-6zm-8 6v8h6v-8H5zm8 0v8h6v-8h-6z',
            ],
            [
                'name' => 'Prototyping',
                'slug' => 'prototyping',
                'category' => 'UI/UX & Design',
                'svg_path' => 'M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-2 14.5v-9l6 4.5-6 4.5z',
            ],

            // Mobile & Tools
            [
                'name' => 'Kotlin',
                'slug' => 'kotlin',
                'category' => 'Mobile & Tools',
                'svg_path' => 'M24 24H0V0h24L12 12Z',
            ],
            [
                'name' => 'Flutter',
                'slug' => 'flutter',
                'category' => 'Mobile & Tools',
                'svg_path' => 'M14.314 0L2.3 12 6 15.7 21.684.013h-7.37zM6 15.7L14.314 24h7.37L13.37 15.7 6 15.7zm0 0L9.685 12 6 8.314 2.3 12 6 15.7z',
            ],
            [
                'name' => 'Git & GitHub',
                'slug' => 'git-github',
                'category' => 'Mobile & Tools',
                'svg_path' => 'M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12',
            ],
            [
                'name' => 'Linux / Laragon',
                'slug' => 'linux-laragon',
                'category' => 'Mobile & Tools',
                'svg_path' => 'M12 2a4 4 0 0 0-4 4v1.5a3.5 3.5 0 0 0-3 3.5v7a3 3 0 0 0 3 3h8a3 3 0 0 0 3-3v-7a3.5 3.5 0 0 0-3-3.5V6a4 4 0 0 0-4-4zm0 2a2 2 0 0 1 2 2v1h-4V6a2 2 0 0 1 2-2z',
            ],
            [
                'name' => 'QA & System Testing',
                'slug' => 'qa-testing',
                'category' => 'Mobile & Tools',
                'svg_path' => 'M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z',
            ],
            [
                'name' => 'Technical Documentation',
                'slug' => 'technical-docs',
                'category' => 'Mobile & Tools',
                'svg_path' => 'M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M16 13H8M16 17H8M10 9H8',
            ],
        ];

        $skills = [];
        foreach ($skillsData as $s) {
            $skills[$s['slug']] = Skill::create($s);
        }

        /*
        |--------------------------------------------------------------------------
        | 2. ALL 6 MEMBERS (5 Cowo, 1 Cewe — Lulusan SMKN 1 Ciamis Jurusan RPL)
        |--------------------------------------------------------------------------
        */
        $membersData = [
            // 01: Rasya Syahreza (Cowo)
            [
                'index_number' => '01',
                'name' => 'Rasya Syahreza',
                'slug' => 'rasya-syahreza',
                'role' => 'Front-End & UI Specialist',
                'specialization' => 'HTML5, CSS3, JavaScript, Tailwind CSS, Blade & UI/UX Slicing',
                'avatar_url' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=800&q=80',
                'short_bio' => 'Front-End developer lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Berfokus pada implementasi antarmuka modern dan responsif.',
                'about_story' => "Rasya Syahreza adalah pengembang Front-End lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Memiliki ketertarikan mendalam pada pembuatan antarmuka pengguna web yang rapi, cepat, dan interaktif.\n\nTerbiasa menggunakan Tailwind CSS, HTML5, JavaScript, dan Blade template engine untuk menerjemahkan rancangan desain antarmuka menjadi kode web yang terstruktur dan mudah dirawat.",
                'location' => 'Ciamis, Jawa Barat, Indonesia',
                'email' => 'rasyasyahreza@gmail.com',
                'phone' => '+62 812-2101-0001',
                'github_url' => 'https://github.com/rasyasyahreza',
                'linkedin_url' => 'https://linkedin.com/in/rasyasyahreza',
                'instagram_url' => 'https://instagram.com/rasyasyahreza',
                'cv_url' => 'https://read.cv/rasyasyahreza',
                'is_available' => true,
                'primary_skills' => ['html5', 'css3', 'javascript', 'tailwindcss', 'bootstrap', 'laravel', 'figma'],
                'experiences' => [
                    [
                        'period' => '2021 — 2024',
                        'title' => 'Siswa Rekayasa Perangkat Lunak (RPL)',
                        'organization' => 'SMKN 1 Ciamis',
                        'type' => 'Education',
                        'description' => 'Mempelajari dasar pemrograman web, algoritma perangkat lunak, perancangan antarmuka aplikasi, dan pembuatan proyek web interaktif.',
                    ],
                    [
                        'period' => '2023 — 2024',
                        'title' => 'Prakerin / Praktik Kerja Industri (Front-End)',
                        'organization' => 'Studio Mitra Industri TI — Ciamis',
                        'type' => 'Work',
                        'description' => 'Bertanggung jawab melakukan slicing desain UI ke dalam HTML/Tailwind CSS dan integrasi antarmuka pada proyek web sistem sekolah.',
                    ],
                    [
                        'period' => '2024 — Sekarang',
                        'title' => 'Front-End Web Specialist',
                        'organization' => 'Studio IdihSebel',
                        'type' => 'Project Milestone',
                        'description' => 'Mengembangkan antarmuka proyek web bersama 5 rekan tim lulusan SMKN 1 Ciamis.',
                    ],
                ],
            ],

            // 02: M. Fathin (Cowo)
            [
                'index_number' => '02',
                'name' => 'M. Fathin',
                'slug' => 'm-fathin',
                'role' => 'Back-End & Database Engineer',
                'specialization' => 'PHP, Laravel 11, MySQL, REST API Architecture & Data Modeling',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=800&q=80',
                'short_bio' => 'Back-End engineer lulusan SMKN 1 Ciamis jurusan RPL. Menguasai arsitektur backend Laravel, normalisasi database MySQL, dan pembuatan REST API.',
                'about_story' => "M. Fathin adalah pengembang Back-End lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Berfokus pada logika bisnis sisi server, perancangan database relasional yang optimal, dan pengamanan endpoint API.\n\nMemiliki keahlian dalam framework PHP Laravel, migrasi database, autentikasi multi-level, serta integrasi layanan backend untuk berbagai kebutuhan aplikasi web dan sistem informasi.",
                'location' => 'Ciamis, Jawa Barat, Indonesia',
                'email' => 'm.fathin@gmail.com',
                'phone' => '+62 813-2102-0002',
                'github_url' => 'https://github.com/mfathin',
                'linkedin_url' => 'https://linkedin.com/in/mfathin-backend',
                'instagram_url' => 'https://instagram.com/mfathin.dev',
                'cv_url' => 'https://read.cv/mfathin',
                'is_available' => true,
                'primary_skills' => ['php', 'laravel', 'mysql', 'rest-api', 'system-architecture', 'git-github', 'linux-laragon'],
                'experiences' => [
                    [
                        'period' => '2021 — 2024',
                        'title' => 'Siswa Rekayasa Perangkat Lunak (RPL)',
                        'organization' => 'SMKN 1 Ciamis',
                        'type' => 'Education',
                        'description' => 'Mendalami logika pemrograman backend, normalisasi database MySQL, query relasional, dan arsitektur Model-View-Controller (MVC).',
                    ],
                    [
                        'period' => '2023 — 2024',
                        'title' => 'Prakerin / Praktik Kerja Industri (Backend Dev)',
                        'organization' => 'Software House Partner — Jawa Barat',
                        'type' => 'Work',
                        'description' => 'Membangun endpoint REST API dan skema database relasional untuk sistem transaksi dan administrasi internal.',
                    ],
                    [
                        'period' => '2024 — Sekarang',
                        'title' => 'Lead Back-End Engineer',
                        'organization' => 'Studio IdihSebel',
                        'type' => 'Project Milestone',
                        'description' => 'Merancang logika backend, skema migrasi database MySQL, dan endpoint API pada portofolio proyek tim.',
                    ],
                ],
            ],

            // 03: Refaldy Febriansyah (Cowo)
            [
                'index_number' => '03',
                'name' => 'Refaldy Febriansyah',
                'slug' => 'refaldy-febriansyah',
                'role' => 'Full-Stack Web Developer',
                'specialization' => 'Laravel, Tailwind CSS, JavaScript, MySQL, Git & GitHub Workflows',
                'avatar_url' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=800&q=80',
                'short_bio' => 'Full-Stack developer lulusan SMKN 1 Ciamis jurusan RPL. Menghubungkan antarmuka interaktif dengan logika server dan database.',
                'about_story' => "Refaldy Febriansyah adalah pengembang web Full-Stack lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Memiliki kemampuan merancang aplikasi web secara menyeluruh, mulai dari perancangan skema database hingga tampilan antarmuka.\n\nMenggabungkan kekuatan backend Laravel dengan interaktivitas JavaScript dan Tailwind CSS untuk menciptakan sistem web yang fungsional, responsif, dan mudah digunakan.",
                'location' => 'Ciamis, Jawa Barat, Indonesia',
                'email' => 'refaldy.febriansyah@gmail.com',
                'phone' => '+62 811-2103-0003',
                'github_url' => 'https://github.com/refaldyfebriansyah',
                'linkedin_url' => 'https://linkedin.com/in/refaldy-febriansyah',
                'instagram_url' => 'https://instagram.com/refaldy.code',
                'cv_url' => 'https://read.cv/refaldyfebriansyah',
                'is_available' => true,
                'primary_skills' => ['laravel', 'tailwindcss', 'javascript', 'mysql', 'php', 'git-github', 'html5'],
                'experiences' => [
                    [
                        'period' => '2021 — 2024',
                        'title' => 'Siswa Rekayasa Perangkat Lunak (RPL)',
                        'organization' => 'SMKN 1 Ciamis',
                        'type' => 'Education',
                        'description' => 'Mempelajari siklus hidup pengembangan perangkat lunak (SDLC), framework web modern, dan kolaborasi git repository.',
                    ],
                    [
                        'period' => '2023 — 2024',
                        'title' => 'Prakerin / Web Developer Intern',
                        'organization' => 'Digital Agency Solution — Priangan Timur',
                        'type' => 'Work',
                        'description' => 'Mengerjakan pembuatan modul sistem web full-stack, integrasi form interaktif, dan pemeliharaan fitur aplikasi klien.',
                    ],
                    [
                        'period' => '2024 — Sekarang',
                        'title' => 'Senior Full-Stack Developer',
                        'organization' => 'Studio IdihSebel',
                        'type' => 'Project Milestone',
                        'description' => 'Memimpin pengembangan fitur end-to-end pada aplikasi web kolektif bersama tim RPL SMKN 1 Ciamis.',
                    ],
                ],
            ],

            // 04: Surya Aditya (Cowo)
            [
                'index_number' => '04',
                'name' => 'Surya Aditya',
                'slug' => 'surya-aditya',
                'role' => 'UI/UX Designer & Product Specialist',
                'specialization' => 'Figma, Design System, Wireframing, User Flow & Prototyping',
                'avatar_url' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=800&q=80',
                'short_bio' => 'UI/UX Designer lulusan SMKN 1 Ciamis jurusan RPL. Berfokus pada riset pengguna, perancangan wireframe, dan prototipe interaktif di Figma.',
                'about_story' => "Surya Aditya adalah desainer produk & antarmuka digital (UI/UX) lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Menggabungkan pemahaman teknis coding dengan kepekaan visual desain grafis.\n\nTerbiasa menyusun alur pengguna (user flow), wireframe struktural, komponen design system, dan prototipe interaktif di Figma sebelum diimplementasikan ke dalam kode oleh tim developer.",
                'location' => 'Ciamis, Jawa Barat, Indonesia',
                'email' => 'surya.aditya@gmail.com',
                'phone' => '+62 815-2104-0004',
                'github_url' => 'https://github.com/suryaaditya',
                'linkedin_url' => 'https://linkedin.com/in/surya-aditya-design',
                'instagram_url' => 'https://instagram.com/surya.uiux',
                'cv_url' => 'https://read.cv/suryaaditya',
                'is_available' => true,
                'primary_skills' => ['figma', 'design-system', 'wireframing', 'prototyping', 'html5', 'css3', 'tailwindcss'],
                'experiences' => [
                    [
                        'period' => '2021 — 2024',
                        'title' => 'Siswa Rekayasa Perangkat Lunak (RPL)',
                        'organization' => 'SMKN 1 Ciamis',
                        'type' => 'Education',
                        'description' => 'Mempelajari prinsip antarmuka pengguna (UI), pengalaman pengguna (UX), serta integrasi desain ke dalam struktur kode frontend.',
                    ],
                    [
                        'period' => '2023 — 2024',
                        'title' => 'Prakerin / UI/UX Design Intern',
                        'organization' => 'Creative Tech Hub — Jawa Barat',
                        'type' => 'Work',
                        'description' => 'Merancang wireframe, user flow, dan aset visual antarmuka sistem web untuk berbagai kebutuhan klien sekolah dan UMKM.',
                    ],
                    [
                        'period' => '2024 — Sekarang',
                        'title' => 'Lead UI/UX Designer',
                        'organization' => 'Studio IdihSebel',
                        'type' => 'Project Milestone',
                        'description' => 'Membuat standarisasi design system dan prototipe interaktif untuk seluruh proyek tim Kolektif Enam.',
                    ],
                ],
            ],

            // 05: Leonard (Cowo)
            [
                'index_number' => '05',
                'name' => 'Leonard',
                'slug' => 'leonard',
                'role' => 'Mobile Application Developer',
                'specialization' => 'Mobile Development, Flutter, Kotlin, REST API Integration & UI Layouts',
                'avatar_url' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=800&q=80',
                'short_bio' => 'Mobile application developer lulusan SMKN 1 Ciamis jurusan RPL. Terampil membangun aplikasi mobile Android dan Flutter yang responsif.',
                'about_story' => "Leonard adalah pengembang aplikasi mobile lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Berfokus pada perancangan aplikasi Android native (Kotlin) dan cross-platform (Flutter).\n\nBerpengalaman mengintegrasikan aplikasi mobile dengan REST API backend, manajemen state, penyimpanan lokal, serta pembuatan antarmuka mobile yang intuitif dan nyaman digunakan.",
                'location' => 'Ciamis, Jawa Barat, Indonesia',
                'email' => 'leonard.dev@gmail.com',
                'phone' => '+62 817-2105-0005',
                'github_url' => 'https://github.com/leonard-dev',
                'linkedin_url' => 'https://linkedin.com/in/leonard-mobile',
                'instagram_url' => 'https://instagram.com/leonard.mobile',
                'cv_url' => 'https://read.cv/leonard',
                'is_available' => true,
                'primary_skills' => ['flutter', 'kotlin', 'rest-api', 'git-github', 'javascript'],
                'experiences' => [
                    [
                        'period' => '2021 — 2024',
                        'title' => 'Siswa Rekayasa Perangkat Lunak (RPL)',
                        'organization' => 'SMKN 1 Ciamis',
                        'type' => 'Education',
                        'description' => 'Mempelajari dasar pembuatan aplikasi mobile, pemrograman berorientasi objek, siklus hidup activity/widget, dan integrasi API.',
                    ],
                    [
                        'period' => '2023 — 2024',
                        'title' => 'Prakerin / Mobile Developer Intern',
                        'organization' => 'Mobile App Studio — Jawa Barat',
                        'type' => 'Work',
                        'description' => 'Membantu pembuatan aplikasi mobile absensi dan katalog informasi berbasis Flutter dan integrasi REST API backend.',
                    ],
                    [
                        'period' => '2024 — Sekarang',
                        'title' => 'Lead Mobile Developer',
                        'organization' => 'Studio IdihSebel',
                        'type' => 'Project Milestone',
                        'description' => 'Mengembangkan aplikasi mobile dan integrasi layanan client untuk proyek portofolio tim.',
                    ],
                ],
            ],

            // 06: Fadhila (Cewe)
            [
                'index_number' => '06',
                'name' => 'Fadhila',
                'slug' => 'fadhila',
                'role' => 'QA Engineer & Technical Documentation',
                'specialization' => 'Software Quality Assurance, Database Testing, Bug Tracking & Technical Docs',
                'avatar_url' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=800&q=80',
                'short_bio' => 'QA Engineer & Technical Writer lulusan SMKN 1 Ciamis jurusan RPL. Memastikan keandalan fungsionalitas sistem dan dokumentasi teknis yang jelas.',
                'about_story' => "Fadhila adalah spesialis Quality Assurance (QA) dan dokumentasi teknis lulusan SMKN 1 Ciamis jurusan Rekayasa Perangkat Lunak (RPL). Berperan penting menjaga standar kualitas aplikasi perangkat lunak sebelum dirilis ke pengguna.\n\nTeliti dalam menyusun skenario pengujian fungsionalitas (test cases), pelacakan bug (bug tracking), validasi query database, serta penyusunan buku panduan pengguna dan dokumentasi teknis sistem yang rapi dan terstruktur.",
                'location' => 'Ciamis, Jawa Barat, Indonesia',
                'email' => 'fadhila.qa@gmail.com',
                'phone' => '+62 819-2106-0006',
                'github_url' => 'https://github.com/fadhila-qa',
                'linkedin_url' => 'https://linkedin.com/in/fadhila-qa',
                'instagram_url' => 'https://instagram.com/fadhila.docs',
                'cv_url' => 'https://read.cv/fadhila',
                'is_available' => true,
                'primary_skills' => ['qa-testing', 'technical-docs', 'mysql', 'php', 'git-github', 'system-architecture'],
                'experiences' => [
                    [
                        'period' => '2021 — 2024',
                        'title' => 'Siswa Rekayasa Perangkat Lunak (RPL)',
                        'organization' => 'SMKN 1 Ciamis',
                        'type' => 'Education',
                        'description' => 'Mendalami metodologi pengujian perangkat lunak, dokumentasi diagram alir (DFD/UML), dan tata kelola basis data relasional.',
                    ],
                    [
                        'period' => '2023 — 2024',
                        'title' => 'Prakerin / QA & Technical Documentation Intern',
                        'organization' => 'Pusat Layanan TI & Sistem Informasi — Ciamis',
                        'type' => 'Work',
                        'description' => 'Melakukan pengujian fungsional (manual testing), pencatatan laporan isu bug, dan pembuatan user manual untuk aplikasi web instansi.',
                    ],
                    [
                        'period' => '2024 — Sekarang',
                        'title' => 'Lead QA & Technical Documentation Specialist',
                        'organization' => 'Studio IdihSebel',
                        'type' => 'Project Milestone',
                        'description' => 'Menjalankan pengujian kualitas sistem dan memelihara dokumentasi teknis untuk seluruh aplikasi yang dibangun tim.',
                    ],
                ],
            ],
        ];

        $members = [];
        foreach ($membersData as $mData) {
            $primarySkills = $mData['primary_skills'];
            $experiences = $mData['experiences'];
            unset($mData['primary_skills'], $mData['experiences']);

            $member = Member::create($mData);
            $members[$member->index_number] = $member;

            // Attach skills with primary flag
            foreach ($primarySkills as $sSlug) {
                if (isset($skills[$sSlug])) {
                    $member->skills()->attach($skills[$sSlug]->id, ['is_primary' => true]);
                }
            }

            // Create experiences
            foreach ($experiences as $exp) {
                $member->experiences()->create($exp);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | 3. DEMO PORTFOLIO PROJECTS (Demo Mode — Portofolio Proyek SMKN 1 Ciamis RPL)
        |--------------------------------------------------------------------------
        */
        $projectsData = [
            [
                'title' => '[DEMO] Sistem Informasi Akademik & Kelulusan Siswa RPL',
                'slug' => 'demo-sistem-informasi-akademik-rpl',
                'year' => '2024',
                'category' => 'Web Application',
                'client_or_context' => 'Demo Showcase — Rekayasa Perangkat Lunak SMKN 1 Ciamis',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1556742049-0a67c5574f73?auto=format&fit=crop&w=1200&q=80',
                'summary' => 'Aplikasi web manajemen data siswa, rekapitulasi nilai kompetensi kejuruan, dan verifikasi kelulusan siswa jurusan RPL berbasis Laravel.',
                'case_study' => "Proyek demo ini dirancang sebagai studi kasus sistem informasi akademik internal jurusan Rekayasa Perangkat Lunak SMKN 1 Ciamis.\n\nMemfasilitasi pengelolaan data siswa, penilaian kompetensi keahlian kejuruan, input nilai ujian praktik, serta cetak rapor kompetensi digital dengan validasi otentikasi multi-level.",
                'tech_stack' => ['PHP', 'Laravel 11', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'REST API'],
                'live_url' => 'https://demo-akademik.smkn1ciamis.id',
                'repo_url' => 'https://github.com/idihsebel/demo-akademik-rpl',
                'is_featured' => true,
                'team' => [
                    ['member' => '01', 'role' => 'Front-End Slicing & Desain Antarmuka'],
                    ['member' => '02', 'role' => 'Lead Back-End & Relasi Database'],
                    ['member' => '06', 'role' => 'Pengujian Validasi Nilai & Dokumentasi'],
                ],
            ],
            [
                'title' => '[DEMO] Aplikasi Kas & Manajemen Keuangan Kelas RPL',
                'slug' => 'demo-aplikasi-kas-keuangan-rpl',
                'year' => '2024',
                'category' => 'System & POS',
                'client_or_context' => 'Demo Showcase — Keuangan & Kas Kelas SMKN 1 Ciamis',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=1200&q=80',
                'summary' => 'Aplikasi pembukuan kas iuran mingguan siswa, pencatatan pengeluaran kegiatan kelas, dan laporan rekapitulasi keuangan otomatis.',
                'case_study' => "Aplikasi demo pencatatan keuangan kelas untuk menggantikan buku kas manual dengan sistem digital transparan.\n\nMenyediakan matriks pembayaran per minggu, notifikasi tunggakan, rekapitulasi saldo kas otomatis, serta ekspor laporan keuangan kas kelas ke dalam format PDF/Excel.",
                'tech_stack' => ['Laravel 11', 'MySQL', 'Tailwind CSS', 'Alpine.js', 'PHP'],
                'live_url' => 'https://demo-kas.smkn1ciamis.id',
                'repo_url' => 'https://github.com/idihsebel/demo-kas-rpl',
                'is_featured' => true,
                'team' => [
                    ['member' => '03', 'role' => 'Lead Full-Stack Web Development'],
                    ['member' => '02', 'role' => 'Skema Relasi Database MySQL'],
                    ['member' => '06', 'role' => 'Pengujian Audit Transaksi & User Docs'],
                ],
            ],
            [
                'title' => '[DEMO] Desain Antarmuka Portal Perpustakaan & E-Learning',
                'slug' => 'demo-desain-uiux-perpustakaan-digital',
                'year' => '2024',
                'category' => 'UI/UX Design',
                'client_or_context' => 'Demo Prototype — Desain Antarmuka Edukasi Digital',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1513542789411-b6a5d4f31634?auto=format&fit=crop&w=1200&q=80',
                'summary' => 'Rancangan desain UI/UX portal perpustakaan digital dan materi modul interaktif di Figma dengan gaya antarmuka modern.',
                'case_study' => "Eksplorasi perancangan UI/UX untuk perpustakaan digital dan repository tugas siswa jurusan RPL SMKN 1 Ciamis.\n\nMenitikberatkan pada alur pencarian buku yang intuitif, katalog modul kejuruan berbasis tag teknologi, serta desain responsif untuk layar laptop dan smartphone.",
                'tech_stack' => ['Figma', 'Design System', 'Wireframing', 'Prototyping', 'Tailwind CSS'],
                'live_url' => 'https://figma.com/@kolektif-enam-demo',
                'repo_url' => 'https://github.com/idihsebel/demo-uiux-perpustakaan',
                'is_featured' => true,
                'team' => [
                    ['member' => '04', 'role' => 'Lead UI/UX Designer & User Flow'],
                    ['member' => '01', 'role' => 'Front-End Slicing ke Blade & Tailwind CSS'],
                ],
            ],
            [
                'title' => '[DEMO] Mobile Presensi Siswa & Jurnal PKL Berbasis GPS',
                'slug' => 'demo-mobile-presensi-jurnal-pkl',
                'year' => '2024',
                'category' => 'Mobile App',
                'client_or_context' => 'Demo Showcase — Aplikasi Mobile Android & Flutter',
                'thumbnail_url' => 'https://images.unsplash.com/photo-1625246333195-78d9c38ad449?auto=format&fit=crop&w=1200&q=80',
                'summary' => 'Aplikasi mobile presensi kehadiran harian siswa dan pengisian jurnal kegiatan praktik kerja industri (PKL) dengan validasi radius lokasi GPS.',
                'case_study' => "Aplikasi demo mobile Android/Flutter yang dirancang untuk mempermudah monitoring kehadiran siswa selama menjalani masa Prakerin/PKL di industri.\n\nDilengkapi fitur check-in berbasis geolokasi GPS, input catatan kegiatan harian, unggah foto bukti kerja, dan sinkronisasi data ke API backend Laravel.",
                'tech_stack' => ['Flutter', 'Kotlin', 'REST API', 'MySQL', 'Git & GitHub'],
                'live_url' => 'https://demo-presensi.smkn1ciamis.id',
                'repo_url' => 'https://github.com/idihsebel/demo-mobile-presensi',
                'is_featured' => true,
                'team' => [
                    ['member' => '05', 'role' => 'Lead Mobile Developer (Flutter/Kotlin)'],
                    ['member' => '02', 'role' => 'Endpoint REST API Backend Presensi'],
                    ['member' => '06', 'role' => 'Pengujian Validasi GPS & QA Documentation'],
                ],
            ],
        ];

        foreach ($projectsData as $pData) {
            $team = $pData['team'];
            unset($pData['team']);

            $project = Project::create($pData);

            foreach ($team as $t) {
                if (isset($members[$t['member']])) {
                    $project->members()->attach($members[$t['member']]->id, [
                        'specific_role' => $t['role'],
                    ]);
                }
            }
        }
    }
}
