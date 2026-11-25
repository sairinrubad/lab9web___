<?php
// modules/user/list.php - READ: daftar pengguna (+ pencarian sederhana)
$q = isset($_GET['q']) && is_string($_GET['q']) ? trim($_GET['q']) : '';

if ($q !== '') {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE nama LIKE :q OR email LIKE :q ORDER BY id DESC');
    $stmt->execute([':q' => '%' . $q . '%']);
} else {
    $stmt = $pdo->query('SELECT * FROM users ORDER BY id DESC');
}
$users = $stmt->fetchAll();
?>
<section>
    <h2>Data Pengguna</h2>

    <div class="toolbar">
        <form method="get" action="<?php echo e(base_path() . '/index.php'); ?>" class="search">
            <input type="hidden" name="page" value="user/list">
            <input type="text" name="q" placeholder="Cari nama atau email..." value="<?php echo e($q); ?>">
            <button type="submit">Cari</button>
        </form>
        <a class="btn" href="<?php echo e(url('user/add')); ?>">+ Tambah Pengguna</a>
    </div>

    <?php if (!$users): ?>
        <p>Data pengguna tidak ditemukan.</p>
    <?php else: ?>
    <table>
        <thead>
            <tr><th>#</th><th>Nama</th><th>Email</th><th>No. HP</th><th>Dibuat</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        <?php foreach ($users as $i => $u): ?>
            <tr>
                <td><?php echo $i + 1; ?></td>
                <td><?php echo e($u['nama']); ?></td>
                <td><?php echo e($u['email']); ?></td>
                <td><?php echo e($u['no_hp'] ?? '-'); ?></td>
                <td><?php echo e(formatTanggal($u['created_at'])); ?></td>
                <td class="aksi">
                    <a class="btn-sm" href="<?php echo e(url('user/edit', ['id' => $u['id']])); ?>">Ubah</a>
                    <form method="post" action="<?php echo e(url('user/delete')); ?>" class="inline"
                          data-confirm="Hapus pengguna <?php echo e($u['nama']); ?>?">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo (int)$u['id']; ?>">
                        <button type="submit" class="btn-sm danger">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p class="muted">Total: <?php echo count($users); ?> pengguna</p>
    <?php endif; ?>
</section>
