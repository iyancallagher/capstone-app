<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sparepart extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'kode_sparepart',
        'nama_sparepart',
        'kategori_sparepart_id',
        'number_part',
        'alternatif_part',
        'satuan',
        'keterangan'
    ];
}
