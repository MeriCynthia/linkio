<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TextBlockController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/mylinks/{mylinkId}/text-block', [TextBlockController::class, 'index']);
    Route::post('/mylinks/{mylinkId}/text-block', [TextBlockController::class, 'store']);
    Route::put('/mylinks/{mylinkId}/text-block/{id}', [TextBlockController::class, 'update']);
    Route::delete('/mylinks/{mylinkId}/text-block/{id}', [TextBlockController::class, 'destroy']);
});
