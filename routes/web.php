<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'login'])->name('login');
Route::post('/', [MainController::class, 'login']);
Route::get('/keluar', [MainController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/wisata', [MainController::class, 'wisata']);
    Route::get('/kuliner', [MainController::class, 'kuliner']);
    Route::get('/user', [MainController::class, 'user']);

    Route::post('/tambah-wisata', [MainController::class, 'addwisata']);
    Route::post('/tambah-kuliner', [MainController::class, 'addkuliner']);
    Route::post('/tambah-user', [MainController::class, 'adduser']);
    
    Route::post('/ubah-wisata', [MainController::class, 'editwisata']);
    Route::post('/ubah-kuliner', [MainController::class, 'editkuliner']);
    Route::post('/ubah-user', [MainController::class, 'edituser']);

    Route::get('/hapus-wisata/{id}', [MainController::class, 'deletewisata']);
    Route::get('/hapus-kuliner/{id}', [MainController::class, 'deletekuliner']);
    Route::get('/hapus-user/{id}', [MainController::class, 'deleteuser']);
});