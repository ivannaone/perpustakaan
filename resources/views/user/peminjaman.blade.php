<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya — Ruang Baca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream-50: #fdfaf5; --cream-100: #f7f1e3; --cream-200: #ede4cc;
            --brown-500: #8a6540; --brown-600: #704f2e;
            --sage-200: #d4dfc8; --sage-500: #6a8f52; --sage-600: #4f7039;
            --text-main: #2d2016; --text-muted: #7a6650;
            --border: #e8dcc8;
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

        .alert-box { border-radius: var(--radius-md); padding: 16px 20px; margin-bottom: 24px; font-size: 14px; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; }
        .alert-info    { background: #eff6ff; border: 1px solid #bfdbfe; color: #1e40af; }

        .empty-state { text-align: center; padding: 60px 20px; color: var(--text-muted); background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg); }
        .empty-state .empty-icon { font-size: 48px; margin-bottom: 16px; }
        .empty-state h3 { font-family: 'Lora', serif; font-size: 20px; color: var(--text-main); margin-bottom: 8px; }
        .btn-link { display: inline-block; margin-top: 16px; padding: 11px 24px; background: var(--sage-500); color: white; border-radius: 50px; font-size: 14px; font-weight: 600; transition: background .2s; }
        .btn-link:hover { background: var(--sage-600); }

        .loan-card {
            background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg);
            padding: 24px; margin-bottom: 16px;
            display: grid; grid-template-columns: auto 1fr auto;
            gap: 20px; align-items: start;
            transition: box-shadow .2s;
        }
        .loan-card:hover { box-shadow: var(--shadow-card); }
        .loan-cover {
            width: 56px; height: 72px; background: var(--cream-100);
            border-radius: 8px; display: flex; align-items: center; justify-content: center;
            font-size: 28px; border: 1px solid var(--border); flex-shrink: 0;
        }
        .loan-info {}
        .loan-title { font-family: 'Lora', serif; font-size: 17px; font-weight: 600; margin-bottom: 6px; }
        .loan-meta { font-size: 13px; color: var(--text-muted); line-height: 1.8; }
        .loan-meta span { display: inline-block; }
        .loan-status { display: flex; flex-direction: column; align-items: flex-end; gap: 8px; }
        .badge { display: inline-block; padding: 5px 12px; border-radius: 50px; font-size: 12px; font-weight: 600; }
        .badge-dipinjam   { background: #dbeafe; color: #1d4ed8; }
        .badge-kembali    { background: #dcfce7; color: #166534; }

        .pagination-wrap { margin-top: 36px; display: flex; justify-content: center; }

        footer { background: #1a1008; color: white; padding: 36px 5%; margin-top: 60px; }
        .footer-inner { max-width: 1100px; margin: auto; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        .footer-brand strong { font-family: 'Lora', serif; font-size: 16px; }
        .footer-brand p { font-size: 12px; color: rgba(255,255,255,.45); margin-top: 4px; }
        .footer-logout button { background: none; border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.7); padding: 8px 18px; border-radius: 50px; cursor: pointer; font-size: 13px; }

        @media (max-width: 768px) {
            .nav-links, .nav-name { display: none; }
            .hamburger { display: block; }
            .loan-card { grid-template-columns: auto 1fr; }
            .loan-status { align-items: flex-start; flex-direction: row; flex-wrap: wrap; }
            .footer-inner { flex-direction: column; align-items: flex-start; }
        }
        @media (max-width: 480px) {
            .loan-card { grid-template-columns: 1fr; }
            .loan-cover { width: 48px; height: 60px; }
        }
    </style>
</head>
<body>

@include('partials.ruang-nav', ['nav' => 'peminjaman'])

<header class="page-header">
    <div class="page-header-inner">
        <small>RIWAYAT PEMINJAMAN</small>
        <h1>Peminjaman Saya</h1>
        <p>Daftar buku yang sedang dan pernah kamu pinjam.</p>
    </div>
</header>

<main class="container">

    @if(session('success'))
        <div class="alert-box alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-box alert-error">✕ {{ session('error') }}</div>
    @endif

    @if(!empty($tidakTerhubung))
        <div class="empty-state">
            <div class="empty-icon">🔗</div>
            <h3>Akun belum terhubung</h3>
            <p>Akun kamu belum dikaitkan dengan data anggota perpustakaan.<br>Hubungi petugas untuk menghubungkan akunmu.</p>
            <a href="{{ route('user.informasi') }}" class="btn-link">Lihat Informasi</a>
        </div>

    @elseif($peminjaman->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">📚</div>
            <h3>Belum ada peminjaman</h3>
            <p>Kamu belum memiliki riwayat peminjaman buku.</p>
            <a href="{{ route('user.buku') }}" class="btn-link">Jelajahi Katalog</a>
        </div>

    @else
        @foreach($peminjaman as $item)
            <div class="loan-card">
                <div class="loan-cover">📘</div>
                <div class="loan-info">
                    <div class="loan-title">{{ $item->detailBuku->buku->judul_buku ?? '-' }}</div>
                    <div class="loan-meta">
                        <span>No. Eksemplar: <strong>{{ $item->no_buku }}</strong></span><br>
                        <span>Tanggal Pinjam: {{ $item->tgl_pinjam?->format('d M Y') ?? '-' }}</span><br>
                        <span>
                            Tanggal Kembali:
                            @if($item->tgl_kembali)
                                {{ $item->tgl_kembali->format('d M Y') }}
                            @else
                                <em>Belum dikembalikan</em>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="loan-status">
                    @if($item->status === 'dipinjam')
                        <span class="badge badge-dipinjam">Sedang Dipinjam</span>
                    @else
                        <span class="badge badge-kembali">Sudah Dikembalikan</span>
                    @endif
                </div>
            </div>
        @endforeach
        <div class="pagination-wrap">{{ $peminjaman->links() }}</div>
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
