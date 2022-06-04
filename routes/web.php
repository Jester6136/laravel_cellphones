<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guess_page.home');
});

Route::get('/admin/products', function () {
    return view('admin_page.products');
});

Route::get('/admin/invoices', function () {
    return view('admin_page.invoices');
});
Route::get('/admin/home', function () {
    return view('admin_page.home');
});
Route::get('/admin', function () {
    return view('admin_page.home');
});
Route::get('/admin/order', function () {
    return view('admin_page.order');
});
Route::get('/admin/login', function () {
    return view('admin_page.login');
});

Route::get('/productdetail', function () {
    return view('guess_page.productdetail');
});

Route::get('/cart', function () {
    return view('guess_page.cart');
});
Route::get('/payment_info', function () {
    return view('guess_page.payment_info');
});
Route::get('/voucher', function () {
    return view('guess_page.voucher');
});
Route::get('/payment', function () {
    return view('guess_page.payment');
});
Route::get('/cart-success', function () {
    return view('guess_page.cart-success');
});
Route::get('/ordercheck', function () {
    return view('guess_page.ordercheck');
});
Route::get('/brand/{id}', function () {
    return view('guess_page.brand');
});

Route::get('api/generate-pdf/{id}/{staffName}', [PDFController::class, 'generatePDF']);