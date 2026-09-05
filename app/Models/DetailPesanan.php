<?php

namespace App\Models;

use App\Models\Pesanan;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Model;

class detailPesanan extends Model
{
    protected $fillable = [
        'pesanan_id',
        'produk_id',
        'jumlah',
        'harga_satuan',
    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
