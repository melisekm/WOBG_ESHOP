<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Cart::getCart();
        if (!$cart) {
            return redirect('cart');
        }
        ["products" => $products, "totalPrice" => $totalPrice] = Cart::getProducts($cart);

        return view('checkout', compact('products', 'totalPrice'));
    }

    public function getShipping(int $shipping, Request $request)
    {
        Log::info('Shipping: ' . $shipping);
        $cart = $request->input('cart');
        Log::info('Cart: ' . $cart);
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
