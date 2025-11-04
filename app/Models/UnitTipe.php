<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitTipe extends Model
{
     protected $fillable = [
        'nama_tipe',
        'deskripsi'
    ];
        public function jenis_unit()
    {
        return $this->hasOne(JenisUnit::class);
    }
    public function DetailSparepart()
    {
        return $this->hasMany(DetailSparepart::class);
    }
}
