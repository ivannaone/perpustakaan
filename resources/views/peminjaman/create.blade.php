<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Peminjaman - Sistem Informasi Perpustakaan</title>

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
        }

        .header h1 {
            font-size: 22px;
        }

        .container {
            max-width: 750px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            border-radius: 14px;
            padding: 30px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.06);
        }

        .card h2 {
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
        }

        input,
        select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background: white;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 6px;
        }

        .info {
            background: #eff6ff;
            color: #1d4ed8;
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 22px;
            font-size: 14px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            padding: 11px 18px;
            border-radius: 8px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-back {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-save {
            background: #2563eb;
            color: white;
        }

        @media (max-width: 600px) {
            .header {
                padding: 16px 20px;
            }

            .header h1 {
                font-size: 18px;
            }

            .card {
                padding: 22px;
            }

            .buttons {
                flex-direction: column;
            }

            .buttons .btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Sistem Informasi Perpustakaan</h1>
    </div>

    <div class="container">

        <div class="card">

            <h2>Tambah Peminjaman</h2>

            <div class="info">
                Hanya buku dengan status <strong>Ada</strong> yang dapat dipinjam.
            </div>

            <form action="{{ route('peminjaman.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="id_pinjam">ID Peminjaman</label>

                    <input
                        type="text"
                        id="id_pinjam"
                        name="id_pinjam"
                        value="{{ old('id_pinjam') }}"
                        placeholder="Contoh: P001"
                        maxlength="10"
                        required
                    >

                    @error('id_pinjam')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tgl_pinjam">Tanggal Pinjam</label>

                    <input
                        type="date"
                        id="tgl_pinjam"
                        name="tgl_pinjam"
                        value="{{ old('tgl_pinjam', date('Y-m-d')) }}"
                        required
                    >

                    @error('tgl_pinjam')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="id_anggota">Anggota</label>

                    <select id="id_anggota" name="id_anggota" required>
                        <option value="">-- Pilih Anggota --</option>

                        @foreach($anggota as $item)
                            <option
                                value="{{ $item->id_anggota }}"
                                {{ old('id_anggota') == $item->id_anggota ? 'selected' : '' }}
                            >
                                {{ $item->id_anggota }} - {{ $item->nama_anggota }}
                            </option>
                        @endforeach
                    </select>

                    @error('id_anggota')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="no_buku">Buku</label>

                    <select id="no_buku" name="no_buku" required>
                        <option value="">-- Pilih Buku --</option>

                        @foreach($buku as $item)
                            <option
                                value="{{ $item->no_buku }}"
                                {{ old('no_buku') == $item->no_buku ? 'selected' : '' }}
                            >
                                {{ $item->no_buku }} -
                                {{ $item->buku->judul_buku ?? 'Judul tidak tersedia' }}
                            </option>
                        @endforeach
                    </select>

                    @error('no_buku')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="buttons">
                    <a
                        href="{{ route('peminjaman.index') }}"
                        class="btn btn-back"
                    >
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-save">
                        Simpan Peminjaman
                    </button>
                </div>

            </form>

        </div>

    </div>

</body>
</html>