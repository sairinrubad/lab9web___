<?php
/**
 * helpers.php - kumpulan function Praktikum 9 (bagian E)
 */

function formatRupiah(float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

function e(string $nilai): string {
    return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
}

// ---- Latihan function ----

/** 1. Konversi Celcius ke Fahrenheit: F = (C x 9/5) + 32 */
function konversiCelciusKeFahrenheit(float $c): float {
    return ($c * 9 / 5) + 32;
}

/** 2. Predikat nilai: A >= 85, B >= 70, C >= 55, D >= 40, selain itu E */
function tentukanStatusNilai(float $nilai): string {
    if ($nilai >= 85) {
        return 'A (Sangat Baik)';
    } elseif ($nilai >= 70) {
        return 'B (Baik)';
    } elseif ($nilai >= 55) {
        return 'C (Cukup)';
    } elseif ($nilai >= 40) {
        return 'D (Kurang)';
    }
    return 'E (Gagal)';
}

/** 3. Total belanja = harga x jumlah */
function hitungTotal(float $harga, int $jumlah): float {
    return $harga * $jumlah;
}
