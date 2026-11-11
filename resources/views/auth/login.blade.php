<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Ruang Baca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream-50:  #fdfaf5;
            --cream-100: #f7f1e3;
            --cream-200: #ede4cc;
            --brown-400: #a07850;
            --brown-500: #8a6540;
            --brown-600: #704f2e;
            --sage-400:  #8aab70;
            --sage-500:  #6a8f52;
            --navy-500:  #1e3a5f;
            --text-main: #2d2016;
            --text-muted:#7a6650;
            --radius-lg: 18px;
            --radius-md: 10px;
            --shadow-card: 0 8px 48px rgba(30,16,4,.18);
        }

        body {
            min-height: 100vh;
            font-family: 'Inter', system-ui, sans-serif;
            background: var(--cream-50);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px 16px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 15% 20%, rgba(138,171,112,.18) 0%, transparent 60%),
                radial-gradient(ellipse 60% 80% at 85% 80%, rgba(160,120,80,.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .page-wrap {
            width: 100%;
            max-width: 980px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 580px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            position: relative;
            z-index: 1;
        }

        .panel-left {
            background: linear-gradient(160deg, #4a3520 0%, #2d2016 55%, #1a3a1a 100%);
            padding: 56px 48px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .panel-left::before {
            content: '';
            position: absolute;
            width: 300px; height: 300px;
            border-radius: 50%;
            background: rgba(138,171,112,.12);
            top: -80px; right: -80px;
        }

        .panel-left::after {
            content: '';
            position: absolute;
            width: 200px; height: 200px;
            border-radius: 50%;
            background: rgba(160,120,80,.10);
            bottom: -60px; left: -60px;
        }

        .logo-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
            position: relative; z-index: 1;
        }

        .logo-icon {
            width: 46px; height: 46px;
            background: rgba(138,171,112,.25);
            border: 1px solid rgba(138,171,112,.4);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }

        .logo-text strong {
            display: block;
            font-family: 'Lora', serif;
            font-size: 20px;
            font-weight: 700;
            letter-spacing: .3px;
        }

        .logo-text span {
            font-size: 11px;
            opacity: .7;
            letter-spacing: .8px;
            text-transform: uppercase;
        }

        .panel-left-body {
            position: relative; z-index: 1;
        }

        .panel-left-body h1 {
            font-family: 'Lora', serif;
            font-size: 34px;
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 16px;
        }

        .panel-left-body h1 em {
            font-style: italic;
            color: #b8d49a;
        }

        .panel-left-body p {
            font-size: 14px;
            line-height: 1.75;
            opacity: .78;
            max-width: 320px;
        }

        .panel-left-footer {
            font-size: 12px;
            opacity: .5;
            position: relative; z-index: 1;
        }

        .panel-right {
            background: var(--cream-50);
            padding: 52px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .panel-right h2 {
            font-family: 'Lora', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .panel-right .subtitle {
            font-size: 14px;
            color: var(--text-muted);
            margin-bottom: 32px;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: var(--radius-md);
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 7px;
            letter-spacing: .2px;
        }

        .input-wrap {
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 13px 16px;
            border: 1.5px solid var(--cream-200);
            border-radius: var(--radius-md);
            background: white;
            font-family: 'Inter', sans-serif;
            font-size: 14px;
            color: var(--text-main);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-group input:focus {
            border-color: var(--sage-400);
            box-shadow: 0 0 0 3px rgba(138,171,112,.15);
        }

        .toggle-pass {
            position: absolute;
            right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none;
            cursor: pointer; color: var(--text-muted);
            font-size: 16px; padding: 4px;
            line-height: 1;
            transition: color .2s;
        }

        .toggle-pass:hover { color: var(--brown-500); }

        .btn-primary {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 50px;
            background: var(--brown-500);
            color: white;
            font-family: 'Inter', sans-serif;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 8px;
            transition: background .2s, transform .15s, box-shadow .2s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .btn-primary:hover {
            background: var(--brown-600);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(112,79,46,.3);
        }

        .btn-primary:active { transform: translateY(0); }

        .btn-primary.loading { opacity: .7; pointer-events: none; }

        .register-link {
            text-align: center;
            margin-top: 24px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .register-link a {
            color: var(--sage-500);
            font-weight: 600;
            text-decoration: none;
        }

        .register-link a:hover { text-decoration: underline; }

        .divider {
            height: 1px;
            background: var(--cream-200);
            margin: 24px 0;
        }

        @media (max-width: 700px) {
            .page-wrap { grid-template-columns: 1fr; min-height: auto; }
            .panel-left {
                padding: 36px 28px 32px;
                min-height: auto;
            }
            .panel-left-body h1 { font-size: 26px; }
            .panel-left-footer { display: none; }
            .panel-right { padding: 36px 28px; }
        }
    </style>
</head>
<body>
<div class="page-wrap">

    <div class="panel-left">
        <div class="logo-wrap">
            <div class="logo-icon">📖</div>
            <div class="logo-text">
                <strong>Ruang Baca</strong>
                <span>Perpustakaan</span>
            </div>
        </div>

        <div class="panel-left-body">
            <h1>Temukan Cerita,<br><em>Perluas Wawasan.</em></h1>
            <p>Kelola peminjaman, jelajahi koleksi, dan nikmati pengalaman membaca yang lebih mudah.</p>
        </div>

        <div class="panel-left-footer">
            Sistem Informasi Perpustakaan &copy; {{ date('Y') }}
        </div>
    </div>

    <div class="panel-right">
        <h2>Selamat Datang 👋</h2>
        <p class="subtitle">Masuk ke akun perpustakaan kamu.</p>

        @if ($errors->any())
            <div class="alert-error">
                <span>⚠</span>
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login.process') }}" method="POST" id="loginForm">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Masukkan username"
                    autocomplete="username"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                    <button type="button" class="toggle-pass" onclick="togglePass('password', this)" aria-label="Tampilkan password">
                        👁
                    </button>
                </div>
            </div>

            <button type="submit" class="btn-primary" id="loginBtn">
                <span id="loginBtnText">Masuk ke Sistem</span>
            </button>
        </form>

        <div class="divider"></div>
        <p class="register-link">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>
    </div>

</div>

<script>
    function togglePass(id, btn) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
            btn.textContent = '🙈';
        } else {
            input.type = 'password';
            btn.textContent = '👁';
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function() {
        const btn = document.getElementById('loginBtn');
        btn.classList.add('loading');
        document.getElementById('loginBtnText').textContent = 'Memproses...';
    });
</script>
</body>
</html>
