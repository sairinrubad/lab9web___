# Laporan Praktikum 9 — PHP Modular

**Nama:** Sairin bin Rubad  **NIM:** 312510134  **Mata Kuliah:** Pemrograman Web

---

## A. Praktik Include dan Require (`01_praktik_include/`)

Percobaan: `uji-include.php` / `uji-require.php` memanggil `pesan.php`; kemudian `pesan.php` diganti namanya sementara.

| Kondisi | `include` | `require` |
|---|---|---|
| `pesan.php` ada | Tampil: Sebelum → isi pesan → Sesudah | Sama |
| `pesan.php` tidak ada | Muncul **Warning** (2 baris), **eksekusi berlanjut** — teks "Sesudah pemanggilan" tetap tampil | Muncul Warning lalu **Fatal error**, **eksekusi berhenti** — "Sesudah pemanggilan" **tidak** tampil |

Percobaan tambahan (`uji-once.php`): `include` dua kali mencetak isi file dua kali, sedangkan `require_once` dua kali hanya memuat file satu kali.

Screenshot: `03`, `04`, `05`, `06`.

## B. Analisis Hasil Template (`02_template/`)

1. **Bagian yang digunakan bersama semua halaman?**
   `header.php` (awal dokumen HTML, `<head>`, judul, navigasi, pembuka `<main>`), `footer.php` (penutup `</main>`, footer, penutup `</html>`), dan `style.css`.
2. **Apa yang terjadi jika teks navigasi diubah pada `header.php`?**
   Perubahan langsung terlihat di **semua** halaman (`home`, `about`, `kontak`) tanpa mengedit satu per satu, karena semuanya memuat file header yang sama.
3. **Mengapa konten halaman tidak diletakkan seluruhnya di `header.php`?**
   Header hanya untuk bagian yang sama di setiap halaman. Jika konten diletakkan di header, semua halaman akan menampilkan konten yang sama dan header tidak bisa dipakai ulang. Memisahkan konten membuat tanggung jawab file jelas: template = kerangka, halaman = isi.
4. **Manfaat `require_once` dibanding menyalin kode header ke setiap halaman?**
   Tidak ada duplikasi kode, perubahan cukup di satu tempat (mudah dipelihara), mengurangi risiko tidak konsisten/salah ketik, file wajib dipastikan ada (fatal error jika hilang), dan file tidak termuat ganda sehingga tidak terjadi tampilan header ganda.

## C. Latihan Function (`03_function/`)

| No | Function | Keterangan | Contoh hasil |
|---|---|---|---|
| 1 | `konversiCelciusKeFahrenheit($c)` | F = (C × 9/5) + 32 | 36,5 °C → 97,7 °F |
| 2 | `tentukanStatusNilai($nilai)` | A ≥ 85, B ≥ 70, C ≥ 55, D ≥ 40, selain itu E | 78 → B (Baik); 92 → A |
| 3 | `hitungTotal($harga, $jumlah)` | harga × jumlah | 25.000 × 4 = 100.000 |
| 4 | Semua dipindah ke `helpers.php` | Dipanggil dari `latihan-halaman-a.php` dan `latihan-halaman-b.php` | — |

Screenshot: `10`–`13`.

## D. Latihan Terstruktur

| Latihan | Folder | Kriteria yang dipenuhi |
|---|---|---|
| 1 — Template multi-halaman | `latihan1_template/` | Home, Profil, Kontak memakai `header.php`/`footer.php` yang sama; tidak ada salinan header/footer; navigasi berfungsi dengan menu aktif |
| 2 — Library function | `latihan2_library_function/` | `helpers/functions.php` berisi `formatRupiah()`, `hitungDiskon()`, `validasiEmail()`, `ringkasTeks()` (+ `e()`); dipakai di `produk.php` dan `pendaftaran.php`; nilai return digunakan (ditampilkan, dihitung, dijadikan kondisi) |
| 3 — Router aman | `latihan3_router/` | 6 rute, halaman 404 dengan status HTTP 404, path file berasal dari whitelist (bukan input URL) |
| 4 — Refactoring CRUD | `project/` | Struktur sesuai bagian F; template bersama; koneksi hanya di `config/database.php`; semua tautan lewat `index.php?page=...` |

