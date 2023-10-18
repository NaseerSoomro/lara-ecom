<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishlistController;


Auth::routes();

Route::get('/', [FrontendController::class, 'index']);
Route::get('/collections', [FrontendController::class, 'categories'])->name('collections');
Route::get('/collections/{category_slug}', [FrontendController::class, 'category_products'])->name('category_products');
Route::get('/collections/{cateory_slug}/{product_slug}', [FrontendController::class, 'category_product_view'])->name('category_product_view');

Route::middleware(['auth'])->group(function () {
    Route::get('wishlists', [WishlistController::class, 'index'])->name('wishlists');
    Route::get('carts', [CartController::class, 'index'])->name('carts');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout');
});

// Thank you controller
Route::get('/thank-you', [FrontendController::class, 'thank_you'])->name('thank_you');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Dashboard Routes

Route::prefix('admin/')->middleware(['auth', 'is_admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index']);

    // Category Routes
    Route::resource('category', CategoryController::class);
    // Route::resource('brands', BrandController::class);

    // Brand Component using Livewire
    Route::get('/brands', App\Http\Livewire\Admin\Brand\Index::class)->name('brands');

    // Brand Routes
    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index')->name('products.index');
        Route::get('products/create', 'create')->name('products.create');
        Route::post('products', 'store')->name('products.store');
        Route::get('products/{product}/edit', 'edit')->name('products.edit');
        Route::post('products/{id}/update', 'update')->name('products.update');
        Route::get('products/{id}/show', 'show')->name('products.show');
        Route::get('products/{id}/delete', 'destroy')->name('products.delete');
        Route::get('products/delete-product-image/{id}', 'destroy_image')->name('products.image.delete');

        // 
        Route::post('products/update-color-products/{color_product_id}', 'update_color_products_quantity')->name('update_color_products_quantity');
        Route::get('products/delete-color-products/{color_product_id}', 'delete_color_products_quantity')->name('delete_color_products_quantity');
    });

    // Color Routes
    Route::controller(ColorController::class)->group(function () {
        Route::get('colors', 'index')->name('colors.index');
        Route::get('colors/create', 'create')->name('colors.create');
        Route::post('colors', 'store')->name('colors.store');
        Route::get('colors/{id}/edit', 'edit')->name('colors.edit');
        Route::post('colors/{id}/update', 'update')->name('colors.update');
        Route::get('colors/{id}/show', 'show')->name('colors.show');
        Route::get('colors/{id}/delete', 'destroy')->name('colors.delete');
        Route::delete('colors/product-image/{id}/delete', 'destroy_image')->name('colors.image.delete');
    });

    // Slider Routes
    Route::controller(SliderController::class)->group(function () {
        Route::get('sliders', 'index')->name('sliders.index');
        Route::get('sliders/create', 'create')->name('sliders.create');
        Route::post('sliders', 'store')->name('sliders.store');
        Route::get('sliders/{id}/edit', 'edit')->name('sliders.edit');
        Route::post('sliders/{id}/update', 'update')->name('sliders.update');
        Route::get('sliders/{id}/show', 'show')->name('sliders.show');
        Route::get('sliders/{id}/delete', 'destroy')->name('sliders.delete');
        Route::delete('sliders/product-image/{id}/delete', 'destroy_image')->name('sliders.image.delete');
    });
});
