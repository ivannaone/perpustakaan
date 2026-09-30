<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Buku - Sistem Informasi Perpustakaan</title>

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
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .card h2 {
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .button {
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            cursor: pointer;
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

        @media (max-width: 600px) {
            .header {
                padding: 15px 20px;
            }

            .container {
                margin-top: 20px;
            }

            .card {
                padding: 20px;
            }

            .buttons {
                flex-direction: column;
            }

            .button {
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

            <h2>Tambah Data Buku</h2>

            <form action="{{ route('buku.store') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label for="id_buku">ID Buku</label>

                    <input
                        type="text"
                        id="id_buku"
                        name="id_buku"
                        value="{{ old('id_buku') }}"
                        placeholder="Contoh: B001"
                        maxlength="10"
                        required
                    >

                    @error('id_buku')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="judul_buku">Judul Buku</label>

                    <input
                        type="text"
                        id="judul_buku"
                        name="judul_buku"
                        value="{{ old('judul_buku') }}"
                        placeholder="Masukkan judul buku"
                        maxlength="150"
                        required
                    >

                    @error('judul_buku')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="pengarang">Pengarang</label>

                    <input
                        type="text"
                        id="pengarang"
                        name="pengarang"
                        value="{{ old('pengarang') }}"
                        placeholder="Masukkan nama pengarang"
                        maxlength="100"
                        required
                    >

                    @error('pengarang')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="penerbit">Penerbit</label>

                    <input
                        type="text"
                        id="penerbit"
                        name="penerbit"
                        value="{{ old('penerbit') }}"
                        placeholder="Masukkan nama penerbit"
                        maxlength="100"
                    >

                    @error('penerbit')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="tahun_terbit">Tahun Terbit</label>

                    <input
                        type="number"
                        id="tahun_terbit"
                        name="tahun_terbit"
                        value="{{ old('tahun_terbit') }}"
                        placeholder="Contoh: 2024"
                        min="1000"
                        max="9999"
                    >

                    @error('tahun_terbit')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="jumlah">Jumlah Buku</label>

                    <input
                        type="number"
                        id="jumlah"
                        name="jumlah"
                        value="{{ old('jumlah', 0) }}"
                        min="0"
                        placeholder="Contoh: 5"
                        required
                    >

                    @error('jumlah')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="buttons">

                    <button type="submit" class="button">
                        Simpan Buku
                    </button>

                    <a href="{{ route('buku.index') }}" class="button button-back">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>
</html>