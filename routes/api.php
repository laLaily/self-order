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

//Route::get('reservation',[\App\Http\Controllers\api\ReservationApi::class, 'register']);
Route::post('reservation', [\App\Http\Controllers\api\ReservationApi::class, 'create'])
    ->name('reservation.create');
Route::get('order/product', [\App\Http\Controllers\api\TransactionApi::class, 'cart']);
Route::get('cart', [\App\Http\Controllers\api\DetailTransactionApi::class, 'create']);
Route::delete('cart',  [\App\Http\Controllers\api\DetailTransactionApi::class, 'destroy']);
Route::get('submitCart', [\App\Http\Controllers\TransactionsController::class, 'submitCart']);

Route::middleware(\App\Http\Middleware\HasJwtTokenMiddleware::class)
->get('me', [\App\Http\Controllers\api\ReservationApi::class, 'me']);
