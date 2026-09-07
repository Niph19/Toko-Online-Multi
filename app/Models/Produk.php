<?php

namespace App\Models;

use App\Models\DetailPesanan;
use App\Models\Toko;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = 'produks';
    protected $fillable = [
        'toko_id',
        'nama_produk',
        'deskripsi',
        'harga',
        'stok',
        'foto',
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
    public function detailpesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
