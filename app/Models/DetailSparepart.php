<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailSparepart extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'sparepart_id',
        'jenis_unit_id',
        'catatan'
    ];
     public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'sparepart_id');
    }

    public function jenisUnit()
    {
        return $this->belongsTo(JenisUnit::class, 'jenis_unit_id');
    }

}