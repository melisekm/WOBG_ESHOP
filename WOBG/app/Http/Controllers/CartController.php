<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function show()
    {
        $cart = $this->getCart();
        if (!$cart) {
            return view('cart');
        }
        $products = Product::with("mainPhotos")->findMany(array_keys($cart), ['id', 'name', 'price']);
        $totalPrice = 0;
        foreach ($products as $product) {
            $product->quantity = $cart[$product->id]["quantity"];
            $product->total_price = $product->price * $product->quantity;
            $totalPrice += $product->total_price;
        }
        return view('cart', compact('products', 'totalPrice'));
    }

    function store(Product $product)
    {
        $cart = $this->getCart();
        if (!$cart) {
            $cart = [];
        }

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            $this->saveCart("update", $product->id, $cart);
        } else {
            $cart[$product->id] = ['quantity' => 1];
            $this->saveCart("attach", $product->id, $cart);
        }
        return response()->json(['length' => count(session('cart'))]);
    }

    public function increment(Product $product)
    {
        $cart = $this->getCart();

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id]['quantity']++;
            $this->saveCart("update", $product->id, $cart);
        }
        return back();
    }

    public function decrement(Product $product)
    {
        $cart = $this->getCart();

        if (array_key_exists($product->id, $cart) && $cart[$product->id]['quantity'] > 1) {
            $cart[$product->id]['quantity']--;
            $this->saveCart("update", $product->id, $cart);
        }
        return back();
    }

    public function destroy(Product $product)
    {
        $cart = $this->getCart();

        if (array_key_exists($product->id, $cart)) {
            unset($cart[$product->id]);
            $this->saveCart("detach", $product->id, $cart);
        }
        return back();
    }

    private function getCart()
    {
        if (auth()->check()) {
            $cart = auth()->user()->getProductsInCartWithQuantity();
            session(['cart' => $cart]);
        } else {
            $cart = session('cart');
        }
        return $cart;
    }

    private function saveCart(string $action, $productId, $cart)
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

    public static function loadCartOnLogin()
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

    public static function getCartCount()
    {
        if (auth()->check()) {
            return auth()->user()->products()->count();
        }
        if (session()->has('cart')) {
            return count(session()->get('cart'));
        }
        return 0;
    }
}
