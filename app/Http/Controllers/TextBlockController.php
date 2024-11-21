<?php

namespace App\Http\Controllers;

use App\Models\TextBlock;
use Illuminate\Http\Request;

class TextBlockController extends Controller
{
    // Menampilkan semua TextBlock
    public function index()
    {
        $textBlock = TextBlock::with('mylink')->get();
        return response()->json($textBlock);
    }

    // Menampilkan TextBlock berdasarkan ID
    public function show($id)
    {
        $textBlock = TextBlock::with('mylink')->find($id);

        if (!$textBlock) {
            return response()->json(['message' => 'TextBlock not found'], 404);
        }

        return response()->json($textBlock);
    }

    // Menambahkan TextBlock baru
    public function store(Request $request)
    {
        $request->validate([
            'mylink_id' => 'required|exists:my_links,mylink_id', // Pastikan mylink_id valid
            'title' => 'nullable|string|max:255',
            'font' => 'nullable|string|max:255',
            'alignment' => 'nullable|in:left,center,right',
            'bold' => 'nullable|boolean',
            'italic' => 'nullable|boolean',
            'color' => 'nullable|string|max:7', // Hex color
        ]);

        $textBlock = TextBlock::create($request->all());

        return response()->json(['message' => 'TextBlock created successfully', 'textBlock' => $textBlock], 201);
    }

    // Mengupdate TextBlock berdasarkan ID
    public function update(Request $request, $id)
    {
        $textBlock = TextBlock::find($id);

        if (!$textBlock) {
            return response()->json(['message' => 'TextBlock not found'], 404);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'font' => 'nullable|string|max:255',
            'alignment' => 'nullable|in:left,center,right',
            'bold' => 'nullable|boolean',
            'italic' => 'nullable|boolean',
            'color' => 'nullable|string|max:7', // Hex color
        ]);

        $textBlock->update($request->all());

        return response()->json(['message' => 'TextBlock updated successfully', 'textBlock' => $textBlock]);
    }

    // Menghapus TextBlock berdasarkan ID
    public function destroy($id)
    {
        $textBlock = TextBlock::find($id);

        if (!$textBlock) {
            return response()->json(['message' => 'TextBlock not found'], 404);
        }

        $textBlock->delete();

        return response()->json(['message' => 'TextBlock deleted successfully']);
    }
}
