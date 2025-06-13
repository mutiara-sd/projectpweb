<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class DonasiController extends Controller
{
    public function index()
    {
        $donasi = Donasi::with('pengguna')->get();
        return view('dashboard', compact('donasi'));
    }

    public function form()
    {
        // untuk form donasi
        return view('donasi.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'nama_makanan' => 'required|string|max:255',
        'kategori' => 'required|string',
        'deskripsi_makanan' => 'required|string',
        'alamat' => 'required|string',
        'jumlah' => 'required|numeric|min:1',
        'kadaluwarsa' => 'required|date',
        'halal' => 'required|in:halal,non halal',
        'gambar' => 'required|image|mimes:jpg,jpeg,png|max:4096',
    ]);

    $gambarPath = $request->file('gambar')->store('donasi', 'public');

    Donasi::create([
        'user_id' => Auth::id(),
        'nama_makanan' => $validated['nama_makanan'],
        'kategori' => $validated['kategori'],
        'deskripsi_makanan' => $validated['deskripsi_makanan'],
        'alamat' => $validated['alamat'],
        'jumlah' => $validated['jumlah'],
        'kadaluwarsa' => $validated['kadaluwarsa'],
        'halal' => $validated['halal'],
        'gambar' => $gambarPath,
    ]);

    return redirect()->route('donasi.create')->with('success', 'Donasi berhasil ditambahkan!');

    try {
        $gambarPath = $request->file('gambar')->store('donasi', 'public');

        $donasi = Donasi::create([
            'user_id' => Auth::id(),
            'nama_makanan' => $validated['nama_makanan'],
            'kategori' => $validated['kategori'],
            'deskripsi_makanan' => $validated['deskripsi_makanan'],
            'alamat' => $validated['alamat'],
            'jumlah' => $validated['jumlah'],
            'kadaluwarsa' => $validated['kadaluwarsa'],
            'halal' => $validated['halal'],
            'gambar' => $gambarPath,
        ]);

        // Debug: Lihat data yang tersimpan
        dd([
            'success' => true,
            'donasi' => $donasi,
            'donasi_id' => $donasi->id
        ]);

        return redirect()->route('form.donasi')->with('success', 'Donasi berhasil ditambahkan!');

    } catch (\Exception $e) {
        // Debug: Lihat error detail
        dd([
            'error' => true,
            'message' => $e->getMessage(),
            'line' => $e->getLine(),
            'file' => $e->getFile()
        ]);
    
    }
    }

    public function dashboardList()
    {
    $donasis = Donasi::whereDate('kadaluwarsa', '>=', now()->toDateString())
                    ->orderBy('created_at', 'desc')
                    ->limit(3) // atau sesuai kebutuhan
                    ->get();

    return view('dashboard', compact('donasis'));
    }

    public function hariIni()
    {
    Carbon::setLocale('id');
    $today = Carbon::today();

    $donasis = Donasi::whereDate('kadaluwarsa', '>=', $today)
        ->where('user_id', '!=', Auth::id()) // ⛔ Filter: jangan tampilkan donasi milik sendiri
        ->orderBy('kadaluwarsa', 'asc') // opsional: biar urut
        ->get();

    return view('donasi.hari-ini', compact('donasis'));
    }
}

