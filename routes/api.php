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

Route::get('/', function () {
    return view('order.dashboard');
});
Route::get('reservation',[\App\Http\Controllers\api\ReservationApi::class, 'register']);
Route::post('reservation', [\App\Http\Controllers\api\ReservationApi::class, 'create'])
    ->name('reservation.create');
Route::get('order/product', [\App\Http\Controllers\api\TransactionApi::class, 'cart']);
Route::get('cart', [\App\Http\Controllers\api\DetailTransactionApi::class, 'create']);
Route::delete('cart',  [\App\Http\Controllers\api\DetailTransactionApi::class, 'destroy']);
Route::get('submitCart', [\App\Http\Controllers\TransactionsController::class, 'submitCart']);

//Route::get('cart/add', function (Request $request){
//    $data = DetailTransactions::where('transactionId', $request->input('transaction_id'))->where('productId', $request->input('productId'))->first();
//    $dataprod = Products::find($request->input('productId'));
//
//    if ($data == NULL) {
//        $det = new DetailTransactions();
//        $det->transactionId = $request->input('transaction_id');
//        $det->productId = $request->input('productId');
//        $det->quantity = $request->input('quantity');
//        $det->quantityPrice = ($request->input('quantity') * $dataprod->productPrice);
//        $det->save();
//    } else {
//        DetailTransactions::where('transactionId', $request->input('transaction_id'))->where('productId', $request->input('productId'))
//            ->update(['quantity' => ($data->quantity + $request->input('quantity')),
//                'quantityPrice' => ($data->quantityPrice + ($request->input('quantity') * $dataprod->productPrice))
//            ]);
//    }
//    $dine = Transactions::find($request->input('transaction_id'));
//    $dine->subtotal += ($request->input('quantity')) * $dataprod->productPrice;
//    $dine->tax = $dine->subtotal * 0.1;
//    $dine->totalPrice = $dine->subtotal + $dine->tax;
//    $dine->save();
//
//    return response()->json([
//        'status' => 'success',
//        'message' => 'tambah keranjang berhasil'
//    ], 201);
//});

Route::get('me', [\App\Http\Controllers\api\ReservationApi::class, 'me']);
