<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductApi extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")->get();

        return response()->json([
           'products' => $products
        ], 201);
    }
}
