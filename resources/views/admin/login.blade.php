<!DOCTYPE html>
<html lang="id" class="h-full bg-[#FAFAFB]">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Masuk Console — IdihSebel</title>

    <!-- Fonts: Plus Jakarta Sans & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Play CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', '-apple-system', 'BlinkMacSystemFont', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                    },
                    colors: {
                        studio: {
                            50: '#fafafa',
                            100: '#f4f4f5',
                            200: '#e4e4e7',
                            300: '#d4d4d8',
                            400: '#a1a1aa',
                            500: '#71717a',
                            600: '#52525b',
                            700: '#3f3f46',
                            800: '#27272a',
                            900: '#18181b',
                            950: '#09090b',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Three.js (3D WebGL Graphics Engine) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        body { 
            font-feature-settings: "cv02", "cv03", "cv04", "cv11";
            letter-spacing: -0.012em;
        }
    </style>
</head>
<body class="relative min-h-screen font-sans text-studio-900 bg-[#FAFAFB] antialiased flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8 overflow-hidden selection:bg-studio-950 selection:text-white">

    <!-- =========================================================================
         FULLSCREEN INTERACTIVE 3D WEBGL BACKGROUND CANVAS
         ========================================================================= -->
    <div 
        id="login-3d-canvas-wrap" 
        class="fixed inset-0 z-0 pointer-events-auto cursor-grab active:cursor-grabbing overflow-hidden"
        title="Klik dan geser untuk memutar objek 3D"
    ></div>

    <!-- =========================================================================
         FOREGROUND LOGIN CARD (FROSTED GLASS STUDIO ELEVATION)
         ========================================================================= -->
    <div class="relative z-10 w-full max-w-sm space-y-6 my-auto py-10 pointer-events-auto">
        
        <!-- Header Branding (Minimal Studio Mark) -->
        <div class="text-center space-y-2 select-none">
            <div class="inline-flex items-center justify-center w-11 h-11 rounded-xl bg-studio-950 text-white font-mono font-bold text-sm shadow-md mb-1 ring-1 ring-white/20">
                IS
            </div>
            <h1 class="text-xl font-bold tracking-tight text-studio-950">
                IdihSebel Console
            </h1>
            <p class="text-xs text-studio-500 max-w-xs mx-auto">
                Autentikasi panel manajemen studio dan portofolio tim RPL SMKN 1 Ciamis.
            </p>
        </div>

        <!-- Auth Card -->
        <div class="bg-white/88 backdrop-blur-xl rounded-2xl border border-studio-200/90 shadow-[0_12px_40px_rgba(0,0,0,0.06)] p-6 sm:p-7 space-y-5 transition-all">

            <!-- Flash Error Message -->
            @if (isset($errors) && $errors->any())
                <div class="p-3 rounded-xl bg-rose-50/90 border border-rose-200 text-rose-900 text-xs font-medium space-y-1">
                    <div class="flex items-center space-x-1.5 font-semibold text-rose-800">
                        <svg class="w-3.5 h-3.5 text-rose-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>Kredensial tidak valid</span>
                    </div>
                    <ul class="list-disc list-inside text-[11px] text-rose-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="p-3 rounded-xl bg-emerald-50/90 border border-emerald-200 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Quick Auto-Fill Helper -->
            <div class="p-3 bg-studio-50/90 rounded-xl border border-studio-200/80 text-xs flex items-center justify-between gap-2">
                <div class="space-y-0.5">
                    <div class="text-[11px] font-semibold text-studio-700">Akun Pengelola Default:</div>
                    <div class="font-mono text-[11px] text-studio-500">admin@idihsebel.id</div>
                </div>
                <button 
                    type="button" 
                    id="btn-autofill"
                    class="px-2.5 py-1 rounded-lg bg-white hover:bg-studio-100 text-studio-800 border border-studio-300 text-[11px] font-medium transition-all cursor-pointer shadow-2xs active:scale-95"
                >
                    Gunakan Akun
                </button>
            </div>

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-semibold text-studio-700">
                        Alamat Email
                    </label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        value="{{ old('email', 'admin@idihsebel.id') }}" 
                        required 
                        autocomplete="email"
                        class="w-full px-3 py-2 rounded-lg border border-studio-200 bg-white/90 text-studio-900 text-xs placeholder-studio-400 focus:outline-none focus:ring-1 focus:ring-studio-950 focus:border-studio-950 transition-colors"
                        placeholder="admin@idihsebel.id"
                    >
                </div>

                <!-- Password Input -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-semibold text-studio-700">
                            Kata Sandi
                        </label>
                    </div>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        value="admin123"
                        required 
                        autocomplete="current-password"
                        class="w-full px-3 py-2 rounded-lg border border-studio-200 bg-white/90 text-studio-900 text-xs placeholder-studio-400 focus:outline-none focus:ring-1 focus:ring-studio-950 focus:border-studio-950 transition-colors"
                        placeholder="••••••••"
                    >
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center justify-between text-xs pt-0.5">
                    <label class="flex items-center space-x-2 cursor-pointer select-none">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            checked
                            class="w-3.5 h-3.5 rounded text-studio-950 border-studio-300 focus:ring-studio-950"
                        >
                        <span class="text-studio-600 text-xs">Simpan sesi masuk</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-2.5 px-4 rounded-lg bg-studio-950 hover:bg-studio-900 text-white font-semibold text-xs tracking-tight shadow-md transition-all active:scale-[0.99] flex items-center justify-center space-x-1.5"
                >
                    <span>Masuk ke Console</span>
                    <svg class="w-3.5 h-3.5 text-studio-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

        </div>

        <!-- Back to Website Link -->
        <div class="text-center">
            <a 
                href="{{ route('portfolio.index') }}" 
                class="inline-flex items-center space-x-1.5 text-xs text-studio-500 hover:text-studio-950 transition-colors bg-white/60 backdrop-blur-xs px-3 py-1.5 rounded-full border border-studio-200/60 shadow-2xs"
            >
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                <span>Kembali ke Website Portofolio</span>
            </a>
        </div>

    </div>

    <!-- =========================================================================
         THREE.JS 3D SCENE SCRIPT
         ========================================================================= -->
    <script>
        // 1-Click Auto-Fill Demo Helper
        document.getElementById('btn-autofill')?.addEventListener('click', function() {
            document.getElementById('email').value = 'admin@idihsebel.id';
            document.getElementById('password').value = 'admin123';
        });

        // 3D WebGL Background Engine
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('login-3d-canvas-wrap');
            if (!container || typeof THREE === 'undefined') return;

            // 1. Scene, Camera, Renderer
            const scene = new THREE.Scene();
            const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 11.0;

            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.shadowMap.enabled = true;
            container.appendChild(renderer.domElement);

            // 2. Multi-Point Studio Lighting
            const ambientLight = new THREE.AmbientLight(0xffffff, 1.2);
            scene.add(ambientLight);

            const dirLight1 = new THREE.DirectionalLight(0xffffff, 2.5);
            dirLight1.position.set(8, 10, 8);
            scene.add(dirLight1);

            const dirLight2 = new THREE.DirectionalLight(0x2563eb, 3.5); // Studio Electric Klein Blue rim
            dirLight2.position.set(-8, -5, -4);
            scene.add(dirLight2);

            const dirLight3 = new THREE.DirectionalLight(0x38bdf8, 2.2); // Cyan accent rim
            dirLight3.position.set(5, -6, -5);
            scene.add(dirLight3);

            const centerPointLight = new THREE.PointLight(0x60a5fa, 2.8, 16);
            centerPointLight.position.set(0, 0, 0);
            scene.add(centerPointLight);

            // 3. Central 3D Kinetic Sculptural Group
            const modelGroup = new THREE.Group();
            scene.add(modelGroup);

            // Responsive Scaling and Positioning
            function updateScale() {
                const width = window.innerWidth;
                let scale = 1.0;
                if (width < 640) {
                    scale = 0.72;
                } else if (width < 1024) {
                    scale = 0.88;
                } else {
                    scale = 1.05;
                }
                modelGroup.scale.set(scale, scale, scale);
            }
            updateScale();

            // 4. Kinetic Sculptural Components
            // A. Outer Polyhedron Crystalline Shell (Midnight Obsidian with Mirror Speculars)
            const coreGeo = new THREE.IcosahedronGeometry(1.65, 1);
            const coreMat = new THREE.MeshPhysicalMaterial({
                color: 0x0f172a,
                metalness: 0.9,
                roughness: 0.15,
                clearcoat: 1.0,
                clearcoatRoughness: 0.1,
                reflectivity: 1.0,
                flatShading: true,
            });
            const coreMesh = new THREE.Mesh(coreGeo, coreMat);
            modelGroup.add(coreMesh);

            // B. Inner Glowing Chromatic Core
            const innerGeo = new THREE.OctahedronGeometry(1.05, 0);
            const innerMat = new THREE.MeshStandardMaterial({
                color: 0x1d4ed8,
                emissive: 0x3b82f6,
                emissiveIntensity: 0.95,
                metalness: 0.8,
                roughness: 0.2,
            });
            const innerMesh = new THREE.Mesh(innerGeo, innerMat);
            modelGroup.add(innerMesh);

            // C. Multi-Layered Neon Wireframe Lattice
            const wireframeGeo1 = new THREE.WireframeGeometry(coreGeo);
            const wireframeMat1 = new THREE.LineBasicMaterial({
                color: 0x60a5fa,
                transparent: true,
                opacity: 0.75,
            });
            const wireframe1 = new THREE.LineSegments(wireframeGeo1, wireframeMat1);
            wireframe1.scale.set(1.035, 1.035, 1.035);
            modelGroup.add(wireframe1);

            const wireframeGeo2 = new THREE.WireframeGeometry(new THREE.DodecahedronGeometry(2.18, 0));
            const wireframeMat2 = new THREE.LineBasicMaterial({
                color: 0x3b82f6,
                transparent: true,
                opacity: 0.35,
            });
            const wireframe2 = new THREE.LineSegments(wireframeGeo2, wireframeMat2);
            modelGroup.add(wireframe2);

            // D. Multi-Axis Gyroscopic Rings
            // Ring 1 (Polished Dark Chrome)
            const ring1Radius = 2.65;
            const ring1Geo = new THREE.TorusGeometry(ring1Radius, 0.045, 16, 120);
            const ring1Mat = new THREE.MeshStandardMaterial({
                color: 0x27272a,
                metalness: 0.95,
                roughness: 0.15,
            });
            const ring1 = new THREE.Mesh(ring1Geo, ring1Mat);
            ring1.rotation.x = Math.PI / 3;
            modelGroup.add(ring1);

            // Ring 2 (Electric Klein Blue)
            const ring2Radius = 3.15;
            const ring2Geo = new THREE.TorusGeometry(ring2Radius, 0.04, 16, 120);
            const ring2Mat = new THREE.MeshStandardMaterial({
                color: 0x2563eb,
                metalness: 0.85,
                roughness: 0.2,
            });
            const ring2 = new THREE.Mesh(ring2Geo, ring2Mat);
            ring2.rotation.y = Math.PI / 4;
            ring2.rotation.z = Math.PI / 6;
            modelGroup.add(ring2);

            // Ring 3 (Platinum Silver)
            const ring3Radius = 3.65;
            const ring3Geo = new THREE.TorusGeometry(ring3Radius, 0.03, 16, 120);
            const ring3Mat = new THREE.MeshStandardMaterial({
                color: 0xa1a1aa,
                metalness: 0.95,
                roughness: 0.1,
            });
            const ring3 = new THREE.Mesh(ring3Geo, ring3Mat);
            ring3.rotation.x = -Math.PI / 4;
            ring3.rotation.y = Math.PI / 3;
            modelGroup.add(ring3);

            // E. Orbiting Satellite Nodes
            const satelliteGeo = new THREE.SphereGeometry(0.12, 16, 16);
            const satelliteMat = new THREE.MeshStandardMaterial({
                color: 0x93c5fd,
                emissive: 0x3b82f6,
                emissiveIntensity: 0.9,
                metalness: 0.9,
                roughness: 0.1,
            });

            const sat1 = new THREE.Mesh(satelliteGeo, satelliteMat);
            ring1.add(sat1);

            const sat2 = new THREE.Mesh(satelliteGeo, satelliteMat);
            ring2.add(sat2);

            const sat3 = new THREE.Mesh(satelliteGeo, satelliteMat);
            ring3.add(sat3);

            // 5. Constellation Micro-Particle Cloud (240 Particles)
            const particleCount = 240;
            const particleGeo = new THREE.BufferGeometry();
            const particlePositions = new Float32Array(particleCount * 3);

            for (let i = 0; i < particleCount * 3; i += 3) {
                const radius = 2.2 + Math.random() * 3.5;
                const theta = Math.random() * Math.PI * 2;
                const phi = Math.acos((Math.random() * 2) - 1);
                particlePositions[i] = radius * Math.sin(phi) * Math.cos(theta);
                particlePositions[i + 1] = radius * Math.sin(phi) * Math.sin(theta);
                particlePositions[i + 2] = radius * Math.cos(phi);
            }

            particleGeo.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));
            const particleMat = new THREE.PointsMaterial({
                color: 0x3b82f6,
                size: 0.055,
                transparent: true,
                opacity: 0.75
            });
            const particles = new THREE.Points(particleGeo, particleMat);
            modelGroup.add(particles);

            // 6. Mouse Parallax & Interactive Drag
            let mouseX = 0;
            let mouseY = 0;
            let targetRotationX = 0;
            let targetRotationY = 0;
            let isDragging = false;
            let previousMousePosition = { x: 0, y: 0 };

            window.addEventListener('mousemove', function (e) {
                mouseX = (e.clientX / window.innerWidth) * 2 - 1;
                mouseY = -(e.clientY / window.innerHeight) * 2 - 1;
            });

            container.addEventListener('mousedown', function (e) {
                isDragging = true;
                previousMousePosition = { x: e.clientX, y: e.clientY };
            });

            window.addEventListener('mouseup', function () {
                isDragging = false;
            });

            window.addEventListener('mousemove', function (e) {
                if (!isDragging) return;
                const deltaX = e.clientX - previousMousePosition.x;
                const deltaY = e.clientY - previousMousePosition.y;

                targetRotationY += deltaX * 0.008;
                targetRotationX += deltaY * 0.008;

                previousMousePosition = { x: e.clientX, y: e.clientY };
            });

            // Touch Support
            container.addEventListener('touchstart', function (e) {
                if (e.touches.length === 1) {
                    isDragging = true;
                    previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
                }
            }, { passive: true });

            window.addEventListener('touchend', function () {
                isDragging = false;
            });

            window.addEventListener('touchmove', function (e) {
                if (!isDragging || e.touches.length !== 1) return;
                const deltaX = e.touches[0].clientX - previousMousePosition.x;
                const deltaY = e.touches[0].clientY - previousMousePosition.y;

                targetRotationY += deltaX * 0.008;
                targetRotationX += deltaY * 0.008;

                previousMousePosition = { x: e.touches[0].clientX, y: e.touches[0].clientY };
            }, { passive: true });

            // 7. Window Resize Handler
            function onResize() {
                const width = window.innerWidth;
                const height = window.innerHeight;
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
                renderer.setSize(width, height);
                updateScale();
            }
            window.addEventListener('resize', onResize);

            // 8. Animation Loop
            const clock = new THREE.Clock();

            function animate() {
                requestAnimationFrame(animate);
                const elapsedTime = clock.getElapsedTime();

                if (!isDragging) {
                    targetRotationY += 0.0035;
                    targetRotationX = Math.sin(elapsedTime * 0.4) * 0.12 + (mouseY * 0.25);
                    modelGroup.rotation.y += (targetRotationY + (mouseX * 0.25) - modelGroup.rotation.y) * 0.06;
                    modelGroup.rotation.x += (targetRotationX - modelGroup.rotation.x) * 0.06;
                } else {
                    modelGroup.rotation.y += (targetRotationY - modelGroup.rotation.y) * 0.15;
                    modelGroup.rotation.x += (targetRotationX - modelGroup.rotation.x) * 0.15;
                }

                // Kinetic components relative rotation
                coreMesh.rotation.y = elapsedTime * 0.2;
                innerMesh.rotation.x = elapsedTime * 0.35;
                innerMesh.rotation.y = -elapsedTime * 0.4;
                wireframe1.rotation.y = -elapsedTime * 0.15;
                wireframe2.rotation.x = elapsedTime * 0.12;

                // Orbiting satellite beads along the rings
                sat1.position.x = Math.cos(elapsedTime * 1.2) * ring1Radius;
                sat1.position.y = Math.sin(elapsedTime * 1.2) * ring1Radius;

                sat2.position.x = Math.cos(elapsedTime * 0.95 + 1.5) * ring2Radius;
                sat2.position.y = Math.sin(elapsedTime * 0.95 + 1.5) * ring2Radius;

                sat3.position.x = Math.cos(elapsedTime * 0.75 + 3.0) * ring3Radius;
                sat3.position.y = Math.sin(elapsedTime * 0.75 + 3.0) * ring3Radius;

                particles.rotation.y = elapsedTime * 0.04;

                renderer.render(scene, camera);
            }

            animate();
        });
    </script>
</body>
</html>
