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
            width: 250px;
            height: 100vh;
            background: #1d4ed8;
            color: white;
            padding: 30px 20px;
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
        }

        @media (max-width: 900px) {
            .cards {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 650px) {
            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .main {
                margin-left: 0;
                padding: 20px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <aside class="sidebar">

        <div class="logo">
            📚 Perpustakaan
        </div>

        <ul class="menu">
            <li>
                <a href="#" class="active">🏠 Dashboard</a>
            </li>

            <li>
                <a href="{{ route('anggota.index') }}">👥 Data Anggota</a>
            </li>

            <li>
                <a href="{{ route('buku.index') }}">📚 Data Buku</a>
            </li>

            <li>
                <a href="#">📖 Detail Buku</a>
            </li>

            <li>
                <a href="#">🔄 Peminjaman</a>
            </li>

            <li>
                <a href="#">📊 Laporan</a>
            </li>
        </ul>

        <form action="{{ route('logout') }}" method="POST" class="logout">
            @csrf
            <button type="submit">🚪 Logout</button>
        </form>

    </aside>


    <main class="main">

        <div class="topbar">

            <div>
                <h1>Dashboard Admin</h1>
                <p>Selamat datang di Sistem Informasi Perpustakaan.</p>
            </div>

            <div class="admin-name">
                👤 {{ Auth::user()->nama }}
            </div>

        </div>


        <div class="cards">

            <div class="card">
                <div class="card-icon">📚</div>
                <h3>Total Buku</h3>
                <div class="number">{{ $totalBuku }}</div>
            </div>

            <div class="card">
                <div class="card-icon">👥</div>
                <h3>Total Anggota</h3>
                <div class="number">{{ $totalAnggota }}</div>
            </div>

            <div class="card">
                <div class="card-icon">📖</div>
                <h3>Buku Dipinjam</h3>
                <div class="number">0</div>
            </div>

            <div class="card">
                <div class="card-icon">🔄</div>
                <h3>Peminjaman</h3>
                <div class="number">0</div>
            </div>

        </div>


        <div class="content">

            <h2>Selamat Datang, {{ Auth::user()->nama }} 👋</h2>

            <p>
                Gunakan menu di sebelah kiri untuk mengelola
                data perpustakaan.
            </p>

        </div>

    </main>

</body>
</html>