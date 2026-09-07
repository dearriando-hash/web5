<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    // Tampilkan Halaman Dashboard / Form Upload Foto Profil
    public function dashboard()
    {
        return view('dashboard', ['user' => Auth::user()]);
    }

    // Proses Upload & Ganti Foto Profil
    public function updateFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();

        // Hapus foto lama dari storage jika ada
        if ($user->foto && Storage::disk('public')->exists($user->foto)) {
            Storage::disk('public')->delete($user->foto);
        }

        // Simpan foto baru ke folder storage/app/public/profil
        $path = $request->file('foto')->store('profil', 'public');

        // Update path foto di database
        $user->update(['foto' => $path]);

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}