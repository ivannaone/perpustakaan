<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class BukuImport implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'Data Buku' => new BukuSheetImport(),
        ];
    }
}