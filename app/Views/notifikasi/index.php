<?= $this->extend('layout/header') ?>
<?= $this->section('content') ?>

<div class="page-header">
    <h3 class="section-title"><i class='bx bx-bell'></i> Notifikasi</h3>
    <?php if(!empty($items)): ?>
        <a href="/notifikasi/clear" class="btn btn-danger btn-sm" onclick="return confirm('Hapus semua notifikasi?')"><i class='bx bx-trash'></i> Hapus Semua</a>
    <?php endif; ?>
</div>

<div class="notif-list">
    <?php if(empty($items)): ?>
        <div class="empty-state" style="padding:48px 24px;">
            <i class='bx bx-bell-off' style="font-size:48px; color:var(--text-muted);"></i>
            <p style="margin-top:12px;">Belum ada notifikasi</p>
        </div>
    <?php else: ?>
        <?php foreach($items as $item): ?>
            <div class="notif-item <?= $item['is_read'] ? '' : 'unread' ?>">
                <div class="notif-icon-wrap notif-<?= $item['tipe'] ?>">
                    <i class='bx <?= $item['icon'] ?>'></i>
                </div>
                <div class="notif-content">
                    <p class="notif-message"><?= esc($item['pesan']) ?></p>
                    <span class="notif-time"><i class='bx bx-time-five'></i> <?= date('d M Y, H:i', strtotime($item['created_at'])) ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>
