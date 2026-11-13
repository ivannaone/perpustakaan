@php
    $nav = $nav ?? '';
    $isGuest = !auth()->check();
    $nama = $isGuest ? '' : auth()->user()->nama;
    $initial = $isGuest ? '?' : strtoupper(substr($nama, 0, 1));
@endphp
<style>
    .nav-profile { display: flex; align-items: center; gap: 10px; padding: 3px 8px 3px 3px; border-radius: 999px; color: inherit; }
    .nav-profile:hover { background: var(--cream-100); }
    .navbar { height: auto; min-height: 64px; }
    .btn-masuk {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 20px; border-radius: 50px;
        background: var(--brown-500); color: white;
        font-size: 14px; font-weight: 600;
        border: none; cursor: pointer; font-family: 'Inter', sans-serif;
        transition: background .2s;
        text-decoration: none;
        position: relative;
    }
    .btn-masuk:hover { background: var(--brown-600); }
    .login-dropdown {
        position: absolute; top: calc(100% + 10px); right: 0;
        background: white; border: 1.5px solid var(--border);
        border-radius: 14px; padding: 8px;
        min-width: 200px;
        box-shadow: 0 8px 32px rgba(80,50,20,.14);
        display: none; flex-direction: column; gap: 4px;
        z-index: 300;
    }
    .login-dropdown.open { display: flex; }
    .login-dropdown a {
        display: flex; align-items: center; gap: 10px;
        padding: 11px 14px; border-radius: 9px;
        font-size: 14px; color: var(--text-main);
        transition: background .15s;
        text-decoration: none;
    }
    .login-dropdown a:hover { background: var(--cream-100); }
    .login-dropdown .sep { height: 1px; background: var(--border); margin: 2px 0; }
    .login-dropdown .login-label {
        font-size: 11px; font-weight: 600; color: var(--text-muted);
        letter-spacing: .5px; text-transform: uppercase;
        padding: 6px 14px 2px;
    }
    @media (max-width: 1080px) {
        .nav-links, .nav-name { display: none !important; }
        .hamburger { display: flex !important; align-items: center; justify-content: center; }
    }
</style>
<nav class="navbar" id="navbar">
    <a href="{{ route('home') }}" class="nav-brand">
        <div class="nav-brand-icon" aria-hidden="true">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
            </svg>
        </div>
        <div class="nav-brand-text">
            <strong>Ruang Baca</strong>
            <small>Perpustakaan</small>
        </div>
    </a>

    <div class="nav-links">
        <a href="{{ route('home') }}" @class(['active' => $nav === 'beranda'])>Beranda</a>
        <a href="{{ route('katalog') }}" @class(['active' => $nav === 'katalog'])>Katalog</a>
        @auth
            <a href="{{ route('user.peminjaman') }}" @class(['active' => $nav === 'peminjaman'])>Peminjaman</a>
        @endauth
        <a href="{{ route('informasi') }}" @class(['active' => $nav === 'informasi'])>Informasi</a>
        @auth
            <a href="{{ route('user.profile') }}" @class(['active' => $nav === 'profil'])>Profil</a>
        @endauth
    </div>

    <div class="nav-user">
        @auth
            <a href="{{ route('user.profile') }}" class="nav-profile" aria-label="Buka profil">
                <div class="nav-avatar">{{ $initial }}</div>
                <span class="nav-name">{{ $nama }}</span>
            </a>
        @else
            <div style="position:relative;">
                <button class="btn-masuk" id="loginToggle" type="button" aria-label="Masuk atau daftar">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                        <circle cx="12" cy="7" r="4"/>
                    </svg>
                    Masuk
                </button>
                <div class="login-dropdown" id="loginDropdown">
                    <span class="login-label">Sebagai User</span>
                    <a href="{{ route('login') }}">
                        <span style="font-size:18px;">👤</span>
                        <div>
                            <strong style="display:block;font-size:13px;">Login User</strong>
                            <span style="font-size:12px;color:var(--text-muted);">Akses perpustakaan</span>
                        </div>
                    </a>
                    <a href="{{ route('register') }}">
                        <span style="font-size:18px;">✏️</span>
                        <div>
                            <strong style="display:block;font-size:13px;">Daftar Akun</strong>
                            <span style="font-size:12px;color:var(--text-muted);">Buat akun baru</span>
                        </div>
                    </a>
                    <div class="sep"></div>
                    <span class="login-label">Sebagai Admin</span>
                    <a href="{{ route('login') }}?role=admin">
                        <span style="font-size:18px;">🔐</span>
                        <div>
                            <strong style="display:block;font-size:13px;">Login Admin</strong>
                            <span style="font-size:12px;color:var(--text-muted);">Kelola perpustakaan</span>
                        </div>
                    </a>
                </div>
            </div>
        @endauth
        <button class="hamburger" id="hamburgerBtn" type="button" aria-label="Buka menu">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                <path d="M4 7h16M4 12h16M4 17h16"/>
            </svg>
        </button>
    </div>
