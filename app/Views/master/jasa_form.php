<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="form-container">
    <h3 class="section-title" style="margin-bottom:24px;">
        <i class='bx bx-wrench'></i> <?= isset($item) ? 'Edit Jasa' : 'Tambah Jasa Baru' ?>
    </h3>

    <form action="<?= isset($item) ? '/jasa/update/'.$item['ID_Jasa'] : '/jasa/create' ?>" method="post">
        <div class="form-group">
            <label>Nama Jasa</label>
            <div class="input-icon-group">
                <i class='bx bx-wrench'></i>
                <input type="text" name="Nama_Jasa" value="<?= isset($item) ? $item['Nama_Jasa'] : '' ?>" placeholder="Contoh: Ganti Oli, Tune Up" required>
            </div>
        </div>
        <div class="form-group">
            <label>Harga Satuan (Rp)</label>
            <div class="input-icon-group">
                <i class='bx bx-money'></i>
                <input type="number" name="Harga_Satuan" value="<?= isset($item) ? $item['Harga_Satuan'] : '' ?>" placeholder="Contoh: 50000" required>
            </div>
        </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class='bx bx-check'></i> Simpan</button>
            <a href="/jasa" class="btn btn-secondary"><i class='bx bx-x'></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
