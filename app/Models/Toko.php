<?php

namespace App\Models;

use App\Models\Pesanan;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class toko extends Model
{
    protected $fillable = [
        'user_id',
        'nama_toko',
        'deskripsi',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function produk()
    {
        return $this->hasMany(Produk::class);
    }
    public function pesanan()
    {
        return $this->hasMany(Pesanan::class);
    }
}
