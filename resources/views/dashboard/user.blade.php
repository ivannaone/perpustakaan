<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda — Ruang Baca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream-50:  #fdfaf5;
            --cream-100: #f7f1e3;
            --cream-200: #ede4cc;
            --brown-400: #a07850;
            --brown-500: #8a6540;
            --brown-600: #704f2e;
            --sage-200:  #d4dfc8;
            --sage-400:  #8aab70;
            --sage-500:  #6a8f52;
            --sage-600:  #4f7039;
            --text-main: #2d2016;
            --text-muted:#7a6650;
            --border:    #e8dcc8;
            --shadow:    0 2px 12px rgba(80,50,20,.08);
            --shadow-card: 0 4px 24px rgba(80,50,20,.10);
            --radius-lg: 16px;
            --radius-md: 10px;
            --radius-sm: 6px;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: var(--cream-50); color: var(--text-main); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        .navbar {
            position: sticky; top: 0; z-index: 100;
            background: rgba(253,250,245,.96);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--border);
            height: 64px;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 5%;
            transition: box-shadow .2s;
        }
        .navbar.scrolled { box-shadow: var(--shadow); }

        .nav-brand { display: flex; align-items: center; gap: 10px; }
        .nav-brand-icon {
            width: 36px; height: 36px;
            background: var(--sage-500); color: white;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            font-size: 17px;
        }
        .nav-brand-text strong { font-family: 'Lora', serif; font-size: 17px; font-weight: 700; }
        .nav-brand-text small { display: block; font-size: 10px; color: var(--text-muted); letter-spacing: .5px; text-transform: uppercase; }

        .nav-links {
            display: flex; align-items: center; gap: 4px;
        }
        .nav-links a {
            padding: 7px 14px; border-radius: 50px;
            font-size: 14px; font-weight: 500; color: var(--text-muted);
            transition: color .2s, background .2s;
        }
        .nav-links a:hover { color: var(--text-main); background: var(--cream-100); }
        .nav-links a.active { color: var(--sage-600); background: var(--sage-200); font-weight: 600; }

        .nav-user { display: flex; align-items: center; gap: 10px; }
        .nav-avatar {
            width: 36px; height: 36px; border-radius: 50%;
            background: var(--cream-200); color: var(--brown-500);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 14px; border: 2px solid var(--border);
        }
        .nav-name { font-size: 14px; font-weight: 500; }

        .hamburger {
            display: none; background: none; border: none;
            font-size: 22px; cursor: pointer; color: var(--text-main);
            padding: 6px;
        }

        .mobile-drawer {
            display: none; position: fixed; inset: 0; z-index: 200;
        }
        .drawer-overlay {
            position: absolute; inset: 0;
            background: rgba(0,0,0,.35);
        }
        .drawer-panel {
            position: absolute; top: 0; right: 0;
            width: 260px; height: 100%;
            background: var(--cream-50);
            padding: 28px 24px;
            box-shadow: -4px 0 24px rgba(0,0,0,.12);
            display: flex; flex-direction: column; gap: 8px;
            transform: translateX(100%);
            transition: transform .28s ease;
        }
        .mobile-drawer.open { display: block; }
        .mobile-drawer.open .drawer-panel { transform: translateX(0); }
        .drawer-close {
            align-self: flex-end; background: none; border: none;
            font-size: 22px; cursor: pointer; color: var(--text-muted);
            margin-bottom: 8px;
        }
        .drawer-nav a {
            display: block; padding: 12px 16px; border-radius: var(--radius-md);
            font-size: 15px; font-weight: 500; color: var(--text-muted);
            transition: background .15s, color .15s;
        }
        .drawer-nav a:hover, .drawer-nav a.active {
            background: var(--cream-100); color: var(--sage-600);
        }
        .drawer-logout {
            margin-top: auto;
        }
        .drawer-logout button {
            width: 100%; padding: 11px; border-radius: var(--radius-md);
            background: none; border: 1.5px solid var(--border);
            color: var(--text-muted); font-size: 14px; cursor: pointer;
        }

        .hero {
            background: linear-gradient(160deg, #2d1a0a 0%, #1a3a1a 60%, #3d2810 100%);
            padding: 72px 5% 80px;
            color: white;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse 60% 80% at 80% 50%, rgba(138,171,112,.15) 0%, transparent 65%);
        }
        .hero-inner { max-width: 1100px; margin: auto; position: relative; z-index: 1; }
        .hero-tag {
            display: inline-block;
            background: rgba(138,171,112,.2); border: 1px solid rgba(138,171,112,.4);
            color: #b8d49a; border-radius: 50px;
            padding: 5px 14px; font-size: 12px; font-weight: 600;
            letter-spacing: .5px; text-transform: uppercase;
            margin-bottom: 18px;
        }
        .hero h1 {
            font-family: 'Lora', serif;
            font-size: 46px; font-weight: 700;
            line-height: 1.18; max-width: 580px;
            margin-bottom: 16px;
        }
        .hero h1 em { font-style: italic; color: #b8d49a; }
        .hero p {
            font-size: 16px; line-height: 1.75; opacity: .82;
            max-width: 540px; margin-bottom: 32px;
        }
        .hero-search {
            display: flex; gap: 0; max-width: 520px;
            background: white; border-radius: 50px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0,0,0,.2);
        }
        .hero-search input {
            flex: 1; padding: 14px 20px;
            border: none; outline: none;
            font-family: 'Inter', sans-serif; font-size: 14px;
            color: var(--text-main); background: transparent;
        }
        .hero-search button {
            padding: 0 24px;
            background: var(--sage-500); color: white;
            border: none; cursor: pointer; font-weight: 600; font-size: 14px;
            transition: background .2s;
        }
        .hero-search button:hover { background: var(--sage-600); }

        .container { max-width: 1100px; margin: auto; padding: 0 20px; }

        .section { padding: 52px 0; }
        .section-header {
            display: flex; align-items: center; justify-content: space-between;
            margin-bottom: 28px;
        }
        .section-title {
            font-family: 'Lora', serif; font-size: 24px; font-weight: 700;
        }
        .section-link {
            font-size: 13px; font-weight: 600; color: var(--sage-500);
            padding: 7px 16px; border-radius: 50px;
            border: 1.5px solid var(--sage-200);
            transition: background .2s;
        }
        .section-link:hover { background: var(--sage-200); }

        .quick-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;
        }
        .quick-card {
            background: white; border: 1.5px solid var(--border);
            border-radius: var(--radius-lg); padding: 22px 20px;
            transition: transform .2s, box-shadow .2s, border-color .2s;
            cursor: pointer;
        }
        .quick-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-card);
            border-color: var(--sage-200);
        }
        .quick-icon {
            width: 44px; height: 44px; border-radius: 11px;
            background: var(--cream-100);
            display: flex; align-items: center; justify-content: center;
            font-size: 20px; margin-bottom: 14px;
        }
        .quick-card strong { display: block; font-size: 15px; margin-bottom: 5px; }
        .quick-card span { font-size: 12px; color: var(--text-muted); }

        .books-grid {
            display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;
        }
        .book-card {
            background: white; border: 1.5px solid var(--border);
            border-radius: var(--radius-lg); overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .book-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-card); }
        .book-cover {
            height: 160px; background: var(--cream-100);
            display: flex; align-items: center; justify-content: center;
            font-size: 48px; border-bottom: 1px solid var(--border);
            position: relative;
        }
        .book-body { padding: 16px; }
        .book-title { font-family: 'Lora', serif; font-size: 15px; font-weight: 600; line-height: 1.4; margin-bottom: 6px; }
        .book-author { font-size: 12px; color: var(--text-muted); margin-bottom: 10px; }
        .badge {
            display: inline-block; padding: 4px 10px; border-radius: 50px;
            font-size: 11px; font-weight: 600;
        }
        .badge-available { background: #dcfce7; color: #166534; }
        .badge-empty     { background: #fee2e2; color: #991b1b; }

        .info-strip {
            background: white; border: 1.5px solid var(--border);
            border-radius: var(--radius-lg); padding: 32px 36px;
            margin-bottom: 52px;
        }
        .info-strip h2 {
            font-family: 'Lora', serif; font-size: 20px;
            margin-bottom: 20px;
        }
        .info-cols { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
        .info-item strong { display: block; font-size: 14px; margin-bottom: 8px; }
        .info-item p { font-size: 13px; color: var(--text-muted); line-height: 1.65; }

        footer {
            background: #1a1008; color: white;
            padding: 40px 5%;
        }
        .footer-inner {
            max-width: 1100px; margin: auto;
            display: flex; justify-content: space-between;
            align-items: flex-start; gap: 32px;
        }
        .footer-brand strong {
            font-family: 'Lora', serif; font-size: 18px;
            display: flex; align-items: center; gap: 8px;
        }
        .footer-brand p { font-size: 13px; color: rgba(255,255,255,.5); margin-top: 6px; }
        .footer-links { display: flex; flex-direction: column; gap: 8px; }
        .footer-links a { font-size: 13px; color: rgba(255,255,255,.6); transition: color .2s; }
        .footer-links a:hover { color: white; }
        .footer-logout button {
            background: none; border: 1px solid rgba(255,255,255,.2);
            color: rgba(255,255,255,.7); padding: 9px 20px; border-radius: 50px;
            cursor: pointer; font-size: 13px; transition: all .2s;
        }
        .footer-logout button:hover { background: rgba(255,255,255,.08); color: white; }
        .footer-copy {
            max-width: 1100px; margin: 24px auto 0;
            padding-top: 20px; border-top: 1px solid rgba(255,255,255,.08);
            font-size: 12px; color: rgba(255,255,255,.35);
        }

        @media (max-width: 1024px) {
            .quick-grid { grid-template-columns: repeat(2, 1fr); }
            .books-grid { grid-template-columns: repeat(3, 1fr); }
        }

        @media (max-width: 768px) {
            .nav-links { display: none; }
            .nav-name { display: none; }
            .hamburger { display: block; }
            .hero h1 { font-size: 32px; }
            .hero { padding: 52px 5% 60px; }
            .books-grid { grid-template-columns: repeat(2, 1fr); }
            .info-cols { grid-template-columns: 1fr; }
            .footer-inner { flex-direction: column; gap: 24px; }
        }

        @media (max-width: 480px) {
            .hero h1 { font-size: 26px; }
            .hero-search { border-radius: var(--radius-md); }
            .books-grid { grid-template-columns: 1fr; }
            .quick-grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>

<nav class="navbar" id="navbar">
    <a href="{{ route('user.dashboard') }}" class="nav-brand">
        <div class="nav-brand-icon">📖</div>
        <div class="nav-brand-text">
            <strong>Ruang Baca</strong>
            <small>Perpustakaan</small>
        </div>
    </a>

    <div class="nav-links">
        <a href="{{ route('user.dashboard') }}" class="active">Beranda</a>
        <a href="{{ route('user.buku') }}">Katalog</a>
        <a href="{{ route('user.peminjaman') }}">Peminjaman</a>
        <a href="{{ route('user.informasi') }}">Informasi</a>
    </div>

    <div class="nav-user">
        <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
        <span class="nav-name">{{ Auth::user()->nama }}</span>
        <button class="hamburger" id="hamburgerBtn" aria-label="Menu">☰</button>
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
            <a href="{{ route('user.dashboard') }}" class="active">🏠 Beranda</a>
            <a href="{{ route('user.buku') }}">📚 Katalog Buku</a>
            <a href="{{ route('user.peminjaman') }}">📖 Peminjaman Saya</a>
            <a href="{{ route('user.profile') }}">👤 Profil</a>
            <a href="{{ route('user.informasi') }}">ℹ️ Informasi</a>
        </div>
        <div class="drawer-logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">🚪 Keluar</button>
            </form>
        </div>
    </div>
</div>

<section class="hero">
    <div class="hero-inner">
        <div class="hero-tag">✦ Ruang Baca Perpustakaan</div>
        <h1>Temukan Cerita,<br><em>Perluas Wawasan.</em></h1>
        <p>Jelajahi koleksi buku, lihat ketersediaan, dan ajukan peminjaman dengan mudah dari mana saja.</p>
        <form class="hero-search" action="{{ route('user.buku') }}" method="GET">
            <input type="text" name="search" placeholder="Cari judul, pengarang, atau penerbit...">
            <button type="submit">Cari</button>
        </form>
    </div>
</section>

<div class="container">
    <div class="section">
        <div class="section-header">
            <h2 class="section-title">Akses Cepat</h2>
        </div>
        <div class="quick-grid">
            <a href="{{ route('user.buku') }}" class="quick-card">
                <div class="quick-icon">📚</div>
                <strong>Katalog Buku</strong>
                <span>Jelajahi semua koleksi</span>
            </a>
            <a href="{{ route('user.peminjaman') }}" class="quick-card">
                <div class="quick-icon">📖</div>
                <strong>Peminjaman Saya</strong>
                <span>Lihat buku yang dipinjam</span>
            </a>
            <a href="{{ route('user.profile') }}" class="quick-card">
                <div class="quick-icon">👤</div>
                <strong>Profil Saya</strong>
                <span>Kelola informasi akun</span>
            </a>
            <a href="{{ route('user.informasi') }}" class="quick-card">
                <div class="quick-icon">ℹ️</div>
                <strong>Informasi</strong>
                <span>Jam layanan &amp; aturan</span>
            </a>
        </div>
    </div>

    <div class="section" style="padding-top:0;">
        <div class="section-header">
            <h2 class="section-title">Koleksi Terbaru</h2>
            <a href="{{ route('user.buku') }}" class="section-link">Lihat semua →</a>
        </div>

        @if($bukuTerbaru->count())
            <div class="books-grid">
                @foreach($bukuTerbaru as $buku)
                    <div class="book-card">
                        <div class="book-cover">📘</div>
                        <div class="book-body">
                            <div class="book-title">{{ $buku->judul_buku }}</div>
                            <div class="book-author">{{ $buku->pengarang }}@if($buku->penerbit) · {{ $buku->penerbit }}@endif</div>
                            @if($buku->stok_tersedia > 0)
                                <span class="badge badge-available">Tersedia · {{ $buku->stok_tersedia }} eks</span>
                            @else
                                <span class="badge badge-empty">Stok Habis</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align:center;padding:40px 20px;color:var(--text-muted);">
                Belum ada koleksi buku tersedia.
            </div>
        @endif
    </div>

    <div class="info-strip">
        <h2>📋 Informasi Perpustakaan</h2>
        <div class="info-cols">
            <div class="info-item">
                <strong>📅 Jam Pelayanan</strong>
                <p>Senin – Jumat<br>07.00 – 15.00 WIB</p>
            </div>
            <div class="info-item">
                <strong>📖 Peminjaman Buku</strong>
                <p>Ajukan peminjaman lewat Katalog. Pastikan akunmu sudah terhubung ke data anggota.</p>
            </div>
            <div class="info-item">
                <strong>↩️ Pengembalian</strong>
                <p>Kembalikan buku tepat waktu sesuai ketentuan perpustakaan.</p>
            </div>
        </div>
    </div>
</div>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <strong>📖 Ruang Baca</strong>
            <p>Sistem Informasi Perpustakaan</p>
        </div>
        <div class="footer-links">
            <a href="{{ route('user.buku') }}">Katalog Buku</a>
            <a href="{{ route('user.peminjaman') }}">Peminjaman Saya</a>
            <a href="{{ route('user.informasi') }}">Informasi</a>
        </div>
        <div class="footer-logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">🚪 Keluar</button>
            </form>
        </div>
    </div>
    <div class="footer-copy">
        &copy; {{ date('Y') }} Ruang Baca — Sistem Informasi Perpustakaan. Hak cipta dilindungi.
    </div>
</footer>

<script>
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileDrawer = document.getElementById('mobileDrawer');

    hamburgerBtn.addEventListener('click', () => {
        mobileDrawer.classList.add('open');
        document.body.style.overflow = 'hidden';
    });

    function closeDrawer() {
        mobileDrawer.classList.remove('open');
        document.body.style.overflow = '';
    }

    window.addEventListener('scroll', () => {
        const navbar = document.getElementById('navbar');
        navbar.classList.toggle('scrolled', window.scrollY > 10);
    });
</script>
</body>
</html>
