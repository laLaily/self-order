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

    public function index(Request $request)
    {
        $jwt = $request->bearerToken();
        $decode = JWTAuth::decode(new Token($jwt));

        $transactionId = $decode->getClaims()['transactionId']->getValue();

        return response()->json([
            'total' => Transactions::find($transactionId)->products()->count(),
            'transactionId' => $transactionId
        ]);
    }

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

        $data = DetailTransactions::where('transactionId', $transactionId)
            ->where('productId', $request->input('productId'))->first();
        $dataprod = Products::find($request->input('productId'));

        if (!$data && $request->input('quantity') != -1) {
            $det = new DetailTransactions();
            $det->transactionId = $transactionId;
            $det->productId = $request->input('productId');
            $det->quantity = $request->input('quantity');
            $det->quantityPrice = ($request->input('quantity') * $dataprod->productPrice);
            $det->save();
        }

        $dine = $this->saveTransactions($request, $dataprod, $transactionId);

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

    public function patch(Request $request)
    {
        $jwt = $request->bearerToken();

        $decode = JWTAuth::decode(new Token($jwt));

        $transactionId = $decode->getClaims()['transactionId']->getValue();

        $data = DetailTransactions::where('transactionId', $transactionId)
            ->where('productId', $request->input('productId'))->first();

        if(!$data){
            return response()->json([
                'status' => 'error',
                'message' => 'Produk tidak bisa dihapus',
                'total' => Transactions::find($transactionId)->products()->count(),
            ], 422);
        }

        $dataprod = Products::find($request->input('productId'));

        DetailTransactions::where('transactionId', $transactionId)
            ->where('productId', $request->input('productId'))->update(['quantity' => ($data->quantity + $request->input('quantity')),
                'quantityPrice' => ($data->quantityPrice + ($request->input('quantity') * $dataprod->productPrice))
            ]);

        $this->saveTransactions($request, $dataprod, $transactionId);

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil diupdate',
            'total' => Transactions::find($transactionId)->products()->count(),
        ]);

    }

    public function destroy(Request $request)
    {
        $jwt = $request->bearerToken();

        $decode = JWTAuth::decode(new Token($jwt));

        $transactionId = $decode->getClaims()['transactionId']->getValue();

        $data = DetailTransactions::where('transactionId', $transactionId)
            ->where('productId', $request->input('productId'))->first();

        if($request->input('quantity') == -1 && !$data){
            return response()->json([
                'status' => 'error',
                'message' => 'Barang tidak ada dalam keranjang'
            ], 422);
        }

        $dataprod = Products::find($request->input('productId'));

        $status = 'error';
        $message = "Produk gagal dihapus";

        if($data->quantity + $request->input('quantity') <= 0 ){
            DetailTransactions::where('transactionId', $transactionId)
                ->where('productId', $request->input('productId'))->delete();

            $status = 'success';
            $message = "$dataprod->productName berhasil dihapus";
        }

       $this->saveTransactions($request, $dataprod, $transactionId);

        return response()->json([
            'status' => $status,
            'message' => $message,
            'total' => Transactions::find($transactionId)->products()->count(),
        ]);
    }

    private function saveTransactions($request, $dataprod, $transactionId)
    {
        $dine = Transactions::find($transactionId);
        $dine->subtotal += ($request->input('quantity')) * $dataprod->productPrice;
        $dine->tax = $dine->subtotal * 0.1;
        $dine->totalPrice = $dine->subtotal + $dine->tax;
        $dine->save();

        return $dine;
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
