<?php

namespace App\Http\Controllers;

use App\Models\Cashiers;
use App\Models\Products;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CashiersController extends Controller
{
    public function login(): View{
        return view('cashier.loginCashier');
    }

    public function loginCheck(Request $request){

        $cashier = Cashiers::where('username', $request->input('username'))->first();

            if ($request->input('pass') == $cashier->password){
                $request->session()->put('token', $cashier->id);
                return redirect('/cashier/dashboard');
            } else {
                return redirect('/cashier/login');
            }


    }

    public function addCashier(Request $request){
        $cashier = new Cashiers();
        $cashier->cashierName = $request->input('cashierName');
        $cashier->cashierPhone = $request->input('cashierPhone');
        $cashier->username = $request->input('username');
        $cashier->password = $request->input('password');
        $cashier->save();
    }

    public function dashboard(Request $request){
        $cashier = Cashiers::find($request->session()->get('token'));

        $totalTransaction = Transactions::count();
        $totalProduct = Products::count();

        return view('cashier.dashboard', ['totalTransactions' => $totalTransaction, 'totalProducts' => $totalProduct]);
    }

    public function getProducts()
    {
        $product = Products::all();
        return view('cashier.productsCashier', ['products'=>$product]);
    }


    public function getTransactions(Request $request)
    {
        if ($request->old('transactionDate') == null || $request->old('transactionDate') == "") {
            $trx = Transactions::selectRaw("*,CONCAT('Rp.',FORMAT(totalPrice,0,'id_ID'),',-') as priceView")
                ->join('customers', 'customers.id', '=', 'transactions.customerId')->get();
            return view('cashier.transactionsCashier', ['transactions' => $trx]);
        } else {
            $data = $request->old('transactionDate');
            $dataArr = explode(',', $data);
            $trx = Transactions::selectRaw("*,CONCAT('Rp.',FORMAT(totalPrice,0,'id_ID'),',-') as priceView")->whereBetween('transactionDate', $dataArr)
                ->join('customers', 'customers.id', '=', 'transactions.customerId')->get();;
            return view('cashier.transactionsCashier', ['transactions' => $trx])->render();
        }
    }


    public function addProduct(Request $request){
        $product = new Products();
        $product->productName = $request->input('productName');
        $product->productCategory = $request->input('productCategory');
        $product->productPrice = $request->input('productPrice');
        $product->productStock = $request->input('productStock');
        $product->save();
        return redirect('/cashier/product/view');
    }

    public function deleteProduct($id){
        $product = Products::find($id);
        $product->delete();
        return redirect('/cashier/product/view');
    }

    public function updateProducts(Request $request, $id){
        $product = Products::find($id);

        $product->productPrice = $request->input('productPrice');
        $product->productStock = $request->input('productStock');

        $product->updaterId=$request->session()->get('token');
        $product->save();

        return redirect('/cashier/product/view');
    }

    public function getOneTransactionWithProduct($id){
        $trx = Transactions::selectRaw("CONCAT('Rp.',FORMAT(transactions.totalPrice,0,'id_ID'),',-') as priceView,
        CONCAT('Rp.',FORMAT(transactions.subtotal,0,'id_ID'),',-') as subtotalView,
        CONCAT('Rp.',FORMAT(transactions.tax,0,'id_ID'),',-') as taxView,
        transactions.*, customers.customerName")
            ->join('customers', 'customers.id', '=', 'transactions.customerId')->where('transactions.id', $id)->get();

        $details = Transactions::join('detailtransactions', 'transactions.id', '=', 'detailtransactions.transactionId')
            ->join('products', 'products.id', '=', 'detailtransactions.productId')
            ->selectRaw("CONCAT('Rp.',FORMAT(detailtransactions.quantityPrice,0,'id_ID'),',-') as priceView, detailtransactions.productId, products.productName, detailtransactions.quantity, detailtransactions.quantityPrice")
            ->where('transactions.id', $id)
            ->get();
        return view('cashier.detailTransactionsCashier', ['trx' => $trx, 'detail' => $details]);
    }

    public function updateStatusTransaction(Request $request, $id)
    {
        $status = Transactions::find($id);

        $status->status = $request->input('success');
        $status->updatedAt = Carbon::now()->setTimezone('Asia/Phnom_Penh');
        $status->cashierId = $request->session()->get('token');
        $status->save();

        return redirect('/cashier/transaction/view');
    }
}
