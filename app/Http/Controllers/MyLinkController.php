<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MyLink;
use Illuminate\Http\Request;

class MyLinkController extends Controller
{
    // Menampilkan semua MyLink
    public function index()
    {
        $myLinks = MyLink::with('linkBlocks')->get();
        return response()->json($myLinks);
    }

    // Menampilkan MyLink berdasarkan ID
    public function show($id)
    {
        $myLink = MyLink::with('linkBlocks')->find($id);

        if (!$myLink) {
            return response()->json(['message' => 'MyLink not found'], 404);
        }

        return response()->json($myLink);
    }

    // Menambahkan MyLink baru
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id', // Pastikan user_id valid
            'total_views' => 'nullable|integer',
            'total_clicks' => 'nullable|integer',
        ]);

        $myLink = MyLink::create([
            'user_id' => $request->user_id,
            'total_views' => $request->total_views ?? 0,
            'total_clicks' => $request->total_clicks ?? 0,
        ]);

        return response()->json(['message' => 'MyLink created successfully', 'myLink' => $myLink], 201);
    }

    // Mengupdate MyLink berdasarkan ID
    public function update(Request $request, $id)
    {
        $myLink = MyLink::find($id);

        if (!$myLink) {
            return response()->json(['message' => 'MyLink not found'], 404);
        }

        $request->validate([
            'total_views' => 'nullable|integer',
            'total_clicks' => 'nullable|integer',
        ]);

        $myLink->update($request->only(['total_views', 'total_clicks']));

        return response()->json(['message' => 'MyLink updated successfully', 'myLink' => $myLink]);
    }

    // Menghapus MyLink berdasarkan ID
    public function destroy($id)
    {
        $myLink = MyLink::find($id);

        if (!$myLink) {
            return response()->json(['message' => 'MyLink not found'], 404);
        }

        $myLink->delete();

        return response()->json(['message' => 'MyLink deleted successfully']);
    }
    public function getByUsername($username)
    {
        // Cari user berdasarkan username
        $user = User::where('username', $username)->first();
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Ambil MyLink yang dimiliki oleh user
        $myLink = $user->myLink;  // Relasi dengan MyLink
    
        if (!$myLink) {
            return response()->json(['message' => 'MyLink not found for this user'], 404);
        }
    
        return response()->json($myLink);
    }       
}
