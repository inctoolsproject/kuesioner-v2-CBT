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
})->name('index');

// Route Group Auth Mahasiswa, Dosen dan Tendik
Route::name('auth.')->group(function () {
    Route::name('mahasiswa.')->prefix('mahasiswa')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Auth\MahasiswaController::class, 'showLoginForm'])->name('login');
        Route::post('/login',  [\App\Http\Controllers\Auth\MahasiswaController::class, 'login'])->name('login.submit');
    });
    Route::name('dosen.')->prefix('dosen')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Auth\DosenController::class, 'showLoginForm'])->name('login');
        Route::post('/login',  [\App\Http\Controllers\Auth\DosenController::class, 'login'])->name('login.submit');
    });
    Route::name('tendik.')->prefix('tendik')->group(function () {
        Route::get('/login', [\App\Http\Controllers\Auth\TendikController::class, 'showLoginForm'])->name('login');
        Route::post('/login',  [\App\Http\Controllers\Auth\TendikController::class, 'login'])->name('login.submit');
    });
    Route::get('/logout',  [\App\Http\Controllers\Auth\AuthController::class, 'logout'])->name('logout');
});


// Route Group Admin
Route::name('admin.')->prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('index');

    // Route Group Admin Akademik
    Route::get('/akademik/list', [\App\Http\Controllers\Admin\AkademikController::class, 'list'])->name('akademik.list');
    // Kuesioner Mahasiswa
    Route::get('/akademik/mahasiswa', [\App\Http\Controllers\Admin\AkademikController::class, 'mahasiswa'])->name('akademik.mahasiswa.index');
    Route::get('/akademik/mahasiswa/list', [\App\Http\Controllers\Admin\AkademikController::class, 'mahasiswa_list'])->name('akademik.mahasiswa.list');
    // Kepuasan Mahasiswa Per Prodi
    Route::get('/akademik/kepuasan/mahasiswa', [\App\Http\Controllers\Admin\AkademikController::class, 'kepuasan_mahasiswa'])->name('akademik.kepuasan.mahasiswa.index');
    Route::get('/akademik/kepuasan/mahasiswa/list', [\App\Http\Controllers\Admin\AkademikController::class, 'kepuasan_mahasiswa_list'])->name('akademik.kepuasan.mahasiswa.list');


    // Kuesioner Dosen
    Route::get('/akademik/dosen', [\App\Http\Controllers\Admin\AkademikController::class, 'dosen'])->name('akademik.dosen.index');
    Route::get('/akademik/dosen/list', [\App\Http\Controllers\Admin\AkademikController::class, 'dosen_list'])->name('akademik.dosen.list');
    // Kepuasan Dosen Per Prodi
    Route::get('/akademik/kepuasan/dosen', [\App\Http\Controllers\Admin\AkademikController::class, 'kepuasan_dosen'])->name('akademik.kepuasan.dosen.index');
    Route::get('/akademik/kepuasan/dosen/list', [\App\Http\Controllers\Admin\AkademikController::class, 'kepuasan_dosen_list'])->name('akademik.kepuasan.dosen.list');
    Route::resource('akademik', \App\Http\Controllers\Admin\AkademikController::class);

    // Route Group Admin Fakultas
    Route::get('/fakultas/list', [\App\Http\Controllers\Admin\FakultasController::class, 'list'])->name('fakultas.list');
    Route::get('/fakultas/dosen', [\App\Http\Controllers\Admin\FakultasController::class, 'dosen'])->name('fakultas.dosen.index');
    Route::get('/fakultas/dosen/list', [\App\Http\Controllers\Admin\FakultasController::class, 'dosen_list'])->name('fakultas.dosen.list');

    Route::resource('fakultas', \App\Http\Controllers\Admin\FakultasController::class);

    // Route Group Admin LP2M
    Route::get('/lp2m/list', [\App\Http\Controllers\Admin\LP2MController::class, 'list'])->name('lp2m.list');
    Route::get('/lp2m/dosen', [\App\Http\Controllers\Admin\LP2MController::class, 'dosen'])->name('lp2m.dosen.index');
    Route::get('/lp2m/dosen/list', [\App\Http\Controllers\Admin\LP2MController::class, 'dosen_list'])->name('lp2m.dosen.list');
    Route::resource('lp2m', \App\Http\Controllers\Admin\LP2MController::class);

    // Route Group Admin Sarpras
    Route::get('/sarpras/list', [\App\Http\Controllers\Admin\SarprasController::class, 'list'])->name('sarpras.list');
    Route::get('/sarpras/mahasiswa', [\App\Http\Controllers\Admin\SarprasController::class, 'mahasiswa'])->name('sarpras.mahasiswa.index');
    Route::get('/sarpras/mahasiswa/list', [\App\Http\Controllers\Admin\SarprasController::class, 'mahasiswa_list'])->name('sarpras.mahasiswa.list');
    Route::get('/sarpras/dosen', [\App\Http\Controllers\Admin\SarprasController::class, 'dosen'])->name('sarpras.dosen.index');
    Route::get('/sarpras/dosen/list', [\App\Http\Controllers\Admin\SarprasController::class, 'dosen_list'])->name('sarpras.dosen.list');
    Route::resource('sarpras', \App\Http\Controllers\Admin\SarprasController::class);

    // Route Group Admin Visi Misi
    Route::get('/visi-misi/list', [\App\Http\Controllers\Admin\VisiMisiController::class, 'list'])->name('visi-misi.list');
    Route::resource('visi-misi', \App\Http\Controllers\Admin\VisiMisiController::class);
});

