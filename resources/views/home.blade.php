<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ruang Baca — Perpustakaan</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
    --cream-50:#fdfaf5;--cream-100:#f7f1e3;--cream-200:#ede4cc;
    --brown-400:#a07850;--brown-500:#8a6540;--brown-600:#704f2e;
    --sage-200:#d4dfc8;--sage-400:#8aab70;--sage-500:#6a8f52;--sage-600:#4f7039;
    --text-main:#2d2016;--text-muted:#7a6650;
    --border:#e8dcc8;
    --shadow:0 2px 12px rgba(80,50,20,.08);
    --shadow-card:0 4px 24px rgba(80,50,20,.10);
    --radius-lg:16px;--radius-md:10px;
}
body{font-family:'Inter',system-ui,sans-serif;background:var(--cream-50);color:var(--text-main);min-height:100vh;}
a{text-decoration:none;color:inherit;}

.navbar{position:sticky;top:0;z-index:100;background:rgba(253,250,245,.96);backdrop-filter:blur(10px);border-bottom:1px solid var(--border);height:64px;display:flex;align-items:center;justify-content:space-between;padding:0 5%;transition:box-shadow .2s;}
.navbar.scrolled{box-shadow:var(--shadow);}
.nav-brand{display:flex;align-items:center;gap:10px;}
.nav-brand-icon{width:36px;height:36px;background:var(--sage-500);color:white;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px;}
.nav-brand-text strong{font-family:'Lora',serif;font-size:17px;font-weight:700;}
.nav-brand-text small{display:block;font-size:10px;color:var(--text-muted);letter-spacing:.5px;text-transform:uppercase;}
.nav-links{display:flex;align-items:center;gap:4px;}
.nav-links a{padding:7px 14px;border-radius:50px;font-size:14px;font-weight:500;color:var(--text-muted);transition:color .2s,background .2s;}
.nav-links a:hover{color:var(--text-main);background:var(--cream-100);}
.nav-links a.active{color:var(--sage-600);background:var(--sage-200);font-weight:600;}
.nav-right{display:flex;align-items:center;gap:10px;}
.nav-avatar{width:36px;height:36px;border-radius:50%;background:var(--cream-200);color:var(--brown-500);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);}
.nav-name{font-size:14px;font-weight:500;}
.btn-masuk{display:inline-flex;align-items:center;gap:7px;padding:9px 20px;border-radius:50px;background:var(--brown-500);color:white;font-size:14px;font-weight:600;border:none;cursor:pointer;font-family:'Inter',sans-serif;transition:background .2s;position:relative;}
.btn-masuk:hover{background:var(--brown-600);}
.login-dropdown{position:absolute;top:calc(100% + 10px);right:0;background:white;border:1.5px solid var(--border);border-radius:14px;padding:8px;min-width:200px;box-shadow:0 8px 32px rgba(80,50,20,.14);display:none;flex-direction:column;gap:4px;z-index:300;}
.login-dropdown.open{display:flex;}
.login-dropdown a{display:flex;align-items:center;gap:10px;padding:11px 14px;border-radius:9px;font-size:14px;color:var(--text-main);transition:background .15s;}
.login-dropdown a:hover{background:var(--cream-100);}
.login-dropdown .sep{height:1px;background:var(--border);margin:2px 0;}
.login-dropdown .login-label{font-size:11px;font-weight:600;color:var(--text-muted);letter-spacing:.5px;text-transform:uppercase;padding:6px 14px 2px;}
.hamburger{display:none;background:none;border:none;font-size:22px;cursor:pointer;color:var(--text-main);padding:6px;}

.mobile-drawer{display:none;position:fixed;inset:0;z-index:200;}
.drawer-overlay{position:absolute;inset:0;background:rgba(0,0,0,.35);}
.drawer-panel{position:absolute;top:0;right:0;width:260px;height:100%;background:var(--cream-50);padding:28px 24px;box-shadow:-4px 0 24px rgba(0,0,0,.12);display:flex;flex-direction:column;gap:8px;transform:translateX(100%);transition:transform .28s ease;}
.mobile-drawer.open{display:block;}
.mobile-drawer.open .drawer-panel{transform:translateX(0);}
.drawer-close{align-self:flex-end;background:none;border:none;font-size:22px;cursor:pointer;color:var(--text-muted);margin-bottom:8px;}
.drawer-nav a{display:block;padding:12px 16px;border-radius:var(--radius-md);font-size:15px;font-weight:500;color:var(--text-muted);transition:background .15s;}
.drawer-nav a:hover,.drawer-nav a.active{background:var(--cream-100);color:var(--sage-600);}
.drawer-auth{margin-top:auto;padding-top:16px;border-top:1px solid var(--border);display:flex;flex-direction:column;gap:8px;}
.drawer-auth a{display:block;padding:11px;text-align:center;border-radius:50px;font-size:14px;font-weight:600;}
.drawer-auth .btn-login{background:var(--brown-500);color:white;}
.drawer-auth .btn-daftar{background:white;color:var(--text-main);border:1.5px solid var(--border);}
.drawer-logout{margin-top:auto;}
.drawer-logout button{width:100%;padding:11px;border-radius:var(--radius-md);background:none;border:1.5px solid var(--border);color:var(--text-muted);font-size:14px;cursor:pointer;}

