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

        if(!$jwt){
            return response()->json([
                'status' => 'error',
                'message' => 'Silahkan refresh ulang'
            ], 403);
        }

        if(!JWTAuth::parseToken($jwt)->check())
        {
            return response('Unauthorized', 403);
        }

        $decode = JWTAuth::decode(new Token($jwt));

        $transactionId = $decode->getClaims()['transactionId']->getValue();

        if($request->input('productId') == 0){
            return response()->json([
                'total' => Transactions::find($transactionId)->products()->count(),
                'transactionId' => $transactionId
            ]);
        }

        $data = DetailTransactions::where('transactionId', $transactionId)
            ->where('productId', $request->input('productId'))->first();
        $dataprod = Products::find($request->input('productId'));

        if($request->input('quantity') == -1 && !$data){
            return response()->json([
                'status' => 'error',
                'message' => 'Barang tidak bisa dikurangi'
            ], 422);
        }

        if (!$data && $request->input('quantity') != -1) {
            $det = new DetailTransactions();
            $det->transactionId = $transactionId;
            $det->productId = $request->input('productId');
            $det->quantity = $request->input('quantity');
            $det->quantityPrice = ($request->input('quantity') * $dataprod->productPrice);
            $det->save();
        } else {
            if($data->quantity + $request->input('quantity') <= 0 ){
                DetailTransactions::where('transactionId', $transactionId)
                    ->where('productId', $request->input('productId'))->delete();

                return response()->json([
                   'status' => 'success',
                   'message' => "{$dataprod->productName} berhasil dihapus"
                ]);
            }

            DetailTransactions::where('transactionId', $transactionId)
                ->where('productId', $request->input('productId'))->update(['quantity' => ($data->quantity + $request->input('quantity')),
                    'quantityPrice' => ($data->quantityPrice + ($request->input('quantity') * $dataprod->productPrice))
                ]);
        }
        $dine = Transactions::find($transactionId);
        $dine->subtotal += ($request->input('quantity')) * $dataprod->productPrice;
        $dine->tax = $dine->subtotal * 0.1;
        $dine->totalPrice = $dine->subtotal + $dine->tax;
        $dine->save();

        $totalProduct = $dine->products()->count();

        $status = 'ditambahkan';
        if($request->input('quantity') == -1){
            $status = 'dikurangi';
        }

        return response()->json([
            'status' => 'success',
            'message' => "$dataprod->productName berhasil $status",
            'total' => $totalProduct,
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
