<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="form-container" style="max-width:700px;">
    <h3 class="section-title" style="margin-bottom:24px;">
        <i class='bx bxs-group'></i> <?= isset($item) ? 'Edit Karyawan' : 'Tambah Karyawan Baru' ?>
    </h3>

    <form action="<?= isset($item) ? '/karyawan/update/'.$item['ID_User'] : '/karyawan/create' ?>" method="post">
        <div class="form-group">
            <label>Nama Lengkap</label>
            <div class="input-icon-group">
                <i class='bx bx-user'></i>
                <input type="text" name="nama" value="<?= isset($item) ? $item['nama'] : '' ?>" placeholder="Nama lengkap karyawan" required>
            </div>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label>Username</label>
                <div class="input-icon-group">
                    <i class='bx bx-at'></i>
                    <input type="text" name="username" value="<?= isset($item) ? $item['username'] : '' ?>" placeholder="Username untuk login" required <?= (isset($item) && $item['username'] === 'admin') ? 'readonly' : '' ?>>
                </div>
            </div>
            <div class="form-group">
                <label><?= isset($item) ? 'Password Baru (kosongkan jika tidak diubah)' : 'Password' ?></label>
                <div class="input-icon-group">
                    <i class='bx bx-lock'></i>
                    <input type="password" name="password" placeholder="Masukkan password" <?= isset($item) ? '' : 'required' ?>>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>Role</label>
            <div class="input-icon-group">
                <i class='bx bx-shield'></i>
                <select name="role" required <?= (isset($item) && $item['username'] === 'admin') ? 'disabled' : '' ?>>
                    <option value="kasir" <?= (isset($item) && $item['role'] === 'kasir') ? 'selected' : '' ?>>Kasir</option>
                    <option value="admin" <?= (isset($item) && $item['role'] === 'admin') ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>
            <?php if(isset($item) && $item['username'] === 'admin'): ?>
                <input type="hidden" name="role" value="admin">
            <?php endif; ?>
        </div>

        <div style="display:flex; gap:12px; margin-top:8px;">
            <button type="submit" class="btn btn-primary"><i class='bx bx-check'></i> Simpan</button>
            <a href="/karyawan" class="btn btn-secondary"><i class='bx bx-x'></i> Batal</a>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
