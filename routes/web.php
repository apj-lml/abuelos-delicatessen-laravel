<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;

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
    return view('index');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/cart', function () {
        return view('checkout');
    });

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Route::get('/view-product', [App\Http\Controllers\HomeController::class, 'viewProduct'])->name('view-product');

    Route::get('/view-product/{id}', function ($id){
        return view('view-product');
    })->name('view-product');

    Route::get('/my-orders/{id}', function ($id){
        return view('my-orders');
    })->name('my-orders');

    Route::get('/my-orders', [App\Http\Controllers\HomeController::class, 'myOrders'])->name('myOrders');
    Route::get('/my-fulfilled-orders', [App\Http\Controllers\HomeController::class, 'myFulfilledOrders'])->name('myFulfilledOrders');
    Route::get('/my-canceled-orders', [App\Http\Controllers\HomeController::class, 'myCanceledOrders'])->name('myCanceledOrders');

});

Route::group(['middleware' => ['admin']], function () {
    // Route::get('product', [DashboardController::class, 'products'])->name('product.index');

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/manage-orders', [App\Http\Controllers\HomeController::class, 'manageOrders'])->name('manage-orders');
    Route::get('/fulfilled-orders', [App\Http\Controllers\HomeController::class, 'fulfilledOrders'])->name('fulfilled-orders');
    Route::get('/canceled-orders', [App\Http\Controllers\HomeController::class, 'canceledOrders'])->name('canceled-orders');


 });

 Route::group(['middleware' => ['user']], function () {
    // Route::get('product', [DashboardController::class, 'products'])->name('product.index');
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


 });



 Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
 Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
 Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
 Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
 Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
 Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
