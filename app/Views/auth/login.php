<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="login-wrapper">
    <div class="login-card">
        <div class="login-brand"><i class='bx bxs-cog' style="color:var(--primary-red); font-size:32px;"></i> Bengkel<span>Pro</span></div>
        <p class="login-subtitle">Masuk ke dashboard sistem bengkel</p>

        <?php if(session()->getFlashdata('error')): ?>
            <div class="login-error">
                <i class='bx bx-error-circle'></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/auth/login" method="post">
            <div class="form-group">
                <div class="input-icon-group">
                    <i class='bx bx-user'></i>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-icon-group">
                    <i class='bx bx-lock-alt'></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; padding:14px; margin-top:8px; justify-content:center;">
                <i class='bx bx-log-in'></i> MASUK
            </button>
        </form>
        <a href="/" class="back-to-landing">
            <i class='bx bx-arrow-back'></i> Kembali ke Beranda
        </a>
    </div>
</div>

<?= $this->endSection() ?>