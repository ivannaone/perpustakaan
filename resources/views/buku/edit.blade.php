<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Buku — PustakaLog</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{--cream-50:#fdfaf5;--cream-200:#ede4cc;--brown-500:#8a6540;--navy-500:#1e3a5f;--navy-600:#162d4a;--navy-400:#2a5080;--sage-500:#6a8f52;--text-main:#1a1a2e;--text-muted:#64748b;--border:#e2e8f0;--radius-lg:14px;--radius-md:9px;--sidebar-w:240px;}
body{font-family:'Inter',system-ui,sans-serif;background:#f1f5f9;color:var(--text-main);min-height:100vh;}
a{text-decoration:none;color:inherit;}
.sidebar{position:fixed;left:0;top:0;width:var(--sidebar-w);height:100vh;background:var(--navy-500);color:white;display:flex;flex-direction:column;z-index:100;overflow-y:auto;}
.sidebar-brand{padding:24px 20px 16px;border-bottom:1px solid rgba(255,255,255,.08);display:flex;align-items:center;gap:10px;}
.sidebar-brand-icon{width:36px;height:36px;background:rgba(255,255,255,.12);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px;}
.sidebar-brand-text strong{display:block;font-family:'Lora',serif;font-size:16px;}
.sidebar-brand-text small{font-size:10px;opacity:.6;letter-spacing:.5px;text-transform:uppercase;}
.sidebar-section-label{padding:20px 20px 8px;font-size:10px;font-weight:600;letter-spacing:.8px;text-transform:uppercase;opacity:.45;}
.sidebar-menu{padding:0 12px;}
.sidebar-menu a{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:var(--radius-md);font-size:14px;font-weight:500;color:rgba(255,255,255,.75);margin-bottom:2px;transition:background .15s,color .15s;}
.sidebar-menu a:hover{background:rgba(255,255,255,.08);color:white;}
.sidebar-menu a.active{background:rgba(255,255,255,.14);color:white;}
.sidebar-menu a .icon{font-size:16px;width:20px;text-align:center;}
.sidebar-footer{margin-top:auto;padding:16px 12px 20px;border-top:1px solid rgba(255,255,255,.08);}
.sidebar-footer form button{width:100%;display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:var(--radius-md);background:none;border:none;cursor:pointer;font-size:14px;color:rgba(255,255,255,.65);font-family:'Inter',sans-serif;}
.sidebar-footer form button:hover{background:rgba(255,255,255,.08);color:white;}
.menu-toggle{display:none;position:fixed;top:14px;left:14px;width:40px;height:40px;background:var(--navy-500);color:white;border:none;border-radius:10px;cursor:pointer;font-size:18px;z-index:150;align-items:center;justify-content:center;}
.overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.35);z-index:90;}
.main{margin-left:var(--sidebar-w);min-height:100vh;display:flex;flex-direction:column;}
.topbar{background:white;border-bottom:1px solid var(--border);padding:0 28px;height:64px;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;z-index:50;}
.topbar-left h1{font-size:20px;font-weight:700;}
.topbar-left .breadcrumb{font-size:12px;color:var(--text-muted);margin-top:2px;}
.topbar-right{display:flex;align-items:center;gap:12px;}
.topbar-avatar{width:36px;height:36px;border-radius:50%;background:var(--cream-200);color:var(--brown-500);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);}
.content{flex:1;padding:28px;}
.form-card{background:white;border:1px solid var(--border);border-radius:var(--radius-lg);padding:28px;max-width:700px;}
.form-card h2{font-family:'Lora',serif;font-size:20px;font-weight:700;margin-bottom:4px;}
.form-card .subtitle{font-size:13px;color:var(--text-muted);margin-bottom:24px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px;}
.form-group{margin-bottom:0;}
.form-group.full{grid-column:1/-1;}
.form-group label{display:block;font-size:13px;font-weight:600;color:var(--text-main);margin-bottom:7px;}
.form-group label .req{color:#dc2626;margin-left:2px;}
.form-group input{width:100%;padding:11px 14px;border:1.5px solid var(--border);border-radius:var(--radius-md);font-family:'Inter',sans-serif;font-size:14px;color:var(--text-main);outline:none;transition:border-color .2s,box-shadow .2s;}
.form-group input:focus{border-color:var(--navy-400);box-shadow:0 0 0 3px rgba(42,80,128,.12);}
.form-group input[disabled]{background:#f8fafc;color:var(--text-muted);cursor:not-allowed;}
.field-error{font-size:12px;color:#dc2626;margin-top:5px;}
.form-actions{display:flex;gap:10px;margin-top:24px;padding-top:20px;border-top:1px solid var(--border);}
.btn{display:inline-flex;align-items:center;gap:7px;padding:11px 22px;border-radius:50px;font-size:14px;font-weight:600;border:none;cursor:pointer;font-family:'Inter',sans-serif;transition:all .2s;}
.btn-primary{background:var(--navy-500);color:white;}
.btn-primary:hover{background:var(--navy-600);}
.btn-secondary{background:white;color:var(--text-main);border:1.5px solid var(--border);}
.btn-secondary:hover{background:#f8fafc;}
footer{background:white;border-top:1px solid var(--border);padding:14px 28px;font-size:13px;color:var(--text-muted);}
@media(max-width:768px){.sidebar{left:calc(-1 * var(--sidebar-w));transition:left .25s ease;}.sidebar.open{left:0;}.overlay.show{display:block;}.main{margin-left:0;}.menu-toggle{display:flex;}.topbar{padding-left:68px;}.form-grid{grid-template-columns:1fr;}}
</style>
</head>
<body>
<button class="menu-toggle" id="menuToggle">☰</button>
<div class="overlay" id="overlay" onclick="closeSidebar()"></div>
<aside class="sidebar" id="sidebar">
  <div class="sidebar-brand"><div class="sidebar-brand-icon">📚</div><div class="sidebar-brand-text"><strong>PustakaLog</strong><small>Admin Panel</small></div></div>
  <div class="sidebar-section-label">Menu Utama</div>
  <nav class="sidebar-menu">
    <a href="{{ route('admin.dashboard') }}"><span class="icon">🏠</span> Dashboard</a>
    <a href="{{ route('buku.index') }}" class="active"><span class="icon">📚</span> Data Buku</a>
    <a href="{{ route('detail-buku.index') }}"><span class="icon">📖</span> Detail Buku</a>
    <a href="{{ route('anggota.index') }}"><span class="icon">👥</span> Data Anggota</a>
    <a href="{{ route('peminjaman.index') }}"><span class="icon">🔄</span> Peminjaman</a>
  </nav>
  <div class="sidebar-section-label">Lainnya</div>
  <nav class="sidebar-menu">
    <a href="{{ route('admin.users') }}"><span class="icon">🔗</span> Kelola Akun User</a>
    <a href="{{ route('laporan.index') }}"><span class="icon">📊</span> Laporan</a>
  </nav>
  <div class="sidebar-footer"><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit"><span class="icon">🚪</span> Keluar</button></form></div>
</aside>
<div class="main">
  <header class="topbar">
    <div class="topbar-left"><h1>Edit Buku</h1><div class="breadcrumb">Dashboard › Data Buku › Edit</div></div>
    <div class="topbar-right"><div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->nama,0,1)) }}</div></div>
  </header>
  <main class="content">
    <div class="form-card">
      <h2>Edit Data Buku</h2>
      <p class="subtitle">Perbarui informasi buku. ID Buku tidak dapat diubah.</p>
      <form action="{{ route('buku.update', ['buku' => $buku->id_buku]) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-grid">
          <div class="form-group">
            <label>ID Buku</label>
            <input type="text" value="{{ $buku->id_buku }}" disabled>
          </div>
          <div class="form-group">
            <label>Jumlah Eksemplar <span class="req">*</span></label>
            <input type="number" name="jumlah" value="{{ old('jumlah', $buku->jumlah) }}" min="0" required>
            @error('jumlah')<div class="field-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group full">
            <label>Judul Buku <span class="req">*</span></label>
            <input type="text" name="judul_buku" value="{{ old('judul_buku', $buku->judul_buku) }}" maxlength="150" required>
            @error('judul_buku')<div class="field-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group full">
            <label>Pengarang <span class="req">*</span></label>
            <input type="text" name="pengarang" value="{{ old('pengarang', $buku->pengarang) }}" maxlength="100" required>
            @error('pengarang')<div class="field-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label>Penerbit</label>
            <input type="text" name="penerbit" value="{{ old('penerbit', $buku->penerbit) }}" maxlength="100">
            @error('penerbit')<div class="field-error">{{ $message }}</div>@enderror
          </div>
          <div class="form-group">
            <label>Tahun Terbit</label>
            <input type="number" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1000" max="9999">
            @error('tahun_terbit')<div class="field-error">{{ $message }}</div>@enderror
          </div>
        </div>
        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
          <a href="{{ route('buku.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </main>
  <footer>&copy; {{ date('Y') }} PustakaLog</footer>
</div>
<script>
const menuToggle=document.getElementById('menuToggle'),sidebar=document.getElementById('sidebar'),overlay=document.getElementById('overlay');
menuToggle.addEventListener('click',()=>{sidebar.classList.add('open');overlay.classList.add('show');});
function closeSidebar(){sidebar.classList.remove('open');overlay.classList.remove('show');}
</script>
</body>
</html>
