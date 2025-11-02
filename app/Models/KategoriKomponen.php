<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriKomponen extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'kode_komponen',
        'nama_komponen',
        'deskripsi'
    ];
     public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Kalau user tidak isi kode_sistem, generate otomatis
            if (empty($model->kode_komponen) && !empty($model->nama_komponen)) {
                // Ambil 3 huruf pertama tanpa spasi
                $kode = strtoupper(substr(str_replace(' ', '', $model->nama_komponen), 0, 3));

                // Pastikan unik (cek di DB)
                $original = $kode;
                $counter = 1;
                while (self::where('kode_komponen', $kode)->exists()) {
                    $kode = $original . $counter;
                    $counter++;
                }

                $model->kode_komponen = $kode;
            }
        });
    }
    public function kategoriSpareparts()
    {
        return $this->hasMany(\App\Models\KategoriSparepart::class, 'kategori_komponen_id');
    }
        public function sparepart()
    {
        return $this->hasMany(\App\Models\Sparepart::class, 'kategori_sparepart_id');
    }
}
