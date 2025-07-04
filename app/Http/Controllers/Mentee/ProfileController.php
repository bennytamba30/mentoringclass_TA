<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
         /** @var \App\Models\User $user */
        $user = Auth::user();
        return view('mentee.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'kelas' => 'required|string|max:50',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            // Hapus lama jika ada
            if ($user->photo && Storage::disk('public')->exists($user->photo)) {
                Storage::disk('public')->delete($user->photo);
            }
            $user->photo = $request->file('photo')->store('profile_photos', 'public');
        }

        $user->name = $request->name;
        $user->nim = $request->nim;
        $user->kelas = $request->kelas;
        $user->save();

        return redirect()->route('mentee.profile.edit')->with('success', '✅ Profil berhasil diperbarui.');
    }
}
