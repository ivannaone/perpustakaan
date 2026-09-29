<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Data Anggota - Perpustakaan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
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

        .container {
            padding: 30px;
        }

        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            gap: 15px;
        }

        .top h2 {
            font-size: 24px;
        }

        .button {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            display: inline-block;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .table-box {
            background: white;
            border-radius: 14px;
            padding: 20px;
            overflow-x: auto;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th,
        td {
            padding: 13px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f8fafc;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
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
            background: #ef4444;
            color: white;
            border: none;
            padding: 7px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        .action-delete:hover {
            background: #dc2626;
        }

        .pagination {
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            .top {
                flex-direction: column;
                align-items: flex-start;
            }

            .header {
                padding: 18px 20px;
            }

            .header h1 {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>📚 Sistem Informasi Perpustakaan</h1>

        <span>{{ Auth::user()->nama }}</span>
    </div>

    <div class="container">

        <div class="top">

            <div>

                <a href="{{ route('admin.dashboard') }}" class="button">
                    ← Dashboard
                </a>

                <h2 style="margin-top: 15px;">
                    Data Anggota
                </h2>

            </div>


            <a href="{{ route('anggota.create') }}" class="button">
                + Tambah Anggota
            </a>

        </div>

        @if (session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif

        <form action="{{ route('anggota.index') }}" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px;">

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari ID, nama, jenis anggota, atau kelas/prodi..."
                style="flex: 1; padding: 11px 14px; border: 1px solid #d1d5db; border-radius: 8px; outline: none;"
            >

            <button
                type="submit"
                class="button"
                style="border: none; cursor: pointer;"
            >
                🔎 Cari
            </button>

            @if ($search)
                <a href="{{ route('anggota.index') }}" class="button" style="background: #64748b;">
                    Reset
                </a>
            @endif

        </form>

        <div class="table-box">

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
                                {{ $loop->iteration }}
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


                            <!-- AKSI -->
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

                            <td
                                colspan="8"
                                class="empty"
                            >
                                Belum ada data anggota.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>


            <!-- PAGINATION -->
            <div class="pagination">

                {{ $anggota->links() }}

            </div>

        </div>

    </div>

</body>

</html>