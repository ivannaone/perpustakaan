<?php

namespace App\Exports;

use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PeminjamanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Peminjaman::with([
            'anggota',
            'detailBuku.buku'
        ])
        ->latest('tgl_pinjam')
        ->get()
        ->map(function ($item) {
            return [
                $item->id_pinjam,
                $item->anggota->nama_anggota ?? '-',
                $item->no_buku,
                $item->detailBuku->buku->judul_buku ?? '-',
                $item->tgl_pinjam?->format('d-m-Y') ?? '-',
                $item->tgl_kembali?->format('d-m-Y') ?? '-',
                ucfirst($item->status),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID Peminjaman',
            'Nama Anggota',
            'No. Buku',
            'Judul Buku',
            'Tanggal Pinjam',
            'Tanggal Kembali',
            'Status',
        ];
    }
}