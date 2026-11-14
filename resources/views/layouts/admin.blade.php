<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') — PustakaLog</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --cream-50: #fdfaf5; --cream-100: #f7f1e3; --cream-200: #ede4cc;
            --brown-500: #8a6540; --navy-500: #1e3a5f; --navy-600: #162d4a; --navy-400: #2a5080;
            --sage-500: #6a8f52; --sage-600: #4f7039;
            --text-main: #1a1a2e; --text-muted: #64748b; --border: #e2e8f0;
            --shadow: 0 2px 12px rgba(30,58,95,.08);
            --radius-lg: 14px; --radius-md: 9px; --sidebar-w: 240px;
        }
        body { font-family: 'Inter', system-ui, sans-serif; background: #f4f7fb; color: var(--text-main); min-height: 100vh; }
        a { text-decoration: none; color: inherit; }
        button, input, select, textarea { font-family: inherit; }
        .ico { width: 18px; height: 18px; flex-shrink: 0; }
        .sidebar { position: fixed; left: 0; top: 0; width: var(--sidebar-w); height: 100vh; background: var(--navy-500); color: white; display: flex; flex-direction: column; z-index: 100; overflow-y: auto; }
        .sidebar-brand { padding: 24px 20px 16px; border-bottom: 1px solid rgba(255,255,255,.08); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand-icon { width: 36px; height: 36px; background: rgba(255,255,255,.12); border-radius: 9px; display: flex; align-items: center; justify-content: center; }
        .sidebar-brand-text strong { display: block; font-family: 'Lora', serif; font-size: 16px; }
        .sidebar-brand-text small { font-size: 10px; opacity: .6; letter-spacing: .5px; text-transform: uppercase; }
        .sidebar-section-label { padding: 20px 20px 8px; font-size: 10px; font-weight: 600; letter-spacing: .8px; text-transform: uppercase; opacity: .45; }
        .sidebar-menu { padding: 0 12px; }
        .sidebar-menu a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: var(--radius-md); font-size: 14px; font-weight: 500; color: rgba(255,255,255,.75); margin-bottom: 2px; transition: background .15s, color .15s; }
        .sidebar-menu a:hover { background: rgba(255,255,255,.08); color: white; }
        .sidebar-menu a.active { background: rgba(255,255,255,.14); color: white; }
        .sidebar-footer { margin-top: auto; padding: 16px 12px 20px; border-top: 1px solid rgba(255,255,255,.08); }
        .sidebar-footer form button { width: 100%; display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: var(--radius-md); background: none; border: none; cursor: pointer; font-size: 14px; color: rgba(255,255,255,.65); }
        .sidebar-footer form button:hover { background: rgba(255,255,255,.08); color: white; }
        .menu-toggle { display: none; position: fixed; top: 14px; left: 14px; width: 40px; height: 40px; background: var(--navy-500); color: white; border: none; border-radius: 10px; cursor: pointer; z-index: 150; align-items: center; justify-content: center; }
        .overlay { display: none; position: fixed; inset: 0; background: rgba(0,0,0,.35); z-index: 90; }
        .overlay.show { display: block; }
        .main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; min-width: 0; }
        .topbar { background: white; border-bottom: 1px solid var(--border); padding: 0 28px; min-height: 64px; display: flex; align-items: center; justify-content: space-between; gap: 16px; position: sticky; top: 0; z-index: 50; }
        .topbar-left h1 { font-size: 18px; font-weight: 650; letter-spacing: -.01em; }
        .topbar-left .breadcrumb { font-size: 12px; color: var(--text-muted); margin-top: 2px; }
        .topbar-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--cream-200); color: var(--brown-500); display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; border: 2px solid var(--border); }
        .content { flex: 1; padding: 28px; min-width: 0; }
        .page-intro { display: flex; justify-content: space-between; align-items: flex-end; gap: 16px; margin-bottom: 18px; flex-wrap: wrap; }
        .page-intro h2 { font-family: 'Lora', serif; font-size: 26px; font-weight: 650; }
        .page-intro p { color: var(--text-muted); font-size: 14px; margin-top: 4px; max-width: 640px; }
        .toolbar { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; }
        .card { background: white; border: 1px solid var(--border); border-radius: var(--radius-lg); box-shadow: var(--shadow); }
        .card-pad { padding: 22px; }
        .alert { border-radius: 10px; padding: 12px 14px; margin-bottom: 16px; font-size: 14px; }
        .alert-success { background: #eef6e8; color: #3f6212; border: 1px solid #d4dfc8; }
        .alert-error { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }
        .note { background: var(--cream-50); border: 1px solid var(--cream-200); color: #5c4632; border-radius: 12px; padding: 12px 14px; font-size: 13px; line-height: 1.6; margin-bottom: 16px; }
        .filters { display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 16px; }
        .filters input, .filters select, .field input, .field select, .field textarea {
            width: 100%; padding: 11px 14px; border: 1.5px solid var(--border); border-radius: var(--radius-md);
            font-size: 14px; color: var(--text-main); background: white; outline: none;
        }
        .filters input { min-width: min(100%, 280px); flex: 1; }
        .filters select { width: auto; min-width: 180px; }
        .filters input:focus, .filters select:focus, .field input:focus, .field select:focus, .field textarea:focus {
            border-color: var(--navy-400); box-shadow: 0 0 0 3px rgba(42,80,128,.12);
        }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 7px; padding: 10px 18px; border-radius: 999px; font-size: 14px; font-weight: 600; border: 1.5px solid transparent; cursor: pointer; background: white; color: var(--text-main); transition: background .15s, transform .15s; }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--navy-500); color: white; }
        .btn-primary:hover { background: var(--navy-600); }
        .btn-secondary { background: white; border-color: var(--border); }
        .btn-secondary:hover { background: #f8fafc; }
        .btn-sage { background: var(--sage-500); color: white; }
        .btn-sage:hover { background: var(--sage-600); }
        .btn-danger { background: white; color: #b91c1c; border-color: #fecaca; }
        .btn-danger:hover { background: #fef2f2; }
        .btn-sm { padding: 7px 12px; font-size: 12px; }
        .table-card { overflow: hidden; }
        .table-scroll { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 760px; }
        th { text-align: left; font-size: 12px; letter-spacing: .04em; text-transform: uppercase; color: var(--text-muted); background: #f8fafc; padding: 12px 14px; border-bottom: 1px solid var(--border); white-space: nowrap; }
        td { padding: 13px 14px; border-bottom: 1px solid #eef2f6; font-size: 14px; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        .code { background: #f1f5f9; padding: 2px 7px; border-radius: 6px; font-size: 12px; }
        .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 650; white-space: nowrap; }
        .badge-dipinjam { background: #f7f1e3; color: #8a6540; }
        .badge-dikembalikan, .badge-ada { background: #eef6e8; color: #3f6212; }
        .badge-off { background: #f1f5f9; color: #64748b; }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; align-items: center; }
        .empty { text-align: center; padding: 36px 16px; color: var(--text-muted); }
        .stats { display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px; margin-bottom: 18px; }
        .stat { padding: 16px 18px; }
        .stat span { display: block; font-size: 12px; color: var(--text-muted); margin-bottom: 6px; }
        .stat strong { font-family: 'Lora', serif; font-size: 28px; font-weight: 650; }
        .bars { display: grid; gap: 12px; }
        .bar-row { display: grid; grid-template-columns: 140px 1fr auto; gap: 12px; align-items: center; font-size: 13px; }
        .bar-track { height: 8px; background: #eef2f6; border-radius: 999px; overflow: hidden; }
        .bar-fill { height: 100%; background: var(--navy-500); border-radius: 999px; }
        .bar-fill.sage { background: var(--sage-500); }
        .bar-fill.brown { background: var(--brown-500); }
        .form-card { max-width: 820px; }
        .form-section { margin-top: 8px; }
        .form-section + .form-section { margin-top: 22px; padding-top: 8px; }
        .form-section h3 { font-family: 'Lora', serif; font-size: 18px; margin-bottom: 4px; }
        .form-section .section-copy { color: var(--text-muted); font-size: 13px; margin-bottom: 14px; }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .field.full { grid-column: 1 / -1; }
        .field label { display: block; font-size: 13px; font-weight: 650; margin-bottom: 7px; }
        .req { color: #dc2626; }
        .hint, .field-error { font-size: 12px; margin-top: 5px; }
        .hint { color: var(--text-muted); }
        .field-error { color: #dc2626; }
        .form-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 22px; padding-top: 18px; border-top: 1px solid var(--border); }
        .detail-layout { display: grid; grid-template-columns: 280px 1fr; gap: 18px; align-items: start; }
        .cover-plate { aspect-ratio: 3/4; border-radius: 16px; background: linear-gradient(165deg, #1e3a5f, #2a5080 55%, #6a8f52); color: white; display: flex; flex-direction: column; justify-content: flex-end; padding: 22px; }
        .cover-plate strong { font-family: 'Lora', serif; font-size: 22px; line-height: 1.3; }
        .cover-plate span { opacity: .8; font-size: 13px; margin-top: 8px; }
        .meta-list { display: grid; grid-template-columns: 140px 1fr; gap: 10px 14px; font-size: 14px; }
        .meta-list dt { color: var(--text-muted); }
        footer.admin-foot { background: white; border-top: 1px solid var(--border); padding: 14px 28px; font-size: 13px; color: var(--text-muted); }
        .print-only { display: none; }
        @media (max-width: 900px) {
            .stats, .detail-layout, .form-grid, .bar-row { grid-template-columns: 1fr; }
            .bar-row { gap: 6px; }
        }
        @media (max-width: 768px) {
            .sidebar { left: calc(-1 * var(--sidebar-w)); transition: left .25s ease; }
            .sidebar.open { left: 0; }
            .main { margin-left: 0; }
            .menu-toggle { display: flex; }
            .topbar { padding-left: 68px; }
            .content { padding: 18px 14px 28px; }
        }
        @media print {
            .sidebar, .topbar, .menu-toggle, .overlay, .no-print, footer.admin-foot { display: none !important; }
            .main { margin: 0; }
            body { background: white; }
            .content { padding: 0; }
            .card { box-shadow: none; }
            .print-only { display: block; margin-bottom: 16px; }
            .print-only h1 { font-family: 'Lora', serif; font-size: 22px; }
            .print-only p { color: #444; font-size: 12px; margin-top: 4px; }
            table { min-width: 0; }
            a { color: inherit; }
        }
    </style>
    @yield('styles')
</head>
<body>
@php($activeMenu = trim($__env->yieldContent('active')))
<button class="menu-toggle" id="menuToggle" type="button" aria-label="Buka menu">
    <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
</button>
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-icon">
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
        </div>
        <div class="sidebar-brand-text"><strong>PustakaLog</strong><small>Admin Panel</small></div>
    </div>
    <div class="sidebar-section-label">Menu Utama</div>
    <nav class="sidebar-menu">
        <a href="{{ route('admin.dashboard') }}" @class(['active' => $activeMenu === 'dashboard'])>
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 10.5 12 4l8 6.5V20a1 1 0 0 1-1 1h-5v-6H10v6H5a1 1 0 0 1-1-1z"/></svg>
            Dashboard
        </a>
        <a href="{{ route('buku.index') }}" @class(['active' => $activeMenu === 'buku'])>
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
            Data Buku
        </a>
        <a href="{{ route('detail-buku.index') }}" @class(['active' => $activeMenu === 'detail'])>
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/></svg>
            Detail Buku
        </a>
        <a href="{{ route('anggota.index') }}" @class(['active' => $activeMenu === 'anggota'])>
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="3"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            Data Anggota
        </a>
        <a href="{{ route('peminjaman.index') }}" @class(['active' => $activeMenu === 'peminjaman'])>
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17 1v4M7 1v4M3 8h18M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z"/></svg>
            Peminjaman
        </a>
    </nav>
    <div class="sidebar-section-label">Lainnya</div>
    <nav class="sidebar-menu">
        <a href="{{ route('admin.users') }}" @class(['active' => $activeMenu === 'users'])>
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/></svg>
            Kelola Akun User
        </a>
        <a href="{{ route('laporan.index') }}" @class(['active' => $activeMenu === 'laporan'])>
            <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V5M4 19h16"/><path d="M8 16v-5M12 16V8M16 16v-3"/></svg>
            Laporan
        </a>
    </nav>
    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">
                <svg class="ico" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4M16 17l5-5-5-5M21 12H9"/></svg>
                Keluar
            </button>
        </form>
    </div>
</aside>
<div class="main">
    <header class="topbar">
        <div class="topbar-left">
            <h1>@yield('heading')</h1>
            <div class="breadcrumb">@yield('crumb')</div>
        </div>
        <div class="topbar-avatar" title="{{ Auth::user()->nama }}">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
    </header>
    <main class="content">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @yield('content')
    </main>
    <footer class="admin-foot">&copy; {{ date('Y') }} PustakaLog — Sistem Informasi Perpustakaan</footer>
</div>
<script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');
    menuToggle.addEventListener('click', () => { sidebar.classList.add('open'); overlay.classList.add('show'); });
    function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('show'); }
</script>
@yield('scripts')
</body>
</html>
