<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactions;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutApi extends Controller
{
    public function show(int $transactionId)
    {
        $detail = Transactions::with('detail')
            ->with('detail.products')
            ->where('id', $transactionId)->first();

        foreach ($detail->detail as $item){
            $item->total = $item->quantity * $item->quantityPrice;
        }

        return response()->json([
            'detail' => $detail,
        ]);
    }

    public function store(Request $request, int $transactionId)
    {
        if(!$request->bearerToken()){
            return response()->json([
                'status' => 'error',
                'message' => 'Silahkan refresh halaman'
            ], 403);
        }

        $paymentCode = Str::uuid();

        $transaction = Transactions::withCount('detail')->find($transactionId);

        if($transaction->detail_count <= 0 ) {
            return response()->json([
                'status' => 'error',
                'message' => 'Checkout gagal, pilih menu terlebih dahulu'
            ], 422);
        }

        $transaction->update([
            'paymentCode' => $paymentCode,
        ]);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
