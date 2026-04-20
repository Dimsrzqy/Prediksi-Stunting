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
            'telepon' => 'nullable|string'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon ?? '',
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
}
