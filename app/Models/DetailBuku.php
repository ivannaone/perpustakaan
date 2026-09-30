<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailBuku extends Model
{
    protected $table = 'detail_buku';

    protected $primaryKey = 'no_buku';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'no_buku',
        'id_buku',
        'status',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id_buku');
    }
}