<?php

namespace App\Imports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class BukuSheetImport implements ToModel, WithStartRow, WithValidation, SkipsOnError
{
    use SkipsErrors;

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        $existing = Buku::find($row[0]);

        if ($existing) {
            return null;
        }

        return new Buku([
            'id_buku'      => $row[0],
            'judul_buku'   => $row[1],
            'pengarang'    => $row[2],
            'penerbit'     => $row[3] ?? null,
            'tahun_terbit' => $row[4] ?? null,
            'jumlah'       => $row[5] ?? 0,
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => ['required', 'string', 'max:10'],
            '1' => ['required', 'string', 'max:150'],
            '2' => ['required', 'string', 'max:100'],
            '3' => ['nullable', 'string', 'max:100'],
            '4' => ['nullable', 'integer', 'digits:4'],
            '5' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '0.required' => 'Kolom ID Buku wajib diisi.',
            '0.max'      => 'ID Buku maksimal 10 karakter.',
            '1.required' => 'Kolom Judul Buku wajib diisi.',
            '1.max'      => 'Judul Buku maksimal 150 karakter.',
            '2.required' => 'Kolom Pengarang wajib diisi.',
            '2.max'      => 'Pengarang maksimal 100 karakter.',
            '4.digits'   => 'Tahun terbit harus 4 digit angka.',
            '5.integer'  => 'Jumlah harus berupa angka.',
            '5.min'      => 'Jumlah tidak boleh negatif.',
        ];
    }
}
