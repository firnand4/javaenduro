<?php

namespace App\Http\Controllers\Contributor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function showRegister(): View|RedirectResponse
    {
        // Cuma lempar ke dashboard kalau yang login itu kontributor — kalau yang login
        // superadmin, tetap tampilkan form ini (superadmin boleh punya akun kontributor terpisah).
        if (Auth::check() && Auth::user()->isContributor()) {
            return redirect()->route('contributor.dashboard');
        }

        return view('contributor.register');
    }

    public function register(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => 'contributor',
        ]);

        Auth::login($user);

        return redirect()->route('contributor.dashboard')->with('status', 'Akun kontributor dibuat. Yuk unggah poster event pertamamu.');
    }

    public function showLogin(): View|RedirectResponse
    {
        // Cuma lempar ke dashboard kalau yang login itu kontributor — kalau yang login
        // superadmin, tetap tampilkan form ini (superadmin boleh punya akun kontributor terpisah).
        if (Auth::check() && Auth::user()->isContributor()) {
            return redirect()->route('contributor.dashboard');
        }

        return view('contributor.login');
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Email atau password salah.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('contributor.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
