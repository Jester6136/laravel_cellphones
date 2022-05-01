<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\productsController;
use App\Http\Controllers\api\categoriesController;
use App\Http\Controllers\api\brandsController;
use App\Http\Controllers\api\memoriesController;
use App\Http\Controllers\api\colorsController;

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

Route::resource('memories', memoriesController::class);
Route::resource('colors', colorsController::class);
Route::resource('categories', categoriesController::class);
Route::resource('brands', brandsController::class);

Route::post('products/upload', [productsController::class, 'uploadFile'])->name('upload.uploadfile');

Route::get('memories/getcolordetails/{memoryID}', [memoriesController::class, 'getcolordetails'])->name('get.getcolordetail');

// Route::get('memories/edit_memory?id={id}&MemoryName={MemoryName}&Description={Description}', [memoriesController::class, 'edit_memory'])->name('post.edit_memory');

