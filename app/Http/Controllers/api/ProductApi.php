<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactions;
use App\Models\Products;
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

        $transactionId = $decode->getClaims()['transactionId']->getValue();

        $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
            ->orderBy('id')->get();

        $detailTransaction = DetailTransactions::where('transactionId', $transactionId)
            ->orderBy('productId')->get();

        $ctr = 0;
        foreach ($products as $product){
            if($ctr < sizeof($detailTransaction) && $product->id == $detailTransaction[$ctr]->productId){
                $product->total = $detailTransaction[$ctr]->quantity;
                $ctr++;
            }
        }

        return response()->json([
           'products' => $products
        ], 201);
    }
}
