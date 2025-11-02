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

    public function kategoriSparepart()
    {
        return $this->belongsTo(KategoriSparepart::class, 'kategori_sparepart_id');
    }
    protected static function boot()
{
    parent::boot();

    static::creating(function ($sparepart) {
       // Pastikan kategori_sparepart_id sudah terisi
            if (!$sparepart->kategori_sparepart_id) {
                return;
            }

            // Ambil kategori sparepart & komponen
            $kategoriSparepart = \App\Models\KategoriSparepart::with('kategoriKomponen')
                ->find($sparepart->kategori_sparepart_id);

            if (!$kategoriSparepart) {
                return;
            }

            $KategoriKomponen = strtoupper($kategoriSparepart->kategoriKomponen->kode_komponen ?? 'XXX');
            $kodePrefix = strtoupper($kategoriSparepart->kode_prefix ?? 'XXX');

            // Hitung nomor urut terakhir untuk kombinasi ini
            $count = self::whereHas('kategoriSparepart', function ($q) use ($kategoriSparepart) {
                $q->where('kategori_komponen_id', $kategoriSparepart->kategori_komponen_id)
                  ->where('kode_prefix', $kategoriSparepart->kode_prefix);
            })->count() + 1;

            // Format ke 3 digit
            $nomor = str_pad($count, 3, '0', STR_PAD_LEFT);

            // Set kode_sparepart otomatis
            $sparepart->kode_sparepart = "{$KategoriKomponen}-{$kodePrefix}-{$nomor}";
        });
}
}
