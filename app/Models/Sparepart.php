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
    
    public function detailSpareparts()
    {
        return $this->hasMany(DetailSparepart::class, 'sparepart_id');
    }
    public function jenisUnit()
{
    return $this->belongsTo(JenisUnit::class, 'jenis_unit_id');
}
    protected static function boot()
{
    parent::boot();

    static::creating(function ($sparepart) {
        // Pastikan kategori_sparepart_id sudah terisi
        if (!$sparepart->kategori_sparepart_id) {
            return;
        }

        // Ambil kategori_sparepart beserta relasi kategori_komponen
        $kategoriSparepart = \App\Models\KategoriSparepart::with('kategoriKomponen')
            ->find($sparepart->kategori_sparepart_id);

        if (!$kategoriSparepart) {
            return;
        }

        $KategoriKomponen = strtoupper($kategoriSparepart->kategoriKomponen->kode_komponen ?? 'XXX');
        $kodePrefix = strtoupper($kategoriSparepart->kode_prefix ?? 'XXX');

        // Ambil kode terakhir (termasuk data yang sudah dihapus)
        $lastCode = self::whereHas('kategoriSparepart', function ($q) use ($kategoriSparepart) {
                $q->where('kategori_komponen_id', $kategoriSparepart->kategori_komponen_id)
                  ->where('kode_prefix', $kategoriSparepart->kode_prefix);
            })
            ->withTrashed() // ikut data soft delete
            ->orderBy('id', 'desc')
            ->value('kode_sparepart');

        // Tentukan nomor berikutnya
        if ($lastCode) {
            // Ambil angka terakhir dari format kode, misal: ENG-FIL-022 → 22
            preg_match('/-(\d+)$/', $lastCode, $matches);
            $lastNumber = isset($matches[1]) ? (int)$matches[1] : 0;
            $nomor = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nomor = '001';
        }

        // Set kode_sparepart baru
        $sparepart->kode_sparepart = "{$KategoriKomponen}-{$kodePrefix}-{$nomor}";
    });
}

}
