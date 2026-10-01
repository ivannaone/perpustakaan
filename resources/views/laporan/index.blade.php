<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laporan - Sistem Informasi Perpustakaan</title>

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

        .back-button {
            width: 46px;
            height: 46px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #64748b;
            color: white;
            text-decoration: none;
            border-radius: 9px;
            font-size: 25px;
            line-height: 1;
        }

        .back-button:hover {
            background: #475569;
        }

        .top h2 {
            font-size: 24px;
        }

        .report-card {
            background: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .report-card h3 {
            margin-bottom: 8px;
            font-size: 20px;
        }

        .report-card p {
            color: #64748b;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .report-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-pdf,
        .btn-excel {
            display: inline-block;
            padding: 11px 18px;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-pdf {
            background: #dc2626;
        }

        .btn-pdf:hover {
            background: #b91c1c;
        }

        .btn-excel {
            background: #16a34a;
        }

        .btn-excel:hover {
            background: #15803d;
        }

        .table-wrapper {
            background: white;
            border-radius: 14px;
            overflow-x: auto;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th,
        td {
            padding: 14px 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        th {
            background: #eff6ff;
            color: #1e40af;
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

        .empty {
            text-align: center;
            padding: 40px;
            color: #64748b;
        }

        @media (max-width: 700px) {
            .header {
                padding: 15px;
            }

            .header h1 {
                font-size: 18px;
                line-height: 1.3;
            }

            .header span {
                font-size: 13px;
            }

            .container {
                margin: 20px auto;
                padding: 0 20px;
            }

            .top {
                align-items: flex-start;
            }

            .top-left {
                gap: 12px;
                align-items: center;
            }

            .back-button {
                width: 46px;
                height: 46px;
                flex-shrink: 0;
            }

            .top h2 {
                font-size: 22px;
            }

            .report-card {
                padding: 20px;
            }

            .report-card h3 {
                font-size: 18px;
            }

            .report-buttons {
                flex-direction: column;
            }

            .btn-pdf,
            .btn-excel {
                width: 100%;
                text-align: center;
            }

            .table-wrapper {
                border-radius: 12px;
            }
        }

        @media (max-width: 450px) {
            .header {
                padding: 15px;
            }

            .header h1 {
                font-size: 17px;
                max-width: 210px;
            }

            .container {
                padding: 0 15px;
            }

            .top h2 {
                font-size: 20px;
            }

            .back-button {
                width: 44px;
                height: 44px;
                font-size: 23px;
            }

            .report-card {
                padding: 18px;
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

        <div class="top">

            <div class="top-left">

                <a href="{{ route('admin.dashboard') }}" class="back-button">
                    ←
                </a>

                <h2>Laporan Perpustakaan</h2>

            </div>

        </div>

        <div class="report-card">

            <h3>📄 Laporan Peminjaman</h3>

            <p>
                Cetak atau export seluruh data peminjaman buku
                dalam format PDF dan Excel.
            </p>

            <div class="report-buttons">

                <a
                    href="{{ route('laporan.peminjaman') }}"
                    class="btn-pdf"
                >
                    📄 Cetak Laporan PDF
                </a>

                <a
                    href="{{ route('laporan.peminjaman.excel') }}"
                    class="btn-excel"
                >
                    📊 Export Excel
                </a>

            </div>

        </div>

        <div class="table-wrapper">

            @if ($peminjaman->count() > 0)

                <table>

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>ID Pinjam</th>
                            <th>Anggota</th>
                            <th>No. Buku</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        @foreach ($peminjaman as $item)

                            <tr>

                                <td>
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

                                <td>
                                    {{ $item->tgl_pinjam?->format('d-m-Y') ?? '-' }}
                                </td>

                                <td>
                                    {{ $item->tgl_kembali?->format('d-m-Y') ?? '-' }}
                                </td>

                                <td>

                                    @if ($item->status === 'dipinjam')

                                        <span class="status status-dipinjam">
                                            Dipinjam
                                        </span>

                                    @else

                                        <span class="status status-dikembalikan">
                                            Dikembalikan
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            @else

                <div class="empty">
                    Belum ada data peminjaman.
                </div>

            @endif

        </div>

    </div>

</body>

</html>