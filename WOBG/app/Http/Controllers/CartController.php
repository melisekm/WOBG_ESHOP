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
        $products = session('cart');
        // if cart is empty add message to cart view
//        if (empty($products)) {
//            return view('cart', ['message' => 'Your cart is empty']);
//        }
//        Log::info($products);
        Log::info(session()->all());
        return view('cart', ['products' => $products]);
    }

    function store(Product $product)
    {
        // get products in session from key 'cart'
        $cart = session('cart');
        // if cart doesn't exist create new array
        if (!$cart) {
            $cart = [];
        }

        // check if product is in cart
        if (array_key_exists($product->id, $cart)) {
            // if product is in cart increase quantity
            $cart[$product->id]['quantity']++;
            // check if user is logged in and increase quantity of user products in pivot table product_user
            if (auth()->check()) {
                auth()->user()->products()->updateExistingPivot($product->id, ['quantity' => $cart[$product->id]['quantity']]);
            }
        } else {
            // if product is not in cart add it to cart
            $cart[$product->id] = [
                'quantity' => 1
            ];
            // check if user is logged in and create new pivot in table product_user
            if (auth()->check()) {
                auth()->user()->products()->attach($product->id, ['quantity' => 1]);
            }
        }
        // save cart in session
        session(['cart' => $cart]);
        return response()->json(['length' => count($cart)]);
    }


    function update(Product $product, Request $request)
    {
        // check if quanity from request is less than one
        $quantity = $request->input('quantity');
        if ($quantity < 1) {
            return abort(422);
        }
        // update product quantity in cart
        $cart = session('cart');
        if (!$cart) {
            return abort(422);
        }

        if (array_key_exists($product->id, $cart)) {
            // if product is in cart increase quantity
            $cart[$product->id]['quantity'] = $quantity;
            // check if user is logged in and increase quantity of user products in pivot table product_user
            if (auth()->check()) {
                auth()->user()->products()->updateExistingPivot($product->id, ['quantity' => $cart[$product->id]['quantity']]);
            }
        } else {
            return abort(422);
        }
        return back();
    }

}
