<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi input dari user
            $request->validate([
                'image_name' => 'required|string|max:50', // Nama gambar maksimal 50 karakter
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Ukuran gambar maksimal 2MB
            ]);

            $imagePath = null;
            if ($request->hasFile('image')) {
                // Simpan file gambar ke storage
                $imagePath = $request->file('image')->store('images', 'public');
            }

            // Simpan data gambar ke database
            $image = Image::create([
                'image_name' => $request->image_name,
                'image' => $imagePath, // Path gambar
            ]);

            // Kembalikan respons berhasil
            return response()->json(['message' => 'Image uploaded successfully', 'data' => $image], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Tangani error validasi
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Tangani error umum lainnya
            return response()->json([
                'message' => 'An error occurred while uploading the image',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function index()
    {
        // Ambil semua data gambar
        $images = Image::all(['id', 'image_name', 'image']);

        // Tambahkan URL lengkap ke gambar
        foreach ($images as $image) {
            $image->image_url = Storage::url($image->image);
        }

        // Kembalikan respons dengan data gambar
        return response()->json($images);
    }

    public function show($id)
    {
        // Cari gambar berdasarkan ID
        $image = Image::findOrFail($id);

        // Tambahkan URL lengkap ke gambar
        $image->image_url = Storage::url($image->image);

        return response()->json($image);
    }

    public function update(Request $request, $id)
    {
        // Validasi request
        $request->validate([
            'image_name' => 'sometimes|string|max:50', // Nama gambar bisa diubah
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048', // Gambar baru bisa diupload
        ]);

        // Cari gambar berdasarkan ID
        $image = Image::findOrFail($id);

        // Jika ada gambar baru, simpan gambar tersebut
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($image->image) {
                Storage::disk('public')->delete($image->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $image->image = $imagePath;
        }

        // Update nama gambar jika ada perubahan
        $image->image_name = $request->image_name ?? $image->image_name;
        $image->save();

        return response()->json(['message' => 'Image updated successfully', 'data' => $image]);
    }

    public function destroy($id)
    {
        // Cari gambar berdasarkan ID
        $image = Image::findOrFail($id);

        // Hapus file gambar dari storage
        if ($image->image) {
            Storage::disk('public')->delete($image->image);
        }

        // Hapus data dari database
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }
}