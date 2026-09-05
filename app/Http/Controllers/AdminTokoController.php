<?php

namespace App\Http\Controllers;

use App\Models\Toko;
use Illuminate\Http\Request;

class AdminTokoController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status');

        $query = Toko::with('user')->latest();

        if ($status && in_array($status, ['menunggu', 'aktif', 'nonaktif'])) {
            $query->where('status', $status);
        }

        $tokos = $query->get();

        return view('admin.toko.index', compact('tokos', 'status'));
    }

    public function approve($id)
    {
        $toko = Toko::findOrFail($id);
        $toko->update(['status' => 'aktif']);

        return redirect()->back()->with('success', 'Toko "' . $toko->nama_toko . '" berhasil disetujui/diaktifkan.');
    }

    public function reject($id)
    {
        $toko = Toko::findOrFail($id);
        $toko->update(['status' => 'nonaktif']);

        return redirect()->back()->with('success', 'Toko "' . $toko->nama_toko . '" dinonaktifkan.');
    }
}