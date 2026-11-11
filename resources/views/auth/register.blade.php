<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun — Ruang Baca</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream-50:  #fdfaf5;
            --cream-100: #f7f1e3;
            --cream-200: #ede4cc;
            --brown-500: #8a6540;
            --brown-600: #704f2e;
            --sage-400:  #8aab70;
            --sage-500:  #6a8f52;
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
            min-height: 620px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            position: relative;
            z-index: 1;
        }

        .panel-left {
            background: linear-gradient(160deg, #2a4a2a 0%, #1a3a1a 50%, #3d2810 100%);
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

        .logo-wrap {
            display: flex; align-items: center; gap: 14px;
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
        }

        .logo-text span {
            font-size: 11px; opacity: .7;
            letter-spacing: .8px; text-transform: uppercase;
        }

        .panel-left-body {
            position: relative; z-index: 1;
        }

        .panel-left-body h1 {
            font-family: 'Lora', serif;
            font-size: 30px; font-weight: 700;
            line-height: 1.3; margin-bottom: 16px;
        }

        .panel-left-body h1 em { font-style: italic; color: #b8d49a; }

        .panel-left-body p {
            font-size: 14px; line-height: 1.75; opacity: .78;
        }

        .steps {
            margin-top: 28px;
            display: flex; flex-direction: column; gap: 14px;
        }

        .step {
            display: flex; align-items: center; gap: 12px;
            font-size: 13px; opacity: .85;
        }

        .step-dot {
            width: 28px; height: 28px; flex-shrink: 0;
            background: rgba(138,171,112,.25);
            border: 1px solid rgba(138,171,112,.4);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px;
        }

        .panel-left-footer {
            font-size: 12px; opacity: .5;
            position: relative; z-index: 1;
        }

        .panel-right {
            background: var(--cream-50);
            padding: 48px 44px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            overflow-y: auto;
        }

        .panel-right h2 {
            font-family: 'Lora', serif;
            font-size: 26px; font-weight: 700;
            color: var(--text-main); margin-bottom: 4px;
        }

        .panel-right .subtitle {
            font-size: 13px; color: var(--text-muted);
            margin-bottom: 28px;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            border-radius: var(--radius-md);
            padding: 12px 16px; font-size: 13px;
            margin-bottom: 18px;
        }

        .form-group { margin-bottom: 18px; }

        .form-group label {
            display: block;
            font-size: 13px; font-weight: 600;
            color: var(--text-main); margin-bottom: 6px;
        }

        .form-group label .req { color: #dc2626; margin-left: 2px; }

        .input-wrap { position: relative; }

        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--cream-200);
            border-radius: var(--radius-md);
            background: white;
            font-family: 'Inter', sans-serif;
            font-size: 14px; color: var(--text-main);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-group input:focus {
            border-color: var(--sage-400);
            box-shadow: 0 0 0 3px rgba(138,171,112,.15);
        }

        .toggle-pass {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: var(--text-muted); font-size: 15px; padding: 4px;
        }

        .toggle-pass:hover { color: var(--brown-500); }

        .field-hint {
            font-size: 12px; color: var(--text-muted);
            margin-top: 5px;
        }

        .field-error {
            font-size: 12px; color: #dc2626; margin-top: 5px;
        }

        .btn-primary {
            width: 100%; padding: 13px;
            border: none; border-radius: 50px;
            background: var(--sage-500); color: white;
            font-family: 'Inter', sans-serif;
            font-size: 15px; font-weight: 600;
            cursor: pointer; margin-top: 6px;
            transition: background .2s, transform .15s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }

        .btn-primary:hover {
            background: var(--sage-400);
            transform: translateY(-1px);
        }

        .btn-primary.loading { opacity: .7; pointer-events: none; }

        .login-link {
            text-align: center; margin-top: 20px;
            font-size: 13px; color: var(--text-muted);
        }

        .login-link a { color: var(--brown-500); font-weight: 600; text-decoration: none; }
        .login-link a:hover { text-decoration: underline; }

        @media (max-width: 700px) {
            .page-wrap { grid-template-columns: 1fr; min-height: auto; }
            .panel-left { padding: 32px 24px 28px; }
            .panel-left-body h1 { font-size: 24px; }
            .steps, .panel-left-footer { display: none; }
            .panel-right { padding: 32px 24px; }
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
            <h1>Bergabung dengan<br><em>Ruang Baca.</em></h1>
            <p>Daftar sebagai anggota dan mulai jelajahi ribuan koleksi buku perpustakaan kami.</p>

            <div class="steps">
                <div class="step">
                    <div class="step-dot">1</div>
                    <span>Buat akun dengan username dan password</span>
                </div>
                <div class="step">
                    <div class="step-dot">2</div>
                    <span>Hubungi petugas untuk verifikasi keanggotaan</span>
                </div>
                <div class="step">
                    <div class="step-dot">3</div>
                    <span>Mulai jelajahi dan ajukan peminjaman buku</span>
                </div>
            </div>
        </div>

        <div class="panel-left-footer">
            Sistem Informasi Perpustakaan &copy; {{ date('Y') }}
        </div>
    </div>

    <div class="panel-right">
        <h2>Buat Akun</h2>
        <p class="subtitle">Daftar sebagai pengguna Ruang Baca.</p>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin: 6px 0 0 16px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.process') }}" method="POST" id="regForm">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="req">*</span></label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="{{ old('nama') }}"
                    placeholder="Masukkan nama lengkap"
                    required
                >
                @error('nama') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="username">Username <span class="req">*</span></label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    placeholder="Buat username unik"
                    autocomplete="username"
                    required
                >
                @error('username') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password">Password <span class="req">*</span></label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Minimal 6 karakter"
                        autocomplete="new-password"
                        required
                    >
                    <button type="button" class="toggle-pass" onclick="togglePass('password', this)">👁</button>
                </div>
                <div class="field-hint">Minimal 6 karakter.</div>
                @error('password') <div class="field-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password <span class="req">*</span></label>
                <div class="input-wrap">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        placeholder="Ulangi password"
                        autocomplete="new-password"
                        required
                    >
                    <button type="button" class="toggle-pass" onclick="togglePass('password_confirmation', this)">👁</button>
                </div>
            </div>

            <button type="submit" class="btn-primary" id="regBtn">
                <span id="regBtnText">Daftar Sekarang</span>
            </button>
        </form>

        <p class="login-link">
            Sudah punya akun?
            <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>

</div>

<script>
    function togglePass(id, btn) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
        btn.textContent = input.type === 'password' ? '👁' : '🙈';
    }
    document.getElementById('regForm').addEventListener('submit', function() {
        const btn = document.getElementById('regBtn');
        btn.classList.add('loading');
        document.getElementById('regBtnText').textContent = 'Memproses...';
    });
</script>
</body>
</html>
