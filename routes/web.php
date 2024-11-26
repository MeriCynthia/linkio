<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TextBlockController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [SearchController::class, 'search'])->name('search');

// Menampilkan semua TextBlock
Route::get('text-block', [TextBlockController::class, 'index']);
