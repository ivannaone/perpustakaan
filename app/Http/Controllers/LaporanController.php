<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with([
            'anggota',
            'detailBuku.buku'
        ])
        ->latest('tgl_pinjam')
        ->get();

        return view('laporan.index', compact('peminjaman'));
    }

    public function peminjaman()
    {
        $peminjaman = Peminjaman::with([
            'anggota',
            'detailBuku.buku'
        ])
        ->latest('tgl_pinjam')
        ->get();

        $pdf = Pdf::loadView(
            'laporan.peminjaman',
            compact('peminjaman')
        );

        return $pdf->download('laporan-peminjaman.pdf');
    }

    public function excel()
    {
        return Excel::download(
            new PeminjamanExport,
            'laporan-peminjaman.xlsx'
        );
    }
}