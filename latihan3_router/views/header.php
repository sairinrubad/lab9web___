<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($judul); ?> - Latihan 3 Router</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Latihan 3 - Router Aman</h1>
        <p>Whitelist rute &bull; halaman 404 &bull; Sairin bin Rubad (312510134)</p>
    </header>
    <nav>
        <?php
        $menu = ['home' => 'Home', 'profil' => 'Profil', 'produk' => 'Produk',
                 'artikel' => 'Artikel', 'kontak' => 'Kontak', 'info/tentang' => 'Tentang'];
        foreach ($menu as $kunci => $label): ?>
            <a href="<?php echo e(rute($kunci)); ?>" class="<?php echo $page === $kunci ? 'active' : ''; ?>"><?php echo e($label); ?></a>
        <?php endforeach; ?>
    </nav>
    <main>
