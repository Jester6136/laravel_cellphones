<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\productsController;
use App\Http\Controllers\api\categoriesController;
use App\Http\Controllers\api\brandsController;
use App\Http\Controllers\api\customersController;
use App\Http\Controllers\api\memoriesController;
use App\Http\Controllers\api\colorsController;
use App\Http\Controllers\api\cartController;

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


Route::resource('products', productsController::class);
Route::resource('cart', cartController::class);

Route::resource('memories', memoriesController::class);
Route::resource('colors', colorsController::class);

Route::resource('categories', categoriesController::class);
Route::resource('brands', brandsController::class);

Route::post('products/upload', [productsController::class, 'uploadFile'])->name('upload.uploadfile');

Route::get('memories/getcolordetails/{memoryID}', [memoriesController::class, 'getcolordetails'])->name('get.getcolordetail');





//GUESS============================================
Route::post('customers/get', [customersController::class, 'show_cus'])->name('get.show_cus');
Route::post('cart/update_carts', [cartController::class, 'update_carts'])->name('put.update_carts');
// Route::get('customers/get', [customersController::class, 'show_cus'])->name('get.show_cus');

Route::get('products/get15procduct/{categoryID}', [productsController::class, 'get15procduct'])->name('get.get15products');
Route::get('products/getprocductdetail/{productID}', [productsController::class, 'getProductDetails'])->name('get.getprocductdetail');
//GUESSEND============================================