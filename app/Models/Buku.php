<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';

    protected $primaryKey = 'id_buku';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_buku',
        'judul_buku',
        'pengarang',
        'penerbit',
        'tahun_terbit',
        'jumlah',
    ];

    protected $casts = [
        'tahun_terbit' => 'integer',
        'jumlah' => 'integer',
    ];

    public function getRouteKeyName()
    {
        return 'id_buku';
    }
}