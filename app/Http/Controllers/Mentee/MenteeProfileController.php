<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // ✅ Tambahkan ini

class MenteeProfileController extends Controller
{
    public function edit()
    {
        /** @var User $user */
        $user = Auth::user();
        return view('mentee.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'kelas' => 'required|string|max:20',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->photo = $path;
        }

        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->kelas = $request->kelas;
        $user->save();

        return back()->with('success', '✅ Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => '❌ Password saat ini salah.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('password_success', '✅ Password berhasil diubah.');
    }
}
