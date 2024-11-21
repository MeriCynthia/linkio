<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LinkBlockController;
use App\Http\Controllers\MyLinkController;
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
Route::get('/link-blocks', [LinkBlockController::class, 'index']);
Route::post('/link-blocks', [LinkBlockController::class, 'store']);
Route::get('/link-blocks/{id}', [LinkBlockController::class, 'show']);
Route::put('/link-blocks/{id}', [LinkBlockController::class, 'update']);
Route::delete('/link-blocks/{id}', [LinkBlockController::class, 'destroy']);
Route::get('/link-blocks/mylink/{mylink_id}', [LinkBlockController::class, 'showByMyLink']);
Route::get('/mylinks', [MyLinkController::class, 'index']);
Route::get('/mylinks/{id}', [MyLinkController::class, 'show']);
Route::post('/mylinks', [MyLinkController::class, 'store']);
Route::put('/mylinks/{id}', [MyLinkController::class, 'update']);
Route::delete('/mylinks/{id}', [MyLinkController::class, 'destroy']);
Route::get('/mylinks/username/{username}', [MyLinkController::class, 'getByUsername']);
