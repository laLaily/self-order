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

Route::view('/', 'order.dashboard');

Route::prefix('/dinein')->group(function (){
    Route::get('/registration', [\App\Http\Controllers\CustomersController::class, 'register']);
//    Route::post('/registration/process', [\App\Http\Controllers\TransactionsController::class, 'createTransaction'])->name('addCustomer');
    Route::get('/order/products', [\App\Http\Controllers\TransactionsController::class, 'cart'])
    ->name('dinein.cart');
    Route::post('/order/products/filter', [\App\Http\Controllers\TransactionsController::class, 'filterByCategory']) ->name('filterProduct');
    Route::post('/order/products/process', [\App\Http\Controllers\TransactionsController::class, 'createDetailTransaction'])->name('addTrxProduct');
    Route::post('/order/products/delete', [\App\Http\Controllers\TransactionsController::class, 'deleteProduct']) ->name('deleteProduct');
    Route::get('/order/submit', [\App\Http\Controllers\TransactionsController::class, 'submitCart']) ->name('submitOrder');
    Route::get('/order/success', function (){
        return view('order.paymentCode');
    });
});

Route::prefix('/cashier')->group(function (){
    Route::get('/login',[\App\Http\Controllers\CashiersController::class, 'login']);
    Route::post('/login/process', [\App\Http\Controllers\CashiersController::class, 'loginCheck'])->name('loginCashier');
//    Route::post('/create', [\App\Http\Controllers\CashiersController::class, 'addCashier'])->name('addCashier');
    Route::middleware(\App\Http\Middleware\CashierMiddleware::class)->group(function (){
        Route::get('/dashboard', [\App\Http\Controllers\CashiersController::class, 'dashboard']);

        Route::prefix('/product')->group(function() {
            Route::get('/view', [\App\Http\Controllers\CashiersController::class, 'getProducts'])->name('cashier.viewProducts');
            Route::post('/create', [\App\Http\Controllers\CashiersController::class, 'addProduct'])->name('cashier.addProduct');
            Route::post('/delete/{id}',[\App\Http\Controllers\CashiersController::class, 'deleteProduct'])->name('cashier.deleteProduct');
            Route::post('/update/{id}', [\App\Http\Controllers\CashiersController::class, 'updateProducts'])->name('cashier.updateProduct');
        });

        Route::prefix('/transaction')->group(function (){
            Route::get('/view', [\App\Http\Controllers\CashiersController::class, 'getTransactions'])->name('cashier.viewTransaction');
            Route::get('/view/{id}', [\App\Http\Controllers\CashiersController::class, 'getOneTransactionWithProduct'])->name('cashier.viewDetailTransaction');
            Route::post('/updateStatus/{id}', [\App\Http\Controllers\CashiersController::class, 'updateStatusTransaction'])->name('cashier.updateStatus');
        });
    });
});

Route::prefix('/admin')->group(function (){

});
