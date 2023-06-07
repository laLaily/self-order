<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\DetailTransactions;
use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    public function createTransaction(Request $request){
        $customer = new Customers();
        $customer->customerName = $request->input('customerName');
        $customer->customerPhone = $request->input('customerPhone');
        $customer->save();

        $data = Customers::where('customerPhone', $customer->customerPhone)->first();

        $transaction = new Transactions();
        $transaction->customerId = $data->id;
        $transaction->save();

        $data2 = Transactions::where('customerId', $transaction->customerId)->orderBy('id', 'desc')->first();

        if ($data2 != NULL) {
            $request->session()->put('session_token', $data2->id);
            return redirect('/dinein/order/products');
        } else {
            return redirect('/dinein/registrartion');
        }
    }

    public function cart(Request $request): View
    {
        $transactions = $this->getTransactionWithCustomerName($request->session()->get('session_token'));
        $carts = $this->getProductTransactionWithProduct($request->session()->get('session_token'));
        $products = null;


        $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")->get();

        if($request->has('filter')){
            $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
                ->where('productCategory', $request->input('filter'))->get();
        }
//            if ($request->old('filter') == 'food') {
//                $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
//                    ->where('productCategory', 'food')->get();
//            } else if ($request->old('filter') == 'beverage') {
//                $products = Products::selectRaw("*, CONCAT('Rp.',FORMAT(productPrice,0,'id_ID'),',-') as priceView")
//                    ->where('productCategory', 'beverage')->get();
//            }

        $totalProductCart = DetailTransactions::where('transactionid', $request->session()->get('session_token'))->sum('quantity');

        return view('order.order', ['products' => $products, 'transactions' => $transactions, 'carts' => $carts, 'totalProduct' => $totalProductCart]);
    }

    public function getTransactionWithCustomerName($id){
        return Transactions::join('customers', 'customers.id', '=', 'transactions.customerId')
            ->selectRaw("CONCAT('Rp.',FORMAT(transactions.totalPrice,0,'id_ID'),',-') as totalPriceView,
            CONCAT('Rp.',FORMAT(transactions.subtotal,0,'id_ID'),',-') as subtotalView,
            CONCAT('Rp.',FORMAT(transactions.tax,0,'id_ID'),',-') as taxView,
            transactions.*, customers.customerName")
            ->where('transactions.id', $id)
            ->get();
    }

    public function getProductTransactionWithProduct($id){
        return Transactions::join('detailtransactions', 'detailtransactions.transactionId', '=', 'transactions.id')
            ->join('products', 'products.id', '=', 'detailtransactions.productId')
            ->selectRaw("CONCAT('Rp.',FORMAT(detailtransactions.quantityPrice,0,'id_ID'),',-') as priceView, detailtransactions.productId, products.productName, detailtransactions.quantity, detailtransactions.quantityPrice")
            ->where('transactions.id', $id)
            ->get();
    }

    public function filterByCategory(){
        return redirect('/dinein/order/products')->withInput();
    }

    public function createDetailTransaction(Request $request){
        $data = DetailTransactions::where('transactionId', $request->session()->get('session_token'))->where('productId', $request->input('productId'))->first();
        $dataprod = Products::find($request->input('productId'));

        if ($data == NULL) {
            $det = new DetailTransactions();
            $det->transactionId = $request->session()->get('session_token');
            $det->productId = $request->input('productId');
            $det->quantity = $request->input('quantity');
            $det->quantityPrice = ($request->input('quantity') * $dataprod->productPrice);
            $det->save();
        } else {
            DetailTransactions::where('transactionId', $request->session()->get('session_token'))->where('productId', $request->input('productId'))
                ->update(['quantity' => ($data->quantity + $request->input('quantity')),
                    'quantityPrice' => ($data->quantityPrice + ($request->input('quantity') * $dataprod->productPrice))
                ]);
        }
        $dine = Transactions::find($request->session()->get('session_token'));
        $dine->subtotal += ($request->input('quantity')) * $dataprod->productPrice;
        $dine->tax = $dine->subtotal * 0.1;
        $dine->totalPrice = $dine->subtotal + $dine->tax;
        $dine->save();
        return redirect('/dinein/order/products');
    }

    public function deleteProduct(Request $request){
        $data = DetailTransactions::where('transactionId', $request->session()->get('session_token'))->where('productId', $request->input('productId'))->first();

        $dine = Transactions::find($request->session()->get('session_token'));
        $dine->totalPrice -= $data->quantityPrice;
        $dine->save();

        DetailTransactions::where('transactionId', $request->session()->get('session_token'))->where('productId', $request->input('productId'))->delete();

        return redirect('/dinein/order/products');
    }

    public function submitCart(Request $request)
    {
        $data = $this->getProductTransactionWithProduct($request->session()->get('session_token'));

        $paymentCode = Str::uuid();

        $transaction = Transactions::findOrFail(session('session_token'));

        $transaction->update(['paymentCode' => $paymentCode]);

        if (sizeof($data) != 0) {
            if ($request->session()->has('res_token')) {
                $request->session()->forget('res_token');
            }
            $request->session()->forget('session_token');
            return redirect('/dinein/order/success')
                ->with(['paymentCode' => $paymentCode]);
        } else {
            return redirect('/dinein/order/products');
        }
    }
}
