<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Penerima;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function riwayatuser()
    {
        $user = Auth::user();

        // Data riwayat donasi dari user (sebagai pendonasi)
        $riwayatDonasi = Donasi::where('user_id', $user->id)->get();

        // Data riwayat penerimaan donasi oleh user (sebagai penerima)
        $riwayatMenerima = Penerima::with('donasi')
            ->where('user_id', $user->id)
            ->get();

        return view('riwayat.index', compact('riwayatDonasi', 'riwayatMenerima'));
    }
}
