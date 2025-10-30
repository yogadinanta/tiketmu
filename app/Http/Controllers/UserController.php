<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Menampilkan semua user
    public function index()
    {
        $users = User::all();
        return view('admin.dash-admin', compact('users'));
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

   public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    // Simpan pesan sukses di session
    return redirect()->route('admin.dashboard')
        ->with('success', 'User berhasil dihapus.');
}


}
