<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotifikasiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/notifications', [NotifikasiController::class, 'index'])->name('notifications');