</nav>

<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-overlay" onclick="closeDrawer()"></div>
    <div class="drawer-panel">
        <button class="drawer-close" type="button" onclick="closeDrawer()" aria-label="Tutup menu">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                <path d="M6 6l12 12M18 6 6 18"/>
            </svg>
        </button>
        @auth
            <div style="display:flex;align-items:center;gap:10px;padding:0 4px 16px;border-bottom:1px solid var(--border);margin-bottom:8px;">
                <div class="nav-avatar">{{ $initial }}</div>
                <span style="font-size:14px;font-weight:600;">{{ $nama }}</span>
            </div>
        @endauth
        <div class="drawer-nav">
            <a href="{{ route('home') }}" @class(['active' => $nav === 'beranda'])>🏠 Beranda</a>
            <a href="{{ route('katalog') }}" @class(['active' => $nav === 'katalog'])>📚 Katalog Buku</a>
            @auth
                <a href="{{ route('user.peminjaman') }}" @class(['active' => $nav === 'peminjaman'])>📖 Peminjaman Saya</a>
                <a href="{{ route('user.profile') }}" @class(['active' => $nav === 'profil'])>👤 Profil</a>
            @endauth
            <a href="{{ route('informasi') }}" @class(['active' => $nav === 'informasi'])>ℹ️ Informasi</a>
        </div>
        @auth
            <div class="drawer-logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">🚪 Keluar</button>
                </form>
            </div>
        @else
            <div style="margin-top:auto;padding-top:16px;border-top:1px solid var(--border);display:flex;flex-direction:column;gap:8px;">
                <a href="{{ route('login') }}" style="display:block;padding:11px;text-align:center;background:var(--brown-500);color:white;border-radius:50px;font-size:14px;font-weight:600;">Masuk</a>
                <a href="{{ route('register') }}" style="display:block;padding:11px;text-align:center;background:white;color:var(--text-main);border:1.5px solid var(--border);border-radius:50px;font-size:14px;font-weight:600;">Daftar</a>
            </div>
        @endauth
    </div>
</div>

<script>
(function() {
    const hamburgerBtn = document.getElementById('hamburgerBtn');
    const mobileDrawer = document.getElementById('mobileDrawer');
    if (hamburgerBtn && mobileDrawer) {
        hamburgerBtn.addEventListener('click', () => {
            mobileDrawer.classList.add('open');
            document.body.style.overflow = 'hidden';
        });
    }

    const loginToggle = document.getElementById('loginToggle');
    const loginDropdown = document.getElementById('loginDropdown');
    if (loginToggle && loginDropdown) {
        loginToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            loginDropdown.classList.toggle('open');
        });
        document.addEventListener('click', () => loginDropdown.classList.remove('open'));
    }
})();

function closeDrawer() {
    const d = document.getElementById('mobileDrawer');
    if (d) { d.classList.remove('open'); document.body.style.overflow = ''; }
}
</script>
