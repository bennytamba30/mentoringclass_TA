<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Semua route dalam grup ini hanya untuk role mentor
Route::middleware(['auth', 'ensureUserIsMentor'])->group(function () {
    Route::get('/', function () {
        return view('mentor.dashboard', [
            'user' => Auth::user()
        ]);
    })->name('mentor.dashboard');
});
