<?php

namespace App\Models;

use App\Models\DetailPesanan;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'toko_id',
        'status',
        'total_harga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
    public function detailpesanan()
    {
        return $this->hasMany(DetailPesanan::class);
    }
}
