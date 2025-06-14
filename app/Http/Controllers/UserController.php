<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lokasi;

class UserController extends Controller
{
    public function index()
{
    $users = User::with('lokasi')
    ->whereNotIn('name', ['admin', 'penulis'])
    ->paginate(10);

    return view('admin.user', compact('users'));
}

public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'no_telepon' => 'nullable|string',
        'lokasi_detail' => 'nullable|string',
        'id_lokasi' => 'nullable|exists:lokasis,id',
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'no_telepon' => $request->no_telepon,
        'lokasi_detail' => $request->lokasi_detail,
        'id_lokasi' => $request->id_lokasi,
    ]);

    return redirect()->route('admin.user')->with('success', 'Data user berhasil diperbarui.');
}

public function destroy(User $user)
{
    $user->delete();
    return redirect()->back()->with('success', 'User berhasil dihapus');
}

}
