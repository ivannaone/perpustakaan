<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Katalog Buku — Ruang Baca</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{
    --navy:#1e3a5f;--navy-dark:#162d4a;--navy-light:#2a5080;
    --blue:#2563eb;--blue-light:#dbeafe;--blue-pale:#eff6ff;
    --text:#1a1a2e;--muted:#64748b;
    --border:#e2e8f0;--bg:#f8fafc;
    --white:#ffffff;
    --radius:14px;--radius-sm:9px;
    --shadow:0 2px 12px rgba(30,58,95,.08);
    --shadow-card:0 8px 28px rgba(30,58,95,.12);
}
body{font-family:'Inter',system-ui,sans-serif;background:var(--bg);color:var(--text);min-height:100vh;}
a{text-decoration:none;color:inherit;}

.navbar{position:sticky;top:0;z-index:100;background:rgba(248,250,252,.97);backdrop-filter:blur(10px);border-bottom:1px solid var(--border);height:64px;display:flex;align-items:center;justify-content:space-between;padding:0 5%;}
.nav-brand{display:flex;align-items:center;gap:10px;}
.nav-brand-icon{width:36px;height:36px;background:var(--navy);color:white;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px;}
.nav-brand-text strong{font-family:'Lora',serif;font-size:17px;}
.nav-brand-text small{display:block;font-size:10px;color:var(--muted);letter-spacing:.5px;text-transform:uppercase;}
.nav-links{display:flex;align-items:center;gap:4px;}
.nav-links a{padding:7px 14px;border-radius:50px;font-size:14px;font-weight:500;color:var(--muted);transition:color .2s,background .2s;}
.nav-links a:hover{color:var(--text);background:var(--blue-pale);}
.nav-links a.active{color:var(--navy);background:var(--blue-light);font-weight:600;}
.nav-user{display:flex;align-items:center;gap:10px;}
.nav-avatar{width:36px;height:36px;border-radius:50%;background:var(--blue-light);color:var(--navy);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);}
.nav-name{font-size:14px;font-weight:500;}
.hamburger{display:none;background:none;border:none;font-size:22px;cursor:pointer;color:var(--text);padding:6px;}
.mobile-drawer{display:none;position:fixed;inset:0;z-index:200;}
.drawer-overlay{position:absolute;inset:0;background:rgba(0,0,0,.35);}
.drawer-panel{position:absolute;top:0;right:0;width:260px;height:100%;background:var(--bg);padding:28px 24px;box-shadow:-4px 0 24px rgba(0,0,0,.12);display:flex;flex-direction:column;gap:8px;transform:translateX(100%);transition:transform .28s ease;}
.mobile-drawer.open{display:block;}
.mobile-drawer.open .drawer-panel{transform:translateX(0);}
.drawer-close{align-self:flex-end;background:none;border:none;font-size:22px;cursor:pointer;color:var(--muted);margin-bottom:8px;}
.drawer-nav a{display:block;padding:12px 16px;border-radius:var(--radius-sm);font-size:15px;font-weight:500;color:var(--muted);transition:background .15s;}
.drawer-nav a:hover,.drawer-nav a.active{background:var(--blue-light);color:var(--navy);}
.drawer-logout{margin-top:auto;}
.drawer-logout button{width:100%;padding:11px;border-radius:var(--radius-sm);background:none;border:1.5px solid var(--border);color:var(--muted);font-size:14px;cursor:pointer;}

