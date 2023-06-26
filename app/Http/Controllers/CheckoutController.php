<?php

namespace App\Http\Controllers;

use App\Models\DetailTransactions;
use App\Models\Transactions;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        return view('order.checkout');
    }
}
