<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }
    // 🎯 FILTER ROLE
    if ($request->filled('role')) {
        $query->where('role', $request->role);
    }

    // 🔒 FILTER STATUS
    if ($request->filled('is_active')) {
        $query->where('is_active', $request->is_active);
    }

    $users = $query->latest()
                   ->paginate(10)
                   ->appends($request->all()); // ⬅ penting

    return view('admin.users.index', compact('users'));
}

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $id,
            'saldo'     => 'nullable|numeric|min:0',
            'is_active' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'saldo'     => $request->saldo,
            'is_active' => $request->is_active,
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy($id)
{
    $user = User::findOrFail($id);

    // Cegah hapus diri sendiri (opsional)
    if ($user->id === auth()->id()) {
        return back()->withErrors('Anda tidak bisa menghapus akun sendiri');
    }

    $user->delete();

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User berhasil dihapus');
}
}
