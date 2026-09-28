<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar | Perpustakaan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f4f7fb;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 950px;
            min-height: 570px;
            background: white;
            border-radius: 24px;
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.10);
        }

        .left {
            background: linear-gradient(145deg, #2563eb, #1d4ed8);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            font-size: 42px;
            margin-bottom: 25px;
        }

        .left h1 {
            font-size: 36px;
            line-height: 1.2;
            margin-bottom: 18px;
        }

        .left p {
            font-size: 16px;
            line-height: 1.7;
            color: rgba(255,255,255,0.85);
        }

        .right {
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right h2 {
            font-size: 30px;
            color: #172033;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7b8494;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 7px;
        }

        input {
            width: 100%;
            padding: 13px 15px;
            border: 1px solid #dce1e8;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
        }

        input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
        }

        .button {
            width: 100%;
            border: none;
            padding: 14px;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 5px;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 15px;
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #7b8494;
        }

        .login-link a {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .left {
                padding: 35px;
                min-height: 240px;
            }

            .left h1 {
                font-size: 28px;
            }

            .right {
                padding: 35px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="left">
        <div class="logo">📚</div>

        <h1>
            Bergabung dengan
            Perpustakaan
        </h1>

        <p>
            Buat akun untuk mengakses sistem
            informasi perpustakaan dengan mudah.
        </p>
    </div>


    <div class="right">

        <h2>Buat Akun</h2>

        <p class="subtitle">
            Daftar sebagai pengguna perpustakaan.
        </p>

        @if ($errors->any())
            <div class="error">
                <ul style="padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST">

            @csrf

            <div class="form-group">
                <label>Nama Lengkap</label>

                <input
                    type="text"
                    name="nama"
                    placeholder="Masukkan nama lengkap"
                    value="{{ old('nama') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Buat username"
                    value="{{ old('username') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Buat password"
                    required
                >
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>

                <input
                    type="password"
                    name="password_confirmation"
                    placeholder="Ulangi password"
                    required
                >
            </div>

            <button type="submit" class="button">
                Daftar
            </button>

        </form>

        <div class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </div>

    </div>

</div>

</body>
</html>