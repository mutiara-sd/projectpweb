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

    $riwayatMenerima = Penerima::with('donasi')
        ->where('nama', $user->name)
        ->get();

    $riwayatDonasi = Donasi::where('user_id', $user->id)->get();

    return view('riwayat.index', compact('riwayatMenerima', 'riwayatDonasi'));
    }
}
