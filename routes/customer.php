<?php

use Illuminate\Support\Facades\Route;





Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function() {
    Route::get('/dashboard', function () {
        return view('customer.dashboard');
    })->name('dashboard');
  
});
