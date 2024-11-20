<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotifikasiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::put('/user/{id}', [UserController::class, 'updateProfile']);

Route::get('/notifikasis/user/{userId}', [NotifikasiController::class, 'getNotifikasisByUser']); 
Route::post('/notifikasi', [NotifikasiController::class, 'createNotifikasi']);