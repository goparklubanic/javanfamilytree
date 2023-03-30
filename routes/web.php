<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ControllerKeluarga;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () { return view('welcome'); });

Route::get('/',[ControllerKeluarga::class,'index'])->name('klgUtama');
Route::post('/keluarga/tambah',[ControllerKeluarga::class,'store'])->name('klgTambah');
Route::put('/keluarga/{id}/update',[ControllerKeluarga::class,'update'])->name('klgMrubah');
Route::delete('/keluarga/{id}/remove',[ControllerKeluarga::class,'destroy'])->name('klgMusnah');
