<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $primaryKey = 'id_anggota';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_anggota',
        'nama_anggota',
        'jenis_anggota',
        'kelas_prodi',
        'tempat_lahir',
        'tgl_lahir',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
    ];

    public function getRouteKeyName()
    {
        return 'id_anggota';
    }
}