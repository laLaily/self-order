<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactions;
use App\Models\Products;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class ProductApi extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $jwt = $request->bearerToken();

        if(!$jwt){
            return response()->json([
                'status' => 'error',
                'message' => 'Silahkan refresh ulang'
            ], 422);
        }

        $decode = JWTAuth::decode(new Token($jwt));


        if (isset($decode->getClaims()['cashierId'])){
            $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
                ->orderBy('id')->get();
            return response()->json([
                'products' => $products
            ], 201);
        }

        $transactionId = $decode->getClaims()['transactionId']->getValue();

        if($request->has('filter') && $request->input('filter') != 'all'){
            $products = Products::where('productCategory', $request->input('filter'))
                ->get();
        }else{
            $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
                ->orderBy('id')->get();
        }

        $detailTransaction = DetailTransactions::where('transactionId', $transactionId)
            ->orderBy('productId')->get();

        $ctr = 0;
        foreach ($products as $product){
            $item = $detailTransaction->where('productId', $product->id)->first() ?? null;
            if($item){
                $product->total = $item->quantity;
            }
//            if($ctr < sizeof($detailTransaction) && $product->id == $detailTransaction[$ctr]->productId){
//                $product->total = $detailTransaction[$ctr]->quantity;
//                $ctr++;
//            }
        }

        return response()->json([
            'products' => $products
        ], 201);
    }



    public function create(Request $request): JsonResponse
    {
        $product = new Products();
        $product->productName = $request->input('productName');
        $product->productCategory = $request->input('productCategory');
        $product->productPrice = $request->input('productPrice');
        $product->productStock = $request->input('productStock');
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'oke',
        ], 201);
    }

    public function update($id, Request $request): JsonResponse
    {

        $jwt = $_COOKIE['SI-CAFE'];
        $payload = JWTAuth::decode(new Token($jwt));
        $cashier = $payload->getClaims()['cashierId']->getValue();

        $product = Products::where('id', $id)->first();
        $product->productPrice = $request->input('productPrice');
        $product->productStock = $request->input('productStock');
        $product->updatedAt = Carbon::now()->setTimezone('Asia/Phnom_Penh');
        $product->updaterId = $cashier;
        $product->save();

        return response()->json([
            'status' => 'success',
            'message' => 'oke',
        ], 201);
    }

    public function destroy($id): JsonResponse
    {
        $product = Products::where('id', $id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'oke',
        ], 201);
    }

    public function show($id): JsonResponse
    {
        $product = Products::find($id);
        return response()->json([
            'productData' => $product
        ], 201);
    }
}
