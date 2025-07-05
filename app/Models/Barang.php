<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Barang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'barang';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nama_barang',
        'barang_masuk_id',
        'barang_keluar_id',
        'jenis_id',
        'stok_minimum',
        'stok',
        'satuan_id',
        'lokasi_barang',
        'foto',
    ];

    /**
     * Relasi Satuan
     */
    public function satuan(): BelongsTo
    {
        return $this->belongsTo(Satuan::class);
    }

    /**
     * Relasi Jenis
     */
    public function jenis(): BelongsTo
    {
        return $this->belongsTo(Jenis::class);
    }

    public function barang_masuk()
    {
        return $this->hasMany(BarangMasuk::class);
    }

    public function barang_keluar()
    {
        return $this->hasMany(BarangKeluar::class);
    }

}
        
