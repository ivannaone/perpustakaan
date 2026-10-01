<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Informasi Perpustakaan - Perpustakaan</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand strong {
            font-size: 17px;
        }

        .brand span {
            display: block;
            color: #6b7280;
            font-size: 11px;
            margin-top: 3px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 25px;
            font-size: 14px;
            color: #4b5563;
        }

        .nav a:hover {
            color: #2563eb;
        }

        .nav .active {
            color: #2563eb;
            font-weight: 600;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .page-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 45px 7%;
        }

        .page-header-inner {
            max-width: 1000px;
            margin: auto;
        }

        .page-header small {
            color: #2563eb;
            font-weight: bold;
        }

        .page-header h1 {
            margin: 8px 0;
            font-size: 30px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 14px;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 35px 20px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 18px;
        }

        .info-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 25px;
        }

        .info-icon {
            width: 45px;
            height: 45px;
            border-radius: 10px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
            margin-bottom: 17px;
        }

        .info-card h2 {
            font-size: 17px;
            margin-bottom: 10px;
        }

        .info-card p {
            color: #6b7280;
            font-size: 13px;
            line-height: 1.7;
        }

        .schedule {
            margin-top: 30px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 25px;
        }

        .schedule h2 {
            font-size: 19px;
            margin-bottom: 18px;
        }

        .schedule-row {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 13px 0;
            border-bottom: 1px solid #f1f5f9;
            font-size: 13px;
        }

        .schedule-row:last-child {
            border-bottom: none;
        }

        .schedule-row span:first-child {
            color: #475569;
        }

        .schedule-row span:last-child {
            font-weight: 600;
            color: #172033;
        }

        .rules {
            margin-top: 18px;
        }

        .rules li {
            margin-bottom: 12px;
            margin-left: 20px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .back {
            display: inline-block;
            margin-top: 25px;
            color: #64748b;
            font-size: 13px;
        }

        .back:hover {
            color: #2563eb;
        }

        .footer {
            margin-top: 40px;
            background: #111827;
            color: white;
            padding: 28px 7%;
        }

        .footer-inner {
            max-width: 1000px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer p {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 5px;
        }

        .logout {
            color: #f87171;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .logout:hover {
            text-decoration: underline;
        }

        @media (max-width: 750px) {
            .navbar {
                padding: 0 20px;
            }

            .nav {
                display: none;
            }

            .page-header {
                padding: 35px 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .brand span {
                display: none;
            }

            .container {
                padding: 25px 15px;
            }

            .info-card,
            .schedule {
                padding: 20px;
            }

            .schedule-row {
                flex-direction: column;
                gap: 5px;
            }

            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

        <a href="{{ route('user.dashboard') }}" class="brand">

            <div class="brand-icon">
                📚
            </div>

            <div>
                <strong>Perpustakaan</strong>

                <span>
                    Sistem Informasi Perpustakaan
                </span>
            </div>

        </a>

        <div class="nav">

            <a href="{{ route('user.dashboard') }}">
                Beranda
            </a>

            <a href="{{ route('user.buku') }}">
                Katalog
            </a>

            <a href="{{ route('user.peminjaman') }}">
                Peminjaman Saya
            </a>

            <a href="{{ route('user.informasi') }}">
                Informasi
            </a>

            <a href="{{ route('user.profile') }}">
                Profil
            </a>

        </div>

        <div class="user">

            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>

            <span style="font-size: 13px;">
                {{ Auth::user()->nama }}
            </span>

        </div>

    </nav>


    <header class="page-header">

        <div class="page-header-inner">

            <small>
                INFORMASI
            </small>

            <h1>
                Informasi Perpustakaan
            </h1>

            <p>
                Informasi mengenai layanan, jam pelayanan,
                peminjaman, dan ketentuan perpustakaan.
            </p>

        </div>

    </header>


    <main class="container">

        <div class="info-grid">

            <div class="info-card">

                <div class="info-icon">
                    🏛️
                </div>

                <h2>
                    Tentang Perpustakaan
                </h2>

                <p>
                    Sistem Informasi Perpustakaan digunakan untuk
                    membantu pengguna dalam mencari koleksi buku,
                    melihat ketersediaan buku, serta memantau
                    riwayat peminjaman.
                </p>

            </div>


            <div class="info-card">

                <div class="info-icon">
                    📚
                </div>

                <h2>
                    Layanan Perpustakaan
                </h2>

                <p>
                    Pengguna dapat melihat katalog buku,
                    mengetahui ketersediaan koleksi, serta
                    melihat informasi peminjaman melalui
                    sistem perpustakaan.
                </p>

            </div>


            <div class="info-card">

                <div class="info-icon">
                    🔎
                </div>

                <h2>
                    Pencarian Buku
                </h2>

                <p>
                    Gunakan menu Katalog Buku untuk mencari
                    koleksi berdasarkan judul, pengarang,
                    penerbit, atau ID buku.
                </p>

            </div>


            <div class="info-card">

                <div class="info-icon">
                    📖
                </div>

                <h2>
                    Peminjaman Buku
                </h2>

                <p>
                    Buku yang tersedia dapat dipinjam sesuai
                    dengan ketentuan perpustakaan. Status
                    peminjaman dapat dipantau melalui menu
                    Peminjaman Saya.
                </p>

            </div>

        </div>


        <div class="schedule">

            <h2>
                🕒 Jam Pelayanan
            </h2>

            <div class="schedule-row">
                <span>Senin</span>
                <span>07.00 – 15.00</span>
            </div>

            <div class="schedule-row">
                <span>Selasa</span>
                <span>07.00 – 15.00</span>
            </div>

            <div class="schedule-row">
                <span>Rabu</span>
                <span>07.00 – 15.00</span>
            </div>

            <div class="schedule-row">
                <span>Kamis</span>
                <span>07.00 – 15.00</span>
            </div>

            <div class="schedule-row">
                <span>Jumat</span>
                <span>07.00 – 15.00</span>
            </div>

        </div>


        <div class="schedule">

            <h2>
                📌 Ketentuan Perpustakaan
            </h2>

            <ul class="rules">

                <li>
                    Gunakan akun masing-masing saat mengakses
                    sistem perpustakaan.
                </li>

                <li>
                    Pastikan buku yang dipinjam dikembalikan
                    sesuai dengan ketentuan yang berlaku.
                </li>

                <li>
                    Periksa status buku sebelum melakukan
                    peminjaman.
                </li>

                <li>
                    Gunakan fasilitas perpustakaan dengan
                    baik dan bertanggung jawab.
                </li>

            </ul>

        </div>


        <a
            href="{{ route('user.dashboard') }}"
            class="back"
        >
            ← Kembali ke Beranda
        </a>

    </main>


    <footer class="footer">

        <div class="footer-inner">

            <div>

                <strong>
                    Perpustakaan
                </strong>

                <p>
                    Sistem Informasi Perpustakaan
                </p>

            </div>

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout"
                >
                    Keluar
                </button>

            </form>

        </div>

    </footer>

</body>
</html>