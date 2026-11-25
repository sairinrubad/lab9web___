# Lab9Web — Praktikum 9: PHP Modular

| | |
|---|---|
| **Nama** | Sairin bin Rubad |
| **NIM** | 312510134 |
| **Mata Kuliah** | Pemrograman Web |
| **Topik** | Praktikum 9 — PHP Modular (Modularisasi Program, Function, Template, dan Routing) |

## 1. Tujuan Project

Repository ini berisi seluruh hasil Praktikum 9. Tujuannya:

1. Memahami modularisasi program PHP dan manfaatnya.
2. Membedakan `include`, `require`, `include_once`, dan `require_once`.
3. Membuat template (header/footer) yang dipakai bersama banyak halaman.
4. Membuat function PHP (parameter, nilai kembalian, type declaration, nilai default) dan memisahkannya ke file helper.
5. Menyusun struktur direktori aplikasi secara modular.
6. Menerapkan routing berbasis parameter URL dengan **whitelist** dan halaman **404**.
7. Merefactor aplikasi CRUD database menjadi modular (template + router + helper + modul).

## 2. Kebutuhan Perangkat

- Web server lokal Apache + PHP 8.0 atau lebih baru + MySQL/MariaDB (XAMPP / Laragon)
- Browser modern
- Visual Studio Code (atau editor sejenis)
- Git

## 3. Cara Menjalankan

1. Ekstrak/clone repository ini, lalu salin folder `Lab9Web` ke *docroot* web server
   (`C:\xampp\htdocs\Lab9Web` untuk XAMPP).
2. Jalankan **Apache** dan **MySQL** dari XAMPP Control Panel.
3. **Khusus Latihan 4 (project CRUD):** impor database
   - buka `http://localhost/phpmyadmin` → tab **Import** → pilih `project/database.sql` → **Go**, atau
   - lewat terminal: `mysql -u root < project/database.sql`
4. Buka di browser:

| Bagian | URL |
|---|---|
| Praktik include/require | `http://localhost/Lab9Web/01_praktik_include/uji-include.php` |
| Template | `http://localhost/Lab9Web/02_template/home.php` |
| Function | `http://localhost/Lab9Web/03_function/contoh-function.php` |
| Latihan 1 | `http://localhost/Lab9Web/latihan1_template/home.php` |
| Latihan 2 | `http://localhost/Lab9Web/latihan2_library_function/produk.php` |
| Latihan 3 | `http://localhost/Lab9Web/latihan3_router/index.php` |
| Latihan 4 (CRUD) | `http://localhost/Lab9Web/project/index.php` |

5. **Login Latihan 4:** username `admin`, password `admin123`.
6. Jika konfigurasi MySQL berbeda, ubah `project/config/database.php` (satu-satunya file konfigurasi koneksi).

## 4. Struktur Direktori

```
Lab9Web/
├── README.md
├── LAPORAN.md                    # jawaban analisis, pertanyaan pemahaman, kendala
├── 01_praktik_include/           # praktik include vs require
├── 02_template/                  # header.php, footer.php, home/about/kontak
├── 03_function/                  # contoh function, helpers.php, latihan function
├── latihan1_template/            # Latihan 1: Home, Profil, Kontak
├── latihan2_library_function/    # Latihan 2: helpers/functions.php (4 function)
├── latihan3_router/              # Latihan 3: router aman (6 rute + 404)
├── project/                      # Latihan 4: CRUD modular
│   ├── index.php                 # router
│   ├── .htaccess                 # URL rewrite (opsional)
│   ├── database.sql
│   ├── config/database.php       # koneksi database (PDO)
│   ├── views/                    # header, footer, dashboard, 404
│   ├── helpers/functions.php     # function umum
│   ├── modules/user/             # list, add, edit, delete
│   ├── modules/auth/             # login, logout
│   └── assets/                   # css/, js/
└── screenshots/                  # bukti hasil praktikum (40 gambar)
```

## 5. Daftar Rute

### Latihan 3 — `latihan3_router/index.php`

| Rute (`?page=`) | File | Keterangan |
|---|---|---|
| `home` (default) | `views/home.php` | Beranda |
| `profil` | `views/profil.php` | Profil mahasiswa |
| `produk` | `views/produk.php` | Daftar produk |
| `artikel` | `views/artikel.php` | Artikel |
| `kontak` | `views/kontak.php` | Kontak |
| `info/tentang` | `views/tentang.php` | Rute bersarang |
| *(lainnya)* | `views/404.php` | Status HTTP 404 |

