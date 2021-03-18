<?php

use App\Http\Controllers\AdminControler;
use App\Http\Controllers\HomeController;
use App\Http\Livewire\AddSurvey;
use App\Http\Livewire\DataSurvey;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/data-survey', [App\Http\Controllers\HomeController::class, 'data']);
// Route::post('/add-data', [App\Http\Controllers\HomeController::class, 'store']);
// Route::delete('/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy']);
// Route::get('/edit-data/{id}', [App\Http\Controllers\HomeController::class, 'edit']);
// Route::put('/edit-data/{id}', [App\Http\Controllers\HomeController::class, 'update']);
// Route::get('/detail/{id}', [App\Http\Controllers\HomeController::class, 'show']);
// Route::get('/cetak/{id}', [App\Http\Controllers\HomeController::class, 'print']);

// Route::get('download-data/', [App\Http\Controllers\HomeController::class, 'printpdf']);
// Route::get('dropdownlist/kelurahan/{id}', [HomeController::class, 'kelurahan']);

Route::get('admin-page', [AdminControler::class, 'index'])->middleware('role:admin')->name('admin.page');

Route::get('user-page', function () {
    return 'Halaman untuk User';
})->middleware('role:user')->name('user.page');

\PWA::routes();
