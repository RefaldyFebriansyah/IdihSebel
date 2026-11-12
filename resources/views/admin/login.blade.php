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
         FULLSCREEN 3D INTERACTIVE DIGITAL TOPOGRAPHY & GEOMETRIC CANVAS
         ========================================================================= -->
    <div 
        id="login-3d-canvas-wrap" 
        class="fixed inset-0 z-0 pointer-events-auto cursor-grab active:cursor-grabbing overflow-hidden"
        title="Gerakkan kursor atau seret untuk mengontrol sudut pandang 3D"
    ></div>

    <!-- Soft Ambient Vignette Overlay -->
    <div class="fixed inset-0 z-1 pointer-events-none bg-radial-[circle_at_center,transparent_0%,rgba(250,250,251,0.35)_60%,rgba(250,250,251,0.85)_100%]"></div>

    <!-- =========================================================================
         FOREGROUND LOGIN CARD (PREMIUM ELEVATED STUDIO ARCHITECTURE)
         ========================================================================= -->
    <div 
        x-data="{ showPass: false }" 
        class="relative z-10 w-full max-w-[400px] my-auto py-8 pointer-events-auto"
    >
        
        <!-- Elevated Studio Card -->
        <div class="bg-white/95 backdrop-blur-2xl rounded-3xl border border-studio-200/90 shadow-[0_24px_60px_-15px_rgba(0,0,0,0.08),0_1px_3px_rgba(0,0,0,0.04)] p-8 sm:p-9 space-y-6 transition-all">
            
            <!-- Centered Card Header -->
            <div class="text-center space-y-2 select-none">
                <!-- Studio Emblem -->
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-studio-950 text-white font-mono font-bold text-sm shadow-md mb-1 ring-4 ring-studio-100">
                    IS
                </div>
                <div>
                    <h1 class="text-xl font-extrabold tracking-tight text-studio-950">
                        IdihSebel Console
                    </h1>
                    <p class="text-xs text-studio-500 mt-1 max-w-[280px] mx-auto leading-relaxed">
                        Panel kontrol studio & portofolio tim RPL SMKN 1 Ciamis
                    </p>
                </div>
            </div>

            <!-- Flash Error Message -->
            @if (isset($errors) && $errors->any())
                <div class="p-3.5 rounded-xl bg-rose-50 border border-rose-200 text-rose-900 text-xs font-medium space-y-1">
                    <div class="flex items-center space-x-1.5 font-semibold text-rose-800">
                        <svg class="w-4 h-4 text-rose-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <span>Kredensial tidak valid</span>
                    </div>
                    <ul class="list-disc list-inside text-[11px] text-rose-700 ml-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-medium">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Login Form -->
            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email Input -->
                <div class="space-y-1.5">
                    <label for="email" class="block text-xs font-semibold text-studio-800">
                        Email Admin
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-studio-400">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        <input 
                            type="email" 
                            name="email" 
                            id="email" 
                            value="{{ old('email', 'admin@idihsebel.id') }}" 
                            required 
                            autocomplete="email"
                            class="w-full pl-10 pr-3.5 py-2.5 rounded-xl border border-studio-200 bg-studio-50/50 hover:bg-studio-50 focus:bg-white text-studio-900 text-xs placeholder-studio-400 focus:outline-none focus:border-studio-950 focus:ring-4 focus:ring-studio-950/5 transition-all font-medium"
                            placeholder="admin@idihsebel.id"
                        >
                    </div>
                </div>

                <!-- Password Input with Show/Hide Toggle -->
                <div class="space-y-1.5">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-xs font-semibold text-studio-800">
                            Kata Sandi
                        </label>
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-studio-400">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </div>
                        <input 
                            :type="showPass ? 'text' : 'password'"
                            name="password" 
                            id="password" 
                            value="admin123"
                            required 
                            autocomplete="current-password"
                            class="w-full pl-10 pr-10 py-2.5 rounded-xl border border-studio-200 bg-studio-50/50 hover:bg-studio-50 focus:bg-white text-studio-900 text-xs placeholder-studio-400 focus:outline-none focus:border-studio-950 focus:ring-4 focus:ring-studio-950/5 transition-all font-medium"
                            placeholder="••••••••"
                        >
                        <button 
                            type="button" 
                            @click="showPass = !showPass"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-studio-400 hover:text-studio-700 transition-colors focus:outline-none cursor-pointer"
                            title="Tampilkan / Sembunyikan sandi"
                        >
                            <svg x-show="!showPass" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <svg x-show="showPass" x-cloak class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                                <line x1="1" y1="1" x2="23" y2="23"></line>
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Remember Me Option -->
                <div class="flex items-center justify-between text-xs pt-1">
                    <label class="flex items-center space-x-2 cursor-pointer select-none">
                        <input 
                            type="checkbox" 
                            name="remember" 
                            id="remember"
                            checked
                            class="w-4 h-4 rounded text-studio-950 border-studio-300 focus:ring-studio-950 cursor-pointer"
                        >
                        <span class="text-studio-600 text-xs font-medium">Ingat sesi saya</span>
                    </label>
                    <span class="font-mono text-[10px] text-studio-400">Aman &bull; HTTPS</span>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="group w-full py-3 px-4 rounded-xl bg-studio-950 hover:bg-studio-900 text-white font-bold text-xs tracking-tight shadow-[0_4px_14px_rgba(0,0,0,0.12)] hover:shadow-[0_6px_20px_rgba(0,0,0,0.18)] active:scale-[0.99] transition-all flex items-center justify-center space-x-2 cursor-pointer mt-2"
                >
                    <span>Masuk ke Console</span>
                    <svg class="w-3.5 h-3.5 text-studio-400 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </button>
            </form>

        </div>

        <!-- Back to Website Link -->
        <div class="text-center pt-3">
            <a 
                href="{{ route('portfolio.index') }}" 
                class="inline-flex items-center space-x-1.5 text-xs text-studio-500 hover:text-studio-950 transition-colors font-medium"
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
         THREE.JS 3D SCENE: ARCHITECTURAL DIGITAL TOPOGRAPHY & KINETIC CONSTELLATION
         ========================================================================= -->
    <script>
        // Modern 3D WebGL Background Engine
        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('login-3d-canvas-wrap');
            if (!container || typeof THREE === 'undefined') return;

            // 1. Scene, Camera, Renderer
            const scene = new THREE.Scene();
            scene.fog = new THREE.FogExp2(0xFAFAFB, 0.055);

            const camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.1, 100);
            camera.position.set(0, 3.2, 9.8);
            camera.lookAt(0, 0, 0);

            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            renderer.setClearColor(0xFAFAFB, 1.0);
            container.appendChild(renderer.domElement);

            // 2. Lighting Setup (Soft Studio Radiance)
            const ambientLight = new THREE.AmbientLight(0xffffff, 1.4);
            scene.add(ambientLight);

            const dirLight = new THREE.DirectionalLight(0x2563eb, 1.8);
            dirLight.position.set(5, 8, 5);
            scene.add(dirLight);

            const rimLight = new THREE.DirectionalLight(0x38bdf8, 1.2);
            rimLight.position.set(-6, -4, -3);
            scene.add(rimLight);

            // 3. Mathematical Undulating Terrain Wave (Digital Software Matrix)
            const gridWidth = 32;
            const gridDepth = 32;
            const gridSegments = 54;
            const terrainGeo = new THREE.PlaneGeometry(gridWidth, gridDepth, gridSegments, gridSegments);
            terrainGeo.rotateX(-Math.PI / 2.2);

            // Store original coordinates
            const posAttr = terrainGeo.attributes.position;
            const origCoords = [];
            for (let i = 0; i < posAttr.count; i++) {
                origCoords.push({
                    x: posAttr.getX(i),
                    y: posAttr.getY(i),
                    z: posAttr.getZ(i)
                });
            }

            // Wireframe Material (Clean Slate & Tech Blue)
            const terrainMat = new THREE.MeshBasicMaterial({
                color: 0x3b82f6,
                wireframe: true,
                transparent: true,
                opacity: 0.18,
            });
            const terrainMesh = new THREE.Mesh(terrainGeo, terrainMat);
            terrainMesh.position.set(0, -2.8, -1.0);
            scene.add(terrainMesh);

            // Vertex Light Points
            const pointsMat = new THREE.PointsMaterial({
                color: 0x2563eb,
                size: 0.045,
                transparent: true,
                opacity: 0.55
            });
            const terrainPoints = new THREE.Points(terrainGeo, pointsMat);
            terrainPoints.position.copy(terrainMesh.position);
            scene.add(terrainPoints);

            // 4. Peripheral Flanking 3D Geometric Sculptures (Framing the card on Left & Right)
            // Left Sculpture: Kinetic Octahedron in Wireframe Gyroscope
            const leftGroup = new THREE.Group();
            leftGroup.position.set(-4.5, 0.4, 0.5);
            scene.add(leftGroup);

            const leftGeo = new THREE.OctahedronGeometry(1.2, 0);
            const leftWire = new THREE.LineSegments(
                new THREE.WireframeGeometry(leftGeo),
                new THREE.LineBasicMaterial({ color: 0x2563eb, transparent: true, opacity: 0.65 })
            );
            leftGroup.add(leftWire);

            const leftRing = new THREE.Mesh(
                new THREE.TorusGeometry(1.7, 0.02, 16, 80),
                new THREE.MeshBasicMaterial({ color: 0x64748b, transparent: true, opacity: 0.45 })
            );
            leftRing.rotation.x = Math.PI / 3;
            leftGroup.add(leftRing);

            // Right Sculpture: Kinetic Icosahedron with Satellite Ring
            const rightGroup = new THREE.Group();
            rightGroup.position.set(4.5, -0.2, 0.8);
            scene.add(rightGroup);

            const rightGeo = new THREE.IcosahedronGeometry(1.25, 0);
            const rightWire = new THREE.LineSegments(
                new THREE.WireframeGeometry(rightGeo),
                new THREE.LineBasicMaterial({ color: 0x09090b, transparent: true, opacity: 0.55 })
            );
            rightGroup.add(rightWire);

            const rightRing = new THREE.Mesh(
                new THREE.TorusGeometry(1.85, 0.02, 16, 80),
                new THREE.MeshBasicMaterial({ color: 0x3b82f6, transparent: true, opacity: 0.45 })
            );
            rightRing.rotation.y = Math.PI / 4;
            rightGroup.add(rightRing);

            // Adjust flanking positions on resize
            function updateFlankingPositions() {
                const width = window.innerWidth;
                if (width < 768) {
                    leftGroup.position.set(-2.6, 2.8, -2.5);
                    leftGroup.scale.set(0.65, 0.65, 0.65);
                    rightGroup.position.set(2.6, -2.8, -2.5);
                    rightGroup.scale.set(0.65, 0.65, 0.65);
                } else if (width < 1024) {
                    leftGroup.position.set(-3.6, 0.5, -0.5);
                    leftGroup.scale.set(0.85, 0.85, 0.85);
                    rightGroup.position.set(3.6, -0.3, -0.5);
                    rightGroup.scale.set(0.85, 0.85, 0.85);
                } else {
                    leftGroup.position.set(-4.6, 0.5, 0.5);
                    leftGroup.scale.set(1.0, 1.0, 1.0);
                    rightGroup.position.set(4.6, -0.3, 0.5);
                    rightGroup.scale.set(1.0, 1.0, 1.0);
                }
            }
            updateFlankingPositions();

            // 5. Constellation Micro-Particle Motes (160 Particles)
            const particleCount = 160;
            const particleGeo = new THREE.BufferGeometry();
            const particlePos = new Float32Array(particleCount * 3);

            for (let i = 0; i < particleCount * 3; i += 3) {
                particlePos[i] = (Math.random() - 0.5) * 16;
                particlePos[i + 1] = (Math.random() - 0.5) * 10;
                particlePos[i + 2] = (Math.random() - 0.5) * 10;
            }

            particleGeo.setAttribute('position', new THREE.BufferAttribute(particlePos, 3));
            const particleMat = new THREE.PointsMaterial({
                color: 0x60a5fa,
                size: 0.04,
                transparent: true,
                opacity: 0.6
            });
            const particles = new THREE.Points(particleGeo, particleMat);
            scene.add(particles);

            // 6. Smooth Mouse Parallax & Interactive Orbiting
            let mouseX = 0;
            let mouseY = 0;
            let targetCamX = 0;
            let targetCamY = 3.2;
            let isDragging = false;
            let prevMouse = { x: 0, y: 0 };
            let orbitOffset = { x: 0, y: 0 };

            window.addEventListener('mousemove', function (e) {
                mouseX = (e.clientX / window.innerWidth) * 2 - 1;
                mouseY = -(e.clientY / window.innerHeight) * 2 - 1;

                targetCamX = mouseX * 0.9;
                targetCamY = 3.2 + mouseY * 0.5;
            });

            container.addEventListener('mousedown', function (e) {
                isDragging = true;
                prevMouse = { x: e.clientX, y: e.clientY };
            });

            window.addEventListener('mouseup', function () {
                isDragging = false;
            });

            window.addEventListener('mousemove', function (e) {
                if (!isDragging) return;
                const deltaX = e.clientX - prevMouse.x;
                const deltaY = e.clientY - prevMouse.y;

                orbitOffset.x += deltaX * 0.005;
                orbitOffset.y += deltaY * 0.005;

                prevMouse = { x: e.clientX, y: e.clientY };
            });

            // Touch Support
            container.addEventListener('touchstart', function (e) {
                if (e.touches.length === 1) {
                    isDragging = true;
                    prevMouse = { x: e.touches[0].clientX, y: e.touches[0].clientY };
                }
            }, { passive: true });

            window.addEventListener('touchend', function () {
                isDragging = false;
            });

            window.addEventListener('touchmove', function (e) {
                if (!isDragging || e.touches.length !== 1) return;
                const deltaX = e.touches[0].clientX - prevMouse.x;
                const deltaY = e.touches[0].clientY - prevMouse.y;

                orbitOffset.x += deltaX * 0.005;
                orbitOffset.y += deltaY * 0.005;

                prevMouse = { x: e.touches[0].clientX, y: e.touches[0].clientY };
            }, { passive: true });

            // 7. Window Resize Handler
            function onResize() {
                const width = window.innerWidth;
                const height = window.innerHeight;
                camera.aspect = width / height;
                camera.updateProjectionMatrix();
                renderer.setSize(width, height);
                updateFlankingPositions();
            }
            window.addEventListener('resize', onResize);

            // 8. Animation Loop
            const clock = new THREE.Clock();

            function animate() {
                requestAnimationFrame(animate);
                const t = clock.getElapsedTime();

                // Smooth camera motion
                camera.position.x += (targetCamX + orbitOffset.x - camera.position.x) * 0.04;
                camera.position.y += (targetCamY + orbitOffset.y - camera.position.y) * 0.04;
                camera.lookAt(0, 0, 0);

                // Mathematical terrain waves calculation
                const pos = terrainGeo.attributes.position;
                for (let i = 0; i < pos.count; i++) {
                    const orig = origCoords[i];
                    // Multi-frequency harmonic wave algorithm
                    const wave1 = Math.sin(orig.x * 0.35 + t * 0.75) * 0.45;
                    const wave2 = Math.cos(orig.y * 0.35 + t * 0.6) * 0.45;
                    const ripple = Math.sin((orig.x + orig.y) * 0.25 + t * 0.9) * 0.25;

                    pos.setZ(i, orig.z + wave1 + wave2 + ripple);
                }
                pos.needsUpdate = true;

                // Animate peripheral sculptures
                leftGroup.rotation.x = t * 0.2;
                leftGroup.rotation.y = t * 0.3;
                leftRing.rotation.z = -t * 0.4;

                rightGroup.rotation.x = -t * 0.25;
                rightGroup.rotation.y = -t * 0.2;
                rightRing.rotation.z = t * 0.35;

                // Particles slow drift
                particles.rotation.y = t * 0.025;

                renderer.render(scene, camera);
            }

            animate();
        });
    </script>
</body>
</html>
