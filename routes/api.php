<?php

use App\Models\DetailTransactions;
use App\Models\Products;
use App\Models\Transactions;
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

Route::middleware(\App\Http\Middleware\NotHaveJwtMiddleware::class)->group(function () {
    Route::post('reservation', [\App\Http\Controllers\api\ReservationApi::class, 'create'])
        ->name('reservation.create');
});

Route::middleware(\App\Http\Middleware\HasJwtTokenMiddleware::class)->group(function () {

    Route::post('products', [\App\Http\Controllers\api\ProductApi::class, 'create']);
    Route::get('products', [\App\Http\Controllers\api\ProductApi::class, 'index']);
    Route::get('products/{productId}', [\App\Http\Controllers\api\ProductApi::class, 'show']);
    Route::put('products/{productId}', [\App\Http\Controllers\api\ProductApi::class, 'update']);
    Route::delete('products/{productId}', [\App\Http\Controllers\api\ProductApi::class, 'destroy']);

    Route::get('transactions', [\App\Http\Controllers\api\TransactionApi::class, 'index']);
    Route::get('transactions/{transactionId}', [\App\Http\Controllers\api\TransactionApi::class, 'show']);
    Route::put('transactions/{transactionId}', [\App\Http\Controllers\api\TransactionApi::class, 'update']);

    Route::get('cart', [\App\Http\Controllers\api\DetailTransactionApi::class, 'create']);
    Route::get('submitCart', [\App\Http\Controllers\TransactionsController::class, 'submitCart']);

    Route::get('checkout/{transactionId}', [\App\Http\Controllers\api\CheckoutApi::class, 'show']);
    Route::post('checkout/{transactionId}', [\App\Http\Controllers\api\CheckoutApi::class, 'store']);

    Route::get('payment/{transactionId}', [\App\Http\Controllers\api\PaymentApi::class, 'show']);



});
Route::post('login', [\App\Http\Controllers\api\CashierApi::class, 'login']);

