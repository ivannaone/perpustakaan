<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Perpustakaan</title>

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
            position: sticky;
            top: 0;
            z-index: 10;
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
            font-size: 20px;
        }

        .brand-text strong {
            display: block;
            font-size: 17px;
        }

        .brand-text span {
            font-size: 11px;
            color: #6b7280;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            gap: 28px;
            font-size: 14px;
            color: #4b5563;
        }

        .nav-menu a:hover {
            color: #2563eb;
        }

        .nav-menu a.active {
            color: #2563eb;
            font-weight: 600;
        }

        .nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
            padding-left: 20px;
            border-left: 1px solid #e5e7eb;
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

        .hero {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
            padding: 65px 7% 75px;
            color: white;
        }

        .hero-content {
            max-width: 1100px;
            margin: auto;
        }

        .hero small {
            font-size: 14px;
            opacity: .85;
        }

        .hero h1 {
            font-size: 38px;
            margin: 12px 0;
            max-width: 650px;
            line-height: 1.2;
        }

        .hero p {
            max-width: 620px;
            line-height: 1.7;
            opacity: .9;
            margin-bottom: 28px;
        }

        .search-box {
            max-width: 700px;
            background: white;
            border-radius: 10px;
            padding: 6px;
            display: flex;
            box-shadow: 0 12px 30px rgba(0, 0, 0, .12);
        }

        .search-box input {
            flex: 1;
            border: none;
            outline: none;
            padding: 14px 16px;
            font-size: 14px;
            color: #172033;
        }

        .search-box button {
            border: none;
            background: #2563eb;
            color: white;
            padding: 0 22px;
            border-radius: 7px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-box button:hover {
            background: #1d4ed8;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 40px 20px;
        }

        .section-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .section-title h2 {
            font-size: 21px;
        }

        .section-title a {
            color: #2563eb;
            font-size: 13px;
            font-weight: bold;
        }

        .quick-menu {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 45px;
        }

        .quick-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 22px;
            transition: .2s;
        }

        .quick-card:hover {
            transform: translateY(-3px);
            border-color: #bfdbfe;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .06);
        }

        .quick-icon {
            width: 42px;
            height: 42px;
            border-radius: 9px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 14px;
        }

        .quick-card strong {
            display: block;
            margin-bottom: 5px;
            font-size: 15px;
        }

        .quick-card span {
            color: #6b7280;
            font-size: 12px;
        }

        .books {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
        }

        .book-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
        }

        .book-cover {
            height: 150px;
            border-radius: 8px;
            background: #eff6ff;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 38px;
            margin-bottom: 15px;
        }

        .book-card h3 {
            font-size: 15px;
            margin-bottom: 7px;
        }

        .book-card p {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 12px;
        }

        .available {
            display: inline-block;
            font-size: 11px;
            color: #15803d;
            background: #dcfce7;
            padding: 5px 8px;
            border-radius: 5px;
        }

        .info-section {
            margin-top: 45px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 28px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
            margin-top: 20px;
        }

        .info-item strong {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .info-item p {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.6;
        }

        .footer {
            background: #111827;
            color: white;
            padding: 30px 7%;
            margin-top: 30px;
        }

        .footer-inner {
            max-width: 1100px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .footer p {
            font-size: 12px;
            color: #9ca3af;
            margin-top: 6px;
        }

        .logout {
            color: #dc2626;
            font-size: 13px;
        }

        .logout:hover {
            text-decoration: underline;
        }

        @media (max-width: 800px) {
            .navbar {
                padding: 0 20px;
            }

            .nav-menu {
                display: none;
            }

            .hero {
                padding: 45px 20px 55px;
            }

            .hero h1 {
                font-size: 30px;
            }

            .quick-menu {
                grid-template-columns: repeat(2, 1fr);
            }

            .books {
                grid-template-columns: repeat(2, 1fr);
            }

            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .brand-text span {
                display: none;
            }

            .hero h1 {
                font-size: 26px;
            }

            .search-box button {
                padding: 0 15px;
            }

            .quick-menu,
            .books {
                grid-template-columns: 1fr;
            }

            .footer-inner {
                flex-direction: column;
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

            <div class="brand-text">
                <strong>Perpustakaan</strong>
                <span>Sistem Informasi Perpustakaan</span>
            </div>

        </a>

        <div class="nav-menu">

            <a href="{{ route('user.dashboard') }}" class="active">
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

        <div class="nav-user">

            <div class="avatar">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>

            <span style="font-size: 13px;">
                {{ Auth::user()->nama }}
            </span>

        </div>

    </nav>


    <section class="hero">

        <div class="hero-content">

            <small>
                Selamat datang di perpustakaan
            </small>

            <h1>
                Temukan buku yang ingin kamu baca.
            </h1>

            <p>
                Jelajahi koleksi buku, lihat ketersediaan,
                dan pantau peminjamanmu dengan mudah.
            </p>

            <form
                class="search-box"
                action="{{ route('user.buku') }}"
                method="GET"
            >

                <input
                    type="text"
                    name="search"
                    placeholder="Cari judul buku, pengarang, atau penerbit..."
                >

                <button type="submit">
                    Cari
                </button>

            </form>

        </div>

    </section>


    <main class="container">

        <div class="section-title">
            <h2>Akses Cepat</h2>
        </div>

        <div class="quick-menu">

            <a
                href="{{ route('user.buku') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    📚
                </div>

                <strong>
                    Katalog Buku
                </strong>

                <span>
                    Jelajahi koleksi buku
                </span>

            </a>


            <a
                href="{{ route('user.peminjaman') }}"
                class="quick-card"
            >

                <div class="quick-icon">
                    📖
                </div>

                <strong>
                    Peminjaman Saya
                </strong>

                <span>
                    Lihat buku yang dipinjam
                </span>

            </a>


            <a href="{{ route('user.profile') }}" class="quick-card">

                <div class="quick-icon">
                    👤
                </div>

                <strong>
                    Profil Saya
                </strong>

                <span>
                    Lihat informasi akun
                </span>

            </a>


            <a href="{{ route('user.informasi') }}" class="quick-card">

                <div class="quick-icon">
                    ℹ️
                </div>

                <strong>
                    Informasi
                </strong>

                <span>
                    Informasi perpustakaan
                </span>

            </a>

        </div>


        <div class="section-title">

            <h2>
                Buku Terbaru
            </h2>

            <a href="{{ route('user.buku') }}">
                Lihat semua →
            </a>

        </div>


        <div class="books">

            @forelse($bukuTerbaru as $item)

                <div class="book-card">

                    <div class="book-cover">
                        📖
                    </div>

                    <h3>
                        {{ $item->judul_buku }}
                    </h3>

                    <p>
                        {{ $item->pengarang }} · {{ $item->penerbit ?? '-' }}
                    </p>

                    @if($item->stok_tersedia > 0)
                        <span class="available">
                            Tersedia · {{ $item->stok_tersedia }} eksemplar
                        </span>
                    @else
                        <span style="display:inline-block;font-size:11px;color:#b91c1c;background:#fee2e2;padding:5px 8px;border-radius:5px;">
                            Stok Habis
                        </span>
                    @endif

                </div>

            @empty

                <div class="book-card" style="grid-column:1/-1;text-align:center;padding:30px;color:#6b7280;">
                    Belum ada data buku.
                </div>

            @endforelse

        </div>


        <div class="info-section">

            <div class="section-title">

                <h2>
                    Informasi Perpustakaan
                </h2>

            </div>

            <div class="info-grid">

                <div class="info-item">

                    <strong>
                        📅 Jam Pelayanan
                    </strong>

                    <p>
                        Senin–Jumat<br>
                        07.00 – 15.00
                    </p>

                </div>


                <div class="info-item">

                    <strong>
                        📖 Peminjaman
                    </strong>

                    <p>
                        Pilih buku yang tersedia dan
                        lakukan peminjaman melalui sistem.
                    </p>

                </div>


                <div class="info-item">

                    <strong>
                        💡 Informasi
                    </strong>

                    <p>
                        Pastikan buku dikembalikan sesuai
                        dengan ketentuan perpustakaan.
                    </p>

                </div>

            </div>

        </div>

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
                    style="background:none;border:none;cursor:pointer;"
                >
                    Keluar
                </button>

            </form>

        </div>

    </footer>

</body>
</html>