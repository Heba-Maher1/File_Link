<?php

use App\Http\Controllers\FilesController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PlansController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\SubscriptionsController;
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


// Authenticated and Subscribed User Routes
Route::middleware(['auth' , 'subscribed'])->group(function () {
    Route::post('/send-email-transfer', [MailController::class, 'sendEmailTransfer'])->name('sendEmailTransfer');
    Route::get('/email-form', [MailController::class, 'emailForm'])->name('emailForm');
});

require __DIR__.'/auth.php';

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    Route::get('plans' , [PlansController::class , 'index'])->name('plans');
    Route::get('/', [FilesController::class , 'index'])->name('index');
    Route::post('/upload', [FilesController::class , 'upload'])->name('upload');
    Route::get('/show/{id}', [FilesController::class , 'show'])->name('show');
    Route::delete('/delete/{file}' , [FilesController::class , 'destroy'])->name('destroy');
    Route::post('payments' , [PaymentsController::class , 'store'])->name('payments.store');
    Route::get('payments/{subscription}/success' , [PaymentsController::class , 'success'])->name('payments.success');
    Route::get('payments/subscription}/cancel' , [PaymentsController::class , 'cancel'])->name('payments.cancel');
    Route::get('subscription/{subscription}/pay' , [PaymentsController::class , 'create'])->name('checkout');
    Route::post('subscribe' , [SubscriptionsController::class , 'store'])->name('subscriptions.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Public Routes
Route::get('/{link}', [FilesController::class, 'downloadView'])->name('downloadView');
Route::get('/download/{link}', [FilesController::class, 'download'])->name('download');

Route::post('/payments/stripe/webhook' , StripeController::class);