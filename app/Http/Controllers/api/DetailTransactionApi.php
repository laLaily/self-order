<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactions;
use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class DetailTransactionApi extends Controller
{
    public function create(Request $request)
    {
        $data = DetailTransactions::where('transactionId', $request->input('transaction_id'))->where('productId', $request->input('productId'))->first();
        $dataprod = Products::find($request->input('productId'));

        if ($data == NULL) {
            $det = new DetailTransactions();
            $det->transactionId = $request->input('transaction_id');
            $det->productId = $request->input('productId');
            $det->quantity = $request->input('quantity');
            $det->quantityPrice = ($request->input('quantity') * $dataprod->productPrice);
            $det->save();
        } else {
            DetailTransactions::where('transactionId', $request->input('transaction_id'))->where('productId', $request->input('productId'))
                ->update(['quantity' => ($data->quantity + $request->input('quantity')),
                    'quantityPrice' => ($data->quantityPrice + ($request->input('quantity') * $dataprod->productPrice))
                ]);
        }
        $dine = Transactions::find($request->input('transaction_id'));
        $dine->subtotal += ($request->input('quantity')) * $dataprod->productPrice;
        $dine->tax = $dine->subtotal * 0.1;
        $dine->totalPrice = $dine->subtotal + $dine->tax;
        $dine->save();

        return response()->json([
            'status' => 'success',
            'message' => 'tambah keranjang berhasil'
        ], 201);
    }

    public function destroy(Request $request){
        $jwt = $_COOKIE['SI-CAFE'];
        $payload = JWTAuth::decode(new Token($jwt));
        $id = $payload->getClaims()['transaction']->getValue();

        $data = DetailTransactions::where('transactionId', $id)->where('productId', $request->input('productId'))->first();

        $dine = Transactions::find($id);
        $dine->totalPrice -= $data->quantityPrice;
        $dine->save();

        DetailTransactions::where('transactionId', $id)->where('productId', $request->input('productId'))->delete();

        return redirect('/api/order/product');
    }
}
