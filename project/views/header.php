<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e($judul); ?> - Aplikasi Data Pengguna</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="container">
    <header>
        <h1>Aplikasi Data Pengguna</h1>
        <p>Praktikum 9 - PHP Modular &bull; Sairin bin Rubad (312510134)</p>
    </header>
    <nav>
        <?php if (is_logged_in()): ?>
            <a href="<?php echo e(url('dashboard')); ?>"   class="<?php echo is_active('dashboard', $page); ?>">Dashboard</a>
            <a href="<?php echo e(url('user/list')); ?>"   class="<?php echo is_active('user/list', $page); ?>">Data Pengguna</a>
            <a href="<?php echo e(url('user/add')); ?>"    class="<?php echo is_active('user/add', $page); ?>">Tambah Pengguna</a>
            <span class="spacer"></span>
            <span class="who">Halo, <?php echo e($_SESSION['admin_nama'] ?? 'Admin'); ?></span>
            <form method="post" action="<?php echo e(url('auth/logout')); ?>" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn-link">Logout</button>
            </form>
        <?php else: ?>
            <a href="<?php echo e(url('auth/login')); ?>" class="<?php echo is_active('auth/login', $page); ?>">Login</a>
        <?php endif; ?>
    </nav>
    <main>
        <?php if ($flash = flash_get()): ?>
            <div class="alert <?php echo e($flash['tipe']); ?>"><?php echo e($flash['pesan']); ?></div>
        <?php endif; ?>
