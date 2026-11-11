<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — PustakaLog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream-50:  #fdfaf5;
            --cream-100: #f7f1e3;
            --cream-200: #ede4cc;
            --brown-500: #8a6540;
            --sage-200:  #d4dfc8;
            --sage-500:  #6a8f52;
            --navy-500:  #1e3a5f;
            --navy-600:  #162d4a;
            --navy-400:  #2a5080;
            --text-main: #1a1a2e;
            --text-muted:#64748b;
            --border:    #e2e8f0;
            --sidebar-w: 240px;
            --shadow:    0 2px 12px rgba(30,58,95,.08);
            --shadow-card: 0 4px 20px rgba(30,58,95,.10);
            --radius-lg: 14px;
            --radius-md: 9px;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: #f1f5f9; color: var(--text-main); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        .sidebar {
            position: fixed; left: 0; top: 0; width: var(--sidebar-w);
            height: 100vh; background: var(--navy-500); color: white;
            display: flex; flex-direction: column; z-index: 100;
            overflow-y: auto;
        }
        .sidebar-brand {
            padding: 24px 20px 16px;
            border-bottom: 1px solid rgba(255,255,255,.08);
            display: flex; align-items: center; gap: 10px;
        }
        .sidebar-brand-icon {
            width: 36px; height: 36px; background: rgba(255,255,255,.12);
            border-radius: 9px; display: flex; align-items: center; justify-content: center;
            font-size: 17px;
        }
        .sidebar-brand-text strong { display: block; font-family: 'Lora', serif; font-size: 16px; }
        .sidebar-brand-text small  { font-size: 10px; opacity: .6; letter-spacing: .5px; text-transform: uppercase; }

        .sidebar-section-label {
            padding: 20px 20px 8px;
            font-size: 10px; font-weight: 600; letter-spacing: .8px;
            text-transform: uppercase; opacity: .45;
        }
        .sidebar-menu { padding: 0 12px; }
        .sidebar-menu a {
            display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: var(--radius-md);
            font-size: 14px; font-weight: 500; color: rgba(255,255,255,.75);
            margin-bottom: 2px; transition: background .15s, color .15s;
        }
        .sidebar-menu a:hover { background: rgba(255,255,255,.08); color: white; }
        .sidebar-menu a.active { background: rgba(255,255,255,.14); color: white; }
        .sidebar-menu a .icon { font-size: 16px; width: 20px; text-align: center; }

        .sidebar-footer {
            margin-top: auto; padding: 16px 12px 20px;
            border-top: 1px solid rgba(255,255,255,.08);
        }
        .sidebar-footer form button {
            width: 100%; display: flex; align-items: center; gap: 10px;
            padding: 10px 12px; border-radius: var(--radius-md);
            background: none; border: none; cursor: pointer;
            font-size: 14px; color: rgba(255,255,255,.65);
            font-family: 'Inter', sans-serif; transition: background .15s;
        }
        .sidebar-footer form button:hover { background: rgba(255,255,255,.08); color: white; }

        .menu-toggle {
            display: none; position: fixed; top: 14px; left: 14px;
            width: 40px; height: 40px; background: var(--navy-500); color: white;
            border: none; border-radius: 10px; cursor: pointer;
            font-size: 18px; z-index: 150; box-shadow: 0 2px 8px rgba(0,0,0,.2);
        }
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.35); z-index: 90; }

        .main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex; flex-direction: column;
        }
        .topbar {
            background: white; border-bottom: 1px solid var(--border);
            padding: 0 28px; height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50; box-shadow: var(--shadow);
        }
        .topbar-left h1 { font-size: 20px; font-weight: 700; }
        .topbar-left p { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
        .topbar-right { display: flex; align-items: center; gap: 12px; }
        .topbar-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--cream-200); color: var(--brown-500);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; border: 2px solid var(--border);
        }
        .topbar-name { font-size: 14px; font-weight: 500; }

        .content { flex: 1; padding: 28px; }

        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px; margin-bottom: 28px; }
        .stat-card {
            background: white; border-radius: var(--radius-lg); padding: 22px 20px;
            border: 1px solid var(--border); display: flex; flex-direction: column; gap: 14px;
            transition: box-shadow .2s;
        }
        .stat-card:hover { box-shadow: var(--shadow-card); }
        .stat-header { display: flex; align-items: center; justify-content: space-between; }
        .stat-label { font-size: 13px; color: var(--text-muted); font-weight: 500; }
        .stat-icon { width: 38px; height: 38px; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 18px; }
        .icon-blue   { background: #dbeafe; }
        .icon-green  { background: #dcfce7; }
        .icon-amber  { background: #fef3c7; }
        .icon-purple { background: #ede9fe; }
        .stat-number { font-size: 32px; font-weight: 700; line-height: 1; }

        .row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

        .card { background: white; border-radius: var(--radius-lg); border: 1px solid var(--border); overflow: hidden; }
        .card-header { padding: 18px 22px 0; display: flex; align-items: center; justify-content: space-between; }
        .card-title { font-size: 16px; font-weight: 700; }
        .card-link { font-size: 13px; color: var(--navy-400); font-weight: 600; }
        .card-link:hover { text-decoration: underline; }
        .card-body { padding: 18px 22px; }

        .quick-nav { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .quick-nav-item {
            display: flex; align-items: center; gap: 12px;
            padding: 14px; border-radius: var(--radius-md);
            border: 1.5px solid var(--border);
            background: var(--cream-50);
            transition: border-color .15s, background .15s;
        }
        .quick-nav-item:hover { border-color: var(--navy-400); background: white; }
        .quick-nav-icon { font-size: 20px; }
        .quick-nav-text strong { display: block; font-size: 13px; font-weight: 600; }
        .quick-nav-text span { font-size: 12px; color: var(--text-muted); }

        .info-list { display: flex; flex-direction: column; gap: 0; }
        .info-row { display: flex; justify-content: space-between; align-items: center; padding: 12px 0; border-bottom: 1px solid var(--border); font-size: 14px; }
        .info-row:last-child { border-bottom: none; }
        .info-row-label { color: var(--text-muted); }
        .info-row-val { font-weight: 600; }

        footer { background: white; border-top: 1px solid var(--border); padding: 16px 28px; font-size: 13px; color: var(--text-muted); }

        @media (max-width: 1100px) { .stats-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 900px) {
            .row-2 { grid-template-columns: 1fr; }
        }
        @media (max-width: 768px) {
            .sidebar { left: calc(-1 * var(--sidebar-w)); transition: left .25s ease; }
            .sidebar.open { left: 0; }
            .overlay.show { display: block; }
            .main { margin-left: 0; }
            .menu-toggle { display: flex; align-items: center; justify-content: center; }
            .topbar { padding-left: 68px; }
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: 1fr; }
            .quick-nav { grid-template-columns: 1fr; }
            .content { padding: 16px; }
        }
    </style>
</head>
<body>

<button class="menu-toggle" id="menuToggle">☰</button>
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>

<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">📚</div>
        <div class="sidebar-brand-text">
            <strong>PustakaLog</strong>
            <small>Admin Panel</small>
        </div>
    </div>

    <div class="sidebar-section-label">Menu Utama</div>
    <nav class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" class="active">
            <span class="icon">🏠</span> Dashboard
        </a>
        <a href="{{ route('buku.index') }}">
            <span class="icon">📚</span> Data Buku
        </a>
        <a href="{{ route('detail-buku.index') }}">
            <span class="icon">📖</span> Detail Buku
        </a>
        <a href="{{ route('anggota.index') }}">
            <span class="icon">👥</span> Data Anggota
        </a>
        <a href="{{ route('peminjaman.index') }}">
            <span class="icon">🔄</span> Peminjaman
        </a>
    </nav>

    <div class="sidebar-section-label">Lainnya</div>
    <nav class="sidebar-menu">
        <a href="{{ route('admin.users') }}">
            <span class="icon">🔗</span> Kelola Akun User
        </a>
        <a href="{{ route('laporan.index') }}">
            <span class="icon">📊</span> Laporan
        </a>
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <span class="icon">🚪</span> Keluar
            </button>
        </form>
    </div>
</aside>

<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <h1>Dashboard</h1>
            <p>Selamat datang kembali, {{ Auth::user()->nama }}</p>
        </div>
        <div class="topbar-right">
            <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
            <span class="topbar-name">{{ Auth::user()->nama }}</span>
        </div>
    </header>

    <main class="content">

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Total Buku</span>
                    <span class="stat-icon icon-blue">📚</span>
                </div>
                <div class="stat-number">{{ $totalBuku }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Total Anggota</span>
                    <span class="stat-icon icon-green">👥</span>
                </div>
                <div class="stat-number">{{ $totalAnggota }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Buku Dipinjam</span>
                    <span class="stat-icon icon-amber">📖</span>
                </div>
                <div class="stat-number">{{ $totalBukuDipinjam }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-header">
                    <span class="stat-label">Total Transaksi</span>
                    <span class="stat-icon icon-purple">🔄</span>
                </div>
                <div class="stat-number">{{ $totalPeminjaman }}</div>
            </div>
        </div>

        <div class="row-2">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Akses Cepat</span>
                </div>
                <div class="card-body">
                    <div class="quick-nav">
                        <a href="{{ route('buku.create') }}" class="quick-nav-item">
                            <span class="quick-nav-icon">➕</span>
                            <div class="quick-nav-text">
                                <strong>Tambah Buku</strong>
                                <span>Input data buku baru</span>
                            </div>
                        </a>
                        <a href="{{ route('anggota.create') }}" class="quick-nav-item">
                            <span class="quick-nav-icon">👤</span>
                            <div class="quick-nav-text">
                                <strong>Tambah Anggota</strong>
                                <span>Daftarkan anggota baru</span>
                            </div>
                        </a>
                        <a href="{{ route('peminjaman.create') }}" class="quick-nav-item">
                            <span class="quick-nav-icon">📋</span>
                            <div class="quick-nav-text">
                                <strong>Catat Peminjaman</strong>
                                <span>Transaksi peminjaman</span>
                            </div>
                        </a>
                        <a href="{{ route('laporan.index') }}" class="quick-nav-item">
                            <span class="quick-nav-icon">📊</span>
                            <div class="quick-nav-text">
                                <strong>Lihat Laporan</strong>
                                <span>PDF &amp; Excel</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="card-title">Ringkasan Sistem</span>
                </div>
                <div class="card-body">
                    <div class="info-list">
                        <div class="info-row">
                            <span class="info-row-label">Total Buku Koleksi</span>
                            <span class="info-row-val">{{ $totalBuku }} judul</span>
                        </div>
                        <div class="info-row">
                            <span class="info-row-label">Total Anggota Terdaftar</span>
                            <span class="info-row-val">{{ $totalAnggota }} orang</span>
                        </div>
                        <div class="info-row">
                            <span class="info-row-label">Buku Sedang Dipinjam</span>
                            <span class="info-row-val">{{ $totalBukuDipinjam }} eksemplar</span>
                        </div>
                        <div class="info-row">
                            <span class="info-row-label">Total Transaksi Peminjaman</span>
                            <span class="info-row-val">{{ $totalPeminjaman }} transaksi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <footer>
        &copy; {{ date('Y') }} PustakaLog — Sistem Informasi Perpustakaan
    </footer>
</div>

<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar    = document.getElementById('sidebar');
    const overlay    = document.getElementById('overlay');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.add('open');
        overlay.classList.add('show');
    });

    function closeSidebar() {
        sidebar.classList.remove('open');
        overlay.classList.remove('show');
    }
</script>
</body>
</html>
