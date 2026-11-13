<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Beranda — Ruang Baca</title>
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
.nav-user{display:flex;align-items:center;gap:10px;}
.nav-avatar{width:36px;height:36px;border-radius:50%;background:var(--cream-200);color:var(--brown-500);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);}
.nav-name{font-size:14px;font-weight:500;}
.hamburger{display:none;background:none;border:none;font-size:22px;cursor:pointer;color:var(--text-main);padding:6px;}
.mobile-drawer{display:none;position:fixed;inset:0;z-index:200;}
.drawer-overlay{position:absolute;inset:0;background:rgba(0,0,0,.35);}
.drawer-panel{position:absolute;top:0;right:0;width:260px;height:100%;background:var(--cream-50);padding:28px 24px;box-shadow:-4px 0 24px rgba(0,0,0,.12);display:flex;flex-direction:column;gap:8px;transform:translateX(100%);transition:transform .28s ease;}
.mobile-drawer.open{display:block;}
.mobile-drawer.open .drawer-panel{transform:translateX(0);}
.drawer-close{align-self:flex-end;background:none;border:none;font-size:22px;cursor:pointer;color:var(--text-muted);margin-bottom:8px;}
.drawer-nav a{display:block;padding:12px 16px;border-radius:var(--radius-md);font-size:15px;font-weight:500;color:var(--text-muted);transition:background .15s;}
.drawer-nav a:hover,.drawer-nav a.active{background:var(--cream-100);color:var(--sage-600);}
.drawer-logout{margin-top:auto;}
.drawer-logout button{width:100%;padding:11px;border-radius:var(--radius-md);background:none;border:1.5px solid var(--border);color:var(--text-muted);font-size:14px;cursor:pointer;}

.hero{background:linear-gradient(160deg,#2d1a0a 0%,#1a3a1a 60%,#3d2810 100%);padding:60px 5% 68px;color:white;position:relative;overflow:hidden;}
.hero::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 60% 80% at 80% 50%,rgba(138,171,112,.15) 0%,transparent 65%);}
.hero-inner{max-width:1100px;margin:auto;position:relative;z-index:1;display:grid;grid-template-columns:1fr auto;gap:40px;align-items:center;}
.hero-left{}
.hero-greeting{font-size:14px;opacity:.75;margin-bottom:8px;}
.hero h1{font-family:'Lora',serif;font-size:36px;font-weight:700;line-height:1.2;margin-bottom:14px;}
.hero h1 em{font-style:italic;color:#b8d49a;}
.hero p{font-size:15px;line-height:1.7;opacity:.8;margin-bottom:24px;max-width:460px;}
.hero-actions{display:flex;gap:10px;flex-wrap:wrap;}
.btn-hero-primary{padding:12px 24px;background:var(--sage-500);color:white;border-radius:50px;font-size:14px;font-weight:700;transition:background .2s,transform .15s;}
.btn-hero-primary:hover{background:var(--sage-600);transform:translateY(-1px);}
.btn-hero-secondary{padding:12px 24px;background:rgba(255,255,255,.12);color:white;border:1.5px solid rgba(255,255,255,.25);border-radius:50px;font-size:14px;font-weight:600;transition:background .2s;}
.btn-hero-secondary:hover{background:rgba(255,255,255,.2);}
.hero-stats{display:flex;flex-direction:column;gap:14px;flex-shrink:0;}
.hero-stat{background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.18);border-radius:14px;padding:18px 22px;text-align:center;min-width:130px;}
.hero-stat strong{display:block;font-size:28px;font-weight:700;color:white;}
.hero-stat span{font-size:12px;opacity:.7;margin-top:3px;display:block;}
.hero-search{margin-top:24px;display:flex;gap:0;max-width:460px;background:white;border-radius:50px;overflow:hidden;box-shadow:0 8px 24px rgba(0,0,0,.18);}
.hero-search input{flex:1;padding:13px 20px;border:none;outline:none;font-family:'Inter',sans-serif;font-size:14px;color:var(--text-main);}
.hero-search button{padding:0 22px;background:var(--sage-500);color:white;border:none;cursor:pointer;font-weight:600;font-size:14px;transition:background .2s;}
.hero-search button:hover{background:var(--sage-600);}

