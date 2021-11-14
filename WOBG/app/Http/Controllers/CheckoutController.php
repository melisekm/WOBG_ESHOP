<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('checkout');
    }

    public function review()
    {
        return view('review');
    }

    public function completeOrder()
    {
        return view("order-done");
    }
}
