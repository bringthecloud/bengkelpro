<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="section-title"><i class='bx bx-receipt'></i> Detail Transaksi #<?= $trans['ID_Transaksi'] ?></h3>
    <a href="/transaksi" class="btn btn-secondary"><i class='bx bx-arrow-back'></i> Kembali</a>
</div>

<div class="invoice-card">
    <div class="invoice-header">
        <div>
            <h2 class="invoice-brand"><i class='bx bxs-cog' style="color:var(--primary-red); margin-right:6px;"></i>Bengkel<span style="color:var(--primary-red);">Pro</span></h2>
            <p style="color:var(--text-muted); font-size:13px;">Sistem Manajemen Bengkel</p>
        </div>
        <div class="invoice-meta">
            <p><strong>No. Nota:</strong> #<?= $trans['ID_Transaksi'] ?></p>
            <p><strong>Tanggal:</strong> <?= date('d M Y, H:i', strtotime($trans['Tanggal_Masuk'])) ?></p>
            <p>
                <?php
                    $status = $trans['Status_Bayar'] ?? 'Pending';
                    $badgeClass = 'badge-warning';
                    if($status == 'Lunas') $badgeClass = 'badge-success';
                    elseif($status == 'Batal') $badgeClass = 'badge-danger';
                ?>
                <span class="badge <?= $badgeClass ?>" style="font-size:13px;"><?= $status ?></span>
            </p>
        </div>
    </div>

    <div class="invoice-divider"></div>

    <!-- PELANGGAN & KENDARAAN -->
    <div class="invoice-section">
        <h4><i class='bx bx-user'></i> Informasi Pelanggan & Kendaraan</h4>
        <div class="invoice-grid">
            <div class="invoice-field">
                <span class="field-label">Nama Pelanggan</span>
                <span class="field-value"><?= $pelanggan['Nama_Lengkap'] ?? '-' ?></span>
            </div>
            <div class="invoice-field">
                <span class="field-label">No. Telepon</span>
                <span class="field-value"><?= $pelanggan['No_Telepon'] ?? '-' ?></span>
            </div>
            <div class="invoice-field">
                <span class="field-label">No. Polisi</span>
                <span class="field-value"><?= $kendaraan['No_Polisi'] ?? '-' ?></span>
            </div>
            <div class="invoice-field">
                <span class="field-label">Kendaraan</span>
                <span class="field-value"><?= ($kendaraan['Merk'] ?? '-') . ' ' . ($kendaraan['Tipe'] ?? '') ?></span>
            </div>
        </div>
    </div>

    <div class="invoice-divider"></div>

    <!-- KELUHAN -->
    <div class="invoice-section">
        <h4><i class='bx bx-message-error'></i> Keluhan</h4>
        <p style="color:var(--text-muted); line-height:1.7; padding:12px 16px; background:rgba(255,255,255,0.03); border-radius:8px;">
            <?= esc($trans['Keluhan']) ?>
        </p>
    </div>

    <?php if(!empty($detailServis)): ?>
    <div class="invoice-divider"></div>
    <div class="invoice-section">
        <h4><i class='bx bx-wrench'></i> Daftar Servis</h4>
        <table class="invoice-table">
            <thead>
                <tr><th>No</th><th>Nama Jasa</th><th style="text-align:right;">Harga</th></tr>
            </thead>
            <tbody>
                <?php $totalServis = 0; $no = 1; foreach($detailServis as $ds): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($ds['Nama_Jasa'] ?? '-') ?></td>
                    <td style="text-align:right; color:var(--primary-red); font-weight:600;">Rp <?= number_format($ds['Harga_Satuan'], 0, ',', '.') ?></td>
                </tr>
                <?php $totalServis += $ds['Harga_Satuan']; endforeach; ?>
            </tbody>
            <tfoot>
                <tr><td colspan="2" style="text-align:right; font-weight:600;">Subtotal Servis</td>
                <td style="text-align:right; font-weight:700; color:var(--text-main);">Rp <?= number_format($totalServis, 0, ',', '.') ?></td></tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <?php if(!empty($detailSparepart)): ?>
    <div class="invoice-divider"></div>
    <div class="invoice-section">
        <h4><i class='bx bxs-box'></i> Daftar Sparepart</h4>
        <table class="invoice-table">
            <thead>
                <tr><th>No</th><th>Nama Barang</th><th>Jumlah</th><th style="text-align:right;">Harga</th><th style="text-align:right;">Subtotal</th></tr>
            </thead>
            <tbody>
                <?php $totalParts = 0; $no = 1; foreach($detailSparepart as $dp): 
                    $sub = $dp['Harga_Satuan'] * $dp['Jumlah'];
                    $totalParts += $sub;
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= esc($dp['Nama_Barang'] ?? '-') ?></td>
                    <td><?= $dp['Jumlah'] ?></td>
                    <td style="text-align:right;">Rp <?= number_format($dp['Harga_Satuan'], 0, ',', '.') ?></td>
                    <td style="text-align:right; color:var(--primary-red); font-weight:600;">Rp <?= number_format($sub, 0, ',', '.') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr><td colspan="4" style="text-align:right; font-weight:600;">Subtotal Sparepart</td>
                <td style="text-align:right; font-weight:700; color:var(--text-main);">Rp <?= number_format($totalParts, 0, ',', '.') ?></td></tr>
            </tfoot>
        </table>
    </div>
    <?php endif; ?>

    <div class="invoice-divider"></div>

    <!-- TOTAL -->
    <div class="invoice-total">
        <div>
            <span style="color:var(--text-muted);">Total Biaya</span>
            <h3 style="color:var(--primary-red); font-size:28px; margin-top:4px;">
                Rp <?= number_format($trans['Total_Harga'] ?? 0, 0, ',', '.') ?>
            </h3>
        </div>
        <div class="invoice-actions">
            <?php if(($trans['Status_Bayar'] ?? '') != 'Lunas'): ?>
                <a href="/transaksi/bayar/<?= $trans['ID_Transaksi'] ?>" class="btn btn-primary" onclick="return confirm('Konfirmasi pembayaran?')">
                    <i class='bx bx-check-circle'></i> Tandai Lunas
                </a>
            <?php endif; ?>
            <button class="btn btn-secondary" onclick="window.print()">
                <i class='bx bx-printer'></i> Cetak Nota
            </button>
            <a href="/transaksi/delete/<?= $trans['ID_Transaksi'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus transaksi ini? Data tidak bisa dikembalikan!')">
                <i class='bx bx-trash'></i> Hapus
            </a>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
