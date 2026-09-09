<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class AdminTokoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');

        $tokos = Toko::with('user')
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->get();

        return view('admin.toko.index', compact('tokos', 'status'));
    }

    public function approve($id)
    {
        Toko::whereKey($id)->update(['status' => 'aktif']);

        return back()->with('success', 'Toko berhasil diaktifkan.');
    }

    public function reject($id)
    {
        Toko::whereKey($id)->update(['status' => 'nonaktif']);

        return back()->with('success', 'Toko berhasil dinonaktifkan.');
    }
}