Pengujian routing (Latihan 4): `dashboard`, `user/list`, `user/add` tampil normal; `page=admin/rahasia`, `page=` (kosong), dan `page[]=user/list` (tipe array) semuanya menghasilkan halaman **404** (screenshot `38`–`40`). Pengujian CRUD: screenshot `25`–`37`.

## E. Tantangan Mandiri (sudah dikerjakan)

- **Menu aktif** — helper `is_active()` memberi class `active` sesuai rute.
- **Pesan sukses/gagal** — `flash_set()` / `flash_get()` berbasis session, ditampilkan di `views/header.php`.
- **Pembatasan akses** — rute bertanda `'auth' => true` mengarahkan ke login bila belum login (screenshot `27`).
- **URL rewrite** — `project/.htaccess`.

## F. Jawaban Pertanyaan Pemahaman

1. **Pengertian modularisasi dan minimal tiga manfaat.**
   Modularisasi adalah teknik membagi aplikasi menjadi bagian-bagian kecil berdasarkan fungsi/tanggung jawabnya (template, konfigurasi, helper, modul fitur). Manfaat: (a) kode dapat dipakai ulang tanpa menulis ulang; (b) perubahan cukup di satu file sehingga pemeliharaan mudah; (c) kode lebih rapi dan mudah dipahami/ditelusuri; (d) pekerjaan tim dapat dibagi per modul tanpa konflik file besar.

2. **Perbedaan `include` dan `require` saat file tidak ditemukan.**
   `include` hanya menghasilkan *warning* dan eksekusi berlanjut; `require` menghasilkan *fatal error* dan eksekusi dihentikan.

3. **Mengapa `require_once` cocok untuk konfigurasi database?**
   Konfigurasi database wajib ada (tanpa itu aplikasi tidak bisa bekerja, jadi harus berhenti jika hilang — sifat `require`) dan cukup dimuat satu kali (sifat `_once`) agar koneksi/variabel/function tidak dideklarasikan atau dibuat berulang.

4. **Perbedaan parameter, argumen, dan nilai return.**
   *Parameter* adalah variabel pada deklarasi function (`function hitungTotal($harga, $jumlah)`). *Argumen* adalah nilai yang dikirim saat function dipanggil (`hitungTotal(25000, 4)`). *Nilai return* adalah nilai yang dikembalikan function ke pemanggil lewat `return` — dapat disimpan, dihitung lagi, atau dipakai dalam kondisi (berbeda dengan `echo` yang hanya menampilkan).

5. **Mengapa header dan footer dipisahkan dari konten?**
   Karena bagian itu sama di semua halaman. Dengan memisahkannya, tampilan konsisten, tidak ada duplikasi, dan perubahan desain/navigasi cukup dilakukan sekali.

6. **Fungsi `index.php` pada pola routing.**
   Sebagai titik masuk tunggal sekaligus router: membaca parameter `page`, memvalidasi dengan whitelist, memuat header, memuat file modul yang sesuai, lalu memuat footer (atau menampilkan 404 bila rute tidak valid).

7. **Mengapa router sebaiknya memakai whitelist rute?**
   Whitelist memastikan hanya halaman yang secara eksplisit didaftarkan yang dapat dijalankan. Path file ditentukan aplikasi, bukan pengguna, sehingga file lain di server tidak bisa dipanggil lewat URL. Rute baru/hilang juga mudah dikelola di satu tempat.

8. **Risiko jika input `page` langsung digabung menjadi path file yang di-`require`.**
   Terbuka celah *path traversal / Local File Inclusion*: penyerang dapat memakai `../` atau nama file lain (mis. `../config/database`) untuk menjalankan atau menampilkan file yang tidak seharusnya diakses, sehingga dapat membocorkan kredensial atau mengeksekusi kode yang tidak dimaksudkan.

