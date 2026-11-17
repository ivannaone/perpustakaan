<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="3;url={{ route('login') }}">
<title>Sesi Berakhir — Ruang Baca</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Inter',system-ui,sans-serif;background:#f8fafc;color:#1a1a2e;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px;}
.box{background:white;border:1px solid #e2e8f0;border-radius:18px;padding:52px 40px;text-align:center;max-width:460px;width:100%;box-shadow:0 8px 32px rgba(30,58,95,.10);}
.icon{font-size:52px;margin-bottom:20px;}
.code{font-size:13px;font-weight:700;color:#2563eb;letter-spacing:1px;text-transform:uppercase;margin-bottom:10px;}
h1{font-family:'Lora',serif;font-size:24px;font-weight:700;margin-bottom:10px;color:#1a1a2e;}
p{font-size:14px;color:#64748b;line-height:1.65;margin-bottom:28px;}
.btn{display:inline-block;padding:12px 28px;background:#1e3a5f;color:white;border-radius:50px;font-size:14px;font-weight:600;text-decoration:none;transition:background .2s;}
.btn:hover{background:#162d4a;}
.countdown{font-size:12px;color:#94a3b8;margin-top:16px;}
.bar-wrap{width:100%;height:3px;background:#e2e8f0;border-radius:50px;margin-top:12px;overflow:hidden;}
.bar{height:3px;background:#2563eb;border-radius:50px;animation:shrink 3s linear forwards;}
@keyframes shrink{from{width:100%;}to{width:0%;}}
</style>
</head>
<body>
<div class="box">
    <div class="icon">⏱️</div>
    <div class="code">419 — Page Expired</div>
    <h1>Sesi Kamu Telah Berakhir</h1>
    <p>Halaman ini sudah kedaluwarsa karena tidak ada aktivitas dalam waktu lama. Kamu akan diarahkan ke halaman login secara otomatis.</p>
    <a href="{{ route('login') }}" class="btn">Masuk Kembali</a>
    <p class="countdown">Mengalihkan dalam 3 detik...</p>
    <div class="bar-wrap"><div class="bar"></div></div>
</div>
</body>
</html>
