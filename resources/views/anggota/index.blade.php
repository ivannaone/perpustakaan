<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Anggota - Perpustakaan</title>

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

        .top {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .back-button {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #64748b;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 25px;
            flex-shrink: 0;
        }

        .back-button:hover {
            background: #475569;
        }

        .top h1 {
            margin: 0;
            font-size: 30px;
            flex: 1;
        }

        .add-button {
            display: inline-block;
            padding: 12px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: white;
            background: #2563eb;
            font-size: 15px;
            font-weight: 600;
        }

        .add-button:hover {
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
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            min-width: 0;
        }

        .search input:focus {
            border-color: #2563eb;
        }

        .search button,
        .reset-button {
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            white-space: nowrap;
        }

        .search button:hover {
            background: #1d4ed8;
        }

        .reset-button {
            background: #64748b;
        }

        .reset-button:hover {
            background: #475569;
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
            min-width: 900px;
        }

        th,
        td {
            padding: 14px 15px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #eff6ff;
            color: #1e40af;
        }

        tr:hover td {
            background: #f8fafc;
        }

        .action-edit {
            color: #2563eb;
            text-decoration: none;
            margin-right: 10px;
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
            padding: 35px;
            color: #64748b;
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 700px) {
            .header {
                padding: 15px;
            }

            .header h2 {
                font-size: 18px;
            }

            .header span {
                font-size: 13px;
            }

            .container {
                margin-top: 20px;
                padding: 0 15px;
            }

            .top {
                gap: 12px;
                margin-bottom: 20px;
                align-items: center;
            }

            .back-button {
                width: 46px;
                height: 46px;
                font-size: 24px;
            }

            .top h1 {
                font-size: 28px;
                line-height: 1.15;
            }

            .add-button {
                padding: 11px 13px;
                font-size: 14px;
                max-width: 150px;
            }

            .search {
                flex-direction: column;
            }

            .search input,
            .search button,
            .reset-button {
                width: 100%;
            }

            .table-wrapper {
                border-radius: 12px;
            }

            th,
            td {
                padding: 13px 14px;
            }
        }

        @media (max-width: 430px) {
            .top {
                align-items: flex-start;
            }

            .top h1 {
                font-size: 26px;
            }

            .add-button {
                max-width: 125px;
                line-height: 1.2;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>📚 Sistem Informasi Perpustakaan</h2>

        @auth
            <span>{{ Auth::user()->nama }}</span>
        @endauth
    </div>

    <div class="container">

        <div class="top">

            <a href="{{ route('admin.dashboard') }}" class="back-button">
                ←
            </a>

            <h1>Data Anggota</h1>

            <a href="{{ route('anggota.create') }}" class="add-button">
                + Tambah Anggota
            </a>

        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('anggota.index') }}" method="GET" class="search">

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari ID, nama, jenis anggota, atau kelas/prodi..."
            >

            <button type="submit">
                🔎 Cari
            </button>

            @if ($search)
                <a href="{{ route('anggota.index') }}" class="reset-button">
                    Reset
                </a>
            @endif

        </form>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Anggota</th>
                        <th>Nama</th>
                        <th>Jenis Anggota</th>
                        <th>Kelas / Prodi</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($anggota as $item)

                        <tr>

                            <td>
                                {{ $anggota->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $item->id_anggota }}
                            </td>

                            <td>
                                {{ $item->nama_anggota }}
                            </td>

                            <td>
                                {{ $item->jenis_anggota }}
                            </td>

                            <td>
                                {{ $item->kelas_prodi ?? '-' }}
                            </td>

                            <td>
                                {{ $item->tempat_lahir ?? '-' }}
                            </td>

                            <td>
                                {{ $item->tgl_lahir
                                    ? $item->tgl_lahir->format('d-m-Y')
                                    : '-' }}
                            </td>

                            <td>

                                <a
                                    href="{{ route('anggota.edit', $item->id_anggota) }}"
                                    class="action-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('anggota.destroy', $item->id_anggota) }}"
                                    method="POST"
                                    style="display:inline;"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="action-delete"
                                        onclick="return confirm('Yakin ingin menghapus anggota ini?')"
                                    >
                                        Hapus
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="empty">
                                Belum ada data anggota.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="pagination">
            {{ $anggota->links() }}
        </div>

    </div>

</body>

</html>