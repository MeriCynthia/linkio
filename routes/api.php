<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::post('/user/{id}/profile-picture', [UserController::class, 'updateProfilePicture']);
Route::delete('/user/{id}/profile-picture', [UserController::class, 'deleteProfilePicture']);

Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);
