<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BengkelPro - Professional Workshop Management</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/landing.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="/" class="nav-brand">
                <i class='bx bxs-cog text-red' style="font-size:26px;"></i>Bengkel<span>Pro</span>
            </a>
            <div class="nav-links">
                <a href="#services">Layanan</a>
                <a href="#accessories">Produk</a>
                <a href="<?= base_url('login') ?>" class="btn-login">Login</a>
            </div>
        </div>
    </nav>

    <!-- HERO SECTION with Rider Background -->
    <section class="hero" style="background-image: url('<?= base_url('assets/images/hero_bg.png') ?>');">
        <div class="hero-overlay"></div>

        <div class="container hero-content">
            <div class="hero-text">
                <h1 class="hero-title">
                    <span class="hero-title-sub">Workshop Management</span>
                    Bengkel<span class="text-red">Pro</span>
                </h1>
                <p class="hero-desc">Sistem manajemen bengkel terpadu untuk mengelola servis, pelanggan, sparepart, dan laporan secara real-time, digital, dan efisien.</p>
                <div class="hero-buttons">
                    <a href="<?= base_url('login') ?>" class="btn-primary">
                        Mulai Sekarang <i class='bx bx-right-arrow-alt'></i>
                    </a>
                    <a href="#about" class="btn-outline">Pelajari Lebih Lanjut</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SPAREPART & ACCESSORIES -->
    <section class="accessories" id="accessories">
        <div class="container">
            <div class="section-header">
                <h2>SPAREPART & <span class="text-red">ACCESSORIES</span></h2>
                <p>Berbagai jenis suku cadang dan aksesoris untuk kebutuhan bengkel Anda.</p>
            </div>

            <div class="acc-grid">
                <div class="acc-card">
                    <i class='bx bxs-circle' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Ban Motor</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-droplet' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Oli Mesin</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-disc' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Kampas Rem</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-transfer-alt' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Rantai & Gear</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-bolt-circle' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Busi</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-cylinder' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Shock Breaker</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-bulb' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Lampu & Bohlam</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-battery' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Aki / Baterai</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-filter-alt' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Filter Udara</h4>
                </div>
                <div class="acc-card">
                    <i class='bx bx-dots-horizontal-rounded' style="font-size:40px; color:var(--primary-red);"></i>
                    <h4>Dan Lainnya</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICES SECTION -->
    <section class="services" id="services">
        <div class="container">
            <div class="section-header">
                <h2 class="text-gradient">Layanan Utama BengkelPro</h2>
                <p>Solusi lengkap untuk manajemen bengkel modern.</p>
            </div>

            <div class="services-grid">
                <div class="glass-panel service-card">
                    <div class="service-icon"><i class='bx bx-wrench'></i></div>
                    <h3>Manajemen Servis</h3>
                    <p>Catat dan pantau setiap layanan perbaikan kendaraan dengan detail yang presisi.</p>
                </div>
                <div class="glass-panel service-card">
                    <div class="service-icon"><i class='bx bxs-box'></i></div>
                    <h3>Inventori Sparepart</h3>
                    <p>Sistem inventarisasi terpadu melacak penggunaan suku cadang secara real-time.</p>
                </div>
                <div class="glass-panel service-card">
                    <div class="service-icon"><i class='bx bxs-user-detail'></i></div>
                    <h3>Data Pelanggan</h3>
                    <p>Database pelanggan terstruktur dan mudah diakses kapanpun.</p>
                </div>
                <div class="glass-panel service-card">
                    <div class="service-icon"><i class='bx bx-receipt'></i></div>
                    <h3>Transaksi Digital</h3>
                    <p>Sistem kasir cerdas mempercepat proses pembayaran dan laporan akurat.</p>
                </div>
                <div class="glass-panel service-card">
                    <div class="service-icon"><i class='bx bx-list-ul'></i></div>
                    <h3>Laporan Transaksi</h3>
                    <p>Laporan sederhana berisi ringkasan dan detail setiap transaksi servis bengkel.</p>
                </div>
                <div class="glass-panel service-card">
                    <div class="service-icon"><i class='bx bx-support'></i></div>
                    <h3>Dukungan 24/7</h3>
                    <p>Sistem selalu online memastikan operasional bengkel tidak terhenti.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TENTANG BENGKELPRO -->
    <section class="cta-banner" id="about">
        <div class="container">
            <div class="cta-banner-content">
                <h2>Kenapa Memilih <span style="font-style:italic; text-decoration:underline; text-underline-offset:4px;">BengkelPro</span>?</h2>
                <p>Kami menyediakan solusi digital lengkap untuk mengelola bengkel Anda. Dari pencatatan servis, manajemen stok sparepart, hingga laporan keuangan — semuanya terintegrasi dalam satu platform yang mudah digunakan.</p>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="footer-contact">
                <h4>CONTACT US</h4>
                <div class="contact-info">
                    <p><i class='bx bx-phone'></i> +62 895-3655-70679</p>
                    <p><i class='bx bx-map'></i> Jl. Modus Anomali No.777, Kota Kiamat Kubro</p>
                    <p><i class='bx bx-time'></i> Senin - Sabtu, 08:00 - 17:00</p>
                </div>
            </div>
            <p>&copy; <?= date('Y') ?> BengkelPro. All Rights Reserved.</p>
        </div>
    </footer>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.style.background = 'rgba(15, 17, 21, 0.95)';
                navbar.style.boxShadow = '0 4px 20px rgba(0,0,0,0.5)';
            } else {
                navbar.style.background = 'rgba(15, 17, 21, 0.8)';
                navbar.style.boxShadow = 'none';
            }
        });

        // Smooth scroll for nav links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Scroll reveal animation
        const revealElements = document.querySelectorAll('.section-header, .acc-card, .service-card, .cta-banner-content, .footer-contact');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    revealObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        revealElements.forEach(el => revealObserver.observe(el));
    </script>
</body>
</html>
