<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Dashboard Routes

Route::prefix('admin/')->middleware(['auth', 'is_admin'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index']);
    
    // Category Routes
    Route::resource('category', CategoryController::class);
    // Route::resource('brands', BrandController::class);

    // Brand Component using Livewire
    Route::get('/add-brand', App\Http\Livewire\Admin\Brand\Index::class);

    // Brand Routes
    Route::controller(ProductController::class)->group(function(){
        Route::get('products', 'index')->name('products.index');  
        Route::get('products/create', 'create')->name('products.create');  
        Route::post('products', 'store')->name('products.store');  
        Route::get('products/{id}/edit', 'edit')->name('products.edit');  
        Route::post('products/{id}/update', 'update')->name('products.update');  
        Route::get('products/{id}/view', 'show')->name('products.show');  
        Route::post('products/{id}/delete', 'destroy')->name('products.delete');  
    });

});
