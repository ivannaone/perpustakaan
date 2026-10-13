<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Akun User - Perpustakaan</title>

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

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
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
            min-width: 800px;
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

        .badge-linked {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #dcfce7;
            color: #166534;
        }

        .badge-unlinked {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            background: #fee2e2;
            color: #991b1b;
        }

        .kaitkan-form {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kaitkan-form select {
            padding: 8px 10px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 13px;
            outline: none;
            max-width: 200px;
        }

        .kaitkan-form select:focus {
            border-color: #2563eb;
        }

        .btn-save {
            padding: 8px 14px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: white;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            white-space: nowrap;
        }

        .btn-save:hover {
            background: #1d4ed8;
        }

        .empty {
            text-align: center;
            padding: 35px;
            color: #64748b;
        }

        .pagination {
            margin-top: 20px;
        }

        .info-note {
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            padding: 13px 16px;
            font-size: 13px;
            color: #1e40af;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        @media (max-width: 700px) {
            .header {
                padding: 15px;
            }

            .header h2 {
                font-size: 18px;
            }

            .container {
                margin-top: 20px;
                padding: 0 15px;
            }

            .top {
                gap: 12px;
                margin-bottom: 20px;
            }

            .back-button {
                width: 46px;
                height: 46px;
                font-size: 24px;
            }

            .top h1 {
                font-size: 26px;
            }

            .search {
                flex-direction: column;
            }

            .kaitkan-form {
                flex-direction: column;
                align-items: flex-start;
            }

            .kaitkan-form select {
                max-width: 100%;
                width: 100%;
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

            <h1>Kelola Akun User</h1>

        </div>

        <div class="info-note">
            Kaitkan akun user dengan data anggota perpustakaan agar user dapat mengajukan peminjaman buku.
            Satu anggota hanya bisa dikaitkan ke satu akun.
        </div>

        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.users') }}" method="GET" class="search">

            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                placeholder="Cari nama atau username..."
            >

            <button type="submit">
                🔎 Cari
            </button>

            @if($search)
                <a href="{{ route('admin.users') }}" class="reset-button">
                    Reset
                </a>
            @endif

        </form>

        <div class="table-wrapper">

            <table>

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Anggota Terhubung</th>
                        <th>Kaitkan ke Anggota</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($users as $item)

                        <tr>

                            <td>
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td>
                                {{ $item->nama }}
                            </td>

                            <td>
                                {{ $item->username }}
                            </td>

                            <td>
                                @if($item->id_anggota)
                                    <span class="badge-linked">Terhubung</span>
                                @else
                                    <span class="badge-unlinked">Belum Terhubung</span>
                                @endif
                            </td>

                            <td>
                                @if($item->anggota)
                                    {{ $item->anggota->nama_anggota }}
                                    <br>
                                    <small style="color:#6b7280;">
                                        {{ $item->id_anggota }}
                                    </small>
                                @else
                                    <span style="color:#9ca3af;">—</span>
                                @endif
                            </td>

                            <td>

                                <form
                                    action="{{ route('admin.users.kaitkan', $item->id) }}"
                                    method="POST"
                                    class="kaitkan-form"
                                >

                                    @csrf

                                    <select name="id_anggota">
                                        <option value="">— Lepas kaitan —</option>

                                        @foreach($anggota as $a)
                                            <option
                                                value="{{ $a->id_anggota }}"
                                                {{ $item->id_anggota === $a->id_anggota ? 'selected' : '' }}
                                            >
                                                {{ $a->nama_anggota }} ({{ $a->id_anggota }})
                                            </option>
                                        @endforeach

                                    </select>

                                    <button type="submit" class="btn-save">
                                        Simpan
                                    </button>

                                </form>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="empty">
                                Belum ada akun user.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="pagination">
            {{ $users->links() }}
        </div>

    </div>

</body>

</html>
