<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Katalog Buku - Perpustakaan</title>

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
            padding: 40px 7%;
        }

        .page-header-inner {
            max-width: 1100px;
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
        }

        .container {
            max-width: 1100px;
            margin: auto;
            padding: 35px 20px;
        }

        .search-area {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px;
            margin-bottom: 30px;
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input {
            flex: 1;
            padding: 13px 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .search-form input:focus {
            border-color: #2563eb;
        }

        .search-form button {
            border: none;
            background: #2563eb;
            color: white;
            border-radius: 8px;
            padding: 0 22px;
            cursor: pointer;
            font-weight: bold;
        }

        .search-form button:hover {
            background: #1d4ed8;
        }

        .result-info {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 18px;
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
            overflow: hidden;
            transition: .2s;
        }

        .book-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0, 0, 0, .07);
        }

        .book-cover {
            height: 155px;
            background: #eff6ff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 45px;
        }

        .book-content {
            padding: 17px;
        }

        .book-content h2 {
            font-size: 15px;
            line-height: 1.4;
            margin-bottom: 9px;
        }

        .book-content p {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 6px;
        }

        .status {
            display: inline-block;
            margin-top: 9px;
            padding: 5px 8px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: bold;
        }

        .status.available {
            background: #dcfce7;
            color: #15803d;
        }

        .status.empty {
            background: #fee2e2;
            color: #b91c1c;
        }

        .empty {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 50px 20px;
            text-align: center;
            color: #6b7280;
        }

        .pagination {
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        .pagination nav {
            display: flex;
            gap: 5px;
        }

        .pagination a,
        .pagination span {
            padding: 8px 12px;
            border: 1px solid #e5e7eb;
            border-radius: 6px;
            background: white;
            font-size: 13px;
        }

        .pagination .active span {
            background: #2563eb;
            color: white;
            border-color: #2563eb;
        }

        .footer {
            margin-top: 40px;
            background: #111827;
            color: white;
            padding: 28px 7%;
        }

        .footer-inner {
            max-width: 1100px;
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

        @media (max-width: 900px) {
            .books {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 700px) {
            .navbar {
                padding: 0 20px;
            }

            .nav {
                display: none;
            }

            .page-header {
                padding: 35px 20px;
            }

            .books {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .brand span {
                display: none;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form button {
                height: 43px;
            }

            .books {
                grid-template-columns: 1fr;
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

            <a href="{{ route('user.buku') }}" class="active">
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
                KOLEKSI PERPUSTAKAAN
            </small>

            <h1>
                Katalog Buku
            </h1>

            <p>
                Temukan buku yang tersedia di perpustakaan.
            </p>

        </div>

    </header>


    <main class="container">

        <div class="search-area">

            <form
                action="{{ route('user.buku') }}"
                method="GET"
                class="search-form"
            >

                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari judul, pengarang, penerbit, atau ID buku..."
                >

                <button type="submit">
                    Cari
                </button>

            </form>

        </div>


        <div class="result-info">

            @if($search)

                Hasil pencarian untuk:
                <strong>{{ $search }}</strong>

            @else

                Menampilkan koleksi buku perpustakaan

            @endif

        </div>


        @if($buku->count())

            <div class="books">

                @foreach($buku as $item)

                    <div class="book-card">

                        <div class="book-cover">
                            📖
                        </div>

                        <div class="book-content">

                            <h2>
                                {{ $item->judul_buku }}
                            </h2>

                            <p>
                                Pengarang:
                                {{ $item->pengarang }}
                            </p>

                            <p>
                                Penerbit:
                                {{ $item->penerbit ?? '-' }}
                            </p>

                            <p>
                                Tahun:
                                {{ $item->tahun_terbit ?? '-' }}
                            </p>

                            @if($item->jumlah > 0)

                                <span class="status available">
                                    Tersedia · {{ $item->jumlah }} buku
                                </span>

                            @else

                                <span class="status empty">
                                    Tidak tersedia
                                </span>

                            @endif

                        </div>

                    </div>

                @endforeach

            </div>

            <div class="pagination">
                {{ $buku->links() }}
            </div>

        @else

            <div class="empty">

                <div style="font-size:40px;margin-bottom:12px;">
                    🔎
                </div>

                <strong>
                    Buku tidak ditemukan
                </strong>

                <p style="margin-top:7px;">
                    Coba gunakan kata kunci pencarian yang berbeda.
                </p>

            </div>

        @endif

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