.hero-banner{
    background:linear-gradient(135deg,#1e3a5f 0%,#2a5080 50%,#1e3a5f 100%);
    margin:24px 5% 0;
    border-radius:20px;
    padding:36px 44px;
    display:flex;align-items:center;justify-content:space-between;
    overflow:hidden;position:relative;
    min-height:180px;
}
.hero-banner::before{
    content:'';position:absolute;inset:0;
    background:radial-gradient(ellipse 60% 100% at 75% 50%,rgba(96,165,250,.18) 0%,transparent 65%);
}
.hero-text{position:relative;z-index:1;max-width:420px;}
.hero-text h2{font-family:'Lora',serif;font-size:28px;font-weight:700;color:white;line-height:1.3;margin-bottom:10px;}
.hero-text h2 em{font-style:italic;color:#93c5fd;}
.hero-text p{color:rgba(255,255,255,.75);font-size:14px;margin-bottom:20px;}
.hero-btn{
    display:inline-flex;align-items:center;gap:8px;
    padding:11px 22px;background:white;color:var(--navy);
    border-radius:50px;font-size:14px;font-weight:700;
    transition:transform .15s,box-shadow .2s;
}
.hero-btn:hover{transform:translateY(-2px);box-shadow:0 6px 20px rgba(0,0,0,.15);}

.hero-books{
    position:relative;z-index:1;
    display:flex;align-items:flex-end;gap:-8px;
    flex-shrink:0;
}
.book-3d{
    position:relative;
    width:72px;
    transform-style:preserve-3d;
}
.book-3d:nth-child(1){transform:rotate(-8deg) translateY(8px);z-index:1;}
.book-3d:nth-child(2){transform:rotate(-2deg) translateY(0px);z-index:2;margin-left:-10px;}
.book-3d:nth-child(3){transform:rotate(5deg) translateY(5px);z-index:1;margin-left:-10px;}
.book-spine{
    width:72px;
    height:108px;
    border-radius:3px 10px 10px 3px;
    display:flex;align-items:center;justify-content:center;
    position:relative;
    box-shadow:4px 4px 14px rgba(0,0,0,.35),-2px 0 0 rgba(0,0,0,.2);
}
.book-spine::before{
    content:'';
    position:absolute;left:0;top:0;bottom:0;width:7px;
    background:rgba(0,0,0,.2);border-radius:3px 0 0 3px;
}
.book-spine-text{
    writing-mode:vertical-rl;text-orientation:mixed;transform:rotate(180deg);
    font-family:'Lora',serif;font-size:9px;font-weight:700;
    color:rgba(255,255,255,.9);letter-spacing:.5px;
    padding:0 6px;line-height:1.2;text-align:center;
}
.b1{background:linear-gradient(160deg,#1d4ed8,#1e40af);}
.b2{background:linear-gradient(160deg,#0f766e,#115e59);}
.b3{background:linear-gradient(160deg,#b45309,#92400e);}
.book-top{
    position:absolute;top:-4px;left:7px;right:0;height:6px;
    background:rgba(255,255,255,.15);border-radius:0 4px 0 0;
    transform:skewX(-30deg) translateX(2px);
}

.container{max-width:1100px;margin:0 auto;padding:28px 20px;}

.search-row{
    display:flex;align-items:center;gap:0;
    background:white;border:1.5px solid var(--border);
    border-radius:50px;overflow:hidden;
    box-shadow:var(--shadow);
    margin-bottom:24px;
}
.search-icon{padding:0 16px 0 20px;color:var(--muted);font-size:17px;flex-shrink:0;}
.search-row input{flex:1;border:none;outline:none;padding:14px 0;font-size:14px;color:var(--text);font-family:'Inter',sans-serif;background:transparent;}
.search-row button{padding:12px 28px;background:var(--navy);color:white;border:none;cursor:pointer;font-weight:600;font-size:14px;border-radius:50px;margin:4px 4px 4px 0;transition:background .2s;}
.search-row button:hover{background:var(--navy-dark);}

.alert-warning{background:#fefce8;border:1px solid #fde68a;color:#92400e;border-radius:var(--radius-sm);padding:12px 16px;font-size:13px;margin-bottom:20px;display:flex;align-items:center;gap:8px;}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;border-radius:var(--radius-sm);padding:12px 16px;font-size:13px;margin-bottom:20px;}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#991b1b;border-radius:var(--radius-sm);padding:12px 16px;font-size:13px;margin-bottom:20px;}

.section-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;}
.section-title{font-family:'Lora',serif;font-size:20px;font-weight:700;display:flex;align-items:center;gap:8px;}
.result-count{font-size:13px;color:var(--muted);}

.books-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}

.book-card{
    background:white;border:1px solid var(--border);
    border-radius:var(--radius);overflow:hidden;
    transition:transform .2s,box-shadow .2s;
    display:flex;flex-direction:column;
    position:relative;
}
.book-card:hover{transform:translateY(-5px);box-shadow:var(--shadow-card);}

.book-cover-wrap{
    height:160px;
    display:flex;align-items:center;justify-content:center;
    padding:20px 16px 10px;
    position:relative;
    background:linear-gradient(160deg,#f0f4ff 0%,#e8f0fe 100%);
}

.book-visual{
    position:relative;
    width:80px;
    height:118px;
    transform-style:preserve-3d;
    filter:drop-shadow(4px 6px 12px rgba(30,58,95,.25));
    transition:transform .3s;
}
.book-card:hover .book-visual{transform:perspective(300px) rotateY(-8deg) rotateX(2deg);}

.book-front{
    width:80px;height:118px;
    border-radius:2px 8px 8px 2px;
    display:flex;flex-direction:column;
    align-items:center;justify-content:center;
    padding:10px 8px;
    position:relative;
    overflow:hidden;
}
.book-front::after{
    content:'';
    position:absolute;top:0;right:0;bottom:0;width:6px;
    background:rgba(0,0,0,.12);
}
.book-front::before{
    content:'';
    position:absolute;top:0;left:0;bottom:0;width:5px;
    background:rgba(0,0,0,.18);border-radius:2px 0 0 2px;
}
.book-front-title{
    font-family:'Lora',serif;font-size:9px;font-weight:700;
    color:rgba(255,255,255,.95);text-align:center;line-height:1.3;
    position:relative;z-index:1;
    display:-webkit-box;-webkit-line-clamp:4;-webkit-box-orient:vertical;overflow:hidden;
}
.book-front-icon{font-size:22px;margin-bottom:6px;position:relative;z-index:1;}
.book-side{
    position:absolute;left:-6px;top:2px;bottom:2px;width:6px;
    background:rgba(0,0,0,.25);
    border-radius:2px 0 0 2px;
    transform:skewY(-2deg);
}
.book-top-face{
    position:absolute;top:-4px;left:-4px;right:1px;height:5px;
    background:rgba(255,255,255,.2);
    transform:skewX(-25deg) translateX(3px);
    border-radius:0 2px 0 0;
}

.bc0{background:linear-gradient(135deg,#1d4ed8 0%,#1e40af 100%);}
.bc1{background:linear-gradient(135deg,#0f766e 0%,#134e4a 100%);}
.bc2{background:linear-gradient(135deg,#9333ea 0%,#6b21a8 100%);}
.bc3{background:linear-gradient(135deg,#b45309 0%,#92400e 100%);}
.bc4{background:linear-gradient(135deg,#dc2626 0%,#991b1b 100%);}
.bc5{background:linear-gradient(135deg,#0369a1 0%,#075985 100%);}
.bc6{background:linear-gradient(135deg,#4f46e5 0%,#3730a3 100%);}
.bc7{background:linear-gradient(135deg,#059669 0%,#065f46 100%);}

.book-body{padding:14px;flex:1;display:flex;flex-direction:column;}
.book-title{font-family:'Lora',serif;font-size:14px;font-weight:700;line-height:1.35;margin-bottom:4px;color:var(--text);display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.book-author{font-size:11px;color:var(--muted);margin-bottom:10px;}
.book-footer{margin-top:auto;}

.badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:50px;font-size:11px;font-weight:600;}
.badge-available{background:#dcfce7;color:#15803d;}
.badge-empty{background:#fee2e2;color:#991b1b;}

.btn-pinjam{
    display:block;width:100%;margin-top:9px;padding:9px;
    border:none;border-radius:50px;cursor:pointer;
    font-family:'Inter',sans-serif;font-size:12px;font-weight:600;
    background:var(--navy);color:white;
    transition:background .2s,transform .15s;
    text-align:center;
}
.btn-pinjam:hover{background:var(--navy-dark);transform:translateY(-1px);}
.btn-pinjam:disabled{background:var(--border);color:var(--muted);cursor:not-allowed;transform:none;}

.empty-state{text-align:center;padding:60px 20px;color:var(--muted);background:white;border:1.5px solid var(--border);border-radius:var(--radius);}
.empty-icon{font-size:44px;margin-bottom:14px;}

.pagination-wrap{margin-top:36px;display:flex;justify-content:center;}

footer{background:#0f172a;color:white;padding:36px 5%;margin-top:60px;}
.footer-inner{max-width:1100px;margin:auto;display:flex;justify-content:space-between;align-items:center;gap:20px;}
.footer-brand strong{font-family:'Lora',serif;font-size:16px;}
.footer-brand p{font-size:12px;color:rgba(255,255,255,.45);margin-top:4px;}
.footer-logout button{background:none;border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.7);padding:8px 18px;border-radius:50px;cursor:pointer;font-size:13px;}

@media(max-width:1024px){.books-grid{grid-template-columns:repeat(3,1fr);}}
@media(max-width:768px){
    .nav-links,.nav-name{display:none;}
    .hamburger{display:block;}
    .hero-books{display:none;}
    .hero-banner{padding:28px 28px;}
    .hero-text h2{font-size:22px;}
    .books-grid{grid-template-columns:repeat(2,1fr);}
    .footer-inner{flex-direction:column;align-items:flex-start;}
}
@media(max-width:480px){
    .books-grid{grid-template-columns:repeat(2,1fr);}
    .hero-banner{margin:16px 4% 0;padding:24px 20px;}
}
</style>
</head>
<body>

@include('partials.ruang-nav', ['nav' => 'katalog'])

<div class="hero-banner">
    <div class="hero-text">
        <h2>Temukan Buku<br><em>Favoritmu Hari Ini</em></h2>
        <p>Jelajahi ribuan koleksi buku dan pinjam langsung dari sini.</p>
        <span class="hero-btn">📚 Jelajahi Katalog</span>
    </div>
    <div class="hero-books">
        <div class="book-3d">
            <div class="book-spine b1"><div class="book-spine-text">Ilmu Pengetahuan</div></div>
            <div class="book-top"></div>
        </div>
        <div class="book-3d">
            <div class="book-spine b2"><div class="book-spine-text">Teknologi</div></div>
            <div class="book-top"></div>
        </div>
        <div class="book-3d">
            <div class="book-spine b3"><div class="book-spine-text">Sejarah</div></div>
            <div class="book-top"></div>
        </div>
    </div>
</div>

<div class="container">

    @if(!$sudahTerhubung)
        @guest
            <div class="alert-warning">
                <span>🔐</span>
                <span>Silakan <a href="{{ route('login') }}" style="color:var(--navy);font-weight:600;">login</a> terlebih dahulu untuk mengajukan peminjaman buku.</span>
            </div>
        @else
            <div class="alert-warning">
                <span>⚠️</span>
                <span>Akun kamu belum terhubung ke data anggota. Hubungi petugas perpustakaan agar bisa mengajukan peminjaman.</span>
            </div>
        @endguest
    @endif

    @if(session('success'))
        <div class="alert-success">✓ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-error">✕ {{ session('error') }}</div>
    @endif

    <div class="search-row">
        <span class="search-icon">🔎</span>
        <form action="{{ route('katalog') }}" method="GET" style="display:flex;flex:1;align-items:center;">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul buku, pengarang, atau penerbit...">
            <button type="submit">Cari</button>
        </form>
    </div>

    <div class="section-header">
        <div class="section-title">📚 Katalog Buku</div>
        <div class="result-count">
            @if($search)
                Hasil: <strong>"{{ $search }}"</strong>
            @else
                {{ $buku->total() }} judul tersedia
            @endif
        </div>
    </div>

    @if($buku->count())
        <div class="books-grid">
            @foreach($buku as $item)
                @php $colorClass = 'bc' . ($loop->index % 8); @endphp
                <div class="book-card">
                    <div class="book-cover-wrap">
                        <div class="book-visual">
                            <div class="book-front {{ $colorClass }}">
                                <div class="book-front-icon">📖</div>
                                <div class="book-front-title">{{ $item->judul_buku }}</div>
                            </div>
                            <div class="book-side"></div>
                            <div class="book-top-face"></div>
                        </div>
                    </div>
                    <div class="book-body">
                        <div class="book-title">{{ $item->judul_buku }}</div>
                        <div class="book-author">{{ $item->pengarang }}@if($item->penerbit) · {{ $item->penerbit }}@endif</div>
                        <div class="book-footer">
                            @if($item->stok_tersedia > 0)
                                <span class="badge badge-available">✓ Tersedia · {{ $item->stok_tersedia }} eks</span>
                                @if($sudahTerhubung)
                                    <form action="{{ route('user.pinjam', $item->id_buku) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn-pinjam">📖 Pinjam Buku</button>
                                    </form>
                                @elseif(auth()->check())
                                    <button type="button" class="btn-pinjam" disabled>Pinjam Buku</button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-pinjam">Login untuk Pinjam</a>
                                @endif
                            @else
                                <span class="badge badge-empty">✕ Stok Habis</span>
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

</div>

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <strong>📖 Ruang Baca</strong>
            <p>Sistem Informasi Perpustakaan</p>
        </div>
        @auth
        <div class="footer-logout">
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">🚪 Keluar</button></form>
        </div>
        @else
        <a href="{{ route('login') }}" style="background:none;border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.7);padding:8px 18px;border-radius:50px;font-size:13px;">Masuk</a>
        @endauth
    </div>
</footer>

<script>
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
