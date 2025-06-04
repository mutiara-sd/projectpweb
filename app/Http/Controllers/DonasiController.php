<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

class DonasiController extends Controller
{
    public function index()
    {
        $donasi = Donasi::with('pengguna')->get();
        return view('dashboard', compact('donasi'));
    }
}

