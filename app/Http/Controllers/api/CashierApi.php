<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Cashiers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CashierApi extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        $cashier = Cashiers::where('username', $request->input('username'))->first();

        if ($request->input('pass') == $cashier->password){
            $token = auth('api-cashier')
                ->claims(['cashierId'=> $cashier->id])
                ->login($cashier);

            return response()->json([
                'status' => 'success',
                'message' => 'oke',
                'token' => $this->respondWithToken($token)
            ], 201)
                ->withCookie(cookie('SI-CAFE', $token, '60', '/'));
        } else {
            abort(403);
        }
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => 60
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        return redirect()->route('cashier.login');
    }
}
