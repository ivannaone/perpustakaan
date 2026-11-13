<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Peminjaman — PustakaLog</title>
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
.action-bar{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:20px;flex-wrap:wrap;}
.action-bar-right{display:flex;gap:10px;}
.btn{display:inline-flex;align-items:center;gap:7px;padding:10px 18px;border-radius:50px;font-size:14px;font-weight:600;border:none;cursor:pointer;font-family:'Inter',sans-serif;transition:all .2s;}
.btn-primary{background:var(--navy-500);color:white;}
.btn-primary:hover{background:var(--navy-600);}
.btn-danger{background:#dc2626;color:white;}
.btn-danger:hover{background:#b91c1c;}
.btn-success{background:var(--sage-500);color:white;}
.btn-success:hover{background:#4f7039;}
.btn-secondary{background:white;color:var(--text-main);border:1.5px solid var(--border);}
.btn-secondary:hover{background:#f8fafc;}
.btn-pdf{background:#dc2626;color:white;}
.btn-pdf:hover{background:#b91c1c;}
.btn-sm{padding:7px 14px;font-size:13px;}
.alert{border-radius:var(--radius-md);padding:13px 16px;font-size:14px;margin-bottom:18px;}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#991b1b;}
.search-row{display:flex;gap:10px;margin-bottom:20px;}
.search-row input{flex:1;padding:11px 16px;border:1.5px solid var(--border);border-radius:50px;font-size:14px;outline:none;font-family:'Inter',sans-serif;transition:border-color .2s;}
.search-row input:focus{border-color:var(--navy-400);}
.search-row button{padding:11px 20px;background:var(--navy-500);color:white;border:none;border-radius:50px;cursor:pointer;font-size:14px;font-weight:600;}
.table-wrap{background:white;border-radius:var(--radius-lg);border:1px solid var(--border);overflow:hidden;}
.table-scroll{overflow-x:auto;}
table{width:100%;border-collapse:collapse;min-width:1000px;}
thead th{background:#f8fafc;padding:13px 16px;text-align:left;font-size:13px;font-weight:600;color:var(--text-muted);border-bottom:1px solid var(--border);}
tbody td{padding:13px 16px;font-size:14px;border-bottom:1px solid var(--border);}
tbody tr:last-child td{border-bottom:none;}
tbody tr:hover td{background:#fafbfc;}
.action-cell{display:flex;gap:8px;flex-wrap:wrap;}
.pagination-wrap{padding:16px 22px;border-top:1px solid var(--border);}
.empty-row td{text-align:center;padding:40px;color:var(--text-muted);}
.badge{display:inline-block;padding:4px 11px;border-radius:50px;font-size:12px;font-weight:600;}
.badge-dipinjam{background:#fef3c7;color:#92400e;}
.badge-dikembalikan{background:#dcfce7;color:#166534;}
footer{background:white;border-top:1px solid var(--border);padding:14px 28px;font-size:13px;color:var(--text-muted);}
@media(max-width:768px){.sidebar{left:calc(-1 * var(--sidebar-w));transition:left .25s ease;}.sidebar.open{left:0;}.overlay.show{display:block;}.main{margin-left:0;}.menu-toggle{display:flex;}.topbar{padding-left:68px;}.action-bar{flex-direction:column;align-items:flex-start;}}
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
    <a href="{{ route('peminjaman.index') }}" class="active"><span class="icon">🔄</span> Peminjaman</a>
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
    <div class="topbar-left"><h1>Peminjaman</h1><div class="breadcrumb">Dashboard › Peminjaman</div></div>
    <div class="topbar-right"><div class="topbar-avatar">{{ strtoupper(substr(Auth::user()->nama,0,1)) }}</div><span style="font-size:14px;font-weight:500;">{{ Auth::user()->nama }}</span></div>
  </header>
  <main class="content">

    @if(session('success'))<div class="alert alert-success">✓ {{ session('success') }}</div>@endif
    @if(session('error'))<div class="alert alert-error">✕ {{ session('error') }}</div>@endif

    <div class="action-bar">
      <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">+ Tambah Peminjaman</a>
      <div class="action-bar-right">
        <a href="{{ route('laporan.peminjaman') }}" class="btn btn-pdf">📄 Cetak PDF</a>
      </div>
    </div>

    <div class="search-row">
      <form action="{{ route('peminjaman.index') }}" method="GET" style="display:flex;gap:10px;flex:1;">
        <input type="text" name="search" value="{{ $search }}" placeholder="Cari ID peminjaman, nama anggota, atau nomor buku...">
        <button type="submit">🔎 Cari</button>
      </form>
    </div>

    <div class="table-wrap">
      <div class="table-scroll">
        <table>
          <thead>
            <tr><th>No</th><th>ID Pinjam</th><th>Tgl Pinjam</th><th>Anggota</th><th>No. Buku</th><th>Judul Buku</th><th>Status</th><th>Tgl Kembali</th><th>Aksi</th></tr>
          </thead>
          <tbody>
            @forelse($peminjaman as $item)
              <tr>
                <td>{{ $peminjaman->firstItem() + $loop->index }}</td>
                <td><code style="background:#f1f5f9;padding:2px 7px;border-radius:5px;font-size:12px;">{{ $item->id_pinjam }}</code></td>
                <td>{{ $item->tgl_pinjam?->format('d-m-Y') ?? '-' }}</td>
                <td style="font-weight:500;">{{ $item->anggota->nama_anggota ?? '-' }}</td>
                <td>{{ $item->no_buku }}</td>
                <td>{{ $item->detailBuku->buku->judul_buku ?? '-' }}</td>
                <td>
                  @if($item->status==='dipinjam')
                    <span class="badge badge-dipinjam">Dipinjam</span>
                  @else
                    <span class="badge badge-dikembalikan">Dikembalikan</span>
                  @endif
                </td>
                <td>{{ $item->tgl_kembali?->format('d-m-Y') ?? '-' }}</td>
                <td>
                  <div class="action-cell">
                    @if($item->status==='dipinjam')
                      <form action="{{ route('peminjaman.return', $item->id_pinjam) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Konfirmasi pengembalian buku ini?')">↩ Kembalikan</button>
                      </form>
                    @endif
                    <form action="{{ route('peminjaman.destroy', $item->id_pinjam) }}" method="POST" style="display:inline;">
                      @csrf @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data peminjaman ini?')">Hapus</button>
                    </form>
                  </div>
                </td>
              </tr>
            @empty
              <tr class="empty-row"><td colspan="9">Belum ada data peminjaman.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
      <div class="pagination-wrap">{{ $peminjaman->links() }}</div>
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
