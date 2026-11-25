<?php
// modules/auth/logout.php - logout hanya lewat POST + CSRF
if (!is_post() || !csrf_valid($_POST['csrf_token'] ?? null)) {
    redirect(is_logged_in() ? 'dashboard' : 'auth/login');
}

$_SESSION = [];
session_regenerate_id(true);
flash_set('success', 'Anda telah logout.');
redirect('auth/login');