### Latihan 4 — `project/index.php`

| Rute (`?page=`) | File | Login | Keterangan |
|---|---|:---:|---|
| `dashboard` (default) | `views/dashboard.php` | ✔ | Ringkasan data |
| `user/list` | `modules/user/list.php` | ✔ | Read — daftar + pencarian |
| `user/add` | `modules/user/add.php` | ✔ | Create |
| `user/edit&id=N` | `modules/user/edit.php` | ✔ | Update |
| `user/delete` | `modules/user/delete.php` | ✔ | Delete (hanya POST + CSRF) |
| `auth/login` | `modules/auth/login.php` | – | Login |
| `auth/logout` | `modules/auth/logout.php` | – | Logout (POST + CSRF) |
| *(lainnya)* | `views/404.php` | – | Status HTTP 404 |

## 6. Langkah Praktikum (Ringkas)

1. **Praktik include/require** — `01_praktik_include/`: uji `include` vs `require` saat file hilang (screenshot 03–06).
2. **Template** — `02_template/`: `header.php` & `footer.php` dipakai `home`, `about`, `kontak` (screenshot 07–09).
3. **Function** — `03_function/`: function tanpa/dengan parameter, `return`, type declaration, default value, `helpers.php` (screenshot 10–13).
4. **Latihan 1** — template multi-halaman tanpa salinan header/footer (screenshot 14–16).
5. **Latihan 2** — `helpers/functions.php` berisi `formatRupiah()`, `hitungDiskon()`, `validasiEmail()`, `ringkasTeks()` (+ `e()`), dipakai di 2 halaman (screenshot 17–19).
6. **Latihan 3** — router dengan whitelist 6 rute + 404, input URL tidak dipakai sebagai path file (screenshot 20–24).
7. **Latihan 4** — refactor CRUD: `config/`, `views/`, `helpers/`, `modules/`, `assets/`, router `index.php` (screenshot 25–40, struktur di 01–02).
8. **Tantangan mandiri** — menu aktif, helper pesan flash, pembatasan akses login, dan `.htaccess` URL rewrite sudah diimplementasikan di `project/`.

## 7. Fitur Keamanan pada Latihan 4

- **Whitelist rute** — path file diambil dari array `$routes`, bukan dari input URL.
- **PDO prepared statement** — mencegah SQL injection.
- **Escaping output** `e()` — mencegah XSS.
- **Aksi ubah data via POST + token CSRF** — membuka URL (GET) tidak menghapus data.
- **Password di-hash** (`password_hash` / `password_verify`) dan `session_regenerate_id()` saat login.
- **Detail error database tidak ditampilkan** ke pengguna (`error_log` + pesan umum).

## 8. URL Rewrite (Opsional)

`project/.htaccess` meneruskan `/project/user/list` ke `index.php?page=user/list`.
Syarat: `mod_rewrite` aktif dan `AllowOverride All` pada konfigurasi Apache.
Tautan & aset dibuat lewat helper `url()` dan `asset()` sehingga tetap benar saat URL ditulis ulang.

## 9. Kendala dan Solusi

Lihat bagian *Kendala dan Cara Mengatasinya* pada [`LAPORAN.md`](LAPORAN.md).

## 10. Screenshot dan Penjelasan

Semua gambar tersimpan di folder [`screenshots/`](screenshots/).

### A. Struktur Direktori

**01. Struktur direktori seluruh repository**

![Struktur direktori seluruh repository](screenshots/01-struktur-direktori-lab9web.png)

Repository dibagi per bagian praktikum: praktik include, template, function, Latihan 1–3, dan `project/` untuk Latihan 4.

**02. Struktur direktori project CRUD (Latihan 4)**

![Struktur direktori project CRUD (Latihan 4)](screenshots/02-struktur-direktori-project-crud.png)

Sesuai bagian F modul: `index.php` (router), `config/`, `views/`, `helpers/`, `modules/user` & `modules/auth`, serta `assets/`.

### B. Praktik include dan require

**03. `uji-include.php` saat `pesan.php` ada**

![`uji-include.php` saat `pesan.php` ada](screenshots/03-uji-include-normal.png)

