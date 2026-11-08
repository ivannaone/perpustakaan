# Panduan Instalasi

## Kebutuhan Sistem

| Kebutuhan | Versi |
|---|---|
| PHP | 8.2 atau lebih baru |
| MySQL / MariaDB | 10.4 atau lebih baru |
| Composer | 2.x |
| Node.js | 18.x atau lebih baru |
| Web Server | Apache (XAMPP) atau Nginx |

Ekstensi PHP yang wajib aktif:

- `pdo_mysql`
- `mbstring`
- `openssl`
- `tokenizer`
- `xml`
- `fileinfo`
- `gd` (untuk DomPDF)

## Langkah Instalasi Lokal

### 1. Clone Repository

```bash
git clone https://github.com/ivannaone/perpustakaan.git
cd perpustakaan
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi JavaScript

```bash
npm install
npm run build
```

### 4. Konfigurasi Environment

Salin file contoh environment:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buka phpMyAdmin atau MySQL CLI, buat database baru:

```sql
CREATE DATABASE perpustakaan CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Edit file `.env`, sesuaikan bagian database:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan konfigurasi MySQL lokal.

### 6. Jalankan Migration

```bash
php artisan migrate
```

Perintah ini akan membuat semua tabel yang dibutuhkan.
**Jangan gunakan `migrate:fresh` jika database sudah berisi data.**

### 7. Konfigurasi Session

Pastikan nilai berikut ada di `.env`:

```
SESSION_DRIVER=database
SESSION_LIFETIME=60
```

### 8. Konfigurasi Storage

```bash
php artisan storage:link
```

### 9. Buat Akun Admin Pertama

Buka phpMyAdmin atau MySQL CLI dan masukkan data berikut ke tabel `users`.
Password harus di-hash menggunakan bcrypt. Gunakan Tinker untuk generate hash:

```bash
php artisan tinker --execute="echo Hash::make('passwordkamu');"
```

Kemudian insert manual ke database:

```sql
INSERT INTO users (nama, username, password, role, created_at, updated_at)
VALUES ('Administrator', 'admin', '[hasil hash]', 'admin', NOW(), NOW());
```

### 10. Jalankan Aplikasi

```bash
php artisan serve
```

Akses aplikasi di browser: `http://localhost:8000`

## Struktur Folder Utama

```
perpustakaan/
├── app/
│   ├── Exports/          Export Excel
│   ├── Http/
│   │   ├── Controllers/  Semua controller
│   │   └── Middleware/   RoleMiddleware
│   ├── Imports/          Import Excel
│   └── Models/           Eloquent models
├── database/
│   └── migrations/       File migration
├── docs/                 Dokumentasi project
├── public/               Document root (index.php)
├── resources/
│   └── views/            Blade templates
├── routes/
│   └── web.php           Definisi route
└── .env                  Konfigurasi environment (jangan di-commit)
```

## Catatan Keamanan

- File `.env` sudah masuk `.gitignore` dan tidak akan terunggah ke GitHub.
- Jangan ubah `APP_KEY` setelah aplikasi diisi data — sesi akan rusak.
- Gunakan `APP_DEBUG=false` di lingkungan produksi.
