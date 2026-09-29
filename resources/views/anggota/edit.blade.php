<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Anggota - Perpustakaan</title>

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
        }

        .header h1 {
            font-size: 22px;
        }

        .container {
            max-width: 700px;
            margin: 30px auto;
            padding: 0 20px;
        }

        .form-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        h2 {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            background: white;
        }

        input:focus,
        select:focus {
            border-color: #2563eb;
        }

        input:disabled {
            background: #f1f5f9;
            color: #64748b;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .button {
            border: none;
            padding: 11px 18px;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .save {
            background: #2563eb;
            color: white;
        }

        .save:hover {
            background: #1d4ed8;
        }

        .back {
            background: #e5e7eb;
            color: #374151;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>📚 Sistem Informasi Perpustakaan</h1>
    </div>

    <div class="container">

        <div class="form-box">

            <h2>Edit Anggota</h2>

            <form
            action="{{ route('anggota.update', ['anggota' => $anggota->id_anggota]) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

                <div class="form-group">

                    <label>ID Anggota</label>

                    <input
                        type="text"
                        value="{{ $anggota->id_anggota }}"
                        disabled
                    >

                </div>

                <div class="form-group">

                    <label>Nama Anggota</label>

                    <input
                        type="text"
                        name="nama_anggota"
                        value="{{ old('nama_anggota', $anggota->nama_anggota) }}"
                        required
                    >

                    @error('nama_anggota')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Jenis Anggota</label>

                    <select name="jenis_anggota" required>

                        <option value="">-- Pilih Jenis Anggota --</option>

                        <option
                            value="Siswa"
                            {{ old('jenis_anggota', $anggota->jenis_anggota) == 'Siswa' ? 'selected' : '' }}
                        >
                            Siswa
                        </option>

                        <option
                            value="Guru"
                            {{ old('jenis_anggota', $anggota->jenis_anggota) == 'Guru' ? 'selected' : '' }}
                        >
                            Guru
                        </option>

                        <option
                            value="Mahasiswa"
                            {{ old('jenis_anggota', $anggota->jenis_anggota) == 'Mahasiswa' ? 'selected' : '' }}
                        >
                            Mahasiswa
                        </option>

                        <option
                            value="Staff"
                            {{ old('jenis_anggota', $anggota->jenis_anggota) == 'Staff' ? 'selected' : '' }}
                        >
                            Staff
                        </option>

                        <option
                            value="Umum"
                            {{ old('jenis_anggota', $anggota->jenis_anggota) == 'Umum' ? 'selected' : '' }}
                        >
                            Umum
                        </option>

                    </select>

                    @error('jenis_anggota')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Kelas / Prodi</label>

                    <input
                        type="text"
                        name="kelas_prodi"
                        value="{{ old('kelas_prodi', $anggota->kelas_prodi) }}"
                        placeholder="Contoh: XII RPL 1 / Sistem Informasi"
                    >

                    @error('kelas_prodi')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Tempat Lahir</label>

                    <input
                        type="text"
                        name="tempat_lahir"
                        value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}"
                    >

                    @error('tempat_lahir')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Tanggal Lahir</label>

                    <input
                        type="date"
                        name="tgl_lahir"
                        value="{{ old('tgl_lahir', $anggota->tgl_lahir ? $anggota->tgl_lahir->format('Y-m-d') : '') }}"
                    >

                    @error('tgl_lahir')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="buttons">

                    <button
                        type="submit"
                        class="button save"
                    >
                        Simpan Perubahan
                    </button>

                    <a
                        href="{{ route('anggota.index') }}"
                        class="button back"
                    >
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</body>

</html>