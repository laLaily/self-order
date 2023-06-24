<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
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
        $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")->get();

        return response()->json([
           'products' => $products
        ], 201);
    }

    public function create(Request $request)
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
        //return redirect('/cashier/product/view');
    }

    public function update($id, Request $request){
        $jwt = $_COOKIE['SI-CAFE'];
        $payload = JWTAuth::decode(new Token($jwt));
        $cashierId = $payload->getClaims()['id']->getValue();

        $product = Products::find($id);

        $product->productPrice = $request->input('productPrice');
        $product->productStock = $request->input('productStock');

        $product->updaterId=$cashierId;
        $product->save();

        //return
    }

    public function delete($id)
    {
        $product = Products::find($id);
        $product->delete();
//        return
    }
}
