# Persiapan Hosting

## Kebutuhan Server

| Komponen | Minimum |
|---|---|
| PHP | 8.2 |
| MySQL / MariaDB | 10.4 |
| Web Server | Apache dengan mod_rewrite ATAU Nginx |
| Ekstensi PHP | pdo_mysql, mbstring, openssl, tokenizer, xml, fileinfo, gd, zip |
| Composer | Terinstall di server atau di-deploy via CI/CD |

## Pilihan Hosting yang Kompatibel

### Hosting Berbayar Terjangkau

| Layanan | Harga Estimasi | Catatan |
|---|---|---|
| Niagahoster VPS | ~Rp 50.000–100.000/bulan | Perlu konfigurasi manual |
| IDCloudHost VPS | ~Rp 40.000–80.000/bulan | Support PHP 8.2 |
| DigitalOcean Droplet | ~$6/bulan | Butuh konfigurasi Nginx + PHP |

### Hosting untuk Demo / Tugas Sekolah (Gratis)

| Layanan | Catatan |
|---|---|
| InfinityFree | PHP 8.x, MySQL tersedia. Batasan bandwidth dan performa. |
| Byet.host | Serupa InfinityFree. Cocok untuk demo singkat. |

Untuk keperluan presentasi dan tugas, hosting gratis sudah cukup.

## Checklist Sebelum Deploy

### Konfigurasi .env Produksi

Buat file `.env` baru di server (jangan upload dari lokal).

```
APP_NAME="Sistem Informasi Perpustakaan"
APP_ENV=production
APP_KEY=             ← generate dengan php artisan key:generate
APP_DEBUG=false      ← wajib false di produksi
APP_URL=https://domainmu.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_di_server
DB_USERNAME=username_db
DB_PASSWORD=password_db

SESSION_DRIVER=database
SESSION_LIFETIME=60
```

**Jangan upload file `.env` lokal ke server atau GitHub.**

### Langkah Deploy ke Shared Hosting

1. Upload semua file project ke server via FTP/cPanel File Manager
   **kecuali**: folder `.git`, `node_modules`, file `.env`.
2. Pastikan folder `public` dijadikan document root di cPanel.
3. Buat database baru di phpMyAdmin cPanel.
4. Buat file `.env` langsung di server melalui File Manager.
5. Jalankan via SSH (jika tersedia) atau Terminal cPanel:
   ```bash
   composer install --no-dev --optimize-autoloader
   php artisan key:generate
   php artisan migrate --force
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan storage:link
   ```
6. Set permission folder:
   ```bash
   chmod -R 775 storage
   chmod -R 775 bootstrap/cache
   ```

### Langkah Deploy ke VPS

1. Install LEMP/LAMP stack (Nginx/Apache + PHP 8.2 + MySQL).
2. Clone repository:
   ```bash
   git clone https://github.com/ivannaone/perpustakaan.git /var/www/perpustakaan
   ```
3. Buat file `.env` dan konfigurasi seperti di atas.
4. Jalankan:
   ```bash
   composer install --no-dev --optimize-autoloader
   npm run build
   php artisan key:generate
   php artisan migrate --force
   php artisan storage:link
   ```
5. Konfigurasi virtual host Nginx atau Apache untuk mengarahkan ke folder `public`.
6. Atur permission `storage` dan `bootstrap/cache`.

### Keamanan Tambahan

- Pastikan `APP_DEBUG=false` — tidak menampilkan stack trace ke pengguna.
- Pastikan `.env` tidak bisa diakses dari browser.
- Gunakan HTTPS (Let's Encrypt gratis untuk VPS).
- Backup database secara berkala.
- Jangan simpan password database di dalam kode atau file yang di-commit.

### Verifikasi Setelah Deploy

- [ ] Halaman login bisa dibuka.
- [ ] Login admin berhasil.
- [ ] Login user berhasil.
- [ ] Tambah buku berhasil.
- [ ] Import Excel berhasil.
- [ ] Peminjaman dari katalog berhasil.
- [ ] Cetak PDF berhasil.
- [ ] Export Excel berhasil.
- [ ] Laporan menampilkan data yang benar.
- [ ] Tidak ada error 500 di halaman manapun.

## File yang Tidak Boleh Diupload ke Server atau GitHub

- `.env` (sudah ada di `.gitignore`)
- `storage/logs/*.log`
- `vendor/` (diinstall ulang via Composer di server)
- `node_modules/`
- `database/database.sqlite` jika ada
