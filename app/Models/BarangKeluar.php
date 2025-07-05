<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKeluar extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang_keluar';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tanggal',
        'barang_id',
        'sn',
        'jumlah_keluar',
        'lokasi_pengambilan',
        'penanggung_jawab',

    ];
    // public function barang_masuk()
    // {
    //     return $this->hasMany(BarangMasuk::class,'lokasi_penyimpanan');
    // }

}

