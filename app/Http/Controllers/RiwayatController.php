<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function riwayatuser()
    {
        return view('riwayat.index');
    }
}
