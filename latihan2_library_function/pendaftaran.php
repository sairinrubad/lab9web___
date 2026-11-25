<?php
require_once __DIR__ . '/helpers/functions.php';

$nama = $email = '';
$error = null;
$sukses = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim((string)($_POST['nama'] ?? ''));
    $email = trim((string)($_POST['email'] ?? ''));

    if ($nama === '') {
        $error = 'Nama wajib diisi.';
    } elseif (!validasiEmail($email)) {
        $error = 'Format email tidak valid.';
    } else {
        $sukses = true;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latihan 2 - Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Form Pendaftaran</h1>
    <p class="sub">Menggunakan <code>validasiEmail()</code> dan <code>e()</code> dari <code>helpers/functions.php</code></p>
    <nav><a href="produk.php">Produk</a> <a href="pendaftaran.php" class="active">Pendaftaran</a></nav>

    <?php if ($error): ?><div class="alert error"><?php echo e($error); ?></div><?php endif; ?>
    <?php if ($sukses): ?><div class="alert success">Pendaftaran berhasil untuk <strong><?php echo e($nama); ?></strong> (<?php echo e($email); ?>).</div><?php endif; ?>

    <form method="post" action="pendaftaran.php">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="<?php echo e($nama); ?>">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo e($email); ?>">
        <button type="submit">Daftar</button>
    </form>
</div>
</body>
</html>