Urutan keluaran normal: Sebelum pemanggilan → isi `pesan.php` → Sesudah pemanggilan.

**04. `include` saat file tidak ditemukan**

![`include` saat file tidak ditemukan](screenshots/04-uji-include-file-tidak-ada.png)

Muncul **Warning**, tetapi eksekusi **berlanjut**: teks "Sesudah pemanggilan" tetap tampil.

**05. `require` saat file tidak ditemukan**

![`require` saat file tidak ditemukan](screenshots/05-uji-require-file-tidak-ada.png)

Muncul Warning lalu **Fatal error**; eksekusi **berhenti**, teks "Sesudah pemanggilan" tidak tampil. Inilah perbedaan utama `include` dan `require`.

**06. `include` 2× vs `require_once` 2×**

![`include` 2× vs `require_once` 2×](screenshots/06-uji-once-include-vs-require_once.png)

`include` memuat file dua kali, sedangkan `require_once` hanya sekali sehingga mencegah pemuatan berulang.

### C. Template Layout (header & footer bersama)

**07. Halaman Home**

![Halaman Home](screenshots/07-template-home.png)

Header, navigasi, dan footer berasal dari `header.php` dan `footer.php`; hanya konten tengah yang khusus halaman ini.

**08. Halaman Tentang**

![Halaman Tentang](screenshots/08-template-about.png)

Kerangka tampilan sama dengan Home, hanya isi berbeda — bukti template dipakai bersama.

**09. Halaman Kontak**

![Halaman Kontak](screenshots/09-template-kontak.png)

Halaman ketiga yang memakai template yang sama. Mengubah menu di `header.php` langsung berlaku di ketiga halaman.

### D. Function PHP

**10. Contoh function (tanpa parameter, parameter, return, default value)**

![Contoh function (tanpa parameter, parameter, return, default value)](screenshots/10-function-contoh.png)

Menampilkan salam, sapaan, luas persegi panjang (8 × 5 = 40), dan diskon 10% serta 15% dari 200000.

**11. `helpers.php`: `formatRupiah()` dan `e()`**

![`helpers.php`: `formatRupiah()` dan `e()`](screenshots/11-function-helpers-escape.png)

`formatRupiah(150000)` menjadi `Rp 150.000`; `e()` meng-escape tag `<script>` sehingga ditampilkan sebagai teks, bukan dijalankan (pencegahan XSS).

**12. Latihan function — Halaman A**

![Latihan function — Halaman A](screenshots/12-function-latihan-halaman-a.png)

Memakai `konversiCelciusKeFahrenheit()` (36,5 °C = 97,7 °F) dan `tentukanStatusNilai()` (78 = B).

**13. Latihan function — Halaman B**

![Latihan function — Halaman B](screenshots/13-function-latihan-halaman-b.png)

Memakai `hitungTotal()` (25.000 × 4 = Rp 100.000). Function yang sama dipanggil dari dua halaman berbeda sesuai tugas.

### E. Latihan 1 — Template Multi-Halaman

**14. Home**

![Home](screenshots/14-latihan1-home.png)

Tidak ada salinan kode header/footer di file halaman; semuanya dimuat dengan `require_once`. Menu aktif ditandai.

**15. Profil**

![Profil](screenshots/15-latihan1-profil.png)

Berisi nama dan NIM mahasiswa dengan tampilan konsisten.

**16. Kontak**

![Kontak](screenshots/16-latihan1-kontak.png)

Form sederhana; input pengguna di-escape saat ditampilkan kembali.

### F. Latihan 2 — Library Function (`helpers/functions.php`)

**17. Daftar produk**

![Daftar produk](screenshots/17-latihan2-produk.png)

Memakai `formatRupiah()`, `hitungDiskon()`, dan `ringkasTeks()`; nilai return dipakai untuk menghitung harga akhir.

**18. `validasiEmail()` — input salah**

![`validasiEmail()` — input salah](screenshots/18-latihan2-validasi-email-gagal.png)

Email `rina@@example` ditolak dengan pesan kesalahan.

**19. `validasiEmail()` — input benar**

![`validasiEmail()` — input benar](screenshots/19-latihan2-validasi-email-berhasil.png)

Email valid diterima dan nilai ditampilkan melalui `e()`.

### G. Latihan 3 — Router Aman (6 rute + 404)

