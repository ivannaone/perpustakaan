<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan — PustakaLog</title>
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
.topbar-right{display:flex;align-items:center;gap:12px;}
.topbar-avatar{width:36px;height:36px;border-radius:50%;background:var(--cream-200);color:var(--brown-500);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;border:2px solid var(--border);}
.content{flex:1;padding:28px;}
.export-card{background:white;border:1px solid var(--border);border-radius:var(--radius-lg);padding:24px 28px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap;}
.export-card-left h2{font-family:'Lora',serif;font-size:18px;font-weight:700;margin-bottom:4px;}
.export-card-left p{font-size:13px;color:var(--text-muted);}
.export-btns{display:flex;gap:10px;flex-wrap:wrap;}
.btn{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:50px;font-size:14px;font-weight:600;border:none;cursor:pointer;font-family:'Inter',sans-serif;transition:all .2s;}
.btn-pdf{background:#dc2626;color:white;}
.btn-pdf:hover{background:#b91c1c;}
.btn-excel{background:var(--sage-500);color:white;}
.btn-excel:hover{background:#4f7039;}
.table-wrap{background:white;border-radius:var(--radius-lg);border:1px solid var(--border);overflow:hidden;}
.table-header{padding:18px 22px 0;display:flex;align-items:center;justify-content:space-between;}
.table-header h3{font-family:'Lora',serif;font-size:16px;font-weight:700;}
.table-header span{font-size:13px;color:var(--text-muted);}
.table-scroll{overflow-x:auto;}
table{width:100%;border-collapse:collapse;min-width:900px;}
thead th{background:#f8fafc;padding:13px 16px;text-align:left;font-size:13px;font-weight:600;color:var(--text-muted);border-bottom:1px solid var(--border);}
tbody td{padding:13px 16px;font-size:14px;border-bottom:1px solid var(--border);}
tbody tr:last-child td{border-bottom:none;}
tbody tr:hover td{background:#fafbfc;}
.empty-row td{text-align:center;padding:40px;color:var(--text-muted);}
.badge{display:inline-block;padding:4px 11px;border-radius:50px;font-size:12px;font-weight:600;}
.badge-dipinjam{background:#fef3c7;color:#92400e;}
.badge-dikembalikan{background:#dcfce7;color:#166534;}
footer{background:white;border-top:1px solid var(--border);padding:14px 28px;font-size:13px;color:var(--text-muted);}
@media(max-width:768px){.sidebar{left:calc(-1 * var(--sidebar-w));transition:left .25s ease;}.sidebar.open{left:0;}.overlay.show{display:block;}.main{margin-left:0;}.menu-toggle{display:flex;}.topbar{padding-left:68px;}.export-card{flex-direction:column;align-items:flex-start;}}
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
    <a href="{{ route('buku.index') }}"><span class="icon">📚</span> Data Buku</a>
    <a href="{{ route('detail-buku.index') }}"><span class="icon">📖</span> Detail Buku</a>
    <a href="{{ route('anggota.index') }}"><span class="icon">👥</span> Data Anggota</a>
    <a href="{{ route('peminjaman.index') }}"><span class="icon">🔄</span> Peminjaman</a>
  </nav>
  <div class="sidebar-section-label">Lainnya</div>
  <nav class="sidebar-menu">
    <a href="{{ route('admin.users') }}"><span class="icon">🔗</span> Kelola Akun User</a>
    <a href="{{ route('laporan.index') }}" class="active"><span class="icon">📊</span> Laporan</a>
  </nav>
  <div class="sidebar-footer"><form action="{{ route('logout') }}" method="POST">@csrf<button type="submit"><span class="icon">🚪</span> Keluar</button></form></div>
</aside>
<div class="main">
  <header class="topbar">
    <div class="topbar-left"><h1>Laporan</h1><div class="breadcrumb">Dashboard › Laporan</div></div>
    <div class="topbar-right"><div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->nama,0,1)) }}</div><span style="font-size:14px;font-weight:500;">{{ Auth::user()->nama }}</span></div>
  </header>
  <main class="content">

    <div class="export-card">
      <div class="export-card-left">
        <h2>📄 Laporan Peminjaman</h2>
        <p>Cetak atau export seluruh data peminjaman buku dalam format PDF atau Excel.</p>
      </div>
      <div class="export-btns">
        <a href="{{ route('laporan.peminjaman') }}" class="btn btn-pdf">📄 Cetak PDF</a>
        <a href="{{ route('laporan.peminjaman.excel') }}" class="btn btn-excel">📊 Export Excel</a>
      </div>
    </div>

    <div class="table-wrap">
      <div class="table-header">
        <h3>Rekap Data Peminjaman</h3>
        <span>Total: {{ $peminjaman->count() }} transaksi</span>
      </div>
      <div class="table-scroll" style="margin-top:14px;">
        <table>
          <thead>
            <tr><th>No</th><th>ID Pinjam</th><th>Anggota</th><th>No. Buku</th><th>Judul Buku</th><th>Tgl Pinjam</th><th>Tgl Kembali</th><th>Status</th></tr>
          </thead>
          <tbody>
            @forelse($peminjaman as $item)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td><code style="background:#f1f5f9;padding:2px 7px;border-radius:5px;font-size:12px;">{{ $item->id_pinjam }}</code></td>
                <td style="font-weight:500;">{{ $item->anggota->nama_anggota ?? '-' }}</td>
                <td>{{ $item->no_buku }}</td>
                <td>{{ $item->detailBuku->buku->judul_buku ?? '-' }}</td>
                <td>{{ $item->tgl_pinjam?->format('d-m-Y') ?? '-' }}</td>
                <td>{{ $item->tgl_kembali?->format('d-m-Y') ?? '-' }}</td>
                <td>
                  @if($item->status==='dipinjam')
                    <span class="badge badge-dipinjam">Dipinjam</span>
                  @else
                    <span class="badge badge-dikembalikan">Dikembalikan</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr class="empty-row"><td colspan="8">Belum ada data peminjaman.</td></tr>
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
