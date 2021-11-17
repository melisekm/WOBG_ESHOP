<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    public function getCart()
    {
        if (auth()->check()) {
            $cart = auth()->user()->getProductsInCartWithQuantity();
            session(['cart' => $cart]);
        } else {
            $cart = session('cart');
        }
        return $cart;
    }

    public function saveCart(string $action, $productId, $cart)
    {
        if (auth()->check()) {
            $user = auth()->user();
            switch ($action) {
                case "attach":
                    $user->products()->attach($productId, ['quantity' => 1]);
                    break;
                case 'update':
                    $user->products()->updateExistingPivot($productId, ['quantity' => $cart[$productId]['quantity']]);
                    break;
                case 'detach':
                    $user->products()->detach($productId);
                    break;
            }
        }
        session(['cart' => $cart]);
    }


    public function loadCartOnLogin()
    {
        $user = auth()->user();
        $existingCart = $user->getProductsInCartWithQuantity();
        if (count($existingCart) > 0) {
            $cart = $existingCart;
        } else {
            $cart = session()->get('cart', []);
            foreach ($cart as $productId => $details) {
                $user->products()->attach($productId, ['quantity' => $details["quantity"]]);
            }
        }
        // copy the old session data into a new session entry
        session()->regenerate();
        session()->put('cart', $cart);
    }

    public function getCartCount()
    {
        if (auth()->check()) {
            return auth()->user()->products()->count();
        }
        if (session()->has('cart')) {
            return count(session()->get('cart'));
        }
        return 0;
    }

    public function getProducts($cart)
    {
        $products = Product::with("mainPhotos")->findMany(array_keys($cart), ['id', 'name', 'price']);
        $totalPrice = 0;
        foreach ($products as $product) {
            $product->quantity = $cart[$product->id]["quantity"];
            $product->total_price = $product->price * $product->quantity;
            $totalPrice += $product->total_price;
        }
        return [
            "products" => $products,
            "totalPrice" => $totalPrice
        ];
    }
}
