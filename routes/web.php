<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
        


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function(){
    Route::get('/home' , [FilesController::class , 'index'])->name('index');
    Route::post('/upload', [FilesController::class , 'upload'])->name('upload');
    Route::get('/show/{id}', [FilesController::class , 'show'])->name('show');
    Route::get('/{link}', [FilesController::class, 'downloadView'])->name('downloadView');
    Route::get('/download/{link}', [FilesController::class, 'download'])->name('download');
    Route::delete('/delete/{file}' , [FilesController::class , 'destroy'])->name('destroy');
});

