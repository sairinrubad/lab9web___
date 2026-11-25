<?php
/**
 * helpers/functions.php - function umum yang dipakai banyak modul.
 */

/* ---------- Tampilan & URL ---------- */

/** Escape output HTML. */
function e($nilai): string {
    return htmlspecialchars((string)$nilai, ENT_QUOTES, 'UTF-8');
}

/** Folder dasar aplikasi (mis. "/project"), aman untuk URL rewrite. */
function base_path(): string {
    $dir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    return ($dir === '/' || $dir === '.') ? '' : rtrim($dir, '/');
}

/** URL ke sebuah rute: url('user/edit', ['id' => 3]) */
function url(string $page = 'dashboard', array $params = []): string {
    $query = array_merge(['page' => $page], $params);
    return base_path() . '/index.php?' . http_build_query($query);
}

/** URL aset statis: asset('css/style.css') */
function asset(string $path): string {
    return base_path() . '/assets/' . ltrim($path, '/');
}

function redirect(string $page, array $params = []): void {
    header('Location: ' . url($page, $params));
    exit;
}

/** Menu aktif berdasarkan rute yang sedang dibuka. */
function is_active(string $page, string $current): string {
    return $page === $current ? 'active' : '';
}

/* ---------- Format & validasi ---------- */

function formatRupiah(float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

function validasiEmail(string $email): bool {
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL) !== false;
}

function ringkasTeks(string $teks, int $batas = 80): string {
    $teks = trim((string)preg_replace('/\s+/', ' ', $teks));
    if (mb_strlen($teks, 'UTF-8') <= $batas) {
        return $teks;
    }
    return rtrim(mb_substr($teks, 0, $batas, 'UTF-8'), " ,.;:") . '...';
}

function formatTanggal(?string $tanggal): string {
    if (!$tanggal) {
        return '-';
    }
    $ts = strtotime($tanggal);
    return $ts ? date('d-m-Y H:i', $ts) : '-';
}

/* ---------- Pesan flash (sukses / gagal) ---------- */

function flash_set(string $tipe, string $pesan): void {
    $_SESSION['flash'] = ['tipe' => $tipe, 'pesan' => $pesan];
}

/** Mengambil lalu menghapus pesan flash. */
function flash_get(): ?array {
    if (!isset($_SESSION['flash'])) {
        return null;
    }
    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);
    return $flash;
}

/* ---------- CSRF ---------- */

function csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string {
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_valid(?string $token): bool {
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

/* ---------- Autentikasi ---------- */

function is_logged_in(): bool {
    return !empty($_SESSION['admin_id']);
}

function is_post(): bool {
    return ($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST';
}
