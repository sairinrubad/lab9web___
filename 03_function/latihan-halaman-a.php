<?php require_once __DIR__ . '/helpers.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head><meta charset="UTF-8"><title>Latihan Function - Halaman A</title>
<link rel="stylesheet" href="../02_template/style.css"></head>
<body>
<div class="container">
    <h2>Halaman A - Konversi Suhu &amp; Predikat Nilai</h2>
    <?php $suhu = 36.5; $nilai = 78; ?>
    <p>Suhu <?php echo e((string)$suhu); ?> &deg;C = <strong><?php echo konversiCelciusKeFahrenheit($suhu); ?> &deg;F</strong></p>
    <p>Nilai <?php echo e((string)$nilai); ?> mendapat predikat <strong><?php echo e(tentukanStatusNilai($nilai)); ?></strong></p>
    <p><a href="latihan-halaman-b.php">Ke Halaman B &raquo;</a></p>
</div>
</body>
</html>
