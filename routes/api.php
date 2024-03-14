<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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

Route::controller(CategoryController::class)->group(function () {
    Route::get('categories','categories')->name('categories');
    Route::post('category_store','store')->name('category_store');
    Route::post('category_update/{category}','update')->name('category_update');
    Route::get('categories/{category}', 'show')->name('categories.show');
    Route::delete('category_delete/{category}','category_delete')->name('category_delete');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('Products', 'products')->name('products');
    Route::post('product_store', 'store')->name('product_store');
    Route::post('product_update/{product}', 'update')->name('product_update');
    Route::get('products/{product}', 'show')->name('products.show');
    Route::delete('product_delete/{product}', 'category_delete')->name('product_delete');
});

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');

});
