<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Transactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;

//INI RENAME TRANSACTION CONTROLLER
class ReservationApi extends Controller
{
    public function register(): View {
        return view('order.registrationform');
    }

    public function create(Request $request): JsonResponse
    {
        $customer = Customers::firstOrCreate($request->only(['customerName', 'customerPhone']));

        $data = $customer;

        $transaction = new Transactions();
        $transaction->customerId = $data->id;
        $transaction->save();

        $data2 = Transactions::where('customerId', $transaction->customerId)->orderBy('id', 'desc')->first();

        $token = auth('api-customer')
            ->claims(['transactionId'=> $data2->id])
            ->login($customer);


        return response()->json([
            'status' => 'success',
            'message' => 'oke',
            'token' => $this->respondWithToken($token)
        ], 201)
            ->withCookie(cookie('SI-CAFE', $token, '60', '/'));
    }



    public function me(Request $request): JsonResponse
    {
        $jwt = $request->bearerToken();
//        $valid = JWTAuth::setToken($jwt)->check();

        return response()->json([
            'status' => $jwt
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60
        ]);
    }
}
