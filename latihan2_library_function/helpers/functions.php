<?php
/**
 * helpers/functions.php - Library function Latihan 2
 * Dimuat dengan require_once agar tidak terdeklarasi dua kali.
 */

/** Escape output agar aman ditampilkan di HTML. */
function e($nilai): string {
    return htmlspecialchars((string)$nilai, ENT_QUOTES, 'UTF-8');
}

/** Mengubah angka menjadi format rupiah, mis. 150000 -> "Rp 150.000". */
function formatRupiah(float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

/**
 * Menghitung NILAI diskon (bukan harga akhir).
 * @param float $harga  harga awal
 * @param float $persen persentase diskon (default 10)
 */
function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

/** Memeriksa format email. Mengembalikan true jika valid. */
function validasiEmail(string $email): bool {
    return filter_var(trim($email), FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Meringkas teks panjang menjadi $batas karakter lalu menambahkan "...".
 * Memakai mb_* agar aman untuk teks UTF-8.
 */
function ringkasTeks(string $teks, int $batas = 80): string {
    $teks = trim(preg_replace('/\s+/', ' ', $teks));
    if (mb_strlen($teks, 'UTF-8') <= $batas) {
        return $teks;
    }
    $potong = mb_substr($teks, 0, $batas, 'UTF-8');
    // jangan memotong di tengah kata
    $spasi = mb_strrpos($potong, ' ', 0, 'UTF-8');
    if ($spasi !== false && $spasi > $batas * 0.6) {
        $potong = mb_substr($potong, 0, $spasi, 'UTF-8');
    }
    return rtrim($potong, " ,.;:") . '...';
}
