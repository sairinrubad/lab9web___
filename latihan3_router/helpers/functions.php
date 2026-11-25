<?php
function e($nilai): string {
    return htmlspecialchars((string)$nilai, ENT_QUOTES, 'UTF-8');
}

/** Membuat URL ke rute tertentu, mis. rute('profil') -> index.php?page=profil */
function rute(string $page): string {
    return 'index.php?page=' . rawurlencode($page);
}
