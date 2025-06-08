<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerima;
use App\Models\Donasi;

class PenerimaController extends Controller
{
    public function create($id)
    {
        $donasi = Donasi::findOrFail($id);
        return view('penerima.form', compact('donasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'donasi_id' => 'required|exists:donasis,id',
            'nama' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'tanggal_ambil' => 'required|date',
            'jumlah_diambil' => 'required|integer|min:1'
        ]);

        Penerima::create($request->all());

        return redirect()->route('dashboard')->with('success', 'Donasi berhasil diambil!');
    }
}
