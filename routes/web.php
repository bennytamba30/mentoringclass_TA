<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama
Route::get('/', function () {
    return view('welcome');
});

// Test relasi mentor-mentee


// -------------------
// 🔐 Login & Logout
// -------------------
Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', function (Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        if (Auth::guard('mentor')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/mentor');
        }

        if (Auth::guard('web')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    });
});

// Logout semua guard
Route::post('/logout', function (Request $request) {
    Auth::guard('admin')->logout();
    Auth::guard('mentor')->logout();
    Auth::guard('web')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/login');
})->name('logout');

// ---------------------------
// 📄 Dashboard untuk mentee
// ---------------------------
Route::middleware(['auth:web'])->group(function () {
    Route::get('/dashboard', function () {
        return view('mentee.dashboard', [
            'user' => Auth::guard('web')->user()
        ]);
    })->name('dashboard');
});
