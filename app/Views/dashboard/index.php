<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<!-- STAT CARDS -->
<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-icon red"><i class='bx bx-receipt'></i></div>
        <div class="stat-info">
            <h3><?= $totalTransaksi ?? 0 ?></h3>
            <p>Total Transaksi</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon blue"><i class='bx bxs-user-detail'></i></div>
        <div class="stat-info">
            <h3><?= $totalPelanggan ?? 0 ?></h3>
            <p>Pelanggan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon yellow"><i class='bx bxs-car'></i></div>
        <div class="stat-info">
            <h3><?= $totalKendaraan ?? 0 ?></h3>
            <p>Kendaraan</p>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-icon green"><i class='bx bx-money'></i></div>
        <div class="stat-info">
            <h3>Rp <?= number_format($totalPendapatan ?? 0, 0, ',', '.') ?></h3>
            <p>Total Pendapatan</p>
        </div>
    </div>
</div>

<!-- QUICK ACTIONS -->
<div class="section-block">
    <h3 class="section-title"><i class='bx bx-grid-alt'></i> Akses Cepat</h3>
    <?php $role = session()->get('role') ?? 'kasir'; ?>
    <div class="quick-actions">
        <a href="/transaksi/create" class="quick-card">
            <i class='bx bx-plus-circle'></i>
            <span>Transaksi Baru</span>
        </a>
        <?php if($role === 'admin'): ?>
        <a href="/pelanggan/new" class="quick-card">
            <i class='bx bx-user-plus'></i>
            <span>Tambah Pelanggan</span>
        </a>
        <a href="/kendaraan/new" class="quick-card">
            <i class='bx bx-car'></i>
            <span>Tambah Kendaraan</span>
        </a>
        <?php endif; ?>
        <a href="/sparepart" class="quick-card">
            <i class='bx bxs-box'></i>
            <span>Cek Stok</span>
        </a>
        <a href="/laporan" class="quick-card">
            <i class='bx bxs-bar-chart-alt-2'></i>
            <span>Lihat Laporan</span>
        </a>
        <?php if($role === 'admin'): ?>
        <a href="/jasa/new" class="quick-card">
            <i class='bx bx-wrench'></i>
            <span>Tambah Jasa</span>
        </a>
        <?php endif; ?>
    </div>
</div>

<!-- DATA SUMMARY + RECENT TRANSACTIONS -->
<div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px; margin-top:20px;">

    <!-- DATA MASTER SUMMARY -->
    <div class="card-panel">
        <h3 class="section-title" style="margin-bottom:16px;"><i class='bx bx-data'></i> Ringkasan Data</h3>
        <div class="summary-list">
            <div class="summary-row">
                <span><i class='bx bxs-user-detail' style="color:#60a5fa;"></i> Pelanggan</span>
                <strong><?= $totalPelanggan ?? 0 ?></strong>
            </div>
            <div class="summary-row">
                <span><i class='bx bxs-car' style="color:#fbbf24;"></i> Kendaraan</span>
                <strong><?= $totalKendaraan ?? 0 ?></strong>
            </div>
            <div class="summary-row">
                <span><i class='bx bx-wrench' style="color:#f87171;"></i> Jasa Service</span>
                <strong><?= $totalJasa ?? 0 ?></strong>
            </div>
            <div class="summary-row">
                <span><i class='bx bxs-box' style="color:#34d399;"></i> Sparepart</span>
                <strong><?= $totalSparepart ?? 0 ?></strong>
            </div>
        </div>
    </div>

    <!-- RECENT TRANSACTIONS -->
    <div class="card-panel">
        <h3 class="section-title" style="margin-bottom:16px;"><i class='bx bx-history'></i> Transaksi Terkini</h3>
        <?php if(empty($recentTrans)): ?>
            <div class="empty-state" style="padding:24px;">
                <i class='bx bx-receipt'></i>
                <p>Belum ada transaksi</p>
            </div>
        <?php else: ?>
            <div class="summary-list">
                <?php foreach($recentTrans as $t): ?>
                <a href="/transaksi/<?= $t['ID_Transaksi'] ?>" class="summary-row" style="text-decoration:none; cursor:pointer;">
                    <span style="display:flex; align-items:center; gap:8px;">
                        <i class='bx bx-receipt' style="color:var(--primary-red);"></i>
                        #<?= $t['ID_Transaksi'] ?> — <?= substr($t['Keluhan'], 0, 30) ?>...
                    </span>
                    <?php
                        $status = $t['Status_Bayar'] ?? 'Belum Bayar';
                        $badgeClass = 'badge-warning';
                        if($status == 'Lunas') $badgeClass = 'badge-success';
                    ?>
                    <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection() ?>