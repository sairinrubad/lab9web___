<?php
/**
 * index.php - titik masuk aplikasi sekaligus ROUTER.
 * Akses halaman melalui: index.php?page=<rute>
 */
ob_start();            // buffer keluaran agar redirect (header Location) tetap bisa dikirim
session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/helpers/functions.php';

// Whitelist rute. 'auth' => true berarti harus login terlebih dahulu.
$routes = [
    'dashboard'   => ['file' => __DIR__ . '/views/dashboard.php',      'judul' => 'Dashboard',        'auth' => true],
    'user/list'   => ['file' => __DIR__ . '/modules/user/list.php',    'judul' => 'Data Pengguna',    'auth' => true],
    'user/add'    => ['file' => __DIR__ . '/modules/user/add.php',     'judul' => 'Tambah Pengguna',  'auth' => true],
    'user/edit'   => ['file' => __DIR__ . '/modules/user/edit.php',    'judul' => 'Ubah Pengguna',    'auth' => true],
    'user/delete' => ['file' => __DIR__ . '/modules/user/delete.php',  'judul' => 'Hapus Pengguna',   'auth' => true],
    'auth/login'  => ['file' => __DIR__ . '/modules/auth/login.php',   'judul' => 'Login',            'auth' => false],
    'auth/logout' => ['file' => __DIR__ . '/modules/auth/logout.php',  'judul' => 'Logout',           'auth' => false],
];

$page = $_GET['page'] ?? 'dashboard';

if (!is_string($page) || !array_key_exists($page, $routes)) {
    // parameter kosong, bertipe array, atau tidak terdaftar -> 404
    http_response_code(404);
    $page        = '404';
    $judul       = '404 - Halaman tidak ditemukan';
    $contentFile = __DIR__ . '/views/404.php';
} else {
    $route = $routes[$page];

    // Pembatasan akses: halaman tertentu hanya untuk pengguna yang sudah login
    if ($route['auth'] && !is_logged_in()) {
        flash_set('error', 'Silakan login terlebih dahulu.');
        redirect('auth/login');
    }
    $judul       = $route['judul'];
    $contentFile = $route['file'];     // path berasal dari whitelist, bukan dari input URL
}

require_once __DIR__ . '/views/header.php';
require $contentFile;
require_once __DIR__ . '/views/footer.php';
ob_end_flush();
