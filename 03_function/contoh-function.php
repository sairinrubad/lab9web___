<?php
// 1. Function tanpa parameter
function tampilkanSalam() {
    echo "Selamat belajar PHP modular!";
}

// 2. Function dengan parameter
function sapaPengguna($nama) {
    echo "Halo, " . htmlspecialchars($nama, ENT_QUOTES, 'UTF-8');
}

// 3. Function dengan return
function hitungLuasPersegiPanjang($panjang, $lebar) {
    return $panjang * $lebar;
}

// 4. Type declaration dan nilai default
function hitungDiskon(float $harga, float $persen = 10): float {
    return $harga * ($persen / 100);
}

echo "<h3>1. Tanpa parameter</h3>";
tampilkanSalam();

echo "<h3>2. Dengan parameter</h3>";
sapaPengguna("Rina");

echo "<h3>3. Dengan return</h3>";
$luas = hitungLuasPersegiPanjang(8, 5);
echo "Luas: " . $luas;

echo "<h3>4. Type declaration & nilai default</h3>";
echo "Diskon 10% dari 200000 = " . hitungDiskon(200000) . "<br>";
echo "Diskon 15% dari 200000 = " . hitungDiskon(200000, 15);
