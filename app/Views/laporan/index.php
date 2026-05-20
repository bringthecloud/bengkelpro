<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="section-title"><i class='bx bx-list-ul'></i> Laporan Transaksi</h3>
    <button onclick="window.print()" class="btn btn-primary"><i class='bx bx-printer'></i> Cetak Laporan</button>
</div>

<!-- SUMMARY CARDS -->
<div class="info-grid">
    <div class="info-card">
        <div class="info-icon blue"><i class='bx bx-receipt'></i></div>
        <div class="info-data">
            <h4><?= !empty($laporan) ? count($laporan) : 0 ?></h4>
            <p>Total Transaksi</p>
        </div>
    </div>
    <div class="info-card">
        <div class="info-icon green"><i class='bx bx-money'></i></div>
        <div class="info-data">
            <?php
                $totalPendapatan = 0;
                $totalLunas = 0;
                $totalBelum = 0;
                if(!empty($laporan)) {
                    foreach($laporan as $l) {
                        $totalPendapatan += $l['Total_Harga'] ?? 0;
                        if(($l['Status_Bayar'] ?? '') == 'Lunas') $totalLunas++;
                        else $totalBelum++;
                    }
                }
            ?>
            <h4>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></h4>
            <p>Total Pendapatan</p>
        </div>
    </div>
    <div class="info-card">
        <div class="info-icon purple"><i class='bx bx-check-circle'></i></div>
        <div class="info-data">
            <h4><?= $totalLunas ?></h4>
            <p>Transaksi Lunas</p>
        </div>
    </div>
    <div class="info-card">
        <div class="info-icon red"><i class='bx bx-time-five'></i></div>
        <div class="info-data">
            <h4><?= $totalBelum ?></h4>
            <p>Belum Bayar</p>
        </div>
    </div>
</div>

<div class="search-bar" style="margin-bottom:20px;">
    <i class='bx bx-search'></i>
    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama, no polisi, tanggal..." onkeyup="filterTable()">
</div>

<div class="table-container">
    <table id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Kendaraan</th>
                <th>Keluhan</th>
                <th>Total</th>
                <th>Status</th>
                <th class="no-print">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($laporan)): ?>
                <tr class="empty-row"><td colspan="8">
                    <div class="empty-state">
                        <i class='bx bx-receipt'></i>
                        <p>Belum ada data transaksi</p>
                    </div>
                </td></tr>
            <?php else: ?>
                <?php $no = 1; foreach($laporan as $l): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= date('d M Y', strtotime($l['Tanggal_Masuk'])) ?></td>
                    <td><?= esc($l['Nama_Lengkap'] ?? '-') ?></td>
                    <td><?= esc(($l['Merk'] ?? '') . ' ' . ($l['Tipe'] ?? '') . ' — ' . ($l['No_Polisi'] ?? '-')) ?></td>
                    <td style="max-width:200px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="<?= esc($l['Keluhan'] ?? '-') ?>"><?= esc($l['Keluhan'] ?? '-') ?></td>
                    <td style="color:var(--text-main); font-weight:600;">Rp <?= number_format($l['Total_Harga'], 0, ',', '.') ?></td>
                    <td>
                        <?php
                            $status = $l['Status_Bayar'] ?? 'Belum Bayar';
                            $badgeClass = 'badge-warning';
                            if($status == 'Lunas') $badgeClass = 'badge-success';
                            elseif($status == 'Batal') $badgeClass = 'badge-danger';
                        ?>
                        <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                    </td>
                    <td class="no-print">
                        <a href="/transaksi/<?= $l['ID_Transaksi'] ?>" class="btn btn-secondary" style="font-size:12px; padding:6px 12px;">
                            <i class='bx bx-show'></i> Detail
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(!empty($laporan)): ?>
    <div class="data-counter">Menampilkan <strong><?= count($laporan) ?></strong> data transaksi</div>
    <?php endif; ?>
</div>

<script>
function filterTable() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const rows = document.querySelectorAll('#dataTable tbody tr:not(.empty-row)');
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(input) ? '' : 'none';
    });
}
</script>

<?= $this->endSection() ?>