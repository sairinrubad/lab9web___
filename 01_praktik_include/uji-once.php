<?php
// Perbandingan include vs include_once / require vs require_once
echo "<h3>include (2x) -> dimuat dua kali</h3>";
include __DIR__ . '/pesan.php';
include __DIR__ . '/pesan.php';

echo "<h3>require_once (2x) -> hanya dimuat satu kali</h3>";
require_once __DIR__ . '/pesan.php';
require_once __DIR__ . '/pesan.php';
