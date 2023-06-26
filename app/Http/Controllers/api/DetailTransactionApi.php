<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactions;
use App\Models\Products;
use App\Models\Transactions;
use http\Env\Response;
use Illuminate\Http\Request;

use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class DetailTransactionApi extends Controller
{
    public function create(Request $request)
    {
        $jwt = $request->bearerToken();

        if(!JWTAuth::parseToken($jwt)->check())
        {
            return response('Unauthorized', 403);
        }

        $decode = JWTAuth::decode(new Token($jwt));

        $transactionId = $decode->getClaims()['transactionId']->getValue();

        if($request->input('productId') == 0){
            return response()->json([
                'total' => Transactions::find($transactionId)->products()->count()
            ]);
        }

        $data = DetailTransactions::where('transactionId', $transactionId)
            ->where('productId', $request->input('productId'))->first();
        $dataprod = Products::find($request->input('productId'));

        if ($data == NULL) {
            $det = new DetailTransactions();
            $det->transactionId = $transactionId;
            $det->productId = $request->input('productId');
            $det->quantity = $request->input('quantity');
            $det->quantityPrice = ($request->input('quantity') * $dataprod->productPrice);
            $det->save();
        } else {
            $data->update(['quantity' => ($data->quantity + $request->input('quantity')),
                    'quantityPrice' => ($data->quantityPrice + ($request->input('quantity') * $dataprod->productPrice))
                ]);
        }
        $dine = Transactions::find($transactionId);
        $dine->subtotal += ($request->input('quantity')) * $dataprod->productPrice;
        $dine->tax = $dine->subtotal * 0.1;
        $dine->totalPrice = $dine->subtotal + $dine->tax;
        $dine->save();

        $totalProduct = $dine->products()->count();

        return response()->json([
            'status' => 'success',
            'message' => "$dataprod->productName berhasil ditambahkan",
            'total' => $totalProduct
        ], 201);
    }

//    public function show($id){
//        $trx = Transactions::join('customers', 'customers.id', '=', 'transactions.customerId')
//            ->where('transactions.id', $id)->get();
//
//        $details = Transactions::join('detailtransactions', 'transactions.id', '=', 'detailtransactions.transactionId')
//            ->join('products', 'products.id', '=', 'detailtransactions.productId')
//            ->where('transactions.id', $id)
//            ->get();
//
//        return response()->json([
//            'transaction' => $trx,
//            'detailTransactions' => $details
//        ], 201);
//    }
}
