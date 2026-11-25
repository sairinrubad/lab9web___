<?php
// modules/user/delete.php - DELETE
// Hanya diproses lewat POST + token CSRF. Membuka URL (GET) tidak menghapus data.
if (!is_post()) {
    flash_set('error', 'Penghapusan hanya dapat dilakukan melalui tombol Hapus.');
    redirect('user/list');
}
if (!csrf_valid($_POST['csrf_token'] ?? null)) {
    flash_set('error', 'Token keamanan tidak valid. Penghapusan dibatalkan.');
    redirect('user/list');
}

$id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
if ($id === false || $id === null) {
    flash_set('error', 'ID pengguna tidak valid.');
    redirect('user/list');
}

$stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
$stmt->execute([':id' => $id]);

if ($stmt->rowCount() > 0) {
    flash_set('success', 'Pengguna berhasil dihapus.');
} else {
    flash_set('error', 'Pengguna tidak ditemukan.');
}
redirect('user/list');
