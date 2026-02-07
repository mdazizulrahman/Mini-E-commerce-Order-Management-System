<?php

use App\Http\Controllers\indexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\detailsController;
use App\Http\Controllers\Frontend\OrderController;

// কনফার্মেশন ফর্ম দেখানোর জন্য
Route::get('/checkout/{id}/{quantity}', [OrderController::class, 'checkout'])->name('direct.checkout');

// অর্ডার সেভ করার জন্য
Route::post('/order/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');





Route::get('/', [indexController::class, 'index'])->name('frontend.index');

// Route::get('/details/{id}', [detailsController::class, 'details'])
//     ->name('frontend.details');
Route::get('/details/{id}/{slug}', [detailsController::class, 'details'])
    ->name('frontend.details');




Route::middleware(['auth'])->get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/customer.php';

