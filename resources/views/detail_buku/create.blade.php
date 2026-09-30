<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Detail Buku</title>

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
        }

        .container {
            max-width: 650px;
            margin: 35px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input, select {
            width: 100%;
            padding: 11px 13px;
            margin-bottom: 18px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        .button {
            display: inline-block;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            color: white;
            background: #2563eb;
            text-decoration: none;
            cursor: pointer;
        }

        .back {
            background: #64748b;
        }

        .error {
            color: #dc2626;
            font-size: 14px;
            margin-top: -12px;
            margin-bottom: 15px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }
    </style>
</head>

<body>

<div class="header">
    <h2>Sistem Informasi Perpustakaan</h2>
</div>

<div class="container">

    <div class="card">

        <h1>Tambah Detail Buku</h1>

        <form action="{{ route('detail-buku.store') }}" method="POST">
            @csrf

            <label>No. Buku</label>
            <input
                type="text"
                name="no_buku"
                value="{{ old('no_buku') }}"
                placeholder="Contoh: B001-01"
                required
            >

            @error('no_buku')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Data Buku</label>

            <select name="id_buku" required>
                <option value="">-- Pilih Buku --</option>

                @foreach ($buku as $item)
                    <option
                        value="{{ $item->id_buku }}"
                        {{ old('id_buku') == $item->id_buku ? 'selected' : '' }}
                    >
                        {{ $item->id_buku }} - {{ $item->judul_buku }}
                    </option>
                @endforeach
            </select>

            @error('id_buku')
                <div class="error">{{ $message }}</div>
            @enderror

            <label>Status</label>

            <select name="status" required>
                <option value="ada" {{ old('status', 'ada') === 'ada' ? 'selected' : '' }}>
                    Ada
                </option>

                <option value="dipinjam" {{ old('status') === 'dipinjam' ? 'selected' : '' }}>
                    Dipinjam
                </option>
            </select>

            @error('status')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="actions">
                <a href="{{ route('detail-buku.index') }}" class="button back">
                    Kembali
                </a>

                <button type="submit" class="button">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>

</body>
</html>