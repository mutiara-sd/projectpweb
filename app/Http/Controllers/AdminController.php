<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\Penerima;

class AdminController extends Controller
{
    public function index()
    {
        $jumlah_donasi = Donasi::count();
        $jumlah_penerima = Penerima::count();

        return view('admin.dashboard', compact('jumlah_donasi', 'jumlah_penerima'));
    }
}
