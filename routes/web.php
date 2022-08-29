<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.index');
});

// Route Group Auth Mahasiswa, Dosen dan Tendik
Route::name('auth.')->group(function () {
    Route::name('mahasiswa.')->prefix('mahasiswa')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Auth\MahasiswaController::class, 'showLoginForm'])->name('login');
        Route::post('/login',  [\App\Http\Controllers\Auth\MahasiswaController::class, 'login'])->name('login.submit');
        Route::post('/logout',  [\App\Http\Controllers\Auth\MahasiswaController::class, 'logout'])->name('logout');
    });
});


// Route Kusioner Mahasiswa
Route::name('mahasiswa.')->prefix('mahasiswa')->group(function () {
    Route::name('akademik.')->prefix('akademik')->group(function () {
        Route::get('/', [\App\Http\Controllers\Mahasiswa\AkademikController::class, 'index'])->name('index');
    });
});
