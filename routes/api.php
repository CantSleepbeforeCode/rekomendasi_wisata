<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/list-wisata', [ApiController::class, 'listWisata']);
Route::get('/list-kuliner', [ApiController::class, 'listKuliner']);
Route::get('/detail-wisata', [ApiController::class, 'detailWisata']);
Route::get('/detail-kuliner', [ApiController::class, 'detailKuliner']);

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);