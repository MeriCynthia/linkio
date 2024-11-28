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
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:50',
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
        if (
            !$user || !Hash::check($request->password, $user->password)
        ) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        // Jika berhasil
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
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

    public function updateProfilePicture(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file
        ]);

        // Hapus gambar lama jika ada
        if ($user->profile_picture) {
            $oldImagePath = public_path('uploads/profile_pictures/' . $user->profile_picture);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Simpan gambar baru
        $imageName = time() . '.' . $request->profile_picture->extension();
        $request->profile_picture->move(public_path('uploads/profile_pictures'), $imageName);

        $user->profile_picture = $imageName;
        $user->save();

        return response()->json([
            'message' => 'Profile picture updated successfully',
            'user' => $user,
        ]);
    }


    // Edit Profile Picture
    public function deleteProfilePicture($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->profile_picture) {
            $imagePath = public_path('uploads/profile_pictures/' . $user->profile_picture);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $user->profile_picture = null;
            $user->save();
        }

        return response()->json(['message' => 'Profile picture deleted successfully']);
    }


    // Logout  
    public function logout(Request $request)
    {
        // Hapus token pengguna yang sedang login
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout successful'], 200);
    }
    
    public function searchByUsername(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:50', // Pastikan username valid
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation error', 'errors' => $validator->errors()], 422);
        }

        // Mencari pengguna berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Jika pengguna tidak ditemukan
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Mengembalikan hasil pengguna yang ditemukan
        return response()->json(['message' => 'User found', 'user' => $user], 200);
    }
}
