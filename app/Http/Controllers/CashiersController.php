<?php

namespace App\Http\Controllers;

use App\Models\Cashiers;
use App\Models\Product;
use App\Models\Products;
use App\Models\Transactions;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CashiersController extends Controller
{
    public function login(): View{
        return view('cashier.loginCashier');
    }

    public function loginCheck(Request $request){

        $cashier = Cashiers::where('username', $request->input('username'))->first();
        if ($request->input('password') == $cashier->password){
            $request->session()->put('token', $cashier->id);
            return redirect('cashier/dashboard');
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

    public function getTransactions()
    {
        $trx = Transactions::all();
        return view('cashier.transactionsCashier', ['transactions'=>$trx]);
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
}
