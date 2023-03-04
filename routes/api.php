<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/create', [App\Http\Controllers\UserController::class, 'create']);
Route::post('/login', [App\Http\Controllers\UserController::class, 'login']);
Route::post('/message/create/{reciever}', [App\Http\Controllers\MessageController::class, 'create']);

Route::middleware('auth:sanctum')->get('/message/all', [App\Http\Controllers\MessageController::class, 'view'] );