9. **Fungsi `RewriteCond` dan `RewriteRule` pada `.htaccess`.**
   `RewriteCond` menentukan syarat: dua kondisi (`!-f` dan `!-d`) berarti aturan hanya berlaku bila permintaan **bukan** file atau direktori yang ada secara fisik (agar CSS/JS/gambar tetap dilayani langsung). `RewriteRule ^(.+)$ index.php?page=$1 [QSA,L]` mengarahkan semua permintaan lain ke `index.php` dengan path menjadi nilai `page` (`QSA` = query string dipertahankan, `L` = aturan terakhir).

10. **Bagian aplikasi CRUD yang tepat dipindahkan ke config, views, helpers, dan modules.**
    - **config/** — koneksi database (`database.php`).
    - **views/** — komponen tampilan bersama: `header.php`, `footer.php`, `dashboard.php`, `404.php`.
    - **helpers/** — function umum: `e()`, `url()`, `validasiEmail()`, `formatRupiah()`, flash, CSRF.
    - **modules/** — fitur CRUD: `user/list|add|edit|delete`, `auth/login|logout`.

## G. Kendala dan Cara Mengatasinya

| Kendala | Penyebab | Solusi |
|---|---|---|
| *Failed opening required* | Path relatif salah ketika file dipanggil dari lokasi lain | Semua pemanggilan memakai `__DIR__ . '/...'` |
| *Cannot redeclare function* | File function dimuat lebih dari sekali | Gunakan `require_once` |
| CSS tidak tampil setelah URL rewrite | `href="assets/css/style.css"` relatif ikut berubah saat URL `/project/user/list` | Helper `asset()` / `url()` membuat path berdasarkan `base_path()` |
| *Headers already sent* saat `header('Location: ...')` setelah proses simpan | Header HTML sudah dikirim sebelum modul dijalankan | `ob_start()` di `index.php` dan `exit` setelah redirect |
| Hapus data lewat URL berbahaya | Link GET dapat dipicu tanpa sengaja | Hapus hanya via POST + token CSRF + konfirmasi JavaScript |
| Router menampilkan 404 untuk `page=` kosong / `page[]=` | Nilai tidak ada di whitelist / bukan string | Validasi `is_string()` + `array_key_exists()` → 404 |
| URL rewrite tidak jalan | `mod_rewrite`/`AllowOverride` belum aktif | Aktifkan `mod_rewrite`, set `AllowOverride All`, restart Apache |

## H. Daftar Screenshot (`screenshots/`)

Gambar lengkap beserta penjelasannya ditampilkan di [`README.md`](README.md) bagian 10.

| No | Isi |
|---|---|
| 01–02 | Struktur direktori (seluruh repo & project CRUD) |
| 03–06 | include vs require (normal, file hilang, `_once`) |
| 07–09 | Template: home, about, kontak |
| 10–13 | Function: contoh, helper/escape, latihan halaman A & B |
| 14–16 | Latihan 1: Home, Profil, Kontak |
| 17–19 | Latihan 2: produk, validasi email gagal & berhasil |
| 20–24 | Latihan 3: router, rute bersarang, 404 |
| 25–27 | Latihan 4: login, login gagal, akses tanpa login |
| 28–37 | Latihan 4: dashboard, Read, Create (+validasi), Update, Delete, GET ditolak |
| 38–40 | Pengujian routing 404 (`admin/rahasia`, kosong, array) |

## I. Perintah Git (pengumpulan)

```bash
cd Lab9Web
git init
git add .
git commit -m "Praktikum 9: PHP Modular - template, function, router, CRUD modular"
git branch -M main
git remote add origin https://github.com/<username>/Lab9Web.git
git push -u origin main
```

Kirim URL repository melalui e-learning sesuai instruksi dosen.
