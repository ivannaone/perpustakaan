<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Perpustakaan</title>

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

        .login-container {
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

        /* BAGIAN KIRI */
        .login-left {
            background: linear-gradient(145deg, #2563eb, #1d4ed8);
            color: white;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            top: -80px;
            right: -80px;
        }

        .login-left::after {
            content: "";
            position: absolute;
            width: 180px;
            height: 180px;
            border-radius: 50%;
            background: rgba(255,255,255,0.06);
            bottom: -60px;
            left: -60px;
        }

        .logo {
            font-size: 42px;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
        }

        .login-left h1 {
            font-size: 36px;
            line-height: 1.2;
            margin-bottom: 18px;
            position: relative;
            z-index: 1;
        }

        .login-left p {
            font-size: 16px;
            line-height: 1.7;
            color: rgba(255,255,255,0.85);
            max-width: 380px;
            position: relative;
            z-index: 1;
        }

        /* BAGIAN KANAN */
        .login-right {
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h2 {
            font-size: 30px;
            color: #172033;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #7b8494;
            margin-bottom: 32px;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #dce1e8;
            border-radius: 10px;
            outline: none;
            font-size: 14px;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.10);
        }

        .login-button {
            width: 100%;
            border: none;
            padding: 15px;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }

        .login-button:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }

        .error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 12px 14px;
            border-radius: 9px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .footer {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #9ca3af;
        }

        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
                max-width: 480px;
            }

            .login-left {
                padding: 35px;
                min-height: 260px;
            }

            .login-left h1 {
                font-size: 28px;
            }

            .login-left p {
                font-size: 14px;
            }

            .login-right {
                padding: 35px;
            }
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

    .login-link a:hover {
        text-decoration: underline;
    }
    </style>
</head>

<body>

<div class="login-container">

    <!-- KIRI -->
    <div class="login-left">

        <div class="logo">📚</div>

        <h1>
            Sistem Informasi<br>
            Perpustakaan
        </h1>

        <p>
            Kelola data buku, anggota, dan peminjaman
            dengan lebih mudah dalam satu sistem.
        </p>

    </div>


    <!-- KANAN -->
    <div class="login-right">

        <h2>Selamat Datang 👋</h2>

        <p class="subtitle">
            Silakan masuk ke akun perpustakaan kamu.
        </p>

        @if ($errors->any())
            <div class="error">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST">

            @csrf

            <div class="form-group">
                <label>Username</label>

                <input
                    type="text"
                    name="username"
                    placeholder="Masukkan username"
                    value="{{ old('username') }}"
                    required
                >
            </div>

            <div class="form-group">
                <label>Password</label>

                <input
                    type="password"
                    name="password"
                    placeholder="Masukkan password"
                    required
                >
            </div>

            <button type="submit" class="login-button">
                Masuk ke Sistem
            </button>

        </form>

        <div class="login-link">
        Belum punya akun?
        <a href="{{ route('register') }}">Daftar sekarang</a>
    </div>

    <div class="footer">
        © {{ date('Y') }} Sistem Informasi Perpustakaan
    </div>

    </div>

</div>

</body>
</html>