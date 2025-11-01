<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisUnit extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'unit_tipe_id',
        'nama_jenis',
        'tahun'
    ];
    public function unit_tipe()
    {
        return $this->belongsTo(UnitTipe::class);
    }

}
