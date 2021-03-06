<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function show()
    {
        $cart = Cart::getCart();
        if (!$cart) {
            return view('cart.cart');
        }
        ["products" => $products, "totalPrice" => $totalPrice] = Cart::getProducts($cart);
        return view('cart.cart', compact('products', 'totalPrice'));
    }

    function store(Product $product, $amount)
    {
        if ($amount < 1) {
            return response()->json(['error' => 'amount must be greater than 0']);
        }
        $cart = Cart::getCart();
        if (!$cart) {
            $cart = [];
        }
        $isProductInCart = array_key_exists($product->id, $cart);
        if ($isProductInCart) {
            $cart[$product->id]['quantity'] += $amount;
            Cart::saveCart("update", $product->id, $cart);
        } else {
            $cart[$product->id] = ['quantity' => $amount];
            Cart::saveCart("attach", $product->id, $cart, $amount);
        }
        return response()->json(['length' => count(session('cart'))]);
    }

    public function increment(Product $product)
    {
        $cart = Cart::getCart();
        $isProductInCart = array_key_exists($product->id, $cart);
        if ($isProductInCart) {
            $cart[$product->id]['quantity']++;
            Cart::saveCart("update", $product->id, $cart);
        }
        return back();
    }

    public function decrement(Product $product)
    {
        $cart = Cart::getCart();
        $isProductInCart = array_key_exists($product->id, $cart);
        $isAtleastTwiceInCart = $cart[$product->id]['quantity'] > 1;
        $canBeDecremented = $isProductInCart && $isAtleastTwiceInCart;
        if ($canBeDecremented) {
            $cart[$product->id]['quantity']--;
            Cart::saveCart("update", $product->id, $cart);
        }
        return back();
    }

    public function destroy(Product $product)
    {
        $cart = Cart::getCart();
        $isProductInCart = array_key_exists($product->id, $cart);
        if ($isProductInCart) {
            unset($cart[$product->id]);
            Cart::saveCart("detach", $product->id, $cart);
        }
        return back();
    }
}
