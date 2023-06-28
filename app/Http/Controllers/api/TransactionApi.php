<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DetailTransactions;
use App\Models\Products;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Token;

class TransactionApi extends Controller
{
        public function index(): JsonResponse
        {
            $trx = Transactions::selectRaw("*,CONCAT('Rp.',FORMAT(totalPrice,0,'id_ID'),',-') as priceView")
                ->join('customers', 'customers.id', '=', 'transactions.customerId')->get();
//            dump($trx);
            return response()->json([
                'transactions' => $trx
            ], 201);
        }
    public function cart(Request $request): View|string
    {
        return Blade::render('oke');
    }

    public function show($id)
    {
    }
    public function getTransactionWithCustomerName($id)
    {
        return Transactions::join('customers', 'customers.id', '=', 'transactions.customerId')
            ->selectRaw("CONCAT('Rp.',FORMAT(transactions.totalPrice,0,'id_ID'),',-') as totalPriceView,
            CONCAT('Rp.',FORMAT(transactions.subtotal,0,'id_ID'),',-') as subtotalView,
            CONCAT('Rp.',FORMAT(transactions.tax,0,'id_ID'),',-') as taxView,
            transactions.*, customers.customerName")
            ->where('transactions.id', $id)
            ->get();
    }

    public function getProductTransactionWithProduct($id)
    {
        return Transactions::join('detailtransactions', 'detailtransactions.transactionId', '=', 'transactions.id')
            ->join('products', 'products.id', '=', 'detailtransactions.productId')
            ->selectRaw("CONCAT('Rp.',FORMAT(detailtransactions.quantityPrice,0,'id_ID'),',-') as priceView, detailtransactions.productId, products.productName, detailtransactions.quantity, detailtransactions.quantityPrice")
            ->where('transactions.id', $id)
            ->get();
    }

    public function submitCart(Request $request)
    {
        $jwt = $_COOKIE['SI-CAFE'];
        $payload = JWTAuth::decode(new Token($jwt));
        $id = $payload->getClaims()['transaction']->getValue();

        $data = $this->getProductTransactionWithProduct($id);

        $paymentCode = Str::uuid();

        $transaction = Transactions::findOrFail(session('session_token'));

        $transaction->update(['paymentCode' => $paymentCode]);

        //        if (sizeof($data) != 0) {
        //            if ($request->session()->has('res_token')) {
        //                $request->session()->forget('res_token');
        //            }
        //            $request->session()->forget('session_token');
        //            return redirect('/dinein/order/success')
        //                ->with(['paymentCode' => $paymentCode]);
        //        } else {
        //            return redirect('/dinein/order/products');
        //        }
    }

    public function update($id, Request $request)
    {
        $status = Transactions::find($id);

        $status->status = $request->input('success');
        $status->updatedAt = Carbon::now()->setTimezone('Asia/Phnom_Penh');
        $status->cashierId = 12;
        $status->save();

        //        return redirect('/cashier/transaction/view');
    }
}