**20. Rute default `home`**

![Rute default `home`](screenshots/20-latihan3-router-home.png)

Tanpa parameter `page`, router memuat rute `home`.

**21. `?page=produk`**

![`?page=produk`](screenshots/21-latihan3-router-produk.png)

Rute valid dimuat dari whitelist `$routes`; menu aktif mengikuti rute.

**22. `?page=info/tentang`**

![`?page=info/tentang`](screenshots/22-latihan3-router-rute-bersarang.png)

Rute bersarang tetap dipetakan ke file lewat array, bukan lewat input URL.

**23. `?page=admin/rahasia`**

![`?page=admin/rahasia`](screenshots/23-latihan3-router-404-admin-rahasia.png)

Rute tidak terdaftar → status HTTP 404 dan halaman 404.

**24. `?page=../../etc/passwd`**

![`?page=../../etc/passwd`](screenshots/24-latihan3-router-404-traversal.png)

Percobaan path traversal ditolak (404) karena input URL tidak pernah dipakai sebagai path file.

### H. Latihan 4 — Refactoring CRUD Modular

**25. Halaman login**

![Halaman login](screenshots/25-crud-login.png)

Modul `auth/login`. Akun contoh: `admin` / `admin123`.

**26. Login gagal**

![Login gagal](screenshots/26-crud-login-gagal.png)

Pesan dibuat umum agar tidak membocorkan username yang ada.

**27. Akses halaman tanpa login**

![Akses halaman tanpa login](screenshots/27-crud-akses-tanpa-login-redirect.png)

Rute bertanda `auth => true` dialihkan ke login dengan pesan flash.

**28. Dashboard setelah login**

![Dashboard setelah login](screenshots/28-crud-dashboard-setelah-login.png)

Menampilkan total pengguna dan pengguna terbaru dari database melalui koneksi di `config/database.php`.

**29. READ — daftar pengguna**

![READ — daftar pengguna](screenshots/29-crud-read-daftar-pengguna.png)

Modul `user/list` dengan pencarian. Tautan aksi memakai pola `index.php?page=...`.

**30. CREATE — form tambah pengguna**

![CREATE — form tambah pengguna](screenshots/30-crud-create-form-tambah.png)

Modul `user/add`; form dilindungi token CSRF.

**31. CREATE — validasi server**

![CREATE — validasi server](screenshots/31-crud-create-validasi-gagal.png)

Email dan No. HP yang salah ditolak; data yang diketik tetap tampil.

**32. CREATE — email duplikat**

![CREATE — email duplikat](screenshots/32-crud-create-email-duplikat.png)

Email yang sudah terdaftar ditolak.

**33. CREATE — berhasil**

![CREATE — berhasil](screenshots/33-crud-create-berhasil.png)

Data baru muncul di daftar dengan pesan sukses (flash).

**34. UPDATE — form ubah**

![UPDATE — form ubah](screenshots/34-crud-update-form-ubah.png)

Modul `user/edit&id=3`; data lama terisi otomatis.

**35. UPDATE — berhasil**

![UPDATE — berhasil](screenshots/35-crud-update-berhasil.png)

Perubahan tersimpan (No. HP Siti Aminah berubah) dengan pesan sukses.

**36. DELETE — berhasil**

![DELETE — berhasil](screenshots/36-crud-delete-berhasil.png)

Penghapusan lewat tombol Hapus (POST + CSRF + konfirmasi); data hilang dari daftar.

**37. DELETE via URL (GET) ditolak**

![DELETE via URL (GET) ditolak](screenshots/37-crud-delete-via-get-ditolak.png)

Membuka `?page=user/delete&id=2` tidak menghapus data, sesuai anjuran keamanan modul.

### I. Pengujian Routing (Latihan 4)

**38. `page=admin/rahasia`**

![`page=admin/rahasia`](screenshots/38-routing-404-admin-rahasia.png)

Tidak ada di whitelist → 404.

**39. `page=` (kosong)**

![`page=` (kosong)](screenshots/39-routing-404-page-kosong.png)

Parameter kosong ditangani aman → 404.

**40. `page[]=user/list` (tipe array)**

![`page[]=user/list` (tipe array)](screenshots/40-routing-404-page-array.png)

Parameter bertipe tidak sesuai ditolak oleh `is_string()` → 404.
