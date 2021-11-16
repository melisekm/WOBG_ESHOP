<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function show()
    {
        $cart = Cart::getCart();
        if (!$cart) {
            return view('cart');
        }
        ["products" => $products, "totalPrice" => $totalPrice] = Cart::getProducts($cart);
        return view('cart', compact('products', 'totalPrice'));
    }

    function store(Product $product)
    {
        $cart = Cart::getCart();
        if (!$cart) {
            $cart = [];
        }

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            Cart::saveCart("update", $product->id, $cart);
        } else {
            $cart[$product->id] = ['quantity' => 1];
            Cart::saveCart("attach", $product->id, $cart);
        }
        return response()->json(['length' => count(session('cart'))]);
    }

    public function increment(Product $product)
    {
        $cart = Cart::getCart();

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            Cart::saveCart("update", $product->id, $cart);
        }
        return back();
    }

    public function decrement(Product $product)
    {
        $cart = Cart::getCart();

        if (array_key_exists($product->id, $cart) && $cart[$product->id]['quantity'] > 1) {
            $cart[$product->id]['quantity']--;
            Cart::saveCart("update", $product->id, $cart);
        }
        return back();
    }

    public function destroy(Product $product)
    {
        $cart = Cart::getCart();

        if (array_key_exists($product->id, $cart)) {
            unset($cart[$product->id]);
            Cart::saveCart("detach", $product->id, $cart);
        }
        return back();
    }
}