.container{max-width:1100px;margin:auto;padding:0 20px;}
.section{padding:48px 0;}
.section-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;}
.section-title{font-family:'Lora',serif;font-size:22px;font-weight:700;}
.section-link{font-size:13px;font-weight:600;color:var(--sage-500);padding:7px 16px;border-radius:50px;border:1.5px solid var(--sage-200);transition:background .2s;}
.section-link:hover{background:var(--sage-200);}

.stat-row{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:40px;}
.stat-card{background:white;border:1.5px solid var(--border);border-radius:var(--radius-lg);padding:22px 24px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s;}
.stat-card:hover{box-shadow:var(--shadow-card);}
.stat-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;}
.stat-icon.green{background:#dcfce7;}
.stat-icon.blue{background:#dbeafe;}
.stat-icon.amber{background:#fef3c7;}
.stat-info strong{display:block;font-size:26px;font-weight:700;line-height:1;}
.stat-info span{font-size:13px;color:var(--text-muted);margin-top:3px;display:block;}

.active-loans{margin-bottom:40px;}
.loan-list{display:flex;flex-direction:column;gap:12px;}
.loan-item{background:white;border:1.5px solid var(--border);border-radius:var(--radius-lg);padding:18px 20px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s;}
.loan-item:hover{box-shadow:var(--shadow-card);}
.loan-cover{width:48px;height:62px;background:var(--cream-100);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:24px;border:1px solid var(--border);flex-shrink:0;}
.loan-info{flex:1;min-width:0;}
.loan-title{font-family:'Lora',serif;font-size:15px;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-bottom:4px;}
.loan-meta{font-size:12px;color:var(--text-muted);}
.loan-badge{display:inline-block;padding:5px 12px;border-radius:50px;font-size:11px;font-weight:600;background:#dbeafe;color:#1d4ed8;white-space:nowrap;}
.empty-loan{background:white;border:1.5px dashed var(--border);border-radius:var(--radius-lg);padding:32px 20px;text-align:center;color:var(--text-muted);}
.empty-loan-icon{font-size:36px;margin-bottom:10px;}

.quick-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;}
.quick-card{background:white;border:1.5px solid var(--border);border-radius:var(--radius-lg);padding:22px 20px;transition:transform .2s,box-shadow .2s,border-color .2s;cursor:pointer;}
.quick-card:hover{transform:translateY(-3px);box-shadow:var(--shadow-card);border-color:var(--sage-200);}
.quick-icon{width:44px;height:44px;border-radius:11px;background:var(--cream-100);display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:14px;}
.quick-card strong{display:block;font-size:15px;margin-bottom:5px;}
.quick-card span{font-size:12px;color:var(--text-muted);}

.books-grid{display:grid;grid-template-columns:repeat(6,1fr);gap:16px;}
.book-card{background:white;border:1.5px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;transition:transform .2s,box-shadow .2s;}
.book-card:hover{transform:translateY(-4px);box-shadow:var(--shadow-card);}
.book-cover{height:130px;background:var(--cream-100);display:flex;align-items:center;justify-content:center;font-size:40px;border-bottom:1px solid var(--border);}
.book-body{padding:12px;}
.book-title{font-family:'Lora',serif;font-size:13px;font-weight:600;line-height:1.4;margin-bottom:5px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;}
.book-author{font-size:11px;color:var(--text-muted);margin-bottom:8px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.badge{display:inline-block;padding:3px 8px;border-radius:50px;font-size:10px;font-weight:600;}
.badge-available{background:#dcfce7;color:#166534;}
.badge-empty{background:#fee2e2;color:#991b1b;}

.info-banner{background:white;border:1.5px solid var(--border);border-radius:var(--radius-lg);padding:28px 32px;margin-bottom:48px;display:grid;grid-template-columns:repeat(3,1fr);gap:24px;}
.info-item strong{display:flex;align-items:center;gap:8px;font-size:14px;margin-bottom:8px;}
.info-item p{font-size:13px;color:var(--text-muted);line-height:1.65;}

footer{background:#1a1008;color:white;padding:40px 5%;}
.footer-inner{max-width:1100px;margin:auto;display:flex;justify-content:space-between;align-items:flex-start;gap:32px;}
.footer-brand strong{font-family:'Lora',serif;font-size:18px;display:flex;align-items:center;gap:8px;}
.footer-brand p{font-size:13px;color:rgba(255,255,255,.5);margin-top:6px;}
.footer-links{display:flex;flex-direction:column;gap:8px;}
.footer-links a{font-size:13px;color:rgba(255,255,255,.6);transition:color .2s;}
.footer-links a:hover{color:white;}
.footer-logout button{background:none;border:1px solid rgba(255,255,255,.2);color:rgba(255,255,255,.7);padding:9px 20px;border-radius:50px;cursor:pointer;font-size:13px;}
.footer-copy{max-width:1100px;margin:24px auto 0;padding-top:20px;border-top:1px solid rgba(255,255,255,.08);font-size:12px;color:rgba(255,255,255,.35);}

@media(max-width:1200px){.books-grid{grid-template-columns:repeat(4,1fr);}}
@media(max-width:1024px){.quick-grid{grid-template-columns:repeat(2,1fr);}.stat-row{grid-template-columns:repeat(3,1fr);}}
@media(max-width:900px){.hero-inner{grid-template-columns:1fr;}.hero-stats{flex-direction:row;flex-wrap:wrap;}.hero-stat{flex:1;min-width:110px;}.books-grid{grid-template-columns:repeat(3,1fr);}}
@media(max-width:768px){.nav-links,.nav-name{display:none;}.hamburger{display:block;}.hero{padding:44px 5% 52px;}.hero h1{font-size:28px;}.stat-row{grid-template-columns:1fr 1fr;}.books-grid{grid-template-columns:repeat(2,1fr);}.info-banner{grid-template-columns:1fr;}.footer-inner{flex-direction:column;gap:24px;}}
@media(max-width:480px){.hero h1{font-size:24px;}.quick-grid{grid-template-columns:repeat(2,1fr);}.stat-row{grid-template-columns:1fr;}.books-grid{grid-template-columns:1fr 1fr;}}
</style>
</head>
<body>

@include('partials.ruang-nav', ['nav' => 'beranda'])

<section class="hero">
    <div class="hero-inner">
        <div class="hero-left">
            <div class="hero-greeting">👋 Selamat datang kembali,</div>
            <h1>{{ Auth::user()->nama }},<br><em>apa yang ingin kamu baca?</em></h1>
            <p>Jelajahi koleksi buku, pantau peminjamanmu, dan ajukan peminjaman baru dengan mudah.</p>
            <div class="hero-actions">
                <a href="{{ route('katalog') }}" class="btn-hero-primary">📚 Jelajahi Katalog</a>
                <a href="{{ route('user.peminjaman') }}" class="btn-hero-secondary">📖 Peminjaman Saya</a>
            </div>
            <form class="hero-search" action="{{ route('katalog') }}" method="GET">
                <input type="text" name="search" placeholder="Cari judul, pengarang, atau penerbit...">
                <button type="submit">Cari</button>
            </form>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <strong>{{ $totalBuku }}</strong>
                <span>Judul Buku</span>
            </div>
            <div class="hero-stat">
                <strong>{{ $totalTersedia }}</strong>
                <span>Tersedia</span>
            </div>
            <div class="hero-stat">
                <strong>{{ $totalPinjamUser }}</strong>
                <span>Pinjaman Saya</span>
            </div>
        </div>
    </div>
</section>

<div class="container">

    <div class="section">
        <div class="stat-row">
            <div class="stat-card">
                <div class="stat-icon green">📚</div>
                <div class="stat-info">
                    <strong>{{ $totalBuku }}</strong>
                    <span>Total Koleksi Buku</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue">📖</div>
                <div class="stat-info">
                    <strong>{{ $totalPinjamUser }}</strong>
                    <span>Total Pinjaman Saya</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon amber">✅</div>
                <div class="stat-info">
                    <strong>{{ $totalKembaliUser }}</strong>
                    <span>Sudah Dikembalikan</span>
                </div>
            </div>
        </div>

        @if($peminjamanAktif->count())
            <div class="active-loans">
                <div class="section-header">
                    <h2 class="section-title">📖 Sedang Dipinjam</h2>
                    <a href="{{ route('user.peminjaman') }}" class="section-link">Lihat semua →</a>
                </div>
                <div class="loan-list">
                    @foreach($peminjamanAktif as $item)
                        <div class="loan-item">
                            <div class="loan-cover">📘</div>
                            <div class="loan-info">
                                <div class="loan-title">{{ $item->detailBuku->buku->judul_buku ?? '-' }}</div>
                                <div class="loan-meta">
                                    No. Eksemplar: {{ $item->no_buku }} &middot;
                                    Dipinjam: {{ $item->tgl_pinjam?->format('d M Y') }}
                                </div>
                            </div>
                            <span class="loan-badge">Sedang Dipinjam</span>
                        </div>
                    @endforeach
                </div>
            </div>
        @elseif(Auth::user()->id_anggota)
            <div class="empty-loan" style="margin-bottom:40px;">
                <div class="empty-loan-icon">📚</div>
                <strong style="font-size:16px;">Belum ada buku yang dipinjam</strong>
                <p style="font-size:13px;margin-top:6px;">Jelajahi katalog dan ajukan peminjaman buku pilihanmu.</p>
                <a href="{{ route('katalog') }}" style="display:inline-block;margin-top:14px;padding:10px 22px;background:var(--sage-500);color:white;border-radius:50px;font-size:13px;font-weight:600;">Lihat Katalog</a>
            </div>
        @else
            <div class="empty-loan" style="margin-bottom:40px;">
                <div class="empty-loan-icon">🔗</div>
                <strong style="font-size:16px;">Akun belum terhubung ke data anggota</strong>
                <p style="font-size:13px;margin-top:6px;">Hubungi petugas perpustakaan untuk mengaitkan akunmu agar bisa meminjam buku.</p>
            </div>
        @endif

        <div class="section-header">
            <h2 class="section-title">Akses Cepat</h2>
        </div>
        <div class="quick-grid">
            <a href="{{ route('katalog') }}" class="quick-card">
                <div class="quick-icon">📚</div>
                <strong>Katalog Buku</strong>
                <span>Jelajahi semua koleksi</span>
            </a>
            <a href="{{ route('user.peminjaman') }}" class="quick-card">
                <div class="quick-icon">📖</div>
                <strong>Peminjaman Saya</strong>
                <span>{{ $totalPinjamUser }} transaksi tercatat</span>
            </a>
            <a href="{{ route('user.profile') }}" class="quick-card">
                <div class="quick-icon">👤</div>
                <strong>Profil Saya</strong>
                <span>Kelola informasi akun</span>
            </a>
            <a href="{{ route('informasi') }}" class="quick-card">
                <div class="quick-icon">ℹ️</div>
                <strong>Informasi</strong>
                <span>Jam layanan &amp; aturan</span>
            </a>
        </div>
    </div>

    <div class="section" style="padding-top:0;">
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
                            <div class="book-author">{{ $buku->pengarang }}</div>
                            @if($buku->stok_tersedia > 0)
                                <span class="badge badge-available">Tersedia · {{ $buku->stok_tersedia }}</span>
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

    <div class="info-banner">
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

<footer>
    <div class="footer-inner">
        <div class="footer-brand">
            <strong>📖 Ruang Baca</strong>
            <p>Sistem Informasi Perpustakaan</p>
        </div>
        <div class="footer-links">
            <a href="{{ route('katalog') }}">Katalog Buku</a>
            <a href="{{ route('user.peminjaman') }}">Peminjaman Saya</a>
            <a href="{{ route('informasi') }}">Informasi</a>
            <a href="{{ route('user.profile') }}">Profil</a>
        </div>
        <div class="footer-logout">
            <form action="{{ route('logout') }}" method="POST">@csrf<button type="submit">🚪 Keluar</button></form>
        </div>
    </div>
    <div class="footer-copy">&copy; {{ date('Y') }} Ruang Baca — Sistem Informasi Perpustakaan. Hak cipta dilindungi.</div>
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
window.addEventListener('scroll',()=>{
    document.getElementById('navbar')?.classList.toggle('scrolled',scrollY>10);
});
</script>
</body>
</html>
