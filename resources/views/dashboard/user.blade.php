<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Perpustakaan</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f7fb;
            min-height: 100vh;
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

        .container {
            padding: 30px;
        }

        .welcome {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        }

        .welcome h2 {
            margin-bottom: 10px;
            color: #1e293b;
        }

        .welcome p {
            color: #64748b;
        }

        .logout {
            margin-top: 25px;
        }

        .logout button {
            background: #ef4444;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>📚 Sistem Informasi Perpustakaan</h1>
        <span>User</span>
    </div>

    <div class="container">
        <div class="welcome">
            <h2>Selamat Datang, {{ Auth::user()->nama }} 👋</h2>
            <p>Anda berhasil login sebagai user.</p>

            <div class="logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>