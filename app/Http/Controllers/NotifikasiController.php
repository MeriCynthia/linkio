<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    /**
     * 
     *
     * @param string $userId
     * @return \Illuminate\Http\Response
     */
    public function getNotifikasisByUser($userId)
    {
        $notifikasis = Notifikasi::where('user_id', $userId)->get();
        return response()->json($notifikasis); 
    }

    /**
     * 
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function createNotifikasi(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'judul' => 'required',
            'content' => 'required',
        ]);

        $notifikasi = Notifikasi::create([
            'user_id' => $request->user_id,
            'timestamp' => now(),
            'judul' => $request->judul,
            'content' => $request->content,
        ]);

        return response()->json($notifikasi, 201); 
    }
}
