<?php
$total  = (int)$pdo->query('SELECT COUNT(*) FROM users')->fetchColumn();
$terbaru = $pdo->query('SELECT id, nama, email, created_at FROM users ORDER BY id DESC LIMIT 5')->fetchAll();
?>
<section>
    <h2>Dashboard</h2>
    <div class="cards">
        <div class="card">
            <span class="angka"><?php echo $total; ?></span>
            <span class="label">Total Pengguna</span>
        </div>
    </div>
    <h3>Pengguna Terbaru</h3>
    <?php if (!$terbaru): ?>
        <p>Belum ada data pengguna.</p>
    <?php else: ?>
    <table>
        <thead><tr><th>Nama</th><th>Email</th><th>Dibuat</th></tr></thead>
        <tbody>
        <?php foreach ($terbaru as $u): ?>
            <tr>
                <td><?php echo e($u['nama']); ?></td>
                <td><?php echo e($u['email']); ?></td>
                <td><?php echo e(formatTanggal($u['created_at'])); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>
    <p><a class="btn" href="<?php echo e(url('user/list')); ?>">Kelola Pengguna</a></p>
</section>
