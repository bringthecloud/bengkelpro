<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="section-title"><i class='bx bxs-user-detail'></i> Data Pelanggan</h3>
    <a href="/pelanggan/new" class="btn btn-primary"><i class='bx bx-plus'></i> Tambah Data</a>
</div>

<div class="search-bar" style="margin-bottom:20px;">
    <i class='bx bx-search'></i>
    <input type="text" id="searchInput" placeholder="Cari pelanggan..." onkeyup="filterTable()">
</div>

<div class="table-container">
    <table id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>No. Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($items)): ?>
                <tr class="empty-row"><td colspan="4">
                    <div class="empty-state">
                        <i class='bx bx-user-x'></i>
                        <p>Belum ada data pelanggan</p>
                    </div>
                </td></tr>
            <?php else: ?>
                <?php $no = 1; foreach($items as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style="color:var(--text-main); font-weight:500;"><?= $item['Nama_Lengkap'] ?></td>
                    <td><?= $item['No_Telepon'] ?></td>
                    <td>
                        <div class="action-group">
                            <a href="/pelanggan/edit/<?= $item['ID_Pelanggan'] ?>" class="btn btn-secondary btn-sm"><i class='bx bx-edit'></i> Edit</a>
                            <a href="/pelanggan/delete/<?= $item['ID_Pelanggan'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class='bx bx-trash'></i> Hapus</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(!empty($items)): ?>
    <div class="data-counter">Menampilkan <strong><?= count($items) ?></strong> data pelanggan</div>
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