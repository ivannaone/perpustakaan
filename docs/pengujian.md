# Checklist Pengujian

Status: **B** = Berhasil · **G** = Gagal · **BU** = Belum Diuji · **P** = Perlu Perbaikan

---

## 1. Autentikasi dan Keamanan

| # | Skenario | Langkah | Status | Catatan |
|---|---|---|---|---|
| 1.1 | Login admin berhasil | Masukkan username & password admin → klik Masuk | BU | |
| 1.2 | Login user berhasil | Masukkan username & password user → klik Masuk | BU | |
| 1.3 | Login gagal dengan password salah | Masukkan password yang salah | BU | |
| 1.4 | Registrasi membuat role user | Daftar akun baru → cek kolom `role` di database | BU | |
| 1.5 | User tidak bisa akses halaman admin | Login sebagai user → akses `/admin/dashboard` | BU | |
| 1.6 | Admin tidak bisa akses `/user/peminjaman` | Login sebagai admin → akses `/user/peminjaman` | BU | |
| 1.7 | Sesi berakhir setelah 60 menit | Set `SESSION_LIFETIME=1`, login, tunggu 1 menit, akses dashboard | BU | Uji dengan lifetime 1 menit |
| 1.8 | Logout mengakhiri sesi | Klik Logout → coba akses halaman yang perlu login | BU | |
| 1.9 | Role tidak bisa dimanipulasi via form | Kirim POST registrasi dengan field `role=admin` manual | BU | |

---

## 2. Anggota

| # | Skenario | Langkah | Status | Catatan |
|---|---|---|---|---|
| 2.1 | Tambah anggota berhasil | Isi form tambah anggota dengan data valid → simpan | BU | |
| 2.2 | Validasi field wajib | Kirim form kosong atau dengan ID duplikat | BU | |
| 2.3 | Edit anggota berhasil | Ubah nama anggota → simpan | BU | |
| 2.4 | Hapus anggota tanpa peminjaman | Hapus anggota yang tidak punya riwayat peminjaman | BU | |
| 2.5 | Hapus anggota dengan peminjaman | Hapus anggota yang masih punya transaksi | BU | Harus ditolak database |
| 2.6 | Pencarian berfungsi | Cari dengan nama / ID / jenis anggota | BU | |
| 2.7 | Pagination berfungsi | Tambah cukup data untuk melebihi 10 baris | BU | |

---

## 3. Buku

| # | Skenario | Langkah | Status | Catatan |
|---|---|---|---|---|
| 3.1 | Tambah buku berhasil | Isi form tambah buku dengan data valid | BU | |
| 3.2 | Validasi ID buku duplikat | Coba tambah buku dengan ID yang sudah ada | BU | |
| 3.3 | Edit buku berhasil | Ubah judul buku → simpan | BU | |
| 3.4 | Hapus buku tanpa eksemplar | Hapus buku yang belum punya detail buku | BU | |
| 3.5 | Import Excel sheet `Data Buku` | Upload file Excel dengan sheet bernama Data Buku | BU | |
| 3.6 | Import Excel sheet lain | Upload file Excel dengan sheet bernama Sheet1 | BU | Harus tetap diproses (fallback sheet 0) |
| 3.7 | Import Excel dengan ID duplikat | Upload file berisi ID buku yang sudah ada | BU | Harus dilewati, bukan error |
| 3.8 | Import Excel dengan kolom kosong | Upload baris tanpa judul atau pengarang | BU | Harus ditolak per baris |
| 3.9 | Import file bukan Excel | Upload file `.pdf` | BU | Harus ditolak dengan pesan error |

---

## 4. Detail Buku

| # | Skenario | Langkah | Status | Catatan |
|---|---|---|---|---|
| 4.1 | Generate eksemplar berhasil | Klik Generate pada buku dengan jumlah > 0 | BU | |
| 4.2 | Generate buku dengan jumlah 0 | Klik Generate pada buku dengan jumlah = 0 | BU | Harus muncul pesan error |
| 4.3 | Generate tidak duplikat | Klik Generate dua kali pada buku yang sama | BU | Tidak boleh membuat eksemplar ganda |
| 4.4 | Tambah eksemplar manual | Isi form tambah detail buku dengan nomor unik | BU | |
| 4.5 | Edit status eksemplar | Ubah status dari Ada ke Dipinjam | BU | |
| 4.6 | Hapus eksemplar status Ada | Hapus eksemplar yang berstatus Ada | BU | Harus berhasil |
| 4.7 | Hapus eksemplar status Dipinjam | Hapus eksemplar yang berstatus Dipinjam | BU | Harus ditolak dengan pesan error |

