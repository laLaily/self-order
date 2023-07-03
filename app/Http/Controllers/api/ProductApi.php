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
        $jwt = $_COOKIE['SI-CAFE'];
        $payload = JWTAuth::decode(new Token($jwt));
        $role = $payload->getClaims()['role']->getValue();
//        dump($role);
//        $jwt = $request->bearerToken();
//
//        if(!$jwt){
//            return response()->json([
//                'status' => 'error',
//                'message' => 'Silahkan refresh ulang'
//            ], 422);
//        }
//
//        $decode = JWTAuth::decode(new Token($jwt));

        if($role == 'cashier'){
            $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
                ->orderBy('id')->get();
            return response()->json([
                'products' => $products
            ], 201);
        } else {

//            $transactionId = $decode->getClaims()['transactionId']->getValue();
            $transactionId = $payload->getClaims()['transactionId']->getValue();
            $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
                ->orderBy('id')->get();

            $detailTransaction = DetailTransactions::where('transactionId', $transactionId)
                ->orderBy('productId')->get();

            $ctr = 0;
            foreach ($products as $product) {
                if ($ctr < sizeof($detailTransaction) && $product->id == $detailTransaction[$ctr]->productId) {
                    $product->total = $detailTransaction[$ctr]->quantity;
                    $ctr++;
                }
            }

            return response()->json([
                'products' => $products
            ], 201);
        }
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

    public function destroy($id)
    {
        $product = Products::where('id', $id);
        $product->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'oke',
        ], 201);
    }
}
