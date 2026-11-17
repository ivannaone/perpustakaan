<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Bukti Peminjaman {{ $peminjaman->id_pinjam }}</title>
<style>
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
        font-family: DejaVu Sans, Arial, sans-serif;
        font-size: 11px;
        color: #1a1a2e;
        background: white;
        padding: 32px 36px;
    }

    .header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 20px;
        padding-bottom: 16px;
        border-bottom: 2px solid #1e3a5f;
    }
    .header-left {}
    .logo-row {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 4px;
    }
    .logo-box {
        width: 36px; height: 36px;
        background: #1e3a5f;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 18px;
        font-weight: bold;
    }
    .org-name {
        font-size: 18px;
        font-weight: bold;
        color: #1e3a5f;
        font-family: DejaVu Sans, serif;
    }
    .org-sub {
        font-size: 10px;
        color: #64748b;
        letter-spacing: 0.5px;
    }
    .doc-info { text-align: right; }
    .doc-title {
        font-size: 14px;
        font-weight: bold;
        color: #1e3a5f;
        margin-bottom: 4px;
    }
    .doc-id {
        font-size: 11px;
        color: #64748b;
    }
    .doc-date {
        font-size: 10px;
        color: #94a3b8;
        margin-top: 2px;
    }

    .status-banner {
        padding: 10px 18px;
        border-radius: 8px;
        margin-bottom: 22px;
        font-size: 12px;
        font-weight: bold;
        letter-spacing: 0.3px;
    }
    .status-dipinjam {
        background: #dbeafe;
        color: #1d4ed8;
        border-left: 4px solid #2563eb;
    }
    .status-dikembalikan {
        background: #dcfce7;
        color: #166534;
        border-left: 4px solid #16a34a;
    }

    .section {
        margin-bottom: 20px;
    }
    .section-title {
        font-size: 10px;
        font-weight: bold;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        margin-bottom: 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #e2e8f0;
    }
    .info-table { width: 100%; border-collapse: collapse; }
    .info-table td {
        padding: 7px 8px;
        font-size: 11px;
        vertical-align: top;
        border-bottom: 1px solid #f1f5f9;
    }
    .info-table td:first-child {
        width: 38%;
        color: #64748b;
        font-weight: 500;
    }
    .info-table td:last-child {
        font-weight: 600;
        color: #1a1a2e;
    }
    .info-table tr:last-child td { border-bottom: none; }

    .book-box {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 16px 18px;
        margin-bottom: 20px;
        display: flex;
        gap: 16px;
        align-items: flex-start;
    }
    .book-icon-box {
        width: 48px; height: 64px;
        background: #1e3a5f;
        border-radius: 4px 8px 8px 4px;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }
    .book-details { flex: 1; }
    .book-judul {
        font-size: 14px;
        font-weight: bold;
        color: #1a1a2e;
        font-family: DejaVu Sans, serif;
        margin-bottom: 4px;
    }
    .book-meta {
        font-size: 10px;
        color: #64748b;
        margin-bottom: 2px;
    }
    .book-no {
        display: inline-block;
        margin-top: 6px;
        padding: 3px 10px;
        background: #dbeafe;
        color: #1d4ed8;
        border-radius: 50px;
        font-size: 10px;
        font-weight: bold;
    }

    .dates-row {
        display: flex;
        gap: 14px;
        margin-bottom: 20px;
    }
    .date-box {
        flex: 1;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 14px;
    }
    .date-label { font-size: 9px; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px; }
    .date-value { font-size: 13px; font-weight: bold; color: #1a1a2e; }
    .date-box.highlight { border-color: #2563eb; background: #eff6ff; }
    .date-box.highlight .date-value { color: #1d4ed8; }

    .footer-note {
        margin-top: 24px;
        padding: 12px 16px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        font-size: 10px;
        color: #64748b;
        line-height: 1.6;
    }
    .footer-note strong { color: #1a1a2e; }

    .signature-row {
        display: flex;
        justify-content: space-between;
        margin-top: 32px;
    }
    .signature-box {
        text-align: center;
        width: 160px;
    }
    .signature-line {
        border-bottom: 1px solid #334155;
        margin-bottom: 6px;
        height: 44px;
    }
    .signature-label { font-size: 10px; color: #64748b; }
    .signature-name { font-size: 11px; font-weight: bold; color: #1a1a2e; margin-top: 2px; }

    .print-footer {
        margin-top: 20px;
        padding-top: 10px;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        font-size: 9px;
        color: #94a3b8;
    }
</style>
</head>
<body>

<div class="header">
    <div class="header-left">
        <div class="logo-row">
            <div class="logo-box">📖</div>
            <div>
                <div class="org-name">Ruang Baca</div>
                <div class="org-sub">SISTEM INFORMASI PERPUSTAKAAN</div>
            </div>
        </div>
    </div>
    <div class="doc-info">
        <div class="doc-title">BUKTI PEMINJAMAN BUKU</div>
        <div class="doc-id">No: {{ $peminjaman->id_pinjam }}</div>
        <div class="doc-date">Dicetak: {{ now()->format('d M Y, H:i') }}</div>
    </div>
</div>

<div class="status-banner {{ $peminjaman->status === 'dipinjam' ? 'status-dipinjam' : 'status-dikembalikan' }}">
    @if($peminjaman->status === 'dipinjam')
        📖 Status: SEDANG DIPINJAM — Buku belum dikembalikan
    @else
        ✓ Status: SUDAH DIKEMBALIKAN — Transaksi selesai
    @endif
</div>

<div class="book-box">
    <div class="book-icon-box">📚</div>
    <div class="book-details">
        <div class="book-judul">{{ $peminjaman->detailBuku->buku->judul_buku ?? '-' }}</div>
        @if($peminjaman->detailBuku->buku->pengarang ?? false)
            <div class="book-meta">Pengarang: {{ $peminjaman->detailBuku->buku->pengarang }}</div>
        @endif
        @if($peminjaman->detailBuku->buku->penerbit ?? false)
            <div class="book-meta">Penerbit: {{ $peminjaman->detailBuku->buku->penerbit }}</div>
        @endif
        <span class="book-no">No. Eksemplar: {{ $peminjaman->no_buku }}</span>
    </div>
</div>

<div class="dates-row">
    <div class="date-box highlight">
        <div class="date-label">Tanggal Pinjam</div>
        <div class="date-value">{{ $peminjaman->tgl_pinjam?->format('d M Y') ?? '-' }}</div>
    </div>
    <div class="date-box">
        <div class="date-label">Tanggal Kembali</div>
        <div class="date-value">
            @if($peminjaman->tgl_kembali)
                {{ $peminjaman->tgl_kembali->format('d M Y') }}
            @else
                Belum dikembalikan
            @endif
        </div>
    </div>
</div>

<div class="section">
    <div class="section-title">Data Peminjam</div>
    <table class="info-table">
        @if($peminjaman->anggota)
            <tr>
                <td>ID Anggota</td>
                <td>{{ $peminjaman->anggota->id_anggota }}</td>
            </tr>
            <tr>
                <td>Nama Anggota</td>
                <td>{{ $peminjaman->anggota->nama_anggota }}</td>
            </tr>
            <tr>
                <td>Jenis Anggota</td>
                <td>{{ $peminjaman->anggota->jenis_anggota }}</td>
            </tr>
            @if($peminjaman->anggota->kelas_prodi)
                <tr>
                    <td>Kelas / Prodi</td>
                    <td>{{ $peminjaman->anggota->kelas_prodi }}</td>
                </tr>
            @endif
        @else
            <tr>
                <td>ID Anggota</td>
                <td>{{ $peminjaman->id_anggota }}</td>
            </tr>
        @endif
    </table>
</div>

<div class="footer-note">
    <strong>Catatan:</strong> Dokumen ini merupakan bukti sah peminjaman buku dari Ruang Baca.
    Harap menjaga buku dengan baik dan mengembalikan sesuai dengan ketentuan perpustakaan yang berlaku.
    Dokumen ini dibuat secara otomatis oleh Sistem Informasi Perpustakaan.
</div>

<div class="signature-row">
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="signature-label">Peminjam</div>
        <div class="signature-name">{{ $peminjaman->anggota->nama_anggota ?? '-' }}</div>
    </div>
    <div class="signature-box">
        <div class="signature-line"></div>
        <div class="signature-label">Petugas Perpustakaan</div>
        <div class="signature-name">( ______________________ )</div>
    </div>
</div>

<div class="print-footer">
    <span>Ruang Baca — Sistem Informasi Perpustakaan</span>
    <span>ID: {{ $peminjaman->id_pinjam }} | {{ now()->format('d/m/Y H:i') }}</span>
</div>

</body>
</html>
