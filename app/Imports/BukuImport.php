<?php

namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BukuImport implements ToModel, WithStartRow, SkipsOnError
{
    use SkipsErrors;

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $idBuku = trim($row[0] ?? '');
        $judulBuku = trim($row[1] ?? '');
        $pengarang = trim($row[2] ?? '');

        if (empty($idBuku) || empty($judulBuku) || empty($pengarang)) {
            return null;
        }

        if (strlen($idBuku) > 10) {
            return null;
        }

        if (Buku::where('id_buku', $idBuku)->exists()) {
            return null;
        }

        $tahun = !empty($row[4]) ? (int) $row[4] : null;
        if ($tahun !== null && ($tahun < 1000 || $tahun > 9999)) {
            $tahun = null;
        }

        return new Buku([
            'id_buku'      => $idBuku,
            'judul_buku'   => substr($judulBuku, 0, 150),
            'pengarang'    => substr($pengarang, 0, 100),
            'penerbit'     => !empty($row[3]) ? substr(trim($row[3]), 0, 100) : null,
            'tahun_terbit' => $tahun,
            'jumlah'       => isset($row[5]) && is_numeric($row[5]) ? max(0, (int) $row[5]) : 0,
        ]);
    }
}