// Route Kusioner Mahasiswa
Route::name('mahasiswa.')->prefix('mahasiswa')->middleware(['isLogin'])->group(function () {
    Route::name('akademik.')->prefix('akademik')->group(function () {
        Route::get('/', [\App\Http\Controllers\Mahasiswa\AkademikController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Mahasiswa\AkademikController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Mahasiswa\AkademikController::class, 'store'])->name('store');
    });
    Route::name('sarpras.')->prefix('sarpras')->group(function () {
        Route::get('/', [\App\Http\Controllers\Mahasiswa\SarprasController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Mahasiswa\SarprasController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Mahasiswa\SarprasController::class, 'store'])->name('store');
    });
    Route::name('visi-misi.')->prefix('visi-misi')->group(function () {
        Route::get('/', [\App\Http\Controllers\Mahasiswa\VisiMisiController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Mahasiswa\VisiMisiController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Mahasiswa\VisiMisiController::class, 'store'])->name('store');
    });
});

Route::name('dosen.')->prefix('dosen')->middleware(['isLogin'])->group(function () {
    Route::name('akademik.')->prefix('akademik')->group(function () {
        Route::get('/', [\App\Http\Controllers\Dosen\AkademikController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Dosen\AkademikController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Dosen\AkademikController::class, 'store'])->name('store');
    });
    Route::name('sarpras.')->prefix('sarpras')->group(function () {
        Route::get('/', [\App\Http\Controllers\Dosen\SarprasController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Dosen\SarprasController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Dosen\SarprasController::class, 'store'])->name('store');
    });
    Route::name('fakultas.')->prefix('fakultas')->group(function () {
        Route::get('/', [\App\Http\Controllers\Dosen\FakultasController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Dosen\FakultasController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Dosen\FakultasController::class, 'store'])->name('store');
    });
    Route::name('visi-misi.')->prefix('visi-misi')->group(function () {
        Route::get('/', [\App\Http\Controllers\Dosen\VisiMisiController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Dosen\VisiMisiController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Dosen\VisiMisiController::class, 'store'])->name('store');
    });
    Route::name('lp2m.')->prefix('lp2m')->group(function () {
        Route::get('/', [\App\Http\Controllers\Dosen\LP2MController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Dosen\LP2MController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Dosen\LP2MController::class, 'store'])->name('store');
    });
});

Route::name('tendik.')->prefix('tendik')->middleware(['auth'])->group(function () {
    Route::name('sarpras.')->prefix('sarpras')->group(function () {
        Route::get('/', [\App\Http\Controllers\Tendik\SarprasController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Tendik\SarprasController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Tendik\SarprasController::class, 'store'])->name('store');
    });
    Route::name('visi-misi.')->prefix('visi-misi')->group(function () {
        Route::get('/', [\App\Http\Controllers\Tendik\VisiMisiController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Tendik\VisiMisiController::class, 'show'])->name('show');
        Route::post('/{id}', [\App\Http\Controllers\Tendik\VisiMisiController::class, 'store'])->name('store');
    });
});

// Route API
Route::name('api.')->prefix('api')->group(function () {
    Route::name('mahasiswa.')->prefix('mahasiswa')->group(function () {
        Route::post('/kuesioner/{id}/by-matkul', [\App\Http\Controllers\API\MataKuliahController::class, 'mahasiswa'])->name('mata-kuliah');
    });
    Route::name('dosen.')->prefix('dosen')->group(function () {
        Route::post('/kuesioner/{id}/by-matkul', [\App\Http\Controllers\API\MataKuliahController::class, 'dosen'])->name('mata-kuliah');
    });
});
