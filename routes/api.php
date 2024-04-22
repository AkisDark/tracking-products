<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Products\ProductController;
use App\Http\Controllers\Api\Categories\CategoryController;
use App\Http\Controllers\Api\Complaints\ComplaintController;
use App\Http\Controllers\Api\SubCategories\SubcategoryController;
use App\Http\Controllers\Api\StatesAndCities\StatesAndCitiesController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/states', [StatesAndCitiesController::class, 'getStates']);

Route::get('/cities/{stateId}', [StatesAndCitiesController::class, 'getCities']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/subcategories', [SubcategoryController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);

Route::post('/complaints', [ComplaintController::class, 'store']);
