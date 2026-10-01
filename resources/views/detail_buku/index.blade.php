<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Buku - Perpustakaan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
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

        .header h1 {
            font-size: 22px;
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
            gap: 15px;
        }

        .top-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .top h2 {
            font-size: 24px;
        }

        .back-button {
            width: 55px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #64748b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 25px;
            line-height: 1;
        }

        .back-button:hover {
            background: #475569;
        }

        .button {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .button:hover {
            background: #1d4ed8;
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
            outline: none;
            font-size: 14px;
        }

        .search input:focus {
            border-color: #2563eb;
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        th,
        td {
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
            display: inline-block;
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

        .action-edit:hover {
            text-decoration: underline;
        }

        .action-delete {
            color: #dc2626;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
        }

        .action-delete:hover {
            text-decoration: underline;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 700px) {
            .header {
                padding: 18px 20px;
            }

            .header h1 {
                font-size: 18px;
            }

            .container {
                margin-top: 20px;
                padding: 0 20px;
            }

            .top {
                align-items: flex-start;
            }

            .top-left {
                align-items: center;
                gap: 12px;
            }

            .top h2 {
                font-size: 23px;
            }

            .back-button {
                width: 50px;
                height: 42px;
                font-size: 23px;
            }

            .button {
                padding: 10px 14px;
            }

            .search {
                flex-direction: column;
            }

            .search .button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 16px 18px;
            }

            .header h1 {
                font-size: 17px;
            }

            .container {
                padding: 0 15px;
            }

            .top {
                gap: 12px;
            }

            .top-left {
                gap: 10px;
            }

            .top h2 {
                font-size: 22px;
            }

            .back-button {
                width: 45px;
                height: 40px;
                font-size: 22px;
            }

            .top > .button {
                padding: 10px 12px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

<div class="header">

    <h1>📚 Sistem Informasi Perpustakaan</h1>

    @auth
        <span>{{ Auth::user()->nama }}</span>
    @endauth

</div>

<div class="container">

    <div class="top">

        <div class="top-left">

            <a
                href="{{ route('admin.dashboard') }}"
                class="back-button"
                title="Kembali"
            >
                ←
            </a>

            <h2>Detail Buku</h2>

        </div>

        <a
            href="{{ route('detail-buku.create') }}"
            class="button"
        >
            + Tambah Detail Buku
        </a>

    </div>

    @if (session('success'))

        <div class="success">
            {{ session('success') }}
        </div>

    @endif

    <form
        action="{{ route('detail-buku.index') }}"
        method="GET"
        class="search"
    >

        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari nomor buku, ID buku, atau status..."
        >

        <button
            type="submit"
            class="button"
        >
            🔎 Cari
        </button>

        @if ($search)

            <a
                href="{{ route('detail-buku.index') }}"
                class="button"
                style="background: #64748b;"
            >
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

                        <td>
                            {{ $detailBuku->firstItem() + $loop->index }}
                        </td>

                        <td>
                            {{ $item->no_buku }}
                        </td>

                        <td>
                            {{ $item->id_buku }}
                        </td>

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

                        <td
                            colspan="6"
                            class="empty"
                        >
                            Belum ada detail buku.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="pagination">

        {{ $detailBuku->links() }}

    </div>

</div>

</body>
</html>