<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku - Sistem Informasi Perpustakaan</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .header {
            background: #2563eb;
            color: white;
            padding: 18px 30px;
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

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
            flex-wrap: wrap;
        }

        .top-section h2 {
            font-size: 24px;
        }

        .top-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .button {
            display: inline-block;
            padding: 10px 16px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            font-size: 14px;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .button-back {
            background: #64748b;
        }

        .button-back:hover {
            background: #475569;
        }

        .import-form {
            display: flex;
            gap: 8px;
            align-items: center;
            flex-wrap: wrap;
        }

        .import-form input[type="file"] {
            padding: 8px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
            font-size: 14px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .search-box {
            background: white;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .search-form {
            display: flex;
            gap: 10px;
        }

        .search-form input {
            flex: 1;
            padding: 11px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .search-form input:focus {
            border-color: #2563eb;
        }

        .table-wrapper {
            background: white;
            border-radius: 10px;
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th {
            background: #eff6ff;
            color: #1e40af;
            padding: 14px;
            text-align: left;
            font-size: 14px;
        }

        td {
            padding: 13px 14px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
        }

        tr:hover {
            background: #f8fafc;
        }

        .action-edit {
            color: #2563eb;
            text-decoration: none;
            margin-right: 8px;
            font-weight: 600;
        }

        .action-delete {
            color: #dc2626;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #64748b;
        }

        .pagination {
            margin-top: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {
            .header {
                padding: 15px 20px;
            }

            .header h1 {
                font-size: 18px;
            }

            .container {
                margin-top: 20px;
            }

            .top-section {
                align-items: flex-start;
            }

            .top-section h2 {
                font-size: 20px;
            }

            .top-actions {
                width: 100%;
            }

            .import-form {
                width: 100%;
            }

            .import-form input[type="file"] {
                width: 100%;
            }

            .import-form .button {
                width: 100%;
                text-align: center;
            }

            .search-form {
                flex-direction: column;
            }

            .search-form .button {
                text-align: center;
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

        <div class="top-section">

            <h2>Data Buku</h2>

            <div class="top-actions">

                <a href="{{ route('admin.dashboard') }}" class="button button-back">
                    ← Dashboard
                </a>

                <a href="{{ route('buku.create') }}" class="button">
                    + Tambah Buku
                </a>

                <form
                    action="{{ route('buku.import') }}"
                    method="POST"
                    enctype="multipart/form-data"
                    class="import-form"
                >
                    @csrf

                    <input
                        type="file"
                        name="file"
                        accept=".xlsx,.xls,.csv"
                        required
                    >

                    <button
                        type="submit"
                        class="button"
                        style="cursor: pointer;"
                    >
                        📥 Import Excel
                    </button>
                </form>

            </div>

        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error">
                <strong>Import gagal:</strong>

                <ul style="margin-top: 8px; margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="search-box">

            <form
                action="{{ route('buku.index') }}"
                method="GET"
                class="search-form"
            >

                <input
                    type="text"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Cari ID buku, judul, pengarang, atau penerbit..."
                >

                <button type="submit" class="button">
                    🔎 Cari
                </button>

                @if ($search)
                    <a
                        href="{{ route('buku.index') }}"
                        class="button button-back"
                    >
                        Reset
                    </a>
                @endif

            </form>

        </div>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Buku</th>
                        <th>Judul Buku</th>
                        <th>Pengarang</th>
                        <th>Penerbit</th>
                        <th>Tahun</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($buku as $item)

                        <tr>

                            <td>
                                {{ $buku->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $item->id_buku }}
                            </td>

                            <td>
                                {{ $item->judul_buku }}
                            </td>

                            <td>
                                {{ $item->pengarang }}
                            </td>

                            <td>
                                {{ $item->penerbit ?? '-' }}
                            </td>

                            <td>
                                {{ $item->tahun_terbit ?? '-' }}
                            </td>

                            <td>
                                {{ $item->jumlah }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('buku.edit', $item->id_buku) }}"
                                    class="action-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('buku.destroy', $item->id_buku) }}"
                                    method="POST"
                                    style="display: inline;"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-delete"
                                        onclick="return confirm('Yakin ingin menghapus buku ini?')"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada data buku.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="pagination">
            {{ $buku->links() }}
        </div>

    </div>

</body>
</html>