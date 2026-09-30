<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman - Sistem Informasi Perpustakaan</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            color: #1e293b;
        }

        .header {
            background: #2563eb;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 22px;
        }

        .header span {
            font-size: 14px;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .top-bar h2 {
            font-size: 24px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-dashboard {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-add {
            background: #2563eb;
            color: white;
        }

        .search-box {
            background: white;
            padding: 18px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input {
            flex: 1;
            padding: 11px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
        }

        .btn-search {
            background: #2563eb;
            color: white;
        }

        .alert {
            background: #dcfce7;
            color: #166534;
            padding: 13px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th,
        td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        th {
            background: #f8fafc;
            color: #475569;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status-dipinjam {
            background: #fef3c7;
            color: #92400e;
        }

        .status-dikembalikan {
            background: #dcfce7;
            color: #166534;
        }

        .actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .action-return {
            color: #16a34a;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .action-delete {
            color: #dc2626;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .pagination {
            padding: 20px;
        }

        .empty {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }

        @media (max-width: 600px) {
            .header {
                padding: 16px 20px;
            }

            .header h1 {
                font-size: 18px;
            }

            .container {
                margin: 20px auto;
            }

            .top-bar h2 {
                font-size: 20px;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form button {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Sistem Informasi Perpustakaan</h1>
        <span>{{ Auth::user()->nama }}</span>
    </div>

    <div class="container">

        <div class="top-bar">
            <h2>Data Peminjaman</h2>

            <div class="buttons">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-dashboard">
                    Dashboard
                </a>

                <a href="{{ route('peminjaman.create') }}" class="btn btn-add">
                    + Tambah Peminjaman
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="search-box">
            <form action="{{ route('peminjaman.index') }}" method="GET" class="search-form">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Cari ID peminjaman, nama anggota, atau nomor buku..."
                >

                <button type="submit" class="btn btn-search">
                    Cari
                </button>
            </form>
        </div>

        <div class="table-wrapper">
            @if($peminjaman->count() > 0)

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID Pinjam</th>
                            <th>Tanggal Pinjam</th>
                            <th>Anggota</th>
                            <th>No. Buku</th>
                            <th>Judul Buku</th>
                            <th>Status</th>
                            <th>Tanggal Kembali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($peminjaman as $item)
                            <tr>
                                <td>
                                    {{ $peminjaman->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    {{ $item->id_pinjam }}
                                </td>

                                <td>
                                    {{ $item->tgl_pinjam?->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ $item->anggota->nama_anggota ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->no_buku }}
                                </td>

                                <td>
                                    {{ $item->detailBuku->buku->judul_buku ?? '-' }}
                                </td>

                                <td>
                                    @if($item->status === 'dipinjam')
                                        <span class="status status-dipinjam">
                                            Dipinjam
                                        </span>
                                    @else
                                        <span class="status status-dikembalikan">
                                            Dikembalikan
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $item->tgl_kembali?->format('d-m-Y') ?? '-' }}
                                </td>

                                <td>
                                    <div class="actions">

                                        @if($item->status === 'dipinjam')
                                            <form
                                                action="{{ route('peminjaman.return', $item->id_pinjam) }}"
                                                method="POST"
                                            >
                                                @csrf

                                                <button
                                                    type="submit"
                                                    class="action-return"
                                                    onclick="return confirm('Yakin buku ini sudah dikembalikan?')"
                                                >
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @endif

                                        <form
                                            action="{{ route('peminjaman.destroy', $item->id_pinjam) }}"
                                            method="POST"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="action-delete"
                                                onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')"
                                            >
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination">
                    {{ $peminjaman->links() }}
                </div>

            @else

                <div class="empty">
                    Belum ada data peminjaman.
                </div>

            @endif
        </div>

    </div>

</body>
</html>