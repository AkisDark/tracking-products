<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Users\ProfileController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\Complaints\ComplaintController;
use App\Http\Controllers\Dashboard\Products\PricePerStateController;
use App\Http\Controllers\Dashboard\SubCategories\SubCategoryController;

//
Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin')->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//
Route::redirect('/', '/products', 301);

// 
Route::controller(ProfileController::class)->group(function () {

    Route::get('profile', 'profile')->name('users.profile');
    Route::put('update-profile', 'update')->name('users.update');
    //
})->middleware('auth');

//
Route::controller(CategoryController::class)->group(function () {

    Route::get('categories', 'index')->name('categories.index');
    //
    Route::get('categories/create', 'create')->name('categories.create');
    Route::post('categories', 'store')->name('categories.store');
    //
    Route::get('categories/{category}/edit', 'edit')->name('categories.edit');
    Route::put('categories/{category}', 'update')->name('categories.update');
    //
    Route::delete('categories/{category}', 'destroy')->name('categories.destroy');
})->middleware('auth');

//
Route::controller(SubCategoryController::class)->group(function () {

    Route::get('subcategories', 'index')->name('subcategories.index');
    //
    Route::get('subcategories/create', 'create')->name('subcategories.create');
    Route::post('subcategories', 'store')->name('subcategories.store');
    //
    Route::get('subcategories/{subcategory}/edit', 'edit')->name('subcategories.edit');
    Route::put('subcategories/{subcategory}', 'update')->name('subcategories.update');
    //
    Route::delete('subcategories/{subcategory}', 'destroy')->name('subcategories.destroy');
})->middleware('auth');

//
Route::controller(ProductController::class)->group(function () {

    Route::get('products', 'index')->name('products.index');
    //
    Route::get('products/create', 'create')->name('products.create');
    Route::post('products', 'store')->name('products.store');
    //
    Route::get('products/{product}/edit', 'edit')->name('products.edit');
    Route::put('products/{product}', 'update')->name('products.update');
    //
    Route::delete('products/{product}', 'destroy')->name('products.destroy');
})->middleware('auth');

//
Route::controller(ComplaintController::class)->group(function () {

    Route::get('complaints', 'index')->name('complaints.index');
    //
    Route::delete('complaints/{complaint}', 'destroy')->name('complaints.destroy');
})->middleware('auth');

//
Route::controller(PricePerStateController::class)->group(function () {
    Route::get('price-per-state/{product_id}', 'index')->name('price.per.state');
})->middleware('auth');
