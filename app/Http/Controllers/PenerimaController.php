<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PenerimaController extends Controller
{
    public function create($id)
    {
        $donasi = \App\Models\Donasi::with('pengguna')->findOrFail($id);
        return view('penerima.form', compact('donasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donasi_id' => 'required|exists:donasis,id',
            'jumlah_diambil' => 'required|integer|min:1',
        ]);

        Penerima::create([
            'user_id' => Auth::id(),
            'donasi_id' => $request->donasi_id,
            'jumlah_diambil' => $request->jumlah_diambil,
        ]);

        return redirect()->route('dashboard')->with('success', 'Donasi berhasil diambil.');
    }
}
