<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $buku->judul_buku }} — PustakaLog</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
:root{--cream-200:#ede4cc;--brown-500:#8a6540;--navy-500:#1e3a5f;--navy-600:#162d4a;--navy-400:#2a5080;--sage-500:#6a8f52;--text-main:#1a1a2e;--text-muted:#64748b;--border:#e2e8f0;--radius-lg:14px;--radius-md:9px;--sidebar-w:240px;}
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
.topbar-right{display:flex;align-items:center;gap:10px;}
.topbar-avatar{width:36px;height:36px;border-radius:50%;background:var(--cream-200);color:var(--brown-500);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);}
.content{flex:1;padding:28px;}
.btn{display:inline-flex;align-items:center;gap:7px;padding:9px 18px;border-radius:50px;font-size:13px;font-weight:600;border:none;cursor:pointer;font-family:'Inter',sans-serif;transition:all .2s;}
.btn-primary{background:var(--navy-500);color:white;}
.btn-primary:hover{background:var(--navy-600);}
.btn-danger{background:#dc2626;color:white;}
.btn-danger:hover{background:#b91c1c;}
.btn-secondary{background:white;color:var(--text-main);border:1.5px solid var(--border);}
.btn-secondary:hover{background:#f8fafc;}
.btn-sage{background:var(--sage-500);color:white;}
.btn-sage:hover{background:#4f7039;}
.btn-sm{padding:7px 14px;font-size:12px;}
.detail-layout{display:grid;grid-template-columns:220px 1fr;gap:20px;margin-bottom:20px;}
.cover-card{background:white;border:1px solid var(--border);border-radius:var(--radius-lg);padding:24px;display:flex;flex-direction:column;align-items:center;text-align:center;gap:12px;}
.cover-art{width:120px;height:160px;background:var(--cream-200);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:52px;margin-bottom:4px;}
.cover-card strong{font-family:'Lora',serif;font-size:15px;line-height:1.4;}
.cover-card span{font-size:13px;color:var(--text-muted);}
.info-card{background:white;border:1px solid var(--border);border-radius:var(--radius-lg);padding:24px;}
.info-card h2{font-family:'Lora',serif;font-size:20px;margin-bottom:16px;}
.meta-list{display:grid;grid-template-columns:140px 1fr;gap:10px 16px;font-size:14px;}
.meta-list dt{color:var(--text-muted);font-weight:500;}
.meta-list dd{font-weight:500;}
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:20px;}
.stat-card{background:white;border:1px solid var(--border);border-radius:var(--radius-lg);padding:18px;text-align:center;}
.stat-card span{font-size:12px;color:var(--text-muted);display:block;margin-bottom:6px;}
.stat-card strong{font-size:28px;font-weight:700;}
.table-card{background:white;border:1px solid var(--border);border-radius:var(--radius-lg);overflow:hidden;}
.table-card-header{padding:18px 22px;display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--border);flex-wrap:wrap;gap:10px;}
.table-card-header h3{font-family:'Lora',serif;font-size:17px;}
.table-card-header p{font-size:13px;color:var(--text-muted);margin-top:3px;}
.table-scroll{overflow-x:auto;}
table{width:100%;border-collapse:collapse;min-width:400px;}
thead th{background:#f8fafc;padding:12px 16px;text-align:left;font-size:13px;font-weight:600;color:var(--text-muted);border-bottom:1px solid var(--border);}
tbody td{padding:12px 16px;font-size:14px;border-bottom:1px solid var(--border);}
tbody tr:last-child td{border-bottom:none;}
tbody tr:hover td{background:#fafbfc;}
.empty td{text-align:center;padding:36px;color:var(--text-muted);}
.badge{display:inline-block;padding:4px 10px;border-radius:50px;font-size:12px;font-weight:600;}
.badge-ada{background:#dcfce7;color:#166534;}
.badge-dipinjam{background:#fee2e2;color:#991b1b;}
code{background:#f1f5f9;padding:2px 7px;border-radius:5px;font-size:12px;}
.action-row{display:flex;gap:8px;flex-wrap:wrap;align-items:center;margin-bottom:20px;}
footer{background:white;border-top:1px solid var(--border);padding:14px 28px;font-size:13px;color:var(--text-muted);}
@media(max-width:900px){.detail-layout{grid-template-columns:1fr;}.stats-row{grid-template-columns:repeat(2,1fr);}}
@media(max-width:768px){.sidebar{left:calc(-1 * var(--sidebar-w));transition:left .25s ease;}.sidebar.open{left:0;}.overlay.show{display:block;}.main{margin-left:0;}.menu-toggle{display:flex;}.topbar{padding-left:68px;}.stats-row{grid-template-columns:1fr 1fr;}}
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
    <div class="topbar-left">
      <h1>Detail Buku</h1>
      <div class="breadcrumb">Dashboard › Data Buku › {{ $buku->id_buku }}</div>
    </div>
    <div class="topbar-right">
      <div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->nama,0,1)) }}</div>
    </div>
  </header>
  <main class="content">

    <div class="action-row">
      <a href="{{ route('buku.index') }}" class="btn btn-secondary">← Kembali</a>
      <a href="{{ route('buku.edit', $buku->id_buku) }}" class="btn btn-primary">Edit Buku</a>
      <form action="{{ route('buku.destroy', $buku->id_buku) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus buku ini beserta semua eksemplarnya?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger">Hapus Buku</button>
      </form>
    </div>

    <div class="stats-row">
      <div class="stat-card"><span>Eksemplar Terdaftar</span><strong>{{ $buku->detailBuku->count() }}</strong></div>
      <div class="stat-card"><span>Tersedia</span><strong style="color:#166534;">{{ $tersedia }}</strong></div>
      <div class="stat-card"><span>Sedang Dipinjam</span><strong style="color:#991b1b;">{{ $sedangDipinjam }}</strong></div>
      <div class="stat-card"><span>Target Jumlah</span><strong>{{ $buku->jumlah }}</strong></div>
    </div>

    <div class="detail-layout">
      <div class="cover-card">
        <div class="cover-art">📘</div>
        <strong>{{ $buku->judul_buku }}</strong>
        <span>{{ $buku->pengarang }}</span>
      </div>
      <div class="info-card">
        <h2>Informasi Buku</h2>
        <dl class="meta-list">
          <dt>ID Buku</dt><dd><code>{{ $buku->id_buku }}</code></dd>
          <dt>Judul</dt><dd>{{ $buku->judul_buku }}</dd>
          <dt>Pengarang</dt><dd>{{ $buku->pengarang }}</dd>
          <dt>Penerbit</dt><dd>{{ $buku->penerbit ?: '—' }}</dd>
          <dt>Tahun Terbit</dt><dd>{{ $buku->tahun_terbit ?: '—' }}</dd>
          <dt>Jumlah Tercatat</dt><dd>{{ $buku->jumlah }} eksemplar</dd>
        </dl>
      </div>
    </div>

    <div class="table-card">
      <div class="table-card-header">
        <div>
          <h3>Daftar Eksemplar</h3>
          <p>Status ketersediaan diambil dari data detail buku.</p>
        </div>
        <form action="{{ route('detail-buku.generate', $buku->id_buku) }}" method="POST" onsubmit="return confirm('Generate {{ $buku->jumlah }} eksemplar?')">
          @csrf
          <button type="submit" class="btn btn-sage btn-sm">⚡ Generate Eksemplar</button>
        </form>
      </div>
      <div class="table-scroll">
        <table>
          <thead>
            <tr><th>No. Eksemplar</th><th>Status</th><th>Aksi</th></tr>
          </thead>
          <tbody>
            @forelse($buku->detailBuku as $item)
              <tr>
                <td><code>{{ $item->no_buku }}</code></td>
                <td>
                  @if($item->status==='ada')
                    <span class="badge badge-ada">Tersedia</span>
                  @else
                    <span class="badge badge-dipinjam">Dipinjam</span>
                  @endif
                </td>
                <td><a href="{{ route('detail-buku.edit', $item->no_buku) }}" class="btn btn-secondary btn-sm">Edit</a></td>
              </tr>
            @empty
              <tr class="empty"><td colspan="3">Belum ada eksemplar. Gunakan tombol Generate.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </main>
  <footer>&copy; {{ date('Y') }} PustakaLog — Sistem Informasi Perpustakaan</footer>
</div>
<script>
const menuToggle=document.getElementById('menuToggle'),sidebar=document.getElementById('sidebar'),overlay=document.getElementById('overlay');
menuToggle.addEventListener('click',()=>{sidebar.classList.add('open');overlay.classList.add('show');});
function closeSidebar(){sidebar.classList.remove('open');overlay.classList.remove('show');}
</script>
</body>
</html>
