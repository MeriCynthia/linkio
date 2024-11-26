<?php

namespace App\Http\Controllers;

use App\Models\LinkBlock;
use Illuminate\Http\Request;

class LinkBlockController extends Controller
{
    // Menampilkan semua LinkBlock
    public function index()
    {
        $linkBlocks = LinkBlock::with('mylink')->get();
        return response()->json($linkBlocks);
    }

    // Menambahkan LinkBlock baru
    public function store(Request $request)
    {
        $request->validate([
            'mylink_id' => 'required|exists:my_links,id', // Pastikan mylink_id valid
            'link_title' => 'required|string|max:255',
            'url' => 'required|url',
        ]);

        $linkBlock = LinkBlock::create([
            'mylink_id' => $request->mylink_id,
            'link_title' => $request->link_title,
            'url' => $request->url,
        ]);

        return response()->json(['message' => 'LinkBlock created successfully', 'linkBlock' => $linkBlock], 201);
    }

    // Menampilkan detail LinkBlock tertentu
    public function show($id)
    {
        $linkBlock = LinkBlock::with('mylink')->findOrFail($id);
        return response()->json($linkBlock);
    }

    // Mengupdate LinkBlock tertentu
    public function update(Request $request, $id)
    {
        $linkBlock = LinkBlock::findOrFail($id);

        $request->validate([
            'link_title' => 'nullable|string|max:255',
            'url' => 'nullable|url',
        ]);

        $linkBlock->update($request->only(['link_title', 'url']));

        return response()->json(['message' => 'LinkBlock updated successfully', 'linkBlock' => $linkBlock]);
    }

    // Menghapus LinkBlock tertentu
    public function destroy($id)
    {
        $linkBlock = LinkBlock::findOrFail($id);
        $linkBlock->delete();

        return response()->json(['message' => 'LinkBlock deleted successfully']);
    }

    public function showByMyLink($mylink_id)
    {
        // Mendapatkan semua LinkBlock yang terkait dengan mylink_id
        $linkBlocks = LinkBlock::where('mylink_id', $mylink_id)->get();

        // Periksa apakah data ditemukan
        if ($linkBlocks->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'LinkBlock tidak ditemukan untuk mylink_id ini.',
            ], 404);
        }

        // Return response
        return response()->json([
            'success' => true,
            'data' => $linkBlocks,
        ]);
    }
}
