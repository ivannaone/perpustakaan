<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Laporan Peminjaman</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #222;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #2563eb;
            color: white;
            padding: 8px;
            border: 1px solid #333;
        }

        td {
            padding: 7px;
            border: 1px solid #999;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>SISTEM INFORMASI PERPUSTAKAAN</h1>
        <p>Laporan Data Peminjaman Buku</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pinjam</th>
                <th>Anggota</th>
                <th>No Buku</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($peminjaman as $item)
                <tr>
                    <td class="center">
                        {{ $loop->iteration }}
                    </td>

                    <td>
                        {{ $item->id_pinjam }}
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

                    <td class="center">
                        {{ $item->tgl_pinjam?->format('d-m-Y') ?? '-' }}
                    </td>

                    <td class="center">
                        {{ $item->tgl_kembali?->format('d-m-Y') ?? '-' }}
                    </td>

                    <td class="center">
                        {{ ucfirst($item->status) }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="center">
                        Belum ada data peminjaman.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>