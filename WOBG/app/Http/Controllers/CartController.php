<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function show()
    {
        // get products in session from key 'cart'
        $productsId2Quantity = session('cart');
        if(!$productsId2Quantity) {
            return view('cart');
        }
        $products = Product::with("mainPhotos")->findMany(array_keys($productsId2Quantity), ['id', 'name', 'price']);
        $totalPrice = 0;
        foreach ($products as $product) {
            $product->quantity = $productsId2Quantity[$product->id]["quantity"];
            $product->total_price = $product->price * $product->quantity;
            $totalPrice += $product->total_price;
        }
        return view('cart', compact('products', 'totalPrice'));
    }

    function store(Product $product)
    {
        $cart = session('cart');
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
        return response()->json(['length' => count($cart)]);
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
        $cart = session('cart');
        if (!$cart) {
            return abort(422);
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


}
