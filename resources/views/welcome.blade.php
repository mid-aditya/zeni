<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="google-site-verification" content="VrCE8j8LFZq8nIuRavE8qYxFmYag2j7um571qK5kzCQ" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUSDIKZI TNI AD</title>
    <link rel="icon" type="image/png" href="/assets/images/logo-zeni.png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --color-dark-green: #1B4D3E;
            --color-green: #4B7355;
            --color-light-green: #6B8C6E;
            --color-white: #FFFFFF;
        }

        /* Loading Screen */
        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0F2E25;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease-out, visibility 0.5s ease-out;
        }

        .loading-screen.fade-out {
            opacity: 0;
            visibility: hidden;
        }

        .loading-logo {
            width: auto;
            height: auto;
            max-width: 200px;
            max-height: 200px;
            object-fit: contain;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        .loading-text {
            color: white;
            font-size: 2.5rem;
            font-weight: bold;
            margin-top: 1rem;
            animation: fadeInUp 1s ease-out;
        }

        .loading-subtext {
            color: white;
            font-size: 1.2rem;
            margin-top: 0.5rem;
            animation: fadeInUp 1s ease-out 0.3s backwards;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hero Section */
        .hero-section {
            background-color: rgba(15, 46, 37, 0.95);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            height: 100vh;
            position: relative;
            overflow: hidden;
        }

        /* Parallax */
        .parallax-section {
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        /* Navbar */
        .navbar-blur {
            background: rgba(15, 46, 37, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .nav-link {
            position: relative;
            padding-bottom: 2px;
            transition: all 0.3s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--color-light-green);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Mobile Menu */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 80%;
            height: 100vh;
            background: rgba(15, 46, 37, 0.98);
            z-index: 1000;
            transition: right 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            padding: 6rem 1.5rem 2rem;
        }

        .mobile-menu.open {
            right: 0;
        }

        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease;
        }

        .mobile-menu-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        /* Section Transitions */
        .section-transition {
            position: relative;
            padding: 100px 0;
        }

        .section-transition::before {
            content: '';
            position: absolute;
            top: -50px;
            left: 0;
            right: 0;
            height: 100px;
            background: linear-gradient(to bottom, transparent, var(--color-white));
        }

        /* Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .float-animation {
            animation: float 6s ease-in-out infinite;
        }

        /* Card Hover Effects */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: none;
            box-shadow: none;
        }

        /* Text Effects */
        .gradient-text {
            background: linear-gradient(45deg, var(--color-dark-green), var(--color-light-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Layout Classes */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(27, 77, 62, 0.8);
        }

        .visi-misi-card {
            border-left: 4px solid var(--color-dark-green);
            transition: all 0.3s ease;
        }

        .visi-misi-card:hover {
            transform: none;
            box-shadow: none;
        }

        /* Timeline */
        .sejarah-timeline {
            position: relative;
            padding-left: 2rem;
        }

        .sejarah-timeline::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 2px;
            background: var(--color-dark-green);
        }

        .sejarah-item {
            position: relative;
            margin-bottom: 2rem;
        }

        .sejarah-item::before {
            content: '';
            position: absolute;
            left: -2.5rem;
            top: 0.5rem;
            width: 1rem;
            height: 1rem;
            border-radius: 50%;
            background: var(--color-dark-green);
        }

        /* Struktur Organisasi */
        .struktur-line {
            position: relative;
            height: 2px;
            background: var(--color-dark-green);
            margin: 2rem 0;
        }

        .struktur-line::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 1rem;
            height: 1rem;
            background: var(--color-dark-green);
            border-radius: 50%;
        }

        .struktur-text {
            position: relative;
            padding: 0 1rem;
            background: white;
            display: inline-block;
        }

        /* Auth Buttons */
        .auth-button {
            padding: 0.5rem 1.5rem;
            border-radius: 9999px;
            transition: all 0.3s ease;
        }

        .login-button {
            background: transparent;
            border: 2px solid white;
            color: white;
        }

        .login-button:hover {
            background: white;
            color: var(--color-dark-green);
        }

        .register-button {
            background: white;
            color: var(--color-dark-green);
            border: 2px solid white;
        }

        .register-button:hover {
            background: transparent;
            color: white;
        }

        /* Theme Colors */
        .bg-zeni {
            background-color: #0F2E25;
        }

        /* Social Media Buttons */
        .social-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #0F2E25;
            color: white;
            transition: all 0.3s ease;
            margin: 0 8px;
            font-size: 1.25rem;
        }

        .social-button:hover {
            transform: none;
            box-shadow: none;
        }

        .social-button.whatsapp:hover {
            background-color: #25D366;
        }

        .social-button.facebook:hover {
            background-color: #1877F2;
        }

        .social-button.instagram:hover {
            background: linear-gradient(45deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
        }

        .social-button.youtube:hover {
            background-color: #FF0000;
        }

        /* Scroll to top button */
        .scroll-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: rgba(15, 46, 37, 0.8);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 99;
        }

        .scroll-top.active {
            opacity: 1;
            visibility: visible;
        }

        .scroll-top:hover {
            transform: none;
        }

        /* Hero Slider */
        .hero-slider .slide {
            transition: opacity 1s ease-in-out;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .hero-section h1 {
                font-size: 2.5rem;
            }
            .hero-section p.text-3xl {
                font-size: 1.5rem;
            }
            .hero-section p.text-xl {
                font-size: 1rem;
            }
            .sejarah-timeline {
                padding-left: 1.5rem;
            }
            .sejarah-item::before {
                left: -1.75rem;
            }
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Loading Screen -->
    <div class="loading-screen" id="loading-screen">
        <img src="/assets/images/logo-zeni.png" alt="Logo Zeni" class="loading-logo">
        <div class="loading-text">PUSDIKZI</div>
        <div class="loading-subtext">PUSAT PENDIDIKAN ZENI</div>
    </div>

    <!-- Scroll To Top Button -->
    <div class="scroll-top" id="scrollTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#beranda" class="text-white text-xl mb-6 hover:text-gray-300 transition-colors">Beranda</a>
        <a href="#profil" class="text-white text-xl mb-6 hover:text-gray-300 transition-colors">Profil</a>
        <a href="#visi-misi" class="text-white text-xl mb-6 hover:text-gray-300 transition-colors">Visi & Misi</a>
        <a href="#sejarah" class="text-white text-xl mb-6 hover:text-gray-300 transition-colors">Sejarah</a>
        <a href="#struktur" class="text-white text-xl mb-6 hover:text-gray-300 transition-colors">Struktur</a>
        <a href="#kontak" class="text-white text-xl mb-6 hover:text-gray-300 transition-colors">Kontak</a>
        <div class="mt-6 flex flex-col space-y-4">
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-white border-2 border-white hover:bg-white hover:text-[#0F2E25] transition-all duration-300 text-center">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-white text-[#0F2E25] hover:bg-[#4B7355] hover:text-white transition-all duration-300 text-center">Register</a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="fixed w-full shadow-lg z-50 transition-all duration-300 navbar-blur">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <img src="/assets/images/logo-zeni.png" alt="Logo Zeni" class="h-12 w-auto transform hover:scale-110 transition-transform duration-300">
                    <span class="text-2xl font-bold text-white">PUSDIKZI</span>
                </div>
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#beranda" class="nav-link text-white hover:text-gray-300">Beranda</a>
                    <a href="#profil" class="nav-link text-white hover:text-gray-300">Profil</a>
                    <a href="#visi-misi" class="nav-link text-white hover:text-gray-300">Visi & Misi</a>
                    <a href="#sejarah" class="nav-link text-white hover:text-gray-300">Sejarah</a>
                    <a href="#struktur" class="nav-link text-white hover:text-gray-300">Struktur</a>
                    <a href="#kontak" class="nav-link text-white hover:text-gray-300">Kontak</a>
                    <div class="flex items-center space-x-4">
                        <div class="h-6 w-px bg-white mx-2"></div>
                        <a href="{{ route('login') }}" class="px-4 py-2 rounded-full text-white border-2 border-white hover:bg-white hover:text-green-900 transition-all duration-300">Login</a>
                        <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-white text-green-900 hover:bg-green-900 hover:text-white transition-all duration-300">Register</a>
                    </div>
                </div>
                <div class="lg:hidden">
                    <button id="mobileMenuToggle" class="text-white focus:outline-none">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="beranda" class="hero-section relative flex items-center justify-center text-white h-screen overflow-hidden">
        <div class="absolute inset-0">
            <div class="hero-slider w-full h-full">
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="/assets/images/bg-zeni.jpeg" alt="Background 1" class="w-full h-full object-cover">
                </div>
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000">
                    <img src="/assets/images/bg-zeni-2.jpeg" alt="Background 2" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="absolute inset-0 bg-black opacity-40"></div>
        </div>

        <div class="relative z-10 text-center px-6" data-aos="fade-up" data-aos-duration="1000">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 tracking-tight transform hover:scale-105 transition-transform duration-300">
                KORPS ZENI TNI ANGKATAN DARAT
            </h1>
            <p class="text-xl md:text-2xl lg:text-3xl mb-6 font-semibold">WIYATA KSATRIA BHAKTI</p>
            <p class="text-lg md:text-xl max-w-2xl mx-auto leading-relaxed mb-12">
                Menjadi Lembaga Pendidikan Kebanggaan Korps Zeni TNI Angkatan Darat
            </p>
            <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-6">
                <a href="#profil" class="bg-white text-green-900 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                    Pelajari Lebih Lanjut
                </a>
                <a href="#kontak" class="border-2 border-white text-white px-8 py-3 rounded-full font-semibold hover:bg-white hover:text-green-900 transition-all duration-300">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    <section id="profil" class="py-24 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-14 items-center">
                <!-- Gambar -->
                <div class="order-2 md:order-1">
                    <img src="/assets/images/bg-pusdikzi.png" alt="Prajurit Icon" class="w-3/4 md:w-1/2 rounded-3xl mx-auto">
                </div>

                <!-- Text Content -->
                <div class="order-1 md:order-2">
                    <h4 class="text-green-600 font-semibold uppercase mb-4">Profil Kami</h4>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">Pusat Pendidikan Zeni (Pusdikzi)</h2>
                    <p class="text-lg text-gray-700 mb-6">Pusat Pendidikan Zeni (Pusdikzi) merupakan lembah kawah candra dimuka bagi prajurit Zeni TNI Angkatan Darat yang bertugas menyelenggarakan Pendidikan Kecabangan Zeni dalam rangka mendukung tugas pokok Pusat Zeni Angkatan Darat. Sebagai institusi pendidikan, Pusdikzi memiliki peran penting dalam mencetak prajurit Zeni yang profesional, tangguh, dan memiliki jiwa keprajuritan yang tinggi.</p>

                    <p class="text-lg text-gray-700 mb-8">Dalam pelaksanaan tugasnya, Pusdikzi terus berinovasi mengikuti perkembangan teknologi dan strategi pertahanan modern guna memastikan lulusan yang dihasilkan mampu beradaptasi dengan tantangan di medan tugas. Selengkapnya tentang sejarah, program pendidikan, serta peran strategis Pusdikzi dapat Anda temukan di halaman berikutnya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi Section -->
    <section id="visi-misi" class="py-20 relative overflow-hidden">
        <div class="absolute inset-0 bg-zeni opacity-90"></div>
        <div class="absolute inset-0 bg-zeni-2 opacity-50"></div>
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl font-bold text-center mb-16 text-white" data-aos="fade-up">
                Visi & Misi
            </h2>
            <div class="grid md:grid-cols-2 gap-12">
                <div class="bg-white p-8 rounded-2xl shadow-xl transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-right">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-zeni rounded-full flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-zeni">Visi</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        Menjadi Lembaga Pendidikan Kebanggaan Korps Zeni TNI Angkatan Darat yang Profesional, Berdedikasi, Modern dan Berwawasan Teknologi dalam membentuk Postur Prajurit Zeni yang Berpikir, Bersikap, dan bertindak terbaik bagi Negara dan Bangsa.
                    </p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-xl transform hover:-translate-y-2 transition-all duration-300" data-aos="fade-left">
                    <div class="flex items-center mb-6">
                        <div class="w-16 h-16 bg-zeni rounded-full flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-zeni">Misi</h3>
                    </div>
                    <ul class="space-y-4 text-gray-700">
                        <li class="flex items-start">
                            <span class="inline-block w-3 h-3 mt-2 mr-3 bg-zeni rounded-full"></span>
                            <span>Menyelenggarakan Pendidikan untuk Mencetak Prajurit Zeni yang Profesional dibidangnya.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="inline-block w-3 h-3 mt-2 mr-3 bg-zeni rounded-full"></span>
                            <span>Mewujudkan Pusat Pendidikan Zeni TNI Angkatan Darat sebagai Pusat Pengembangan Doktrin, Ilmu Pengetahuan dan Tehnologi.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="inline-block w-3 h-3 mt-2 mr-3 bg-zeni rounded-full"></span>
                            <span>Mengembangkan kemampuan serta Jiwa Juang Gadik dan Gapendik dalam melaksanakan tugas pengajaran.</span>
                        </li>
                        <li class="flex items-start">
                            <span class="inline-block w-3 h-3 mt-2 mr-3 bg-zeni rounded-full"></span>
                            <span>Mewujudkan Pusat Pendidikan Zeni sebagai Almamater Kebanggaan Prajurit Zeni.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Sejarah Section -->
    <section id="sejarah" class="py-20 bg-white relative">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-[#0F2E25]" data-aos="fade-up">
                Sejarah
            </h2>

            <div class="relative max-w-6xl mx-auto">
                <!-- Timeline for desktop -->
                <div class="hidden md:block">
                    <!-- Garis Tengah -->
                    <div class="absolute top-0 left-1/2 transform -translate-x-1/2 h-full w-1 bg-zeni"></div>

                    <div class="flex flex-col space-y-16" data-aos="fade-up">

                        <!-- Item 1 (Kiri) -->
                        <div class="flex justify-start w-full relative">
                            <div class="w-1/2 pr-8 flex justify-end">
                                <div class="text-right max-w-md">
                                    <span class="text-2xl font-bold text-zeni">1945</span>
                                    <h3 class="text-xl font-bold text-zeni mb-2">Awal Mula</h3>
                                    <p class="text-gray-700">Upaya untuk menyelenggarakan pendidikan Zeni TNI AD sudah dimulai sejak tahun 1945 dengan mencoba membuka Sekolah Genie di Batujajar, Bandung.</p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 w-4 h-4 bg-zeni rounded-full border-4 border-white"></div>
                            <div class="w-1/2"></div>
                        </div>

                        <!-- Item 2 (Kanan) -->
                        <div class="flex justify-end w-full relative">
                            <div class="w-1/2"></div>
                            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 w-4 h-4 bg-zeni rounded-full border-4 border-white"></div>
                            <div class="w-1/2 pl-8 flex justify-start">
                                <div class="text-left max-w-md">
                                    <span class="text-2xl font-bold text-zeni">1946</span>
                                    <h3 class="text-xl font-bold text-zeni mb-2">23 Februari 1946</h3>
                                    <p class="text-gray-700">Berhasil dibuka Sekolah Genie di Batujajar, dan di Sala dengan sukses. Sekolah dasar Genie kemudian disempurnakan menjadi Depot Pendidikan Genie.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Item 3 (Kiri) -->
                        <div class="flex justify-start w-full relative">
                            <div class="w-1/2 pr-8 flex justify-end">
                                <div class="text-right max-w-md">
                                    <span class="text-2xl font-bold text-zeni">1950</span>
                                    <h3 class="text-xl font-bold text-zeni mb-2">15 April 1950</h3>
                                    <p class="text-gray-700">Realisasi pembukaan kembali Sekolah Genie ini disesuaikan waktunya dengan serah terima Depot Genie Troepen dari Pihak Belanda (KNIL) kepada TNI AD.</p>
                                    <p class="text-gray-700">Selanjutnya tanggal peristiwa tersebut dijadikan "Hari Jadi Pusdikzi Kodiklat TNI AD" yaitu: berdasarkan Surat keputusan Kasad No. 263 / KSAD / KPTS /1954.</p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 w-4 h-4 bg-zeni rounded-full border-4 border-white"></div>
                            <div class="w-1/2"></div>
                        </div>

                        <!-- Item 4 (Kanan) -->
                        <div class="flex justify-end w-full relative">
                            <div class="w-1/2"></div>
                            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 w-4 h-4 bg-zeni rounded-full border-4 border-white"></div>
                            <div class="w-1/2 pl-8 flex justify-<div class="w-1/2 pl-8 flex justify-start">
                                <div class="text-left max-w-md">
                                    <span class="text-2xl font-bold text-zeni">1959</span>
                                    <h3 class="text-xl font-bold text-zeni mb-2">1 Januari 1959</h3>
                                    <p class="text-gray-700">Sekolah Genie diganti namanya menjadi Pusat Pendidikan Zeni (PUSDIKZI) sesuai dengan Surat Keputusan Menteri Pertahanan No. MP/B/1070/1959.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Item 5 (Kiri) -->
                        <div class="flex justify-start w-full relative">
                            <div class="w-1/2 pr-8 flex justify-end">
                                <div class="text-right max-w-md">
                                    <span class="text-2xl font-bold text-zeni">1984</span>
                                    <h3 class="text-xl font-bold text-zeni mb-2">Pengembangan Fasilitas</h3>
                                    <p class="text-gray-700">Dilakukan perluasan area pendidikan dan pengembangan fasilitas pelatihan untuk mengakomodasi kebutuhan pendidikan yang semakin kompleks.</p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 w-4 h-4 bg-zeni rounded-full border-4 border-white"></div>
                            <div class="w-1/2"></div>
                        </div>

                        <!-- Item 6 (Kanan) -->
                        <div class="flex justify-end w-full relative">
                            <div class="w-1/2"></div>
                            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 w-4 h-4 bg-zeni rounded-full border-4 border-white"></div>
                            <div class="w-1/2 pl-8 flex justify-start">
                                <div class="text-left max-w-md">
                                    <span class="text-2xl font-bold text-zeni">2010</span>
                                    <h3 class="text-xl font-bold text-zeni mb-2">Modernisasi Pendidikan</h3>
                                    <p class="text-gray-700">PUSDIKZI melakukan modernisasi kurikulum dan metode pengajaran sesuai dengan perkembangan teknologi dan kebutuhan strategi pertahanan modern.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Item 7 (Kiri) -->
                        <div class="flex justify-start w-full relative">
                            <div class="w-1/2 pr-8 flex justify-end">
                                <div class="text-right max-w-md">
                                    <span class="text-2xl font-bold text-zeni">2023</span>
                                    <h3 class="text-xl font-bold text-zeni mb-2">Era Digital</h3>
                                    <p class="text-gray-700">PUSDIKZI terus berkembang dengan implementasi teknologi digital dalam pembelajaran dan pelatihan, menghasilkan prajurit Zeni yang adaptif terhadap kemajuan teknologi.</p>
                                </div>
                            </div>
                            <div class="absolute left-1/2 top-0 transform -translate-x-1/2 w-4 h-4 bg-zeni rounded-full border-4 border-white"></div>
                            <div class="w-1/2"></div>
                        </div>
                    </div>
                </div>

                <!-- Timeline for mobile -->
                <div class="md:hidden sejarah-timeline">
                    <div class="sejarah-item" data-aos="fade-left">
                        <span class="text-2xl font-bold text-zeni">1945</span>
                        <h3 class="text-xl font-bold text-zeni mb-2">Awal Mula</h3>
                        <p class="text-gray-700">Upaya untuk menyelenggarakan pendidikan Zeni TNI AD sudah dimulai sejak tahun 1945 dengan mencoba membuka Sekolah Genie di Batujajar, Bandung.</p>
                    </div>
                    
                    <div class="sejarah-item" data-aos="fade-left">
                        <span class="text-2xl font-bold text-zeni">1946</span>
                        <h3 class="text-xl font-bold text-zeni mb-2">23 Februari 1946</h3>
                        <p class="text-gray-700">Berhasil dibuka Sekolah Genie di Batujajar, dan di Sala dengan sukses. Sekolah dasar Genie kemudian disempurnakan menjadi Depot Pendidikan Genie.</p>
                    </div>
                    
                    <div class="sejarah-item" data-aos="fade-left">
                        <span class="text-2xl font-bold text-zeni">1950</span>
                        <h3 class="text-xl font-bold text-zeni mb-2">15 April 1950</h3>
                        <p class="text-gray-700">Realisasi pembukaan kembali Sekolah Genie ini disesuaikan waktunya dengan serah terima Depot Genie Troepen dari Pihak Belanda (KNIL) kepada TNI AD.</p>
                    </div>
                    
                    <div class="sejarah-item" data-aos="fade-left">
                        <span class="text-2xl font-bold text-zeni">1959</span>
                        <h3 class="text-xl font-bold text-zeni mb-2">1 Januari 1959</h3>
                        <p class="text-gray-700">Sekolah Genie diganti namanya menjadi Pusat Pendidikan Zeni (PUSDIKZI) sesuai dengan Surat Keputusan Menteri Pertahanan No. MP/B/1070/1959.</p>
                    </div>
                    
                    <div class="sejarah-item" data-aos="fade-left">
                        <span class="text-2xl font-bold text-zeni">1984</span>
                        <h3 class="text-xl font-bold text-zeni mb-2">Pengembangan Fasilitas</h3>
                        <p class="text-gray-700">Dilakukan perluasan area pendidikan dan pengembangan fasilitas pelatihan untuk mengakomodasi kebutuhan pendidikan yang semakin kompleks.</p>
                    </div>
                    
                    <div class="sejarah-item" data-aos="fade-left">
                        <span class="text-2xl font-bold text-zeni">2010</span>
                        <h3 class="text-xl font-bold text-zeni mb-2">Modernisasi Pendidikan</h3>
                        <p class="text-gray-700">PUSDIKZI melakukan modernisasi kurikulum dan metode pengajaran sesuai dengan perkembangan teknologi dan kebutuhan strategi pertahanan modern.</p>
                    </div>
                    
                    <div class="sejarah-item" data-aos="fade-left">
                        <span class="text-2xl font-bold text-zeni">2023</span>
                        <h3 class="text-xl font-bold text-zeni mb-2">Era Digital</h3>
                        <p class="text-gray-700">PUSDIKZI terus berkembang dengan implementasi teknologi digital dalam pembelajaran dan pelatihan, menghasilkan prajurit Zeni yang adaptif terhadap kemajuan teknologi.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Struktur Organisasi Section -->
<section id="struktur" class="py-20 bg-gray-100">
    <div class="container mx-auto px-6">
        <h2 class="text-4xl font-bold text-center mb-16 text-[#0F2E25]" data-aos="fade-up">
            Struktur Organisasi
        </h2>
        
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col items-center">
                <!-- Komandan -->
                <div class="bg-white p-6 rounded-lg shadow-lg mb-8 w-72 text-center" data-aos="fade-down">
                    <div class="w-24 h-24 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                        <img src="/assets/images/1.png" alt="Komandan" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-[#0F2E25]">KOLONEL CZI ANDY SETYAWAN</h3>
                    <p class="text-gray-600 mt-2">KOMANDAN PUSDIKZI</p>
                </div>
                
                <!-- Garis Vertikal -->
                <div class="w-1 h-12 bg-[#0F2E25]"></div>
                
                <!-- Wakil Komandan -->
                <div class="bg-white p-6 rounded-lg shadow-lg mb-8 w-72 text-center" data-aos="fade-up">
                    <div class="w-24 h-24 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                        <img src="/assets/images/profile.png" alt="Wakil Komandan" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-xl font-bold text-[#0F2E25]">-</h3>
                    <p class="text-gray-600 mt-2">WAKIL KOMANDAN PUSDIKZI</p>
                </div>
                
                <!-- Garis Vertikal -->
                <div class="w-1 h-12 bg-[#0F2E25]"></div>
                
                <!-- Kepala Departemen -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8 mb-12 w-full">
                    <!-- KASIOPSDIK -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/2.png" alt="KASIOPSDIK" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">KAPTEN CZI SULAIMAN</h3>
                        <p class="text-gray-600 mt-2">KASIOPSDIK</p>
                    </div>
                    
                    <!-- KASIJIANBANDIK -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/3.png" alt="KASIJIANBANDIK" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">KAPTEN CZI RIKI HERMAWAN</h3>
                        <p class="text-gray-600 mt-2">KASIJIANBANDIK</p>
                    </div>
                    
                    <!-- KASIPAMOPS -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/4.png" alt="KASIPAMOPS" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">MAYOR CZI DWI H.</h3>
                        <p class="text-gray-600 mt-2">KASIPAMOPS</p>
                    </div>
                    
                    <!-- KASIMIN -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/5.png" alt="KASIMIN" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">KAPTEN CZI EKA R.</h3>
                        <p class="text-gray-600 mt-2">KASIMIN</p>
                    </div>
                </div>

                <!-- Garis Vertikal -->
                <div class="w-1 h-12 bg-[#0F2E25] mb-6"></div>
                
                <!-- Kepala Seksi -->
                <h3 class="text-2xl font-semibold text-center mb-8 text-[#0F2E25]" data-aos="fade-up">Kepala Seksi</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8 mb-12 w-full">
                    <!-- KATIM GUMIL -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/profile.png" alt="KATIM GUMIL" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">-</h3>
                        <p class="text-gray-600 mt-2">KATIM GUMIL</p>
                    </div>
                    
                    <!-- DANDENMA -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/6.png" alt="DANDENMA" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">MAYOR CZI ADI HARIANTO</h3>
                        <p class="text-gray-600 mt-2">DANDENMA</p>
                    </div>
                    
                    <!-- PAUR ALINS -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/7.png" alt="PAUR ALINS" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">LETTU CZI LALU</h3>
                        <p class="text-gray-600 mt-2">PAUR ALINS</p>
                    </div>
                    
                    <!-- KASET -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/8.png" alt="KASET" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">LETDA CZI NOVRIYANTO M</h3>
                        <p class="text-gray-600 mt-2">KASET</p>
                    </div>
                </div>

                <!-- Garis Vertikal -->
                <div class="w-1 h-12 bg-[#0F2E25] mb-6"></div>
                
                <!-- Staff/Kepala Departemen -->
                <h3 class="text-2xl font-semibold text-center mb-8 text-[#0F2E25]" data-aos="fade-up">Kepala Departemen</h3>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6 md:gap-4 mb-12 w-full">
                    <!-- KADEP ALZI -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/9.png" alt="KADEP ALZI" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">LETKOL CZI TATANG</h3>
                        <p class="text-gray-600 mt-2">KADEP ALZI</p>
                    </div>
                    
                    <!-- KADEP TIKNIZI -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/10.png" alt="KADEP TIKNIZI" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">MAYOR CZI IMAM SUBEKTI</h3>
                        <p class="text-gray-600 mt-2">KADEP TIKNIZI</p>
                    </div>
                    
                    <!-- KADEP KONBANG -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/11.png" alt="KADEP KONBANG" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">LETKOL CZI ROBERT R</h3>
                        <p class="text-gray-600 mt-2">KADEP KONBANG</p>
                    </div>
                    
                    <!-- KADEP PENGNUBIKA -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/12.png" alt="KADEP PENGNUBIKA" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">LETKOL CZI RUHIYAT SAPUTRA</h3>
                        <p class="text-gray-600 mt-2">KADEP PENGNUBIKA</p>
                    </div>
                    
                    <!-- KADEP PENGMIUM -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/profile.png" alt="KADEP PENGMIUM" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">-</h3>
                        <p class="text-gray-600 mt-2">KADEP PENGMIUM</p>
                    </div>
                </div>

                <!-- Garis Vertikal -->
                <div class="w-1 h-12 bg-[#0F2E25] mb-6"></div>
                
                <!-- Anggota -->
                <h3 class="text-2xl font-semibold text-center mb-8 text-[#0F2E25]" data-aos="fade-up">Satuan Pendidikan</h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8 w-full">
                    <!-- DAN SATDIK PERWIRA -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/profile.png" alt="DAN SATDIK PERWIRA" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">-</h3>
                        <p class="text-gray-600 mt-2">DAN SATDIK PERWIRA</p>
                    </div>
                    
                    <!-- DAN SATDIKTA -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/13.png" alt="DAN SATDIKTA" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">MAYOR CZI BAYU N</h3>
                        <p class="text-gray-600 mt-2">DAN SATDIKTA</p>
                    </div>
                    
                    <!-- DAN SATDIK BINTARA -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/14.png" alt="DAN SATDIK BINTARA" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">MAYOR CZI NURUL HILAL</h3>
                        <p class="text-gray-600 mt-2">DAN SATDIK BINTARA</p>
                    </div>
                    
                    <!-- DANKI DEMLAT -->
                    <div class="bg-white p-6 rounded-lg shadow-lg text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-20 h-20 rounded-full bg-[#0F2E25] mx-auto mb-4 flex items-center justify-center overflow-hidden">
                            <img src="/assets/images/15.png" alt="DANKI DEMLAT" class="w-full h-full object-cover">
                        </div>
                        <h3 class="text-lg font-bold text-[#0F2E25]">KAPTEN CZI GUNAWAN</h3>
                        <p class="text-gray-600 mt-2">DANKI DEMLAT</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-[#0F2E25]" data-aos="fade-up">
                Hubungi Kami
            </h2>
            
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Kontak Info -->
                <div data-aos="fade-right">
                    <h3 class="text-2xl font-bold text-zeni mb-6">Informasi Kontak</h3>
                    
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-full bg-zeni flex items-center justify-center mr-4">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">Alamat</h4>
                                <p class="text-gray-600 mt-1">Jl. Jend. Sudirman No.35, RT.01/RW.05, Pabaton, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16121</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-full bg-zeni flex items-center justify-center mr-4">
                                <i class="fas fa-phone text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">Telepon</h4>
                                <p class="text-gray-600 mt-1">081388932678</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="w-12 h-12 rounded-full bg-zeni flex items-center justify-center mr-4">
                                <i class="fas fa-envelope text-white"></i>
                            </div>
                            <div>
                                <h4 class="text-lg font-semibold text-gray-800">Email</h4>
                                <p class="text-gray-600 mt-1">kodiklatadpusdikzi@gmail.com</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div class="mt-12">
                        <h4 class="text-lg font-semibold text-gray-800 mb-4">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <a href="https://api.whatsapp.com/send/?phone=6281388932678&text=Live+Chat+Whatsapp+PUSDIKZI+BOGOR&type=phone_number&app_absent=0" target="_blank" class="social-button whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/pusdikzi.kodiklatad/" target="_blank" class="social-button facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/pusat_pendidikan_zeni/" target="_blank" class="social-button instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://www.youtube.com/@pusdikzi_official4259/videos" target="_blank" class="social-button youtube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="h-96 rounded-xl overflow-hidden shadow-lg" data-aos="fade-left">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5139437496905!2d106.79345077453614!3d-6.5828501643496455!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c435a6726881%3A0x8c6c0c4244aee7b2!2sPusat%20Pendidikan%20Zeni%20TNI-AD!5e0!3m2!1sid!2sid!4v1745584245488!5m2!1sid!2sid"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-zeni text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Logo & About -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="/assets/images/logo-zeni.png" alt="Logo Zeni" class="h-12 w-auto">
                        <span class="text-2xl font-bold">PUSDIKZI</span>
                    </div>
                    <p class="text-gray-300 mb-6">
                        Pusat Pendidikan Zeni (Pusdikzi) merupakan lembaga pendidikan untuk mencetak prajurit Zeni TNI Angkatan Darat yang profesional dan tangguh.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="#beranda" class="text-gray-300 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#profil" class="text-gray-300 hover:text-white transition-colors">Profil</a></li>
                        <li><a href="#visi-misi" class="text-gray-300 hover:text-white transition-colors">Visi & Misi</a></li>
                        <li><a href="#sejarah" class="text-gray-300 hover:text-white transition-colors">Sejarah</a></li>
                        <li><a href="#struktur" class="text-gray-300 hover:text-white transition-colors">Struktur Organisasi</a></li>
                        <li><a href="#kontak" class="text-gray-300 hover:text-white transition-colors">Kontak</a></li>
                    </ul>
                </div>
                
                <!-- External Links -->
                <div>
                    <h4 class="text-lg font-bold mb-4">Tautan Eksternal</h4>
                    <ul class="space-y-2">
                        <li><a href="https://www.tni.mil.id" target="_blank" class="text-gray-300 hover:text-white transition-colors">TNI</a></li>
                        <li><a href="https://www.tniad.mil.id" target="_blank" class="text-gray-300 hover:text-white transition-colors">TNI AD</a></li>
                        <li><a href="https://www.kemhan.go.id" target="_blank" class="text-gray-300 hover:text-white transition-colors">Kementerian Pertahanan</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p>&copy; 2025 PUSDIKZI - Pusat Pendidikan Zeni TNI Angkatan Darat. All Rights Reserved.</p>
                <div class="mt-4 md:mt-0">
                    <a href="#" class="text-gray-300 hover:text-white mx-2">Kebijakan Privasi</a>
                    <a href="#" class="text-gray-300 hover:text-white mx-2">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- JS Libraries -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true
            });
            
            // Loading Screen
            setTimeout(function() {
                document.getElementById('loading-screen').classList.add('fade-out');
            }, 1500);
            
            // Mobile Menu Toggle
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
            
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('open');
                mobileMenuOverlay.classList.toggle('active');
            });
            
            mobileMenuOverlay.addEventListener('click', function() {
                mobileMenu.classList.remove('open');
                mobileMenuOverlay.classList.remove('active');
            });
            
            // Close mobile menu when clicking a link
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove('open');
                    mobileMenuOverlay.classList.remove('active');
                });
            });
            
            // Navbar Scroll
            const navbar = document.querySelector('nav');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 50) {
                    navbar.classList.add('shadow-lg');
                } else {
                    navbar.classList.remove('shadow-lg');
                }
            });
            
            // Scroll to Top Button
            const scrollTopBtn = document.getElementById('scrollTop');
            
            window.addEventListener('scroll', function() {
                if (window.scrollY > 500) {
                    scrollTopBtn.classList.add('active');
                } else {
                    scrollTopBtn.classList.remove('active');
                }
            });
            
            scrollTopBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Hero slider
            const slides = document.querySelectorAll('.hero-slider .slide');
            let currentSlide = 0;
            
            function showSlide(index) {
                slides.forEach(slide => {
                    slide.style.opacity = '0';
                });
                slides[index].style.opacity = '1';
            }
            
            function nextSlide() {
                currentSlide = (currentSlide + 1) % slides.length;
                showSlide(currentSlide);
            }
            
            showSlide(0);
            setInterval(nextSlide, 5000);
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        const headerOffset = 80;
                        const elementPosition = targetElement.getBoundingClientRect().top;
                        const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                        
                        window.scrollTo({
                            top: offsetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>
