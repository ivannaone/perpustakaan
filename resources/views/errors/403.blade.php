<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akses Ditolak</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f7fb;
            padding: 20px;
        }

        .error-box {
            background: white;
            width: 100%;
            max-width: 500px;
            text-align: center;
            padding: 45px 30px;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .error-code {
            font-size: 70px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 10px;
        }

        h1 {
            color: #1e293b;
            margin-bottom: 12px;
        }

        p {
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        .button {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 11px 22px;
            border-radius: 8px;
        }

        .button:hover {
            background: #1d4ed8;
        }
    </style>
</head>

<body>

    <div class="error-box">
        <div class="error-code">403</div>

        <h1>Akses Ditolak</h1>

        <p>
            Maaf, akun kamu tidak memiliki izin untuk mengakses
            halaman ini.
        </p>

        @if (Auth::check())
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="button">
                    Kembali ke Dashboard
                </a>
            @else
                <a href="{{ route('user.dashboard') }}" class="button">
                    Kembali ke Dashboard
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="button">
                Kembali ke Login
            </a>
        @endif
    </div>

</body>
</html>