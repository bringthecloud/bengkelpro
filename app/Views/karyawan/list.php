<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="section-title"><i class='bx bxs-group'></i> Data Karyawan</h3>
    <a href="/karyawan/new" class="btn btn-primary"><i class='bx bx-plus'></i> Tambah Karyawan</a>
</div>

<div class="search-bar" style="margin-bottom:20px;">
    <i class='bx bx-search'></i>
    <input type="text" id="searchInput" placeholder="Cari karyawan..." onkeyup="filterTable()">
</div>

<div class="table-container">
    <table id="dataTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($items)): ?>
                <tr class="empty-row"><td colspan="5">
                    <div class="empty-state">
                        <i class='bx bxs-group'></i>
                        <p>Belum ada data karyawan</p>
                    </div>
                </td></tr>
            <?php else: ?>
                <?php $no = 1; foreach($items as $item): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td style="color:var(--text-main); font-weight:500;"><?= esc($item['nama']) ?></td>
                    <td><?= esc($item['username']) ?></td>
                    <td>
                        <span class="badge <?= $item['role'] === 'admin' ? 'badge-danger' : 'badge-success' ?>">
                            <?= ucfirst($item['role']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="/karyawan/edit/<?= $item['ID_User'] ?>" class="btn btn-secondary btn-sm"><i class='bx bx-edit'></i> Edit</a>
                            <?php if($item['username'] !== 'admin'): ?>
                                <a href="/karyawan/delete/<?= $item['ID_User'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')"><i class='bx bx-trash'></i> Hapus</a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
    <?php if(!empty($items)): ?>
    <div class="data-counter">Menampilkan <strong><?= count($items) ?></strong> karyawan</div>
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
