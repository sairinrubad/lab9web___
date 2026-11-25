<?php
// $judul dan $menuAktif diisi oleh masing-masing halaman sebelum header dipanggil
$judul     = $judul ?? 'Latihan 1';
$menuAktif = $menuAktif ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($judul, ENT_QUOTES, 'UTF-8'); ?> - Latihan 1 Template</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>Latihan 1 - Template Multi-Halaman</h1>
        <p>Praktikum 9 Pemrograman Web &bull; Sairin bin Rubad (312510134)</p>
    </header>
    <nav>
        <a href="home.php"   class="<?php echo $menuAktif === 'home'   ? 'active' : ''; ?>">Home</a>
        <a href="profil.php" class="<?php echo $menuAktif === 'profil' ? 'active' : ''; ?>">Profil</a>
        <a href="kontak.php" class="<?php echo $menuAktif === 'kontak' ? 'active' : ''; ?>">Kontak</a>
    </nav>
    <main>
