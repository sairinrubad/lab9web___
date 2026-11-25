<?php
/**
 * index.php - Router (Latihan 3)
 * Semua halaman diakses melalui index.php?page=<nama-rute>
 */
require_once __DIR__ . '/helpers/functions.php';

// Whitelist rute: HANYA kunci di array ini yang boleh dimuat.
$routes = [
    'home'         => ['file' => __DIR__ . '/views/home.php',    'judul' => 'Home'],
    'profil'       => ['file' => __DIR__ . '/views/profil.php',  'judul' => 'Profil'],
    'produk'       => ['file' => __DIR__ . '/views/produk.php',  'judul' => 'Produk'],
    'artikel'      => ['file' => __DIR__ . '/views/artikel.php', 'judul' => 'Artikel'],
    'kontak'       => ['file' => __DIR__ . '/views/kontak.php',  'judul' => 'Kontak'],
    'info/tentang' => ['file' => __DIR__ . '/views/tentang.php', 'judul' => 'Tentang'],
];

$page = $_GET['page'] ?? 'home';

// Validasi: harus string DAN terdaftar di whitelist.
if (!is_string($page) || !array_key_exists($page, $routes)) {
    http_response_code(404);
    $page        = '404';
    $judul       = '404 - Tidak ditemukan';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $judul       = $routes[$page]['judul'];
    $contentFile = $routes[$page]['file'];   // path dari array, BUKAN dari input URL
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
