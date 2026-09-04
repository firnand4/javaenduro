<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::orderBy('role')->orderBy('name')->get(),
        ]);
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => ['required', 'in:superadmin,contributor'],
        ]);

        if ($user->id === $request->user()->id) {
            return back()->with('status', 'Tidak bisa mengubah role akun sendiri — minta superadmin lain untuk mengubahnya.');
        }

        $user->update(['role' => $data['role']]);

        return back()->with('status', "Role {$user->name} diubah jadi {$data['role']}.");
    }

    public function showResetPassword(User $user): View
    {
        return view('admin.users.reset-password', compact('user'));
    }

    public function resetPassword(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Password otomatis di-hash oleh cast 'hashed' di model User.
        $user->update(['password' => $data['password']]);

        return redirect()->route('admin.users.index')->with('status', "Password {$user->name} berhasil direset. Sampaikan password baru ke yang bersangkutan lewat jalur aman (WA/japri), jangan lewat email biasa.");
    }
}
