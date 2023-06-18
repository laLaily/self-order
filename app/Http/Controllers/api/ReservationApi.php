<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Transactions;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;
use Tymon\JWTAuth\JWTAuth;

//INI RENAME TRANSACTION CONTROLLER
class ReservationApi extends Controller
{
    public function register(): View {
        return view('order.registrationform');
    }

    public function create(Request $request)
    {
        $customer = Customers::create($request->only(['customerName', 'customerPhone']));

        $data = Customers::where('customerPhone', $customer->customerPhone)->first();

        $transaction = new Transactions();
        $transaction->customerId = $data->id;
        $transaction->save();

        $data2 = Transactions::where('customerId', $transaction->customerId)->orderBy('id', 'desc')->first();

        $token = auth('api-customer')->claims(['transaction'=> $data2->id])->login($customer);

//        return response()->json(auth()->user());

//        setcookie('X-SI-CAFE', $token);

        return response()->json([
            'status' => 'success',
            'message' => 'oke',
            'token' => $this->respondWithToken($token)
        ], 201);

//        return $this->respondWithToken($token);
    }



    public function me(): JsonResponse
    {
//        dd(auth());
//        $user = (new JWTAuth)->parseToken()->authenticate();
        $cookie = Cookie::get('X-SI-CAFE');

        dd($cookie);
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
