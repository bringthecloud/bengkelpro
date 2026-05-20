<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="form-container">
    <h3 class="section-title" style="margin-bottom:24px;">
        <i class='bx bx-user-plus'></i> <?= isset($item) ? 'Edit Pelanggan' : 'Tambah Pelanggan Baru' ?>
    </h3>

    <form action="<?= isset($item) ? '/pelanggan/update/'.$item['ID_Pelanggan'] : '/pelanggan/create' ?>" method="post">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="input-icon-group">
                <i class='bx bx-user'></i>
                <input type="text" name="Nama_Lengkap" value="<?= isset($item) ? $item['Nama_Lengkap'] : '' ?>" placeholder="Masukkan nama lengkap" required>
            </div>
        </div>
        <div class="form-group">
            <label>No Telepon</label>
            <div class="input-icon-group">
                <i class='bx bx-phone'></i>
                <input type="text" name="No_Telepon" value="<?= isset($item) ? $item['No_Telepon'] : '' ?>" placeholder="Masukkan no telepon" required>
            </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class='bx bx-check'></i> Simpan</button>
            <a href="/pelanggan" class="btn btn-secondary"><i class='bx bx-x'></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>