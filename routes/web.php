<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;

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

Route::get('/home' , [FilesController::class , 'index'])->name('index');
Route::post('/upload', [FilesController::class , 'upload'])->name('upload');
Route::get('/show/{id}', [FilesController::class , 'show'])->name('show');
Route::get('/{link}', [FilesController::class, 'downloadView'])->name('downloadView');
Route::get('/download/{link}', [FilesController::class, 'download'])->name('download');
Route::delete('/delete/{file}' , [FilesController::class , 'destroy'])->name('destroy');



