<?php

namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class BukuSheetImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        return new Buku([
            'id_buku' => $row[0] ?? null,
            'judul_buku' => $row[1] ?? null,
            'pengarang' => $row[2] ?? null,
            'penerbit' => $row[3] ?? null,
            'tahun_terbit' => $row[4] ?? null,
            'jumlah' => $row[5] ?? 0,
        ]);
    }
}