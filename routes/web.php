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

Route::get('/admin-page', [AdminControler::class, 'index'])->middleware('role:admin')->name('admin.page');
Route::get('/home', [HomeController::class, 'index'])->middleware('role:user')->name('home');
Route::get('/data-survey', [HomeController::class, 'data'])->middleware('role:user');
Route::post('/add-data', [HomeController::class, 'store'])->middleware('role:user');
Route::delete('/delete/{id}', [HomeController::class, 'destroy'])->middleware('role:user');
Route::get('/edit-data/{id}', [HomeController::class, 'edit'])->middleware('role:user');
Route::put('/edit-data/{id}', [HomeController::class, 'update'])->middleware('role:user');
Route::get('/detail/{id}', [HomeController::class, 'show'])->middleware('role:user');
Route::get('/cetak/{id}', [HomeController::class, 'print'])->middleware('role:user');

Route::get('download-data/', [HomeController::class, 'printpdf'])->middleware('role:user');
Route::get('dropdownlist/kelurahan/{id}', [HomeController::class, 'kelurahan'])->middleware('role:user');

\PWA::routes();
