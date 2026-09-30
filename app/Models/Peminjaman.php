<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';

    protected $primaryKey = 'id_pinjam';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_pinjam',
        'tgl_pinjam',
        'id_anggota',
        'no_buku',
        'tgl_kembali',
        'status',
    ];

    protected $casts = [
        'tgl_pinjam' => 'date',
        'tgl_kembali' => 'date',
    ];

    public function anggota()
    {
        return $this->belongsTo(
            Anggota::class,
            'id_anggota',
            'id_anggota'
        );
    }

    public function detailBuku()
    {
        return $this->belongsTo(
            DetailBuku::class,
            'no_buku',
            'no_buku'
        );
    }
}