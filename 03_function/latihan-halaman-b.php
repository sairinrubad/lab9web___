<?php require_once __DIR__ . '/helpers.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Latihan Function - Halaman B</title>
<link rel="stylesheet" href="../02_template/style.css"></head>
<body>
<div class="container">
    <h2>Halaman B - Total Belanja</h2>
    <?php
    $harga  = 25000;
    $jumlah = 4;
    $total  = hitungTotal($harga, $jumlah);
    ?>
    <p>Harga satuan : <?php echo formatRupiah($harga); ?></p>
    <p>Jumlah       : <?php echo $jumlah; ?></p>
    <p>Total belanja: <strong><?php echo formatRupiah($total); ?></strong></p>
    <p>Predikat nilai 92 = <strong><?php echo e(tentukanStatusNilai(92)); ?></strong></p>
    <p><a href="latihan-halaman-a.php">&laquo; Ke Halaman A</a></p>
</div>
</body>
</html>
