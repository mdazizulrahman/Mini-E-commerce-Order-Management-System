<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

});

Route::prefix('Category')->name('admin.')->group(function(){
    Route::get('/',[CategoryController::class,'index'])->name('category.index');
    Route::get('/create',[CategoryController::class,'index'])->name('category.create');
    Route::get('/edit/{id}',[CategoryController::class,'index'])->name('category.edit');
});