<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya — Ruang Baca</title>
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

        .profile-grid { display: grid; grid-template-columns: 280px 1fr; gap: 24px; }

        .profile-sidebar {
            background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg);
            padding: 32px 24px; text-align: center;
        }
        .avatar-big {
            width: 90px; height: 90px; border-radius: 50%;
            background: var(--cream-200); color: var(--brown-500);
            display: flex; align-items: center; justify-content: center;
            font-size: 36px; font-weight: 700; margin: 0 auto 16px;
            border: 3px solid var(--border);
        }
        .profile-name { font-family: 'Lora', serif; font-size: 20px; font-weight: 700; margin-bottom: 4px; }
        .profile-username { font-size: 14px; color: var(--text-muted); margin-bottom: 14px; }
        .role-badge { display: inline-block; padding: 5px 14px; border-radius: 50px; background: var(--sage-200); color: var(--sage-600); font-size: 12px; font-weight: 600; margin-bottom: 20px; }
        .profile-actions { display: flex; flex-direction: column; gap: 8px; margin-top: 8px; }
        .btn-action {
            padding: 10px 16px; border-radius: 50px; font-size: 13px; font-weight: 600;
            border: 1.5px solid var(--border); background: none; color: var(--text-muted);
            cursor: pointer; transition: all .2s; text-align: center; display: block;
        }
        .btn-action:hover { border-color: var(--sage-400); color: var(--sage-600); background: var(--sage-200); }
        .btn-logout { color: #dc2626; border-color: #fecaca; }
        .btn-logout:hover { background: #fee2e2; border-color: #fca5a5; color: #b91c1c; }

        .info-row { display: flex; align-items: flex-start; padding: 14px 0; border-bottom: 1px solid var(--border); gap: 16px; }
        .info-row:last-of-type { border-bottom: none; }
        .info-label { font-size: 12px; font-weight: 600; color: var(--text-muted); text-transform: uppercase; letter-spacing: .4px; min-width: 120px; padding-top: 2px; }
        .info-value { font-size: 14px; }

        .form-card { background: white; border: 1.5px solid var(--border); border-radius: var(--radius-lg); padding: 28px; }
        .form-card h2 { font-family: 'Lora', serif; font-size: 20px; margin-bottom: 4px; }
        .form-card p { font-size: 13px; color: var(--text-muted); margin-bottom: 24px; }

        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; color: #166534; border-radius: var(--radius-md); padding: 12px 16px; font-size: 13px; margin-bottom: 20px; }
        .alert-error   { background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: var(--radius-md); padding: 12px 16px; font-size: 13px; margin-bottom: 20px; }

        .form-group { margin-bottom: 18px; }
        .form-group label { display: block; font-size: 13px; font-weight: 600; color: var(--text-main); margin-bottom: 7px; }
        .form-group input {
            width: 100%; padding: 12px 16px; border: 1.5px solid var(--cream-200);
            border-radius: var(--radius-md); background: white;
            font-family: 'Inter', sans-serif; font-size: 14px; color: var(--text-main);
            outline: none; transition: border-color .2s, box-shadow .2s;
        }
        .form-group input:focus { border-color: var(--sage-400); box-shadow: 0 0 0 3px rgba(138,171,112,.15); }
        .form-group input.readonly { background: var(--cream-100); color: var(--text-muted); cursor: not-allowed; }
        .field-error { font-size: 12px; color: #dc2626; margin-top: 5px; }

        .btn-save {
            padding: 12px 28px; background: var(--brown-500); color: white;
            border: none; border-radius: 50px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: background .2s, transform .15s;
        }
        .btn-save:hover { background: var(--brown-600); transform: translateY(-1px); }

        footer { background: #1a1008; color: white; padding: 36px 5%; margin-top: 60px; }
        .footer-inner { max-width: 1100px; margin: auto; display: flex; justify-content: space-between; align-items: center; gap: 20px; }
        .footer-brand strong { font-family: 'Lora', serif; font-size: 16px; }
        .footer-brand p { font-size: 12px; color: rgba(255,255,255,.45); margin-top: 4px; }
        .footer-logout button { background: none; border: 1px solid rgba(255,255,255,.2); color: rgba(255,255,255,.7); padding: 8px 18px; border-radius: 50px; cursor: pointer; font-size: 13px; }

        @media (max-width: 768px) {
            .nav-links, .nav-name { display: none; }
            .hamburger { display: block; }
            .profile-grid { grid-template-columns: 1fr; }
            .footer-inner { flex-direction: column; align-items: flex-start; }
        }
    </style>
</head>
<body>

@include('partials.ruang-nav', ['nav' => 'profil'])

<header class="page-header">
    <div class="page-header-inner">
        <small>AKUN SAYA</small>
        <h1>Profil Saya</h1>
        <p>Kelola informasi akun perpustakaan kamu.</p>
    </div>
</header>

<main class="container">

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert-error">
            <strong>Terjadi kesalahan:</strong>
            <ul style="margin: 6px 0 0 16px;">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div class="profile-grid">

        <aside class="profile-sidebar">
            <div class="avatar-big">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</div>
            <div class="profile-name">{{ Auth::user()->nama }}</div>
            <div class="profile-username">@{{ Auth::user()->username }}</div>
            <span class="role-badge">{{ ucfirst(Auth::user()->role) }}</span>
            <div class="profile-actions">
                <a href="{{ route('user.peminjaman') }}" class="btn-action">📖 Peminjaman Saya</a>
                <a href="{{ route('user.buku') }}" class="btn-action">📚 Katalog Buku</a>
                <form action="{{ route('logout') }}" method="POST" style="margin-top:8px;">
                    @csrf
                    <button type="submit" class="btn-action btn-logout">🚪 Keluar</button>
                </form>
            </div>
        </aside>

        <div>
            <div class="form-card" style="margin-bottom:20px;">
                <h2>Informasi Akun</h2>
                <p>Detail akun yang terdaftar di sistem.</p>
                <div class="info-row">
                    <span class="info-label">Nama Lengkap</span>
                    <span class="info-value">{{ Auth::user()->nama }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Username</span>
                    <span class="info-value">{{ Auth::user()->username }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Role</span>
                    <span class="info-value">{{ ucfirst(Auth::user()->role) }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">ID Anggota</span>
                    <span class="info-value">
                        @if(Auth::user()->id_anggota)
                            {{ Auth::user()->id_anggota }}
                            @if(Auth::user()->anggota)
                                — {{ Auth::user()->anggota->nama_anggota }}
                            @endif
                        @else
                            <em style="color:var(--text-muted);">Belum terhubung ke data anggota</em>
                        @endif
                    </span>
                </div>
            </div>

            <div class="form-card">
                <h2>Perbarui Profil</h2>
                <p>Ubah nama atau username akun kamu.</p>
                <form action="{{ route('user.profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', Auth::user()->nama) }}" required>
                        @error('nama') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" required>
                        @error('username') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <input type="text" value="{{ ucfirst(Auth::user()->role) }}" class="readonly" readonly>
                    </div>
                    <button type="submit" class="btn-save">Simpan Perubahan</button>
                </form>
            </div>
        </div>

    </div>
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
