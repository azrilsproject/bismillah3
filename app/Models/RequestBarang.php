<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestBarang extends Model
{
    protected $table = 'request_barang';
    protected $fillable = ['user_id', 'barang_id', 'jumlah', 'keterangan', 'status', 'approved_at', 'approved_by'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}