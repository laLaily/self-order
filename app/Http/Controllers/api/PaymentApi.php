<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Transactions;
use Illuminate\Http\Request;

class PaymentApi extends Controller
{
    public function show(Request $request, $checkoutId)
    {
        $jwt = $request->bearerToken();

        if(!$jwt){
            return response()->json([
                'status' => 'error',
                'message' => 'Silahkan refresh ulang'
            ], 403);
        }

        $code = Transactions::find($checkoutId)->paymentCode;

        return response()->json([
            'status' => 'success',
            'message' => 'Silahkan ke kasir untuk melakukan pembayaran',
            'paymentCode' => $code
        ])->withoutCookie('SI-CAFE');
    }

}
