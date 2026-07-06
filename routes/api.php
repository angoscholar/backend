<?php

use App\Http\Controllers\ArtigoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/ping', fn () => response()->json([
    'status' => 'ok',
    'message' => 'API do Mubissule funcionando!',
]));

// ---- Auth ----
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('api.token')->group(function () {
    Route::get('/auth/me', [AuthController::class, 'me']);
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

// ---- Artigos (públicos: leitura; admin: escrita) ----
Route::get('/artigos', [ArtigoController::class, 'index']);
Route::get('/artigos/{slug}', [ArtigoController::class, 'show']);

Route::middleware('api.token:admin')->group(function () {
    Route::post('/artigos', [ArtigoController::class, 'store']);
    Route::put('/artigos/{slug}', [ArtigoController::class, 'update']);
    Route::delete('/artigos/{slug}', [ArtigoController::class, 'destroy']);
});

// ---- Páginas estáticas dinâmicas (sobre, privacidade, termos...) ----
Route::get('/pages', [PageController::class, 'index']);
Route::get('/pages/{slug}', [PageController::class, 'show']);
Route::middleware('api.token:admin')->put('/pages/{slug}', [PageController::class, 'update']);
