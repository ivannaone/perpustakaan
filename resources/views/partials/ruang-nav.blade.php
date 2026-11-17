@php
    $nav = $nav ?? '';
    $isGuest = !auth()->check();
    $nama = $isGuest ? '' : auth()->user()->nama;
    $initial = $isGuest ? '?' : strtoupper(substr($nama, 0, 1));
@endphp
<style>
    .nav-profile { display: flex; align-items: center; gap: 10px; padding: 3px 8px 3px 3px; border-radius: 999px; color: inherit; text-decoration: none; }
    .nav-profile:hover { background: #dbeafe; }
    .navbar { height: auto; min-height: 64px; }
    .btn-masuk {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 9px 20px; border-radius: 50px;
        background: #1e3a5f; color: white;
        font-size: 14px; font-weight: 600;
        border: none; cursor: pointer; font-family: 'Inter', sans-serif;
        transition: background .2s;
        text-decoration: none;
        position: relative;
    }
    .btn-masuk:hover { background: #162d4a; }
    .login-dropdown {
        position: absolute; top: calc(100% + 10px); right: 0;
        background: white; border: 1.5px solid #e2e8f0;
        border-radius: 14px; padding: 8px;
        min-width: 200px;
        box-shadow: 0 8px 32px rgba(30,58,95,.14);
        display: none; flex-direction: column; gap: 4px;
        z-index: 300;
    }
    .login-dropdown.open { display: flex; }
    .login-dropdown a {
        display: flex; align-items: center; gap: 10px;
        padding: 11px 14px; border-radius: 9px;
        font-size: 14px; color: #1a1a2e;
        transition: background .15s;
        text-decoration: none;
    }
    .login-dropdown a:hover { background: #f1f5f9; }
    .login-dropdown .sep { height: 1px; background: #e2e8f0; margin: 2px 0; }
    .login-dropdown .login-label {
        font-size: 11px; font-weight: 600; color: #64748b;
        letter-spacing: .5px; text-transform: uppercase;
        padding: 6px 14px 2px;
    }
    .nav-avatar-wrap { width: 36px; height: 36px; border-radius: 50%; background: #dbeafe; color: #1e3a5f; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px; border: 2px solid #e2e8f0; flex-shrink: 0; }
    @media (max-width: 1080px) {
        .nav-links, .nav-name { display: none !important; }
        .hamburger { display: flex !important; align-items: center; justify-content: center; }
    }
</style>
<nav class="navbar" id="navbar">
    <a href="{{ route('home') }}" class="nav-brand">
        <div class="nav-brand-icon" aria-hidden="true" style="background:#1e3a5f;">
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
                <div class="nav-avatar-wrap">{{ $initial }}</div>
                <span class="nav-name" style="font-size:14px;font-weight:500;">{{ $nama }}</span>
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
                        <span style="font-size:16px;width:20px;text-align:center;flex-shrink:0;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </span>
                        <div>
                            <strong style="display:block;font-size:13px;">Login User</strong>
                            <span style="font-size:12px;color:#64748b;">Akses perpustakaan</span>
                        </div>
                    </a>
                    <a href="{{ route('register') }}">
                        <span style="font-size:16px;width:20px;text-align:center;flex-shrink:0;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg>
                        </span>
                        <div>
                            <strong style="display:block;font-size:13px;">Daftar Akun</strong>
                            <span style="font-size:12px;color:#64748b;">Buat akun baru</span>
                        </div>
                    </a>
                    <div class="sep"></div>
                    <span class="login-label">Sebagai Admin</span>
                    <a href="{{ route('login') }}">
                        <span style="font-size:16px;width:20px;text-align:center;flex-shrink:0;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </span>
                        <div>
                            <strong style="display:block;font-size:13px;">Login Admin</strong>
                            <span style="font-size:12px;color:#64748b;">Kelola perpustakaan</span>
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
    <div class="drawer-panel" style="background:#f8fafc;">
        <button class="drawer-close" type="button" onclick="closeDrawer()" aria-label="Tutup menu" style="align-self:flex-end;background:none;border:none;font-size:22px;cursor:pointer;color:#64748b;margin-bottom:8px;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round">
                <path d="M6 6l12 12M18 6 6 18"/>
            </svg>
        </button>
        @auth
            <div style="display:flex;align-items:center;gap:10px;padding:0 4px 16px;border-bottom:1px solid #e2e8f0;margin-bottom:8px;">
                <div class="nav-avatar-wrap">{{ $initial }}</div>
                <span style="font-size:14px;font-weight:600;">{{ $nama }}</span>
            </div>
        @endauth
        <div class="drawer-nav">
            <a href="{{ route('home') }}" @class(['active' => $nav === 'beranda'])>Beranda</a>
            <a href="{{ route('katalog') }}" @class(['active' => $nav === 'katalog'])>Katalog Buku</a>
            @auth
                <a href="{{ route('user.peminjaman') }}" @class(['active' => $nav === 'peminjaman'])>Peminjaman Saya</a>
                <a href="{{ route('user.profile') }}" @class(['active' => $nav === 'profil'])>Profil</a>
            @endauth
            <a href="{{ route('informasi') }}" @class(['active' => $nav === 'informasi'])>Informasi</a>
        </div>
        @auth
            <div style="margin-top:auto;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="width:100%;padding:11px;border-radius:9px;background:none;border:1.5px solid #e2e8f0;color:#64748b;font-size:14px;cursor:pointer;">Keluar</button>
                </form>
            </div>
        @else
            <div style="margin-top:auto;padding-top:16px;border-top:1px solid #e2e8f0;display:flex;flex-direction:column;gap:8px;">
                <a href="{{ route('login') }}" style="display:block;padding:11px;text-align:center;background:#1e3a5f;color:white;border-radius:50px;font-size:14px;font-weight:600;text-decoration:none;">Masuk</a>
                <a href="{{ route('register') }}" style="display:block;padding:11px;text-align:center;background:white;color:#1a1a2e;border:1.5px solid #e2e8f0;border-radius:50px;font-size:14px;font-weight:600;text-decoration:none;">Daftar</a>
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
