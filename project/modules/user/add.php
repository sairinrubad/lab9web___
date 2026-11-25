<?php
// modules/user/add.php - CREATE
$errors = [];
$nama = $email = $no_hp = '';

if (is_post()) {
    if (!csrf_valid($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Token keamanan tidak valid. Muat ulang halaman lalu coba lagi.';
    } else {
        $nama  = trim((string)($_POST['nama'] ?? ''));
        $email = trim((string)($_POST['email'] ?? ''));
        $no_hp = trim((string)($_POST['no_hp'] ?? ''));

        if ($nama === '' || mb_strlen($nama) > 100) {
            $errors[] = 'Nama wajib diisi (maksimal 100 karakter).';
        }
        if (!validasiEmail($email) || mb_strlen($email) > 150) {
            $errors[] = 'Format email tidak valid.';
        }
        if ($no_hp !== '' && !preg_match('/^[0-9+]{8,20}$/', $no_hp)) {
            $errors[] = 'No. HP hanya boleh berisi angka (8-20 digit).';
        }

        if (!$errors) {
            $cek = $pdo->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
            $cek->execute([':email' => $email]);
            if ((int)$cek->fetchColumn() > 0) {
                $errors[] = 'Email sudah terdaftar.';
            }
        }

        if (!$errors) {
            $stmt = $pdo->prepare('INSERT INTO users (nama, email, no_hp) VALUES (:nama, :email, :no_hp)');
            $stmt->execute([
                ':nama'  => $nama,
                ':email' => $email,
                ':no_hp' => $no_hp !== '' ? $no_hp : null,
            ]);
            flash_set('success', 'Pengguna "' . $nama . '" berhasil ditambahkan.');
            redirect('user/list');
        }
    }
}
?>
<section>
    <h2>Tambah Pengguna</h2>

    <?php if ($errors): ?>
        <div class="alert error">
            <ul><?php foreach ($errors as $err): ?><li><?php echo e($err); ?></li><?php endforeach; ?></ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <?php echo csrf_field(); ?>
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo e($nama); ?>" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo e($email); ?>" required>

        <label for="no_hp">No. HP (opsional)</label>
        <input type="text" id="no_hp" name="no_hp" value="<?php echo e($no_hp); ?>">

        <div class="form-actions">
            <button type="submit">Simpan</button>
            <a class="btn-cancel" href="<?php echo e(url('user/list')); ?>">Batal</a>
        </div>
    </form>
</section>
