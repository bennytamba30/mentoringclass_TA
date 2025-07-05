<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // Import ValidationException for explicit error handling

class LoginController extends Controller
{
    /**
     * Tampilkan form login.
     * Displays the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses request login yang masuk.
     * Handles the incoming login request.
     */
    public function login(Request $request)
    {
        // Validate the incoming request data for email and password.
        // If validation fails, Laravel will automatically redirect back with errors.
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt to authenticate the user with the provided credentials.
        if (Auth::attempt($credentials)) {
            // If authentication is successful, regenerate the session to prevent session fixation attacks.
            $request->session()->regenerate();

            // Get the authenticated user instance.
            $user = Auth::user();

            // Redirect the user based on their role.
            if ($user->role === 'mentee') {
                // Redirect to the mentee dashboard.
                return redirect()->intended(route('mentee.dashboard'));
            }

            if ($user->role === 'admin') {
                // Redirect to the admin panel (e.g., Filament admin panel).
                return redirect()->intended('/admin');
            }

            if ($user->role === 'mentor') {
                // Redirect to the mentor panel (e.g., Filament mentor panel).
                return redirect()->intended('/mentor');
            }

            // If the user's role does not match any known roles, log them out
            // and redirect back to the login page with a generic error message.
            Auth::logout();
            // Using ValidationException for a consistent way to return errors to the view.
            throw ValidationException::withMessages([
                'role' => 'Role pengguna tidak dikenali. Silakan hubungi administrator.',
            ]);
        }

        // If authentication fails (email/password incorrect),
        // redirect back to the login form with an error message
        // and only repopulate the email field (not the password for security).
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Proses logout pengguna.
     * Handles user logout.
     */
    public function logout(Request $request)
    {
        // Log out the authenticated user.
        Auth::logout();

        // Invalidate the current session.
        $request->session()->invalidate();

        // Regenerate the CSRF token to prevent token reuse.
        $request->session()->regenerateToken();

        // Redirect to the login page after logout.
        return redirect('/login');
    }
}

