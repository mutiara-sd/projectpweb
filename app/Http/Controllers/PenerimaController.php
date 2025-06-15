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
     public function index()
    {
        $penerimas = Penerima::with(['user', 'donasi'])->paginate(request('entries', 10));
        return view('admin.penerima', compact('penerimas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_diambil' => 'required|integer|min:1',
        ]);

        $penerima = Penerima::findOrFail($id);
        $penerima->jumlah_diambil = $request->jumlah_diambil;
        $penerima->save();

        return redirect()->back()->with('success', 'Data penerima berhasil diperbarui.');
    }

    // ✅ Hapus data penerima
    public function destroy($id)
    {
        $penerima = Penerima::findOrFail($id);
        $penerima->delete();

        return redirect()->back()->with('success', 'Data penerima berhasil dihapus.');
    }
}


