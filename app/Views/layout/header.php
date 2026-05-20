<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Bengkelpro</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php if (session()->get('isLoggedIn')): ?>
<div class="wrapper" id="appWrapper">
    <!-- SIDEBAR OVERLAY (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- SIDEBAR -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-brand" id="sidebarBrand" title="Buka/tutup menu">
            <h3 class="brand-full"><i class='bx bxs-cog'></i>Bengkel<span>Pro</span></h3>
            <h3 class="brand-mini"><i class='bx bxs-cog'></i></h3>
        </div>

        <?php $role = session()->get('role') ?? 'kasir'; ?>
        <p class="sidebar-label">Menu</p>
        <ul class="sidebar-menu">
            <li>
                <a href="/dashboard" class="<?= uri_string() == 'dashboard' ? 'active' : '' ?>" data-tooltip="Dashboard">
                    <i class='bx bxs-dashboard'></i><span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="/transaksi" class="<?= uri_string() == 'transaksi' ? 'active' : '' ?>" data-tooltip="Transaksi">
                    <i class='bx bx-receipt'></i><span>Transaksi</span>
                </a>
            </li>
            <?php $isDataPage = str_contains(uri_string(), 'pelanggan') || str_contains(uri_string(), 'kendaraan') || str_contains(uri_string(), 'jasa') || str_contains(uri_string(), 'sparepart'); ?>
            <li class="menu-dropdown <?= $isDataPage ? 'open' : '' ?>">
                <a href="javascript:void(0)" class="dropdown-toggle" data-tooltip="Data" onclick="this.parentElement.classList.toggle('open')">
                    <i class='bx bx-data'></i><span>Data</span>
                    <i class='bx bx-chevron-down dropdown-arrow'></i>
                </a>
                <ul class="submenu">
                    <li>
                        <a href="/pelanggan" class="<?= str_contains(uri_string(), 'pelanggan') ? 'active' : '' ?>" data-tooltip="Pelanggan">
                            <i class='bx bxs-user-detail'></i><span>Pelanggan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/kendaraan" class="<?= str_contains(uri_string(), 'kendaraan') ? 'active' : '' ?>" data-tooltip="Kendaraan">
                            <i class='bx bxs-car'></i><span>Kendaraan</span>
                        </a>
                    </li>
                    <li>
                        <a href="/jasa" class="<?= str_contains(uri_string(), 'jasa') ? 'active' : '' ?>" data-tooltip="Jasa Service">
                            <i class='bx bx-wrench'></i><span>Jasa Service</span>
                        </a>
                    </li>
                    <li>
                        <a href="/sparepart" class="<?= str_contains(uri_string(), 'sparepart') ? 'active' : '' ?>" data-tooltip="Sparepart">
                            <i class='bx bxs-box'></i><span>Sparepart</span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php if($role === 'admin'): ?>
            <li>
                <a href="/karyawan" class="<?= str_contains(uri_string(), 'karyawan') ? 'active' : '' ?>" data-tooltip="Karyawan">
                    <i class='bx bxs-group'></i><span>Karyawan</span>
                </a>
            </li>
            <?php endif; ?>
            <li>
                <a href="/laporan" class="<?= uri_string() == 'laporan' ? 'active' : '' ?>" data-tooltip="Laporan">
                    <i class='bx bxs-bar-chart-alt-2'></i><span>Laporan</span>
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <a href="/auth/logout" data-tooltip="Logout">
                <i class='bx bx-log-out'></i><span>Logout</span>
            </a>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="content">
        <!-- TOP BAR -->
        <div class="topbar">
            <div class="topbar-left" style="display:flex; align-items:center; gap:12px;">
                <button class="sidebar-toggle" id="sidebarToggle" aria-label="Toggle menu">
                    <i class='bx bx-menu'></i>
                </button>
                <div>
                    <h2><?= esc($title) ?></h2>
                    <p><?= date('l, d F Y') ?></p>
                </div>
            </div>
            <div class="topbar-right">
                <a href="/notifikasi" class="topbar-icon notif-icon" title="Notifikasi">
                    <i class='bx bx-bell'></i>
                    <?php
                        $notifModel = new \App\Models\NotifikasiModel();
                        $unread = $notifModel->where('is_read', 0)->countAllResults();
                    ?>
                    <?php if($unread > 0): ?>
                        <span class="notif-badge"><?= $unread > 9 ? '9+' : $unread ?></span>
                    <?php endif; ?>
                </a>
                <img src="https://ui-avatars.com/api/?name=<?= urlencode(session()->get('nama') ?? 'User') ?>&background=D32F2F&color=fff&size=40&bold=true" alt="<?= session()->get('nama') ?>" class="topbar-avatar" title="<?= session()->get('nama') ?> (<?= session()->get('role') ?? 'kasir' ?>)">
            </div>
        </div>

        <!-- PAGE CONTENT -->
        <div class="page-content">
            <?php if(session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <i class='bx bx-check-circle'></i> <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <?php if(session()->getFlashdata('error')): ?>
                <div class="alert alert-error">
                    <i class='bx bx-error-circle'></i> <?= session()->getFlashdata('error') ?>
                </div>
            <?php endif; ?>

            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>

<script>
(function() {
    const wrapper = document.getElementById('appWrapper');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const brand = document.getElementById('sidebarBrand');
    const content = document.querySelector('.content');
    const mobileToggle = document.getElementById('sidebarToggle');

    const STORAGE_KEY = 'bengkelpro_sidebar_collapsed';
    const isMobile = () => window.innerWidth <= 1024;

    // --- Desktop: Collapse / Expand ---
    function setCollapsed(collapsed, animate) {
        if (animate !== false) {
            wrapper.classList.add('sidebar-animating');
            setTimeout(() => wrapper.classList.remove('sidebar-animating'), 350);
        }
        if (collapsed) {
            wrapper.classList.add('sidebar-collapsed');
        } else {
            wrapper.classList.remove('sidebar-collapsed');
        }
        localStorage.setItem(STORAGE_KEY, collapsed ? '1' : '0');
    }

    // Restore saved state on load (desktop only)
    if (!isMobile() && localStorage.getItem(STORAGE_KEY) === '1') {
        setCollapsed(true, false);
    }

    // Click brand logo = expand sidebar
    if (brand) {
        brand.addEventListener('click', (e) => {
            if (isMobile()) return;
            e.preventDefault();
            if (wrapper.classList.contains('sidebar-collapsed')) {
                setCollapsed(false);
            }
        });
    }

    // Click content area = collapse sidebar
    if (content) {
        content.addEventListener('click', (e) => {
            if (isMobile()) return;
            if (!wrapper.classList.contains('sidebar-collapsed')) {
                setCollapsed(true);
            }
        });
    }

    // --- Mobile: Slide-in / Overlay ---
    if (mobileToggle && sidebar && overlay) {
        mobileToggle.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
        });
    }

    // Reset on resize
    window.addEventListener('resize', () => {
        if (isMobile()) {
            wrapper.classList.remove('sidebar-collapsed');
        } else {
            sidebar.classList.remove('open');
            overlay.classList.remove('active');
            if (localStorage.getItem(STORAGE_KEY) === '1') {
                setCollapsed(true, false);
            }
        }
    });
})();
</script>
<script src="<?= base_url('assets/js/app.js') ?>" defer></script>
<?php else: ?>
    <?= $this->renderSection('content') ?>
<?php endif; ?>
</body>
</html>