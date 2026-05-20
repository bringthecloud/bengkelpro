<?= $this->extend('layout/header') ?>

<?= $this->section('content') ?>

<div class="form-container" style="max-width:700px;">
    <h3 class="section-title" style="margin-bottom:24px;">
        <i class='bx bx-car'></i> <?= isset($item) ? 'Edit Kendaraan' : 'Tambah Kendaraan Baru' ?>
    </h3>

    <form action="<?= isset($item) ? '/kendaraan/update/'.$item['ID_Kendaraan'] : '/kendaraan/create' ?>" method="post">
        <div class="form-group">
            <label>Pemilik (Pelanggan)</label>
            <div class="input-icon-group">
                <i class='bx bx-user'></i>
                <select name="ID_Pelanggan" required>
                    <option value="">-- Pilih Pelanggan --</option>
                    <?php foreach($pelanggan as $p): ?>
                        <option value="<?= $p['ID_Pelanggan'] ?>" <?= isset($item) && $item['ID_Pelanggan'] == $p['ID_Pelanggan'] ? 'selected' : '' ?>><?= $p['Nama_Lengkap'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label>No. Polisi</label>
                <div class="input-icon-group">
                    <i class='bx bx-id-card'></i>
                    <input type="text" name="No_Polisi" value="<?= isset($item) ? $item['No_Polisi'] : '' ?>" placeholder="Contoh: B 1234 XYZ" required>
                </div>
            </div>
            <div class="form-group">
                <label>Merk</label>
                <div class="input-icon-group">
                    <i class='bx bx-car'></i>
                    <input type="text" name="Merk" value="<?= isset($item) ? $item['Merk'] : '' ?>" placeholder="Contoh: Honda, Yamaha" required>
                </div>
            </div>
            <div class="form-group">
                <label>Tipe</label>
                <div class="input-icon-group">
                    <i class='bx bx-customize'></i>
                    <input type="text" name="Tipe" value="<?= isset($item) ? $item['Tipe'] : '' ?>" placeholder="Contoh: Vario 150">
                </div>
        </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class='bx bx-check'></i> Simpan</button>
            <a href="/kendaraan" class="btn btn-secondary"><i class='bx bx-x'></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
