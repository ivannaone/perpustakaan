<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi — Ruang Baca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream-50: #fdfaf5; --cream-100: #f7f1e3; --cream-200: #ede4cc;
            --brown-500: #8a6540; --sage-200: #d4dfc8; --sage-500: #6a8f52; --sage-600: #4f7039;
            --text-main: #2d2016; --text-muted: #7a6650; --border: #e8dcc8;
            --shadow-card: 0 4px 24px rgba(80,50,20,.10);
            --radius-lg: 16px; --radius-md: 10px;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: var(--cream-50); color: var(--text-main); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }

        .navbar { position: sticky; top: 0; z-index: 100; background: rgba(253,250,245,.96); backdrop-filter: blur(10px); border-bottom: 1px solid var(--border); height: 64px; display: flex; align-items: center; justify-content: space-between; padding: 0 5%; }
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
        .page-header-inner { max-width: 900px; margin: auto; }
        .page-header small { color: var(--sage-500); font-size: 12px; font-weight: 600; letter-spacing: .6px; text-transform: uppercase; }
        .page-header h1 { font-family: 'Lora', serif; font-size: 30px; margin: 8px 0; }
        .page-header p { color: var(--text-muted); font-size: 14px; }

        .container { max-width: 900px; margin: 0 auto; padding: 36px 20px; }

        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; margin-bottom: 24px; }
        .info-card { background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg); padding: 26px; transition: box-shadow .2s; }
        .info-card:hover { box-shadow: var(--shadow-card); }
        .info-icon { width: 44px; height: 44px; background: var(--cream-100); border-radius: 11px; display: flex; align-items: center; justify-content: center; font-size: 20px; margin-bottom: 14px; }
        .info-card h2 { font-family: 'Lora', serif; font-size: 17px; font-weight: 700; margin-bottom: 10px; }
        .info-card p { font-size: 13px; color: var(--text-muted); line-height: 1.75; }

        .schedule-card { background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg); padding: 28px; margin-bottom: 20px; }
        .schedule-card h2 { font-family: 'Lora', serif; font-size: 20px; margin-bottom: 20px; }
        .schedule-row { display: flex; justify-content: space-between; padding: 13px 0; border-bottom: 1px solid var(--border); font-size: 14px; }
        .schedule-row:last-child { border-bottom: none; }
        .schedule-row span:last-child { font-weight: 600; }

        .rules-card { background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg); padding: 28px; margin-bottom: 24px; }
        .rules-card h2 { font-family: 'Lora', serif; font-size: 20px; margin-bottom: 16px; }
        .rules-card ul { padding-left: 20px; }
        .rules-card li { font-size: 13px; color: var(--text-muted); line-height: 1.75; margin-bottom: 8px; }

        .back-link { display: inline-flex; align-items: center; gap: 6px; color: var(--text-muted); font-size: 14px; }
        .back-link:hover { color: var(--sage-500); }

        footer { background: #1a1008; color: white; padding: 36px 5%; margin-top: 60px; }
        .footer-inner { max-width: 1100px; margin: auto; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        .footer-brand strong { font-family: 'Lora', serif; font-size: 16px; }
        .footer-brand p { font-size: 12px; color: rgba(255,255,255,.45); margin-top: 4px; }
        .footer-logout button { background: none; border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.7); padding: 8px 18px; border-radius: 50px; cursor: pointer; font-size: 13px; }

        @media (max-width: 768px) {
            .nav-links, .nav-name { display: none; }
            .hamburger { display: block; }
            .info-grid { grid-template-columns: 1fr; }
            .footer-inner { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

<nav class="navbar">
    <a href="{{ route('user.dashboard') }}" class="nav-brand">
        <div class="nav-brand-icon">📖</div>
        <div class="nav-brand-text"><strong>Ruang Baca</strong><small>Perpustakaan</small></div>
    </a>
    <div class="nav-links">
        <a href="{{ route('user.dashboard') }}">Beranda</a>
        <a href="{{ route('user.buku') }}">Katalog</a>
        <a href="{{ route('user.peminjaman') }}">Peminjaman</a>
        <a href="{{ route('user.informasi') }}" class="active">Informasi</a>
        <a href="{{ route('user.profile') }}">Profil</a>
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
            <a href="{{ route('user.buku') }}">📚 Katalog Buku</a>
            <a href="{{ route('user.peminjaman') }}">📖 Peminjaman Saya</a>
            <a href="{{ route('user.profile') }}">👤 Profil</a>
            <a href="{{ route('user.informasi') }}" class="active">ℹ️ Informasi</a>
        </div>
        <div class="drawer-logout"><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">🚪 Keluar</button></form></div>
    </div>
</div>

<header class="page-header">
    <div class="page-header-inner">
        <small>PANDUAN &amp; LAYANAN</small>
        <h1>Informasi Perpustakaan</h1>
        <p>Jam layanan, panduan peminjaman, dan ketentuan penggunaan perpustakaan.</p>
    </div>
</header>

<main class="container">

    <div class="info-grid">
        <div class="info-card">
            <div class="info-icon">🏛️</div>
            <h2>Tentang Perpustakaan</h2>
            <p>Sistem Informasi Perpustakaan membantu pengguna mencari koleksi buku, melihat ketersediaan, dan memantau riwayat peminjaman.</p>
        </div>
        <div class="info-card">
            <div class="info-icon">📚</div>
            <h2>Layanan Perpustakaan</h2>
            <p>Tersedia katalog buku digital, pengajuan peminjaman online, dan riwayat transaksi yang dapat dipantau secara mandiri.</p>
        </div>
        <div class="info-card">
            <div class="info-icon">🔎</div>
            <h2>Cara Mencari Buku</h2>
            <p>Gunakan menu Katalog Buku untuk mencari berdasarkan judul, pengarang, penerbit, atau ID buku.</p>
        </div>
        <div class="info-card">
            <div class="info-icon">📖</div>
            <h2>Peminjaman Buku</h2>
            <p>Klik tombol Pinjam pada buku yang tersedia. Pastikan akunmu sudah terhubung ke data anggota oleh petugas.</p>
        </div>
    </div>

    <div class="schedule-card">
        <h2>🕒 Jam Pelayanan</h2>
        <div class="schedule-row"><span>Senin</span><span>07.00 – 15.00</span></div>
        <div class="schedule-row"><span>Selasa</span><span>07.00 – 15.00</span></div>
        <div class="schedule-row"><span>Rabu</span><span>07.00 – 15.00</span></div>
        <div class="schedule-row"><span>Kamis</span><span>07.00 – 15.00</span></div>
        <div class="schedule-row"><span>Jumat</span><span>07.00 – 15.00</span></div>
        <div class="schedule-row"><span>Sabtu – Minggu</span><span>Tutup</span></div>
    </div>

    <div class="rules-card">
        <h2>📌 Ketentuan Penggunaan</h2>
        <ul>
            <li>Gunakan akun masing-masing saat mengakses sistem perpustakaan.</li>
            <li>Pastikan buku yang dipinjam dikembalikan sesuai ketentuan yang berlaku.</li>
            <li>Periksa status ketersediaan buku sebelum mengajukan peminjaman.</li>
            <li>Hubungi petugas jika akun belum terhubung ke data anggota.</li>
            <li>Gunakan fasilitas perpustakaan dengan baik dan bertanggung jawab.</li>
        </ul>
    </div>

    <a href="{{ route('user.dashboard') }}" class="back-link">← Kembali ke Beranda</a>

</main>

<footer>
    <div class="footer-inner">
        <div class="footer-brand"><strong>📖 Ruang Baca</strong><p>Sistem Informasi Perpustakaan</p></div>
        <div class="footer-logout"><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">🚪 Keluar</button></form></div>
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
