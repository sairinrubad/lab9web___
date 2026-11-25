<?php
require_once __DIR__ . '/helpers/functions.php';

$produk = [
    ['nama' => 'Laptop Pelajar 14"', 'harga' => 7500000, 'diskon' => 10,
     'deskripsi' => 'Laptop ringan dengan baterai tahan seharian, cocok untuk mahasiswa yang sering berpindah antara kampus, perpustakaan, dan rumah.'],
    ['nama' => 'Mouse Wireless', 'harga' => 150000, 'diskon' => 15,
     'deskripsi' => 'Mouse nirkabel dengan sensor presisi dan penerima USB kecil yang mudah dibawa ke mana saja.'],
    ['nama' => 'Keyboard Mekanik', 'harga' => 650000, 'diskon' => 20,
     'deskripsi' => 'Keyboard mekanik dengan switch tactile, lampu latar, dan kabel yang dapat dilepas untuk memudahkan perjalanan.'],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latihan 2 - Daftar Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Daftar Produk</h1>
    <p class="sub">Menggunakan <code>formatRupiah()</code>, <code>hitungDiskon()</code>, dan <code>ringkasTeks()</code> dari <code>helpers/functions.php</code></p>
    <nav><a href="produk.php" class="active">Produk</a> <a href="pendaftaran.php">Pendaftaran</a></nav>
    <table>
        <thead><tr><th>Produk</th><th>Deskripsi (ringkas)</th><th>Harga</th><th>Diskon</th><th>Harga Akhir</th></tr></thead>
        <tbody>
        <?php foreach ($produk as $p):
            $potongan = hitungDiskon($p['harga'], $p['diskon']);
            $akhir    = $p['harga'] - $potongan;
        ?>
            <tr>
                <td><?php echo e($p['nama']); ?></td>
                <td><?php echo e(ringkasTeks($p['deskripsi'], 60)); ?></td>
                <td><?php echo formatRupiah($p['harga']); ?></td>
                <td><?php echo e($p['diskon']); ?>% (<?php echo formatRupiah($potongan); ?>)</td>
                <td><strong><?php echo formatRupiah($akhir); ?></strong></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
