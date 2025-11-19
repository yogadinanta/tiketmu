<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Models\User;

class EditUserController extends Controller
{
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.layouts.edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        try {

            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'saldo' => 'required|numeric'
            ]);

            $user = User::findOrFail($id);

            $user->name  = $request->name;
            $user->email = $request->email;
            $user->saldo = $request->saldo;
            $user->save();

            return redirect()->route('admin.dashboard')
                ->with('success', 'User berhasil diperbarui!');

        } catch (QueryException $e) {

            // Jika error duplicate email
            if ($e->errorInfo[1] == 1062) {
                return redirect()->back()
                    ->with('error', 'Email sudah digunakan, pilih email lain.');
            }

            // Error database lainnya
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan database.');
        }
    }
}
