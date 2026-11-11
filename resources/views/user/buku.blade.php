<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Buku — Ruang Baca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream-50: #fdfaf5; --cream-100: #f7f1e3; --cream-200: #ede4cc;
            --brown-500: #8a6540; --brown-600: #704f2e;
            --sage-200: #d4dfc8; --sage-400: #8aab70; --sage-500: #6a8f52; --sage-600: #4f7039;
            --text-main: #2d2016; --text-muted: #7a6650;
            --border: #e8dcc8;
            --shadow: 0 2px 12px rgba(80,50,20,.08);
            --shadow-card: 0 4px 24px rgba(80,50,20,.10);
            --radius-lg: 16px; --radius-md: 10px;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: var(--cream-50); color: var(--text-main); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(253,250,245,.96); backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border); height: 64px;
            display: flex; align-items: center; justify-content: space-between; padding: 0 5%;
        }
        .nav-brand { display: flex; align-items: center; gap: 10px; }
        .nav-brand-icon { width: 36px; height: 36px; background: var(--sage-500); color: white; border-radius: 9px; display: flex; align-items: center; justify-content: center; font-size: 17px; }
        .nav-brand-text strong { font-family: 'Lora', serif; font-size: 17px; }
        .nav-brand-text small { display: block; font-size: 10px; color: var(--text-muted); letter-spacing: .5px; text-transform: uppercase; }
        .nav-links { display: flex; align-items: center; gap: 4px; }
        .nav-links a { padding: 7px 14px; border-radius: 50px; font-size: 14px; font-weight: 500; color: var(--text-muted); transition: color .2s, background .2s; }
        .nav-links a:hover { color: var(--text-main); background: var(--cream-100); }
        .nav-links a.active { color: var(--sage-600); background: var(--sage-200); font-weight: 600; }
        .nav-user { display: flex; align-items: center; gap: 10px; }
        .nav-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--cream-200); color: var(--brown-500); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; border: 2px solid var(--border); }
        .nav-name { font-size: 14px; font-weight: 500; }
        .hamburger { display: none; background: none; border: none; font-size: 22px; cursor: pointer; color: var(--text-main); padding: 6px; }
        .mobile-drawer { display: none; position: fixed; inset: 0; z-index: 200; }
        .drawer-overlay { position: absolute; inset: 0; background: rgba(0,0,0,.35); }
        .drawer-panel { position: absolute; top: 0; right: 0; width: 260px; height: 100%; background: var(--cream-50); padding: 28px 24px; box-shadow: -4px 0 24px rgba(0,0,0,.12); display: flex; flex-direction: column; gap: 8px; transform: translateX(100%); transition: transform .28s ease; }
        .mobile-drawer.open { display: block; }
        .mobile-drawer.open .drawer-panel { transform: translateX(0); }
        .drawer-close { align-self: flex-end; background: none; border: none; font-size: 22px; cursor: pointer; color: var(--text-muted); margin-bottom: 8px; }
        .drawer-nav a { display: block; padding: 12px 16px; border-radius: var(--radius-md); font-size: 15px; font-weight: 500; color: var(--text-muted); transition: background .15s; }
        .drawer-nav a:hover, .drawer-nav a.active { background: var(--cream-100); color: var(--sage-600); }
        .drawer-logout { margin-top: auto; }
        .drawer-logout button { width: 100%; padding: 11px; border-radius: var(--radius-md); background: none; border: 1.5px solid var(--border); color: var(--text-muted); font-size: 14px; cursor: pointer; }

        .page-header { background: white; border-bottom: 1px solid var(--border); padding: 36px 5%; }
        .page-header-inner { max-width: 1100px; margin: auto; }
        .page-header small { color: var(--sage-500); font-size: 12px; font-weight: 600; letter-spacing: .6px; text-transform: uppercase; }
        .page-header h1 { font-family: 'Lora', serif; font-size: 30px; margin: 8px 0; }
        .page-header p { color: var(--text-muted); font-size: 14px; }

        .container { max-width: 1100px; margin: 0 auto; padding: 36px 20px; }

        .alert-warning { background: #fefce8; border: 1px solid #fde68a; color: #92400e; border-radius: var(--radius-md); padding: 14px 18px; font-size: 13px; margin-bottom: 24px; display: flex; align-items: center; gap: 10px; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: var(--radius-md); padding: 14px 18px; font-size: 13px; margin-bottom: 24px; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: var(--radius-md); padding: 14px 18px; font-size: 13px; margin-bottom: 24px; }

        .search-bar {
            background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg);
            padding: 16px 20px; margin-bottom: 28px;
            display: flex; gap: 10px;
        }
        .search-bar input {
            flex: 1; border: none; outline: none; font-family: 'Inter', sans-serif;
            font-size: 14px; color: var(--text-main); background: transparent;
        }
        .search-bar button {
            padding: 10px 22px; background: var(--sage-500); color: white;
            border: none; border-radius: 50px; cursor: pointer;
            font-weight: 600; font-size: 14px; transition: background .2s;
        }
        .search-bar button:hover { background: var(--sage-600); }

        .result-info { font-size: 13px; color: var(--text-muted); margin-bottom: 20px; }

        .books-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; }

        .book-card {
            background: white; border: 1.5px solid var(--border);
            border-radius: var(--radius-lg); overflow: hidden;
            transition: transform .2s, box-shadow .2s;
            display: flex; flex-direction: column;
        }
        .book-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-card); }

        .book-cover {
            height: 155px; background: var(--cream-100);
            display: flex; align-items: center; justify-content: center;
            font-size: 46px; border-bottom: 1px solid var(--border);
        }
        .book-body { padding: 16px; flex: 1; display: flex; flex-direction: column; }
        .book-title { font-family: 'Lora', serif; font-size: 15px; font-weight: 600; line-height: 1.4; margin-bottom: 6px; }
        .book-meta { font-size: 12px; color: var(--text-muted); margin-bottom: 5px; }
        .book-footer { margin-top: auto; padding-top: 12px; }

        .badge { display: inline-block; padding: 4px 10px; border-radius: 50px; font-size: 11px; font-weight: 600; }
        .badge-available { background: #dcfce7; color: #166534; }
        .badge-empty     { background: #fee2e2; color: #991b1b; }

        .btn-pinjam {
            display: block; width: 100%; margin-top: 10px; padding: 9px;
            border: none; border-radius: 50px; cursor: pointer;
            font-family: 'Inter', sans-serif; font-size: 13px; font-weight: 600;
            background: var(--sage-500); color: white;
            transition: background .2s, transform .15s;
        }
        .btn-pinjam:hover { background: var(--sage-600); transform: translateY(-1px); }
        .btn-pinjam:disabled { background: var(--cream-200); color: var(--text-muted); cursor: not-allowed; transform: none; }

        .empty-state {
            text-align: center; padding: 60px 20px; color: var(--text-muted);
            background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg);
        }
        .empty-state .empty-icon { font-size: 44px; margin-bottom: 14px; }

        .pagination-wrap { margin-top: 36px; display: flex; justify-content: center; }

        footer { background: #1a1008; color: white; padding: 36px 5%; margin-top: 60px; }
        .footer-inner { max-width: 1100px; margin: auto; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        .footer-brand strong { font-family: 'Lora', serif; font-size: 16px; }
        .footer-brand p { font-size: 12px; color: rgba(255,255,255,.45); margin-top: 4px; }
        .footer-logout button { background: none; border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.7); padding: 8px 18px; border-radius: 50px; cursor: pointer; font-size: 13px; transition: all .2s; }
        .footer-logout button:hover { background: rgba(255,255,255,.08); color: white; }

        @media (max-width: 1024px) { .books-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-name { display: none; }
            .hamburger { display: block; }
            .books-grid { grid-template-columns: repeat(2, 1fr); }
            .footer-inner { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 480px) { .books-grid { grid-template-columns: 1fr; } .search-bar { flex-direction: column; } }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('user.dashboard') }}" class="nav-brand">
        <div class="nav-brand-icon">📖</div>
        <div class="nav-brand-text">
            <strong>Ruang Baca</strong>
            <small>Perpustakaan</small>
        </div>
    </a>
    <div class="nav-links">
        <a href="{{ route('user.dashboard') }}">Beranda</a>
        <a href="{{ route('user.buku') }}" class="active">Katalog</a>
        <a href="{{ route('user.peminjaman') }}">Peminjaman</a>
        <a href="{{ route('user.informasi') }}">Informasi</a>
    </div>
    <div class="nav-user">
        <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
        <span class="nav-name">{{ Auth::user()->nama }}</span>
        <button class="hamburger" id="hamburgerBtn">☰</button>
    </div>
</nav>

<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-overlay" onclick="closeDrawer()"></div>
    <div class="drawer-panel">
        <button class="drawer-close" onclick="closeDrawer()">✕</button>
        <div style="display:flex;align-items:center;gap:10px;padding:0 4px 16px;border-bottom:1px solid var(--border);margin-bottom:8px;">
            <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
            <span style="font-size:14px;font-weight:600;">{{ Auth::user()->nama }}</span>
        </div>
        <div class="drawer-nav">
            <a href="{{ route('user.dashboard') }}">🏠 Beranda</a>
            <a href="{{ route('user.buku') }}" class="active">📚 Katalog Buku</a>
            <a href="{{ route('user.peminjaman') }}">📖 Peminjaman Saya</a>
            <a href="{{ route('user.profile') }}">👤 Profil</a>
            <a href="{{ route('user.informasi') }}">ℹ️ Informasi</a>
        </div>
        <div class="drawer-logout">
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">🚪 Keluar</button></form>
        </div>
    </div>
</div>

<header class="page-header">
    <div class="page-header-inner">
        <small>KOLEKSI PERPUSTAKAAN</small>
        <h1>Katalog Buku</h1>
        <p>Temukan dan pinjam buku yang tersedia di perpustakaan.</p>
    </div>
</header>

<main class="container">

    @if(!$sudahTerhubung)
        <div class="alert-warning">
            <span style="font-size:18px;">⚠️</span>
            <span>Akun kamu belum terhubung ke data anggota. Hubungi petugas perpustakaan agar bisa mengajukan peminjaman.</span>
        </div>
    @endif

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">✕ {{ session('error') }}</div>
    @endif

    <div class="search-bar">
        <form action="{{ route('user.buku') }}" method="GET" style="display:flex;flex:1;gap:10px;">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul, pengarang, penerbit, atau ID buku...">
            <button type="submit">🔎 Cari</button>
        </form>
    </div>

    <div class="result-info">
        @if($search)
            Hasil pencarian untuk: <strong>{{ $search }}</strong>
        @else
            Menampilkan semua koleksi perpustakaan
        @endif
    </div>

    @if($buku->count())
        <div class="books-grid">
            @foreach($buku as $item)
                <div class="book-card">
                    <div class="book-cover">📘</div>
                    <div class="book-body">
                        <div class="book-title">{{ $item->judul_buku }}</div>
                        <div class="book-meta">{{ $item->pengarang }}</div>
                        @if($item->penerbit)
                            <div class="book-meta">{{ $item->penerbit }}@if($item->tahun_terbit), {{ $item->tahun_terbit }}@endif</div>
                        @endif
                        <div class="book-footer">
                            @if($item->stok_tersedia > 0)
                                <span class="badge badge-available">Tersedia · {{ $item->stok_tersedia }} eksemplar</span>
                                @if($sudahTerhubung)
                                    <form action="{{ route('user.pinjam', $item->id_buku) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-pinjam">Pinjam Buku</button>
                                    </form>
                                @else
                                    <button type="button" class="btn-pinjam" disabled>Pinjam Buku</button>
                                @endif
                            @else
                                <span class="badge badge-empty">Stok Habis</span>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-wrap">{{ $buku->links() }}</div>
    @else
        <div class="empty-state">
            <div class="empty-icon">🔎</div>
            <strong style="font-size:17px;">Buku tidak ditemukan</strong>
            <p style="margin-top:8px;font-size:14px;">Coba gunakan kata kunci yang berbeda.</p>
        </div>
    @endif

</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <strong>📖 Ruang Baca</strong>
            <p>Sistem Informasi Perpustakaan</p>
        </div>
        <div class="footer-logout">
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">🚪 Keluar</button></form>
        </div>
    </div>
</footer>

<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileDrawer = document.getElementById('mobileDrawer');
    hamburgerBtn.addEventListener('click', () => { mobileDrawer.classList.add('open'); document.body.style.overflow = 'hidden'; });
    function closeDrawer() { mobileDrawer.classList.remove('open'); document.body.style.overflow = ''; }
</script>
</body>
</html>
