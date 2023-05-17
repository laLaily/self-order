<?php

use Illuminate\Support\Facades\Route;

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
    return view('order.dashboard');
});

Route::prefix('/dinein')->group(function (){
    Route::get('/registration', [\App\Http\Controllers\CustomersController::class, 'register']);
    Route::post('/registration/process', [\App\Http\Controllers\TransactionsController::class, 'createTransaction'])->name('addCustomer');
    Route::get('/order/products', [\App\Http\Controllers\TransactionsController::class, 'cart']);
    Route::post('/order/products/filter', [\App\Http\Controllers\TransactionsController::class, 'filterByCategory']) ->name('filterProduct');
    Route::post('/order/products/process', [\App\Http\Controllers\TransactionsController::class, 'createDetailTransaction'])->name('addTrxProduct');
    Route::post('/order/products/delete', [\App\Http\Controllers\TransactionsController::class, 'deleteProduct']) ->name('deleteProduct');
    Route::get('/order/submit', [\App\Http\Controllers\TransactionsController::class, 'submitCart']) ->name('submitOrder');
    Route::get('/order/success', function (){
        return view();
    });
});
