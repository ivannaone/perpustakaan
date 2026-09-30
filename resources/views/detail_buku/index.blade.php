<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
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

        .header h2 {
            margin: 0;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 10px;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        .button {
            display: inline-block;
            padding: 10px 15px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            color: white;
            background: #2563eb;
            cursor: pointer;
        }

        .button.dashboard {
            background: #64748b;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .search {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search input {
            flex: 1;
            padding: 11px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th, td {
            padding: 13px 15px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #eff6ff;
            color: #1e40af;
        }

        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
        }

        .ada {
            background: #dcfce7;
            color: #166534;
        }

        .dipinjam {
            background: #fee2e2;
            color: #991b1b;
        }

        .action-edit {
            color: #2563eb;
            text-decoration: none;
            margin-right: 8px;
        }

        .action-delete {
            color: #dc2626;
            border: none;
            background: none;
            cursor: pointer;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        @media (max-width: 700px) {
            .header {
                padding: 15px;
            }

            .container {
                margin-top: 20px;
            }

            .top {
                flex-direction: column;
                align-items: stretch;
            }

            .buttons {
                flex-direction: column;
            }

            .search {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Sistem Informasi Perpustakaan</h2>

    @auth
        <span>{{ Auth::user()->nama }}</span>
    @endauth
</div>

<div class="container">

    <div class="top">
        <h1>Detail Buku</h1>

        <div class="buttons">
            <a href="{{ route('admin.dashboard') }}" class="button dashboard">
                Dashboard
            </a>

            <a href="{{ route('detail-buku.create') }}" class="button">
                + Tambah Detail Buku
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('detail-buku.index') }}" method="GET" class="search">
        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari nomor buku, ID buku, atau status..."
        >

        <button type="submit" class="button">
            🔎 Cari
        </button>

        @if ($search)
            <a href="{{ route('detail-buku.index') }}" class="button dashboard">
                Reset
            </a>
        @endif
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Buku</th>
                    <th>ID Buku</th>
                    <th>Judul Buku</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($detailBuku as $item)
                    <tr>
                        <td>{{ $detailBuku->firstItem() + $loop->index }}</td>

                        <td>{{ $item->no_buku }}</td>

                        <td>{{ $item->id_buku }}</td>

                        <td>
                            {{ $item->buku->judul_buku ?? '-' }}
                        </td>

                        <td>
                            <span class="status {{ $item->status === 'ada' ? 'ada' : 'dipinjam' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>

                        <td>
                            <a
                                href="{{ route('detail-buku.edit', $item->no_buku) }}"
                                class="action-edit"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('detail-buku.destroy', $item->no_buku) }}"
                                method="POST"
                                style="display:inline;"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="action-delete"
                                    onclick="return confirm('Yakin ingin menghapus detail buku ini?')"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="empty">
                            Belum ada detail buku.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $detailBuku->links() }}
    </div>

</div>

</body>
</html>