---

## 5. Peminjaman

| # | Skenario | Langkah | Status | Catatan |
|---|---|---|---|---|
| 5.1 | User pinjam buku dari katalog | Login user terhubung → buka katalog → klik Pinjam | BU | |
| 5.2 | User belum terhubung anggota tidak bisa pinjam | Login user tanpa kaitan → buka katalog | BU | Tombol harus disabled |
| 5.3 | Pinjam buku stok habis tidak bisa | Coba kirim POST pinjam buku yang semua eksemplarnya dipinjam | BU | |
| 5.4 | Pinjam buku yang sama dua kali | Pinjam buku yang sama sebelum dikembalikan | BU | Harus ditolak |
| 5.5 | Status eksemplar berubah setelah pinjam | Cek status di tabel detail_buku setelah peminjaman | BU | |
| 5.6 | Admin catat peminjaman manual | Admin isi form tambah peminjaman | BU | |
| 5.7 | Pengembalian berhasil | Klik Kembalikan pada transaksi yang dipinjam | BU | |
| 5.8 | Status eksemplar kembali Ada setelah kembali | Cek status di tabel detail_buku setelah pengembalian | BU | |
| 5.9 | Peminjaman Saya hanya tampil milik sendiri | Login dua user berbeda → cek riwayat masing-masing | BU | |
| 5.10 | User belum terhubung: Peminjaman Saya tampil pesan | Login user tanpa kaitan → buka Peminjaman Saya | BU | |

---

## 6. Laporan

| # | Skenario | Langkah | Status | Catatan |
|---|---|---|---|---|
| 6.1 | Cetak PDF berhasil dibuka | Klik Cetak Laporan PDF | BU | |
| 6.2 | Isi PDF sesuai database | Bandingkan isi PDF dengan data di tabel peminjaman | BU | |
| 6.3 | Export Excel bisa dibuka | Klik Export Excel | BU | |
| 6.4 | Header Excel sesuai | Periksa baris pertama file Excel | BU | |
| 6.5 | PDF saat data kosong | Cetak PDF saat belum ada transaksi | BU | Harus tampil tabel kosong, bukan error |
| 6.6 | Akses laporan tanpa login | Akses `/laporan` tanpa login | BU | Harus redirect ke login |

---

## 7. Halaman User

| # | Skenario | Langkah | Status | Catatan |
|---|---|---|---|---|
| 7.1 | Dashboard menampilkan buku terbaru dari database | Login user → cek buku di dashboard | BU | |
| 7.2 | Katalog menampilkan stok dari detail_buku | Cek jumlah eksemplar di katalog vs database | BU | |
| 7.3 | Pencarian katalog berfungsi | Cari judul buku di katalog | BU | |
| 7.4 | Pagination katalog berfungsi | Pastikan halaman 2 dst bisa diakses | BU | |
| 7.5 | Profil: update nama berhasil | Ubah nama di halaman Profil → simpan | BU | |
| 7.6 | Profil: username duplikat ditolak | Ubah username ke username yang sudah ada | BU | |
| 7.7 | Informasi perpustakaan dapat dibuka | Klik menu Informasi | BU | |
| 7.8 | Navigasi antarhalaman berfungsi | Klik semua menu di navbar user | BU | |
| 7.9 | Menu aktif sesuai halaman | Periksa apakah menu yang aktif ditandai benar | BU | |

---

## 8. Halaman Error

| # | Skenario | Status | Catatan |
|---|---|---|---|
| 8.1 | Akses URL tidak ada → 404 | BU | |
| 8.2 | Akses halaman admin tanpa izin → 403 | BU | |
| 8.3 | Tidak ada error 500 yang tidak ditangani | BU | |

---

## Cara Menguji Session Timeout

Karena menunggu 60 menit tidak praktis, gunakan cara berikut:

1. Ubah sementara `SESSION_LIFETIME=1` di file `.env`.
2. Jalankan `php artisan config:clear`.
3. Login ke aplikasi.
4. Tunggu 1–2 menit tanpa melakukan apapun.
5. Buka kembali halaman yang memerlukan login.
6. Seharusnya diarahkan ke halaman login.
7. Kembalikan `SESSION_LIFETIME=60` setelah pengujian selesai.
