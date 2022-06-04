<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\productsController;
use App\Http\Controllers\api\categoriesController;
use App\Http\Controllers\api\brandsController;
use App\Http\Controllers\api\customersController;
use App\Http\Controllers\api\staffsController;
use App\Http\Controllers\api\memoriesController;
use App\Http\Controllers\api\colorsController;
use App\Http\Controllers\api\cartController;
use App\Http\Controllers\api\ordersController;
use App\Http\Controllers\api\orderdetailsController;
use App\Http\Controllers\api\invoicesController;
use App\Http\Controllers\api\suppliersController;
use App\Models\orderdetails;

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
Route::resource('orders', ordersController::class);
Route::resource('invoices', invoicesController::class);
Route::resource('suppliers', suppliersController::class);
Route::resource('cart', cartController::class);

Route::resource('memories', memoriesController::class);
Route::resource('customers', customersController::class);
Route::resource('colors', colorsController::class);

Route::resource('categories', categoriesController::class);
Route::resource('brands', brandsController::class);

Route::post('products/upload', [productsController::class, 'uploadFile'])->name('upload.uploadfile');

Route::get('memories/getcolordetails/{memoryID}', [memoriesController::class, 'getcolordetails'])->name('get.getcolordetail');

Route::get('color/get_basic', [colorsController::class, 'get_basic'])->name('color.get_basic');


Route::get('orderdetails/getTopProductSell', [orderdetailsController::class, 'getTopProductSell'])->name('get.getTopProductSell');
Route::get('orderdetails/total', [orderdetailsController::class, 'total'])->name('get.total');
Route::get('orderdetails/count_order', [orderdetailsController::class, 'count_order'])->name('get.count_order');

Route::post('orders/get_all', [ordersController::class, 'get_all']);
Route::post('staffs/checkLogin', [staffsController::class, 'checkLogin']);
Route::post('orders/update_status', [ordersController::class, 'update_status']);
//GUESS============================================
Route::post('customers/get', [customersController::class, 'show_cus'])->name('get.show_cus');
Route::post('cart/update_carts', [cartController::class, 'update_carts'])->name('put.update_carts');
// Route::get('customers/get', [customersController::class, 'show_cus'])->name('get.show_cus');
Route::get('orders/showByCusID/{id}',[ordersController::class, 'showByCusID']);

Route::get('orders/checkOrder/{phone}/{orderid}',[ordersController::class, 'checkOrder']);
Route::post('orders/editStatus/{id}',[ordersController::class, 'editStatus']);

Route::get('products/get15procduct/{categoryID}', [productsController::class, 'get15procduct'])->name('get.get15products');
Route::get('products/getprocductbybrand/{brandID}', [productsController::class, 'getprocductbybrand'])->name('get.getprocductbybrand');
Route::get('products/getprocductdetail/{productID}', [productsController::class, 'getProductDetails'])->name('get.getprocductdetail');
//GUESSEND============================================