<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'phone_number' => 'required|string|max:15',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    // Login
    public function login(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
                'login' => 'required', // Bisa username atau email
                'password' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        // Cari pengguna berdasarkan username atau email
        $user = User::where('email', $request->login)
        ->orWhere('username', $request->login)
        ->first();

        // Validasi pengguna dan kata sandi
        if (!$user || !Hash::check($request->password, $user->password)
        ) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Jika berhasil
        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
        ]);
    }
    // Edit Profile
    public function updateProfile(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->all());

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user]);
    }
}
