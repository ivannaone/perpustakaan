# Panduan Admin

## Login Admin

1. Buka browser, akses `http://localhost:8000` (atau URL hosting).
2. Masukkan username dan password akun admin.
3. Klik **Masuk ke Sistem**.
4. Admin akan diarahkan ke Dashboard Admin.

Jika login gagal, periksa username dan password. Hubungi administrator teknis
jika akun admin belum tersedia.

## Dashboard Admin

Dashboard menampilkan:

- Total buku di perpustakaan.
- Total anggota terdaftar.
- Jumlah buku yang sedang dipinjam.
- Total seluruh transaksi peminjaman.

Sidebar kiri berisi menu navigasi ke semua fitur admin.

## Mengelola Anggota

**Melihat daftar anggota:**
Klik menu **Data Anggota** di sidebar.
Gunakan kotak pencarian untuk mencari berdasarkan ID, nama, jenis anggota, atau kelas/prodi.

**Menambah anggota:**
1. Klik tombol **+ Tambah Anggota**.
2. Isi semua kolom yang wajib: ID Anggota, Nama, Jenis Anggota.
3. Klik **Simpan**.

Format ID Anggota: maksimal 10 karakter, contoh: `A001`.

**Mengedit anggota:**
Klik **Edit** pada baris anggota yang ingin diubah.
ID Anggota tidak bisa diubah setelah dibuat.

**Menghapus anggota:**
Klik **Hapus** lalu konfirmasi. Anggota yang masih punya riwayat peminjaman
tidak bisa dihapus — database akan menolak operasi tersebut.

## Mengelola Buku

**Melihat daftar buku:**
Klik menu **Data Buku** di sidebar.

**Menambah buku secara manual:**
1. Klik **+ Tambah Buku**.
2. Isi ID Buku (maks 10 karakter), Judul, Pengarang, dan Jumlah.
3. Klik **Simpan Buku**.

**Import buku dari Excel:**
1. Siapkan file Excel dengan nama sheet: `Data Buku`.
2. Kolom berurutan: ID Buku, Judul Buku, Pengarang, Penerbit, Tahun Terbit, Jumlah.
3. Baris pertama adalah header, data mulai baris kedua.
4. Klik **Import Excel**, pilih file, klik tombol upload.
5. Buku dengan ID yang sudah ada akan dilewati (tidak ditimpa).
6. Jika nama sheet tidak persis `Data Buku`, sheet pertama akan diproses sebagai fallback.

Format yang didukung: `.xlsx`, `.xls`, `.csv`. Ukuran maksimal 2MB.

**Mengedit buku:**
Klik **Edit** pada baris buku. ID Buku tidak bisa diubah.

**Menghapus buku:**
Klik **Hapus** lalu konfirmasi. Buku yang masih punya eksemplar terdaftar
tidak bisa dihapus karena ada relasi di tabel `detail_buku`.

## Mengelola Eksemplar Buku (Detail Buku)

Eksemplar adalah salinan fisik dari sebuah buku.
Setiap eksemplar punya nomor unik, contoh: `B001-01`.

**Melihat daftar eksemplar:**
Klik menu **Detail Buku** di sidebar.

**Generate eksemplar otomatis:**
1. Buka **Data Buku**.
2. Klik tombol **Generate** pada baris buku.
3. Sistem akan membuat eksemplar sejumlah kolom `jumlah` pada data buku.
4. Eksemplar yang sudah ada tidak akan dibuat ulang.
5. Jika jumlah buku 0, generate tidak bisa dilakukan.

**Menambah eksemplar manual:**
1. Klik **+ Tambah Detail Buku**.
2. Isi nomor buku, pilih buku induk, dan pilih status.
3. Klik **Simpan**.

**Mengedit eksemplar:**
Klik **Edit**. Nomor buku tidak bisa diubah.
Status bisa diubah antara `Ada` dan `Dipinjam`.

**Menghapus eksemplar:**
Klik **Hapus**. Eksemplar yang sedang berstatus **Dipinjam**
tidak bisa dihapus — sistem akan menampilkan pesan error.

## Mengelola Akun User

Fitur ini mengaitkan akun login user dengan data anggota perpustakaan,
sehingga user bisa mengajukan peminjaman.

1. Klik menu **Kelola Akun User** di sidebar.
2. Tabel menampilkan semua akun dengan role `user`.
3. Kolom **Status** menunjukkan apakah akun sudah terhubung ke anggota.
4. Pada kolom **Kaitkan ke Anggota**, pilih anggota dari dropdown.
5. Klik **Simpan**.

Untuk melepas kaitan, pilih **— Lepas kaitan —** dari dropdown lalu klik **Simpan**.

Satu anggota hanya bisa dikaitkan ke satu akun.

## Mengelola Peminjaman

**Melihat semua peminjaman:**
Klik menu **Peminjaman** di sidebar.
Gunakan pencarian untuk mencari berdasarkan ID peminjaman, nama anggota, atau nomor buku.

**Mencatat peminjaman baru (oleh admin):**
1. Klik **+ Tambah Peminjaman**.
2. Isi ID Peminjaman (contoh: P0001), Tanggal Pinjam, pilih Anggota, pilih Eksemplar.
3. Hanya eksemplar berstatus `Ada` yang muncul di dropdown.
4. Klik **Simpan Peminjaman**.

**Mencatat pengembalian:**
1. Cari transaksi yang berstatus **Dipinjam**.
2. Klik tombol **Kembalikan** pada baris tersebut.
3. Konfirmasi pengembalian.
4. Status eksemplar akan otomatis berubah kembali ke `Ada`.

**Menghapus data peminjaman:**
Klik **Hapus** pada baris yang ingin dihapus.
Penghapusan hanya untuk keperluan koreksi data.

## Laporan

**Melihat rekap peminjaman:**
Klik menu **Laporan** di sidebar untuk melihat tabel semua transaksi.

**Cetak PDF:**
Klik tombol **Cetak Laporan PDF** untuk mengunduh laporan dalam format PDF.

**Export Excel:**
Klik tombol **Export Excel** untuk mengunduh data peminjaman dalam format `.xlsx`.

Laporan mencakup semua transaksi tanpa filter tanggal.

## Logout

Klik tombol **Logout** di bagian bawah sidebar untuk mengakhiri sesi.
Sesi juga akan berakhir otomatis setelah 60 menit tidak aktif.
