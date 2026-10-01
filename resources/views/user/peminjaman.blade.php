<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Saya - Perpustakaan</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #1e293b;
        }

        nav {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 18px 7%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .brand {
            font-size: 22px;
            font-weight: 700;
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            gap: 24px;
        }

        .nav-links a {
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
        }

        .nav-links a.active {
            color: #2563eb;
            font-weight: 600;
        }

        .user {
            font-size: 14px;
            font-weight: 600;
        }

        main {
            max-width: 1100px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .top {
            margin-bottom: 25px;
        }

        .back {
            display: inline-block;
            text-decoration: none;
            color: #64748b;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            margin-bottom: 15px;
            box-shadow: 0 5px 20px rgba(15, 23, 42, 0.05);
        }

        .book-title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .info {
            color: #64748b;
            font-size: 14px;
            line-height: 1.8;
        }

        .status {
            display: inline-block;
            margin-top: 12px;
            padding: 7px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .dipinjam {
            background: #fef3c7;
            color: #92400e;
        }

        .dikembalikan {
            background: #dcfce7;
            color: #166534;
        }

        .empty {
            background: white;
            border-radius: 16px;
            padding: 50px 20px;
            text-align: center;
            color: #64748b;
        }

        .pagination {
            margin-top: 25px;
        }

        footer {
            margin-top: 70px;
            padding: 30px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
        }

        @media (max-width: 700px) {
            nav {
                padding: 15px 20px;
            }

            .nav-links {
                display: none;
            }

            main {
                margin-top: 25px;
            }

            h1 {
                font-size: 25px;
            }

            .card {
                padding: 18px;
            }
        }
    </style>
</head>

<body>

<nav>
    <div class="brand">Perpustakaan</div>

    <div class="nav-links">
        <a href="{{ route('user.dashboard') }}">Beranda</a>
        <a href="{{ route('user.buku') }}">Katalog</a>
        <a href="{{ route('user.peminjaman') }}" class="active">
            Peminjaman Saya
        </a>
        <a href="{{ route('user.informasi') }}">
            Informasi
        </a>
        <a href="{{ route('user.profile') }}">Profil</a>
    </div>

    <div class="user">
        {{ Auth::user()->nama }}
    </div>
</nav>

<main>

    <div class="top">
        <a href="{{ route('user.dashboard') }}" class="back">← Kembali</a>

        <h1>Peminjaman Saya</h1>

        <p class="subtitle">
            Daftar buku yang sedang dan pernah kamu pinjam.
        </p>
    </div>

    @forelse ($peminjaman as $item)

        <div class="card">

            <div class="book-title">
                {{ $item->detailBuku->buku->judul_buku ?? '-' }}
            </div>

            <div class="info">
                <div>No. Buku: {{ $item->no_buku }}</div>

                <div>
                    Tanggal Pinjam:
                    {{ $item->tgl_pinjam?->format('d-m-Y') ?? '-' }}
                </div>

                <div>
                    Tanggal Kembali:
                    {{ $item->tgl_kembali?->format('d-m-Y') ?? 'Belum dikembalikan' }}
                </div>
            </div>

            <span class="status {{ $item->status }}">
                {{ ucfirst($item->status) }}
            </span>

        </div>

    @empty

        <div class="empty">
            <h3>Belum ada peminjaman</h3>
            <p>Kamu belum memiliki riwayat peminjaman buku.</p>
        </div>

    @endforelse

    <div class="pagination">
        {{ $peminjaman->links() }}
    </div>

</main>

<footer>
    Sistem Informasi Perpustakaan
</footer>

</body>
</html>