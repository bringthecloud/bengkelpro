<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="section-title"><i class='bx bx-receipt'></i> Daftar Transaksi</h3>
    <a href="/transaksi/create" class="btn btn-primary"><i class='bx bx-plus'></i> Transaksi Baru</a>
</div>

<div class="search-bar" style="margin-bottom:20px;">
    <i class='bx bx-search'></i>
    <input type="text" id="searchInput" placeholder="Cari transaksi..." onkeyup="filterTable()">
</div>

<div class="table-container">
    <table id="dataTable">
        <thead>
            <tr>
                <th>No. Nota</th>
                <th>Pelanggan</th>
                <th>Kendaraan</th>
                <th>Keluhan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($trans)): ?>
                <tr class="empty-row"><td colspan="7">
                    <div class="empty-state">
                        <i class='bx bx-receipt'></i>
                        <p>Belum ada transaksi</p>
                    </div>
                </td></tr>
            <?php else: ?>
                <?php foreach($trans as $t): ?>
                <tr>
                    <td style="color:var(--primary-red); font-weight:600;">#<?= $t['ID_Transaksi'] ?></td>
                    <td style="font-weight:500;"><?= $t['Nama_Lengkap'] ?? '-' ?></td>
                    <td><?= ($t['No_Polisi'] ?? '-') . ' — ' . ($t['Merk'] ?? '') ?></td>
                    <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?= esc($t['Keluhan']) ?></td>
                    <td style="font-weight:600;">Rp <?= number_format($t['Total_Harga'] ?? 0, 0, ',', '.') ?></td>
                    <td>
                        <?php
                            $status = $t['Status_Bayar'] ?? 'Pending';
                            $badgeClass = 'badge-warning';
                            if($status == 'Lunas') $badgeClass = 'badge-success';
                            elseif($status == 'Batal') $badgeClass = 'badge-danger';
                        ?>
                        <span class="badge <?= $badgeClass ?>"><?= $status ?></span>
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="/transaksi/edit/<?= $t['ID_Transaksi'] ?>" class="btn btn-secondary btn-sm"><i class='bx bx-edit'></i> Edit</a>
                            <a href="/transaksi/<?= $t['ID_Transaksi'] ?>" class="btn btn-secondary btn-sm"><i class='bx bx-show'></i> Detail</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(!empty($trans)): ?>
    <div class="data-counter">Menampilkan <strong><?= count($trans) ?></strong> transaksi</div>
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