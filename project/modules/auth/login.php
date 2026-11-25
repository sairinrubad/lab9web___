<?php
// modules/auth/login.php
if (is_logged_in()) {
    redirect('dashboard');
}

$error = null;
$username = '';

if (is_post()) {
    $username = trim((string)($_POST['username'] ?? ''));
    $password = (string)($_POST['password'] ?? '');

    if (!csrf_valid($_POST['csrf_token'] ?? null)) {
        $error = 'Token keamanan tidak valid. Muat ulang halaman lalu coba lagi.';
    } elseif ($username === '' || $password === '') {
        $error = 'Username dan password wajib diisi.';
    } else {
        $stmt = $pdo->prepare('SELECT id, nama, password FROM admin WHERE username = :u');
        $stmt->execute([':u' => $username]);
        $admin = $stmt->fetch();

        if ($admin && password_verify($password, $admin['password'])) {
            session_regenerate_id(true);          // cegah session fixation
            $_SESSION['admin_id']   = (int)$admin['id'];
            $_SESSION['admin_nama'] = $admin['nama'];
            flash_set('success', 'Login berhasil. Selamat datang, ' . $admin['nama'] . '!');
            redirect('dashboard');
        }
        // pesan sengaja dibuat umum agar tidak membocorkan username mana yang ada
        $error = 'Username atau password salah.';
    }
}
?>
<section class="login-box">
    <h2>Login</h2>
    <?php if ($error): ?><div class="alert error"><?php echo e($error); ?></div><?php endif; ?>
    <form method="post" action="">
        <?php echo csrf_field(); ?>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="<?php echo e($username); ?>" required autofocus>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>

        <div class="form-actions"><button type="submit">Masuk</button></div>
    </form>
    <p class="muted">Akun contoh: <code>admin</code> / <code>admin123</code></p>
</section>
