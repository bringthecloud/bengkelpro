<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="section-title"><i class='bx bxs-box'></i> Data Sparepart</h3>
    <?php if(session()->get('role') === 'admin'): ?>
    <a href="/sparepart/new" class="btn btn-primary"><i class='bx bx-plus'></i> Tambah Sparepart</a>
    <?php endif; ?>
</div>

<div class="search-bar" style="margin-bottom:20px;">
    <i class='bx bx-search'></i>
    <input type="text" id="searchInput" placeholder="Cari sparepart..." onkeyup="filterTable()">
</div>

<div class="table-container">
    <table id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Sparepart</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($items)): ?>
                <tr class="empty-row"><td colspan="5">
                    <div class="empty-state">
                        <i class='bx bx-box'></i>
                        <p>Belum ada data sparepart</p>
                    </div>
                </td></tr>
            <?php else: ?>
                <?php $no = 1; foreach($items as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style="color:var(--text-main); font-weight:500;"><?= $item['Nama_Barang'] ?? '-' ?></td>
                    <td style="color:var(--primary-red); font-weight:600;">Rp <?= number_format($item['Harga_Jual'] ?? 0, 0, ',', '.') ?></td>
                    <td>
                        <?php $stok = $item['Stok_Barang'] ?? 0; ?>
                        <span class="badge <?= $stok <= 5 ? 'badge-danger' : ($stok <= 10 ? 'badge-warning' : 'badge-success') ?>"><?= $stok ?> unit</span>
                    </td>
                    <td>
                        <?php if(session()->get('role') === 'admin'): ?>
                        <div class="action-group">
                            <a href="/sparepart/edit/<?= $item['ID_Sparepart'] ?>" class="btn btn-secondary btn-sm"><i class='bx bx-edit'></i> Edit</a>
                            <a href="/sparepart/delete/<?= $item['ID_Sparepart'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class='bx bx-trash'></i> Hapus</a>
                        </div>
                        <?php else: ?>
                        <span style="color:var(--text-muted); font-size:13px;">View only</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(!empty($items)): ?>
    <div class="data-counter">Menampilkan <strong><?= count($items) ?></strong> data sparepart</div>
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
