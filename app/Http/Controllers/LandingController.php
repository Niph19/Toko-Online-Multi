<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        $tokos = Toko::where('status', 'aktif')
            ->with(['produk' => function ($query) {
                $query->latest();
            }])
            ->get();

        return view('landingpage', compact('tokos'));
    }
}