<?php
$judul     = 'Kontak';
$menuAktif = 'kontak';

// Pemrosesan form sederhana (nilai selalu di-escape saat ditampilkan)
$pesanTerkirim = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama  = trim((string)($_POST['nama'] ?? ''));
    $pesan = trim((string)($_POST['pesan'] ?? ''));
    if ($nama !== '' && $pesan !== '') {
        $pesanTerkirim = ['nama' => $nama, 'pesan' => $pesan];
    }
}
require_once __DIR__ . '/header.php';
?>
<section class="content">
    <h2>Kontak</h2>
    <?php if ($pesanTerkirim): ?>
        <div class="alert success">
            Terima kasih, <strong><?php echo htmlspecialchars($pesanTerkirim['nama'], ENT_QUOTES, 'UTF-8'); ?></strong>.
            Pesan Anda: &ldquo;<?php echo htmlspecialchars($pesanTerkirim['pesan'], ENT_QUOTES, 'UTF-8'); ?>&rdquo;
        </div>
    <?php endif; ?>
    <form method="post" action="kontak.php">
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" required>
        <label for="pesan">Pesan</label>
        <textarea id="pesan" name="pesan" rows="4" required></textarea>
        <button type="submit">Kirim</button>
    </form>
</section>
<?php require_once __DIR__ . '/footer.php'; ?>
