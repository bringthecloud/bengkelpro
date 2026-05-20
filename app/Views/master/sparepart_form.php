<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="form-container" style="max-width:700px;">
    <h3 class="section-title" style="margin-bottom:24px;">
        <i class='bx bx-box'></i> <?= isset($item) ? 'Edit Sparepart' : 'Tambah Sparepart Baru' ?>
    </h3>

    <form action="<?= isset($item) ? '/sparepart/update/'.$item['ID_Sparepart'] : '/sparepart/create' ?>" method="post">
        <div class="form-group">
            <label>Nama Barang</label>
            <div class="input-icon-group">
                <i class='bx bx-package'></i>
                <input type="text" name="Nama_Barang" value="<?= isset($item) ? $item['Nama_Barang'] : '' ?>" placeholder="Contoh: Oli Mesin, Kampas Rem" required>
            </div>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label>Harga Jual (Rp)</label>
                <div class="input-icon-group">
                    <i class='bx bx-money'></i>
                    <input type="number" name="Harga_Jual" value="<?= isset($item) ? $item['Harga_Jual'] : '' ?>" placeholder="Contoh: 75000" required>
                </div>
            </div>
            <div class="form-group">
                <label>Harga Beli (Rp)</label>
                <div class="input-icon-group">
                    <i class='bx bx-money'></i>
                    <input type="number" name="Harga_Beli" value="<?= isset($item) ? $item['Harga_Beli'] : '' ?>" placeholder="Contoh: 50000" required>
                </div>
            </div>
            <div class="form-group">
                <label>Stok</label>
                <div class="input-icon-group">
                    <i class='bx bx-layer'></i>
                    <input type="number" name="Stok_Barang" value="<?= isset($item) ? $item['Stok_Barang'] : '' ?>" placeholder="Contoh: 50" required>
                </div>
            </div>
            <div class="form-group">
                <label>Satuan</label>
                <div class="input-icon-group">
                    <i class='bx bx-unite'></i>
                    <input type="text" name="Satuan" value="<?= isset($item) ? $item['Satuan'] : '' ?>" placeholder="Contoh: pcs, liter, set">
                </div>
            </div>
        </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class='bx bx-check'></i> Simpan</button>
            <a href="/sparepart" class="btn btn-secondary"><i class='bx bx-x'></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
