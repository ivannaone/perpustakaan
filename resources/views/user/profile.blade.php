<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profil Saya - Perpustakaan</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            color: #172033;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .navbar {
            height: 70px;
            background: white;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 7%;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #2563eb;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand strong {
            font-size: 17px;
        }

        .brand span {
            display: block;
            color: #6b7280;
            font-size: 11px;
            margin-top: 3px;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 25px;
            font-size: 14px;
            color: #4b5563;
        }

        .nav a:hover {
            color: #2563eb;
        }

        .nav .active {
            color: #2563eb;
            font-weight: 600;
        }

        .user {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .avatar-small {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .page-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 40px 7%;
        }

        .page-header-inner {
            max-width: 1000px;
            margin: auto;
        }

        .page-header small {
            color: #2563eb;
            font-weight: bold;
        }

        .page-header h1 {
            margin: 8px 0;
            font-size: 30px;
        }

        .page-header p {
            color: #6b7280;
            font-size: 14px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 35px 20px;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: 280px 1fr;
            gap: 20px;
        }

        .profile-card,
        .form-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 14px;
            padding: 25px;
        }

        .profile-card {
            text-align: center;
        }

        .avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #dbeafe;
            color: #2563eb;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 34px;
            font-weight: bold;
            margin: 0 auto 18px;
        }

        .profile-card h2 {
            font-size: 19px;
            margin-bottom: 6px;
        }

        .profile-card p {
            color: #6b7280;
            font-size: 13px;
        }

        .role {
            display: inline-block;
            margin-top: 15px;
            padding: 6px 12px;
            border-radius: 20px;
            background: #eff6ff;
            color: #2563eb;
            font-size: 12px;
            font-weight: bold;
        }

        .form-card h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .form-subtitle {
            color: #6b7280;
            font-size: 13px;
            margin-bottom: 25px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 7px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #2563eb;
        }

        .readonly {
            background: #f3f4f6;
            color: #6b7280;
        }

        .save-button {
            border: none;
            background: #2563eb;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 13px;
        }

        .save-button:hover {
            background: #1d4ed8;
        }

        .back {
            display: inline-block;
            margin-top: 20px;
            color: #64748b;
            font-size: 13px;
        }

        .back:hover {
            color: #2563eb;
        }

        .footer {
            margin-top: 40px;
            background: #111827;
            color: white;
            padding: 28px 7%;
        }

        .footer-inner {
            max-width: 1000px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer p {
            color: #9ca3af;
            font-size: 12px;
            margin-top: 5px;
        }

        .logout {
            color: #f87171;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 13px;
        }

        .logout:hover {
            text-decoration: underline;
        }

        @media (max-width: 750px) {
            .navbar {
                padding: 0 20px;
            }

            .nav {
                display: none;
            }

            .page-header {
                padding: 35px 20px;
            }

            .profile-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .brand span {
                display: none;
            }

            .container {
                padding: 25px 15px;
            }

            .profile-card,
            .form-card {
                padding: 20px;
            }

            .footer-inner {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">

        <a href="{{ route('user.dashboard') }}" class="brand">

            <div class="brand-icon">
                📚
            </div>

            <div>
                <strong>Perpustakaan</strong>

                <span>
                    Sistem Informasi Perpustakaan
                </span>
            </div>

        </a>

        <div class="nav">

            <a href="{{ route('user.dashboard') }}">
                Beranda
            </a>

            <a href="{{ route('user.buku') }}">
                Katalog
            </a>

            <a href="{{ route('user.peminjaman') }}">
                Peminjaman Saya
            </a>

            <a href="{{ route('user.informasi') }}">
                Informasi
            </a>

            <a href="{{ route('user.profile') }}" class="active">
                Profil
            </a>

        </div>

        <div class="user">

            <div class="avatar-small">
                {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
            </div>

            <span style="font-size: 13px;">
                {{ Auth::user()->nama }}
            </span>

        </div>

    </nav>


    <header class="page-header">

        <div class="page-header-inner">

            <small>
                AKUN SAYA
            </small>

            <h1>
                Profil Saya
            </h1>

            <p>
                Kelola informasi akun perpustakaan kamu.
            </p>

        </div>

    </header>


    <main class="container">

        @if(session('success'))

            <div class="success">
                {{ session('success') }}
            </div>

        @endif


        @if($errors->any())

            <div class="error">
                <strong>Terjadi kesalahan:</strong>

                <ul style="margin: 7px 0 0 18px;">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <div class="profile-grid">

            <div class="profile-card">

                <div class="avatar">
                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                </div>

                <h2>
                    {{ Auth::user()->nama }}
                </h2>

                <p>
                    @{{ Auth::user()->username }}
                </p>

                <span class="role">
                    {{ ucfirst(Auth::user()->role) }}
                </span>

            </div>


            <div class="form-card">

                <h2>
                    Informasi Akun
                </h2>

                <p class="form-subtitle">
                    Perbarui informasi dasar akun kamu.
                </p>

                <form
                    action="{{ route('user.profile.update') }}"
                    method="POST"
                >

                    @csrf
                    @method('PUT')

                    <div class="form-group">

                        <label for="nama">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama', Auth::user()->nama) }}"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label for="username">
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username', Auth::user()->username) }}"
                            required
                        >

                    </div>


                    <div class="form-group">

                        <label>
                            Role
                        </label>

                        <input
                            type="text"
                            value="{{ ucfirst(Auth::user()->role) }}"
                            class="readonly"
                            readonly
                        >

                    </div>


                    <button
                        type="submit"
                        class="save-button"
                    >
                        Simpan Perubahan
                    </button>

                </form>

            </div>

        </div>


        <a
            href="{{ route('user.dashboard') }}"
            class="back"
        >
            ← Kembali ke Beranda
        </a>

    </main>


    <footer class="footer">

        <div class="footer-inner">

            <div>

                <strong>
                    Perpustakaan
                </strong>

                <p>
                    Sistem Informasi Perpustakaan
                </p>

            </div>

            <form
                action="{{ route('logout') }}"
                method="POST"
            >

                @csrf

                <button
                    type="submit"
                    class="logout"
                >
                    Keluar
                </button>

            </form>

        </div>

    </footer>

</body>
</html>