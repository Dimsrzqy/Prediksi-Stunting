<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        if (Auth::user()->role !== 'admin') return response()->json([], 403);
        // Exclude current admin to prevent self-deletion
        $users = User::where('_id', '!=', Auth::id())->get();
        return response()->json(['data' => $users]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') return response()->json([], 403);
        
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,user',
            'no_hp' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp ?? '',
            'role' => $request->role,
            'password' => Hash::make('Bunda123')
        ]);

        return response()->json(['message' => 'Berhasil menambah pengguna.', 'data' => $user], 201);
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') return response()->json([], 403);
        
        $user = User::find($id);
        if (!$user) return response()->json(['message' => 'Not found'], 404);

        $user->delete();
        return response()->json(['message' => 'Berhasil menghapus pengguna.']);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id . ',_id',
            'no_hp' => 'nullable|string',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return response()->json(['message' => 'Profil berhasil diperbarui.']);
    }

    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            // Hapus avatar lama jika ada (opsional, tapi bagus)
            if ($user->avatar && file_exists(public_path('storage/' . $user->avatar))) {
                @unlink(public_path('storage/' . $user->avatar));
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->update(['avatar' => $path]);

            return response()->json([
                'message' => 'Foto profil berhasil diperbarui.',
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['message' => 'Gagal mengunggah foto.'], 400);
    }
}
