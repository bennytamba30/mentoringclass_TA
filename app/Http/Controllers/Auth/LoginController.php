<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses request login yang masuk.
     */
    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Arahkan berdasarkan role
      if ($user->role === 'mentee') {
        return redirect()->intended(route('mentee.dashboard'));
        }

        if ($user->role === 'admin') {
            return redirect()->intended('/admin'); // Filament admin panel
        }

        if ($user->role === 'mentor') {
            return redirect()->intended('/mentor'); // Filament mentor panel
        }

        // Jika role tidak cocok
        Auth::logout();
        return redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']);
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ])->onlyInput('email');
}

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
