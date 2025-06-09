<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Penerima;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik untuk user yang login
        $totalDonasi = Donasi::where('user_id', $user->id)->count();
        $totalPenerimaan = Penerima::where('user_id', $user->id)->count();
        
        // PERBAIKAN: Ambil donasi dari SEMUA USER yang masih valid (belum kadaluarsa)
        // dan BUKAN donasi dari user yang login sendiri
        $donasis = Donasi::whereDate('kadaluwarsa', '>=', now()->toDateString())
                        ->where('user_id', '!=', Auth::id()) // Jangan tampilkan donasi sendiri
                        ->orderBy('created_at', 'desc')
                        ->get();
        
        // Debug: uncomment untuk cek
        // dd([
        //     'today' => now()->toDateString(),
        //     'total_donasis' => $donasis->count(),
        //     'donasis' => $donasis->pluck('nama_makanan', 'kadaluwarsa')
        // ]);

        return view('dashboard', [
            'totalDonasi' => $totalDonasi,
            'totalPenerimaan' => $totalPenerimaan,
            'donasis' => $donasis,
        ]);
    }
}