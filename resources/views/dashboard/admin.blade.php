<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Admin | Perpustakaan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f4f7fb;
            color: #172033;
        }


        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: #1d4ed8;
            color: white;
            padding: 30px 20px;
            z-index: 1000;
        }

        .logo {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 40px;
            padding-left: 10px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 8px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: rgba(255,255,255,0.8);
            padding: 13px 15px;
            border-radius: 9px;
            transition: 0.2s;
        }

        .menu a:hover,
        .menu .active {
            background: rgba(255,255,255,0.15);
            color: white;
        }

        .logout {
            margin-top: 30px;
        }

        .logout button {
            width: 100%;
            border: none;
            padding: 12px;
            border-radius: 9px;
            background: rgba(255,255,255,0.12);
            color: white;
            cursor: pointer;
            font-size: 14px;
        }

        .logout button:hover {
            background: rgba(255,255,255,0.2);
        }


        .menu-toggle {
            display: none;
            position: fixed;
            top: 15px;
            left: 15px;
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 10px;
            background: #1d4ed8;
            color: white;
            font-size: 22px;
            cursor: pointer;
            z-index: 1100;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .overlay {
            display: none;
        }


        /* =========================
           MAIN
        ========================= */

        .main {
            margin-left: 250px;
            padding: 35px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
        }

        .topbar h1 {
            font-size: 28px;
        }

        .topbar p {
            margin-top: 5px;
            color: #7b8494;
        }

        .admin-name {
            background: white;
            padding: 11px 18px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            font-size: 14px;
        }



        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .card-icon {
            font-size: 28px;
            margin-bottom: 15px;
        }

        .card h3 {
            font-size: 14px;
            color: #7b8494;
            margin-bottom: 8px;
        }

        .card .number {
            font-size: 30px;
            font-weight: bold;
        }



        .content {
            margin-top: 25px;
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        }

        .content h2 {
            margin-bottom: 10px;
        }

        .content p {
            color: #7b8494;
        }



        @media (max-width: 1100px) {

            .cards {
                grid-template-columns: repeat(2, 1fr);
            }

        }


        @media (max-width: 900px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

        }


        @media (max-width: 650px) {

            body {
                overflow-x: hidden;
            }

            .sidebar {
                position: fixed;
                left: -270px;
                top: 0;
                width: 250px;
                height: 100vh;
                padding: 25px 18px;
                transition: left 0.25s ease;
                box-shadow: 5px 0 20px rgba(0,0,0,0.15);
            }

            .sidebar.open {
                left: 0;
            }

            .menu-toggle {
                display: block;
            }

            .overlay {
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.35);
                z-index: 900;
            }

            .overlay.show {
                display: block;
            }

            .main {
                margin-left: 0;
                padding: 75px 15px 25px;
            }

            .topbar {
                margin-bottom: 22px;
                gap: 12px;
                align-items: flex-start;
            }

            .topbar h1 {
                font-size: 23px;
            }

            .topbar p {
                font-size: 13px;
                line-height: 1.5;
            }

            .admin-name {
                padding: 9px 12px;
                font-size: 12px;
                white-space: nowrap;
            }

            .cards {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .card {
                padding: 17px 15px;
                border-radius: 12px;
            }

            .card-icon {
                font-size: 23px;
                margin-bottom: 9px;
            }

            .card h3 {
                font-size: 12px;
                margin-bottom: 6px;
            }

            .card .number {
                font-size: 24px;
            }

            .content {
                margin-top: 18px;
                padding: 20px;
                border-radius: 12px;
            }

            .content h2 {
                font-size: 18px;
                line-height: 1.4;
            }

            .content p {
                font-size: 13px;
                line-height: 1.5;
            }

        }


        @media (max-width: 380px) {

            .main {
                padding-left: 12px;
                padding-right: 12px;
            }

            .topbar h1 {
                font-size: 21px;
            }

            .admin-name {
                font-size: 11px;
                padding: 8px 10px;
            }

            .card {
                padding: 15px 12px;
            }

            .card-icon {
                font-size: 21px;
            }

            .card .number {
                font-size: 22px;
            }

        }
    </style>
</head>

<body>

    <button
        class="menu-toggle"
        id="menuToggle"
        type="button"
        aria-label="Buka menu"
    >
        ☰
    </button>

    <div
        class="overlay"
        id="overlay"
    ></div>

    <aside class="sidebar" id="sidebar">

        <div class="logo">
            📚 Perpustakaan
        </div>

        <ul class="menu">

            <li>
                <a href="{{ route('admin.dashboard') }}" class="active">
                    🏠 Dashboard
                </a>
            </li>

            <li>
                <a href="{{ route('anggota.index') }}">
                    👥 Data Anggota
                </a>
            </li>

            <li>
                <a href="{{ route('buku.index') }}">
                    📚 Data Buku
                </a>
            </li>

            <li>
                <a href="{{ route('detail-buku.index') }}">
                    📖 Detail Buku
                </a>
            </li>

            <li>
                <a href="{{ route('peminjaman.index') }}">
                    🔄 Peminjaman
                </a>
            </li>

            <li>
                <a href="{{ route('laporan.index') }}">
                    📊 Laporan
                </a>
            </li>

        </ul>

        <form
            action="{{ route('logout') }}"
            method="POST"
            class="logout"
        >
            @csrf

            <button type="submit">
                🚪 Logout
            </button>
        </form>

    </aside>

    <main class="main">

        <div class="topbar">

            <div>
                <h1>Dashboard Admin</h1>

                <p>
                    Selamat datang di Sistem Informasi Perpustakaan.
                </p>
            </div>

            <div class="admin-name">
                👤 {{ Auth::user()->nama }}
            </div>

        </div>

        <div class="cards">

            <div class="card">

                <div class="card-icon">
                    📚
                </div>

                <h3>Total Buku</h3>

                <div class="number">
                    {{ $totalBuku }}
                </div>

            </div>


            <div class="card">

                <div class="card-icon">
                    👥
                </div>

                <h3>Total Anggota</h3>

                <div class="number">
                    {{ $totalAnggota }}
                </div>

            </div>


            <div class="card">

                <div class="card-icon">
                    📖
                </div>

                <h3>Buku Dipinjam</h3>

                <div class="number">
                    {{ $totalBukuDipinjam }}
                </div>

            </div>


            <div class="card">

                <div class="card-icon">
                    🔄
                </div>

                <h3>Total Peminjaman</h3>

                <div class="number">
                    {{ $totalPeminjaman }}
                </div>

            </div>

        </div>

        <div class="content">

            <h2>
                Selamat Datang, {{ Auth::user()->nama }} 👋
            </h2>

            <p>
                Gunakan menu di sebelah kiri untuk mengelola
                data perpustakaan.
            </p>

        </div>

    </main>

    <script>
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuToggle.addEventListener('click', function () {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', function () {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    </script>

</body>
</html>