.hero{background:linear-gradient(160deg,#2d1a0a 0%,#1a3a1a 60%,#3d2810 100%);padding:80px 5% 90px;color:white;position:relative;overflow:hidden;}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(138,171,112,.15) 0%,transparent 65%);}
.hero-inner{max-width:1100px;margin:auto;position:relative;z-index:1;}
.hero-tag{display:inline-block;background:rgba(138,171,112,.2);border:1px solid rgba(138,171,112,.4);color:#b8d49a;border-radius:50px;padding:5px 14px;font-size:12px;font-weight:600;letter-spacing:.5px;text-transform:uppercase;margin-bottom:18px;}
.hero h1{font-family:'Lora',serif;font-size:50px;font-weight:700;line-height:1.15;max-width:600px;margin-bottom:16px;}
.hero h1 em{font-style:italic;color:#b8d49a;}
.hero p{font-size:16px;line-height:1.75;opacity:.82;max-width:540px;margin-bottom:32px;}
.hero-actions{display:flex;gap:12px;flex-wrap:wrap;}
.hero-btn-primary{padding:14px 28px;background:var(--sage-500);color:white;border-radius:50px;font-size:15px;font-weight:700;transition:background .2s,transform .15s;}
.hero-btn-primary:hover{background:var(--sage-600);transform:translateY(-2px);}
.hero-btn-secondary{padding:14px 28px;background:rgba(255,255,255,.12);color:white;border:1.5px solid rgba(255,255,255,.25);border-radius:50px;font-size:15px;font-weight:600;transition:background .2s;}
.hero-btn-secondary:hover{background:rgba(255,255,255,.2);}
.hero-search{display:flex;gap:0;max-width:540px;background:white;border-radius:50px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.2);margin-top:28px;}
.hero-search input{flex:1;padding:14px 20px;border:none;outline:none;font-family:'Inter',sans-serif;font-size:14px;color:var(--text-main);background:transparent;}
.hero-search button{padding:0 24px;background:var(--sage-500);color:white;border:none;cursor:pointer;font-weight:600;font-size:14px;transition:background .2s;}
.hero-search button:hover{background:var(--sage-600);}

.container{max-width:1100px;margin:auto;padding:0 20px;}
.section{padding:56px 0;}
.section-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;}
.section-title{font-family:'Lora',serif;font-size:24px;font-weight:700;}
.section-link{font-size:13px;font-weight:600;color:var(--sage-500);padding:7px 16px;border-radius:50px;border:1.5px solid var(--sage-200);transition:background .2s;}
.section-link:hover{background:var(--sage-200);}

.feature-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-bottom:56px;}
.feature-card{background:white;border:1.5px solid var(--border);border-radius:var(--radius-lg);padding:28px 24px;}
.feature-icon{width:48px;height:48px;background:var(--cream-100);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:16px;}
.feature-card h3{font-family:'Lora',serif;font-size:17px;font-weight:700;margin-bottom:8px;}
.feature-card p{font-size:13px;color:var(--text-muted);line-height:1.75;}

.books-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;}
.book-card{background:white;border:1.5px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;transition:transform .2s,box-shadow .2s;}
.book-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-card);}
.book-cover{height:155px;background:var(--cream-100);display:flex;align-items:center;justify-content:center;font-size:46px;border-bottom:1px solid var(--border);}
.book-body{padding:16px;}
.book-title{font-family:'Lora',serif;font-size:15px;font-weight:600;line-height:1.4;margin-bottom:6px;}
.book-meta{font-size:12px;color:var(--text-muted);margin-bottom:10px;}
.badge{display:inline-block;padding:4px 10px;border-radius:50px;font-size:11px;font-weight:600;}
.badge-available{background:#dcfce7;color:#15803d;}
.badge-empty{background:#fee2e2;color:#b91c1c;}

.cta-strip{background:linear-gradient(135deg,#2d1a0a,#1a3a1a);border-radius:var(--radius-lg);padding:52px 48px;color:white;text-align:center;margin-bottom:56px;}
.cta-strip h2{font-family:'Lora',serif;font-size:30px;margin-bottom:12px;}
.cta-strip p{opacity:.8;margin-bottom:28px;font-size:15px;}
.cta-strip-btns{display:flex;gap:12px;justify-content:center;flex-wrap:wrap;}

footer{background:#1a1008;color:white;padding:40px 5%;}
.footer-inner{max-width:1100px;margin:auto;display:flex;justify-content:space-between;align-items:flex-start;gap:32px;}
.footer-brand strong{font-family:'Lora',serif;font-size:18px;display:flex;align-items:center;gap:8px;}
.footer-brand p{font-size:13px;color:rgba(255,255,255,.5);margin-top:6px;}
.footer-links{display:flex;flex-direction:column;gap:8px;}
.footer-links a{font-size:13px;color:rgba(255,255,255,.6);transition:color .2s;}
.footer-links a:hover{color:white;}
.footer-copy{max-width:1100px;margin:24px auto 0;padding-top:20px;border-top:1px solid rgba(255,255,255,.08);font-size:12px;color:rgba(255,255,255,.35);}

@media(max-width:1024px){.books-grid{grid-template-columns:repeat(3,1fr);}.feature-grid{grid-template-columns:repeat(2,1fr);}}
@media(max-width:768px){
    .nav-links,.nav-name{display:none;}
    .hamburger{display:block;}
    .hero h1{font-size:34px;}
    .hero{padding:56px 5% 64px;}
    .books-grid{grid-template-columns:repeat(2,1fr);}
    .cta-strip{padding:36px 24px;}
    .footer-inner{flex-direction:column;gap:24px;}
    .feature-grid{grid-template-columns:1fr;}
}
@media(max-width:480px){
    .hero h1{font-size:28px;}
    .books-grid{grid-template-columns:1fr;}
    .hero-actions{flex-direction:column;}
}
</style>
</head>
<body>

<nav class="navbar" id="navbar">
    <a href="{{ route('home') }}" class="nav-brand">
        <div class="nav-brand-icon">📖</div>
        <div class="nav-brand-text"><strong>Ruang Baca</strong><small>Perpustakaan</small></div>
    </a>
    <div class="nav-links">
        <a href="{{ route('home') }}" class="active">Beranda</a>
        <a href="{{ route('katalog') }}">Katalog</a>
        @auth
            <a href="{{ route('user.peminjaman') }}">Peminjaman</a>
        @endauth
        <a href="{{ route('informasi') }}">Informasi</a>
        @auth
            <a href="{{ route('user.profile') }}">Profil</a>
        @endauth
    </div>
    <div class="nav-right">
        @auth
            <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->nama,0,1)) }}</div>
            <span class="nav-name">{{ Auth::user()->nama }}</span>
        @else
            <div style="position:relative;">
                <button class="btn-masuk" id="loginToggle" type="button">
                    👤 Masuk
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
                    <a href="{{ route('login') }}">
                        <span style="font-size:18px;">🔐</span>
                        <div>
                            <strong style="display:block;font-size:13px;">Login Admin</strong>
                            <span style="font-size:12px;color:var(--text-muted);">Kelola perpustakaan</span>
                        </div>
                    </a>
                </div>
            </div>
        @endauth
        <button class="hamburger" id="hamburgerBtn">☰</button>
    </div>
</nav>

<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-overlay" onclick="closeDrawer()"></div>
    <div class="drawer-panel">
        <button class="drawer-close" onclick="closeDrawer()">✕</button>
        @auth
            <div style="display:flex;align-items:center;gap:10px;padding:0 4px 16px;border-bottom:1px solid var(--border);margin-bottom:8px;">
                <div class="nav-avatar">{{ strtoupper(substr(Auth::user()->nama,0,1)) }}</div>
                <span style="font-size:14px;font-weight:600;">{{ Auth::user()->nama }}</span>
            </div>
        @endauth
        <div class="drawer-nav">
            <a href="{{ route('home') }}" class="active">🏠 Beranda</a>
            <a href="{{ route('katalog') }}">📚 Katalog Buku</a>
            @auth
                <a href="{{ route('user.peminjaman') }}">📖 Peminjaman Saya</a>
                <a href="{{ route('user.profile') }}">👤 Profil</a>
            @endauth
            <a href="{{ route('informasi') }}">ℹ️ Informasi</a>
        </div>
        @auth
            <div class="drawer-logout">
                <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">🚪 Keluar</button></form>
            </div>
        @else
            <div class="drawer-auth">
                <a href="{{ route('login') }}" class="btn-login">Masuk</a>
                <a href="{{ route('register') }}" class="btn-daftar">Daftar</a>
            </div>
        @endauth
    </div>
</div>

<section class="hero">
    <div class="hero-inner">
        <div class="hero-tag">✦ Perpustakaan Digital</div>
        <h1>Temukan Cerita,<br><em>Perluas Wawasan.</em></h1>
        <p>Jelajahi ribuan koleksi buku, cek ketersediaan, dan ajukan peminjaman dengan mudah dari mana saja.</p>
        <div class="hero-actions">
            <a href="{{ route('katalog') }}" class="hero-btn-primary">Jelajahi Katalog</a>
            @guest
                <a href="{{ route('register') }}" class="hero-btn-secondary">Daftar Gratis</a>
            @else
                <a href="{{ route('user.dashboard') }}" class="hero-btn-secondary">Dashboard Saya</a>
            @endguest
        </div>
        <form class="hero-search" action="{{ route('katalog') }}" method="GET">
            <input type="text" name="search" placeholder="Cari judul, pengarang, atau penerbit...">
            <button type="submit">Cari</button>
        </form>
    </div>
</section>

<div class="container">
    <div class="section">
        <div class="feature-grid">
            <div class="feature-card">
                <div class="feature-icon">📚</div>
                <h3>Koleksi Lengkap</h3>
                <p>Temukan ribuan judul buku dari berbagai kategori tersedia di perpustakaan kami.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔎</div>
                <h3>Pencarian Mudah</h3>
                <p>Cari buku berdasarkan judul, pengarang, atau penerbit dengan cepat dan akurat.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📖</div>
                <h3>Pinjam Online</h3>
                <p>Ajukan peminjaman buku langsung dari sistem tanpa antri di perpustakaan.</p>
            </div>
        </div>

        <div class="section-header">
            <h2 class="section-title">Koleksi Terbaru</h2>
            <a href="{{ route('katalog') }}" class="section-link">Lihat semua →</a>
        </div>

        @if($bukuTerbaru->count())
            <div class="books-grid">
                @foreach($bukuTerbaru as $buku)
                    <div class="book-card">
                        <div class="book-cover">📘</div>
                        <div class="book-body">
                            <div class="book-title">{{ $buku->judul_buku }}</div>
                            <div class="book-meta">{{ $buku->pengarang }}@if($buku->penerbit) · {{ $buku->penerbit }}@endif</div>
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
            <div style="text-align:center;padding:40px;color:var(--text-muted);background:white;border-radius:var(--radius-lg);border:1.5px solid var(--border);">
                Belum ada koleksi buku tersedia.
            </div>
        @endif
    </div>

    @guest
        <div class="cta-strip">
            <h2>Mulai Jelajahi Perpustakaan</h2>
            <p>Daftar akun gratis dan nikmati kemudahan mengakses koleksi buku perpustakaan.</p>
            <div class="cta-strip-btns">
                <a href="{{ route('register') }}" class="hero-btn-primary">Daftar Sekarang</a>
                <a href="{{ route('login') }}" class="hero-btn-secondary">Sudah punya akun? Masuk</a>
            </div>
        </div>
    @endguest
</div>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <strong>📖 Ruang Baca</strong>
            <p>Sistem Informasi Perpustakaan</p>
        </div>
        <div class="footer-links">
            <a href="{{ route('katalog') }}">Katalog Buku</a>
            <a href="{{ route('informasi') }}">Informasi</a>
            @auth
                <a href="{{ route('user.peminjaman') }}">Peminjaman Saya</a>
            @endauth
        </div>
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none;border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.7);padding:9px 20px;border-radius:50px;cursor:pointer;font-size:13px;">🚪 Keluar</button>
            </form>
        @else
            <div style="display:flex;gap:10px;">
                <a href="{{ route('login') }}" style="padding:9px 20px;background:var(--sage-500);color:white;border-radius:50px;font-size:13px;font-weight:600;">Masuk</a>
                <a href="{{ route('register') }}" style="padding:9px 20px;background:rgba(255,255,255,.1);color:rgba(255,255,255,.8);border-radius:50px;font-size:13px;border:1px solid rgba(255,255,255,.2);">Daftar</a>
            </div>
        @endauth
    </div>
    <div class="footer-copy">&copy; {{ date('Y') }} Ruang Baca — Sistem Informasi Perpustakaan. Hak cipta dilindungi.</div>
</footer>

<script>
window.addEventListener('scroll',()=>{document.getElementById('navbar').classList.toggle('scrolled',scrollY>10);});

const loginToggle=document.getElementById('loginToggle');
const loginDropdown=document.getElementById('loginDropdown');
if(loginToggle&&loginDropdown){
    loginToggle.addEventListener('click',(e)=>{e.stopPropagation();loginDropdown.classList.toggle('open');});
    document.addEventListener('click',()=>loginDropdown.classList.remove('open'));
}

document.getElementById('hamburgerBtn')?.addEventListener('click',()=>{
    document.getElementById('mobileDrawer').classList.add('open');
    document.body.style.overflow='hidden';
});
function closeDrawer(){
    document.getElementById('mobileDrawer')?.classList.remove('open');
    document.body.style.overflow='';
}
</script>
</body>
</html>
