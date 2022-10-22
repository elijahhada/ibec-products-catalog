<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\PropertiesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/tree', [CategoriesController::class, 'tree'])->name('tree');
});
Route::prefix('products')->name('products.')->group(function () {
    Route::get('/', [ProductsController::class, 'search'])->name('search');
    Route::get('/{product}', [ProductsController::class, 'bySlug'])->name('bySlug');
});
Route::prefix('properties')->name('properties.')->group(function () {
    Route::post('/', [PropertiesController::class, 'store'])->name('store');
    Route::get('/', [PropertiesController::class, 'list'])->name('list');
    Route::delete('/{property}', [PropertiesController::class, 'remove'])->name('remove');
});
Route::prefix('orders')->name('orders.')->group(function () {
    Route::prefix('items')->name('items.')->group(function () {
        Route::post('/', [OrdersController::class, 'addToCart'])->name('addToCart');
        Route::put('/{item}', [OrdersController::class, 'updateItem'])->name('update');
        Route::delete('/{item}', [OrdersController::class, 'removeItem'])->name('remove');
    });
    Route::post('/{order}', [OrdersController::class, 'payOrder'])->name('pay');
    Route::get('/', [OrdersController::class, 'list'])->name('list')->middleware('auth:sanctum');
});
Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});
