<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Ambil query pencarian dari input
        $searchQuery = $request->input('query');

        // Cari pengguna berdasarkan username
        $users = User::where('username', 'LIKE', '%' . $searchQuery . '%')->get();

        // Kembalikan hasil pencarian ke view
        return view('search', compact('users'));
    }
}
