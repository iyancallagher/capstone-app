<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriSparepart extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'kategori_komponen_id',
        'kode_prefix',
        'kategori_sparepart',
        'deskripsi'
    ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Kalau user tidak isi kode_sistem, generate otomatis
            if (empty($model->kode_prefix) && !empty($model->kategori_sparepart)) {
                // Ambil 3 huruf pertama tanpa spasi
                $kode = strtoupper(substr(str_replace(' ', '', $model->kategori_sparepart), 0, 3));

                // Pastikan unik (cek di DB)
                $original = $kode;
                $counter = 1;
                while (self::where('kode_prefix', $kode)->exists()) {
                    $kode = $original . $counter;
                    $counter++;
                }

                $model->kode_prefix = $kode;
            }
        });
    }
    public function kategoriKomponen()
    {
        return $this->belongsTo(KategoriKomponen::class, 'kategori_komponen_id');
    }
        public function sparepart()
    {
        return $this->hasMany(sparepart::class);
    }
}
