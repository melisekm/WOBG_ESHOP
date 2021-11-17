<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\User;
use Illuminate\Http\Request;


class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = Cart::getCart();
        if (!$cart) {
            return redirect('cart');
        }
        ["products" => $products, "totalPrice" => $totalPrice] = Cart::getProducts($cart);
        $user = auth()->check() ? auth()->user() : new User();
        return view('checkout', compact('products', 'totalPrice', 'user'));
    }


    public function review(Request $request)
    {
        if (!auth()->check()) {
            $request->validate([
                'email' => 'required|email|max:255',
            ]);
            $user_data = $request->all();
        } else {
            $user_data = array_merge($request->all(), ['email' => auth()->user()->email]);
        }
        $request->validate([
            'first_name' => 'required|max:255',
            'surname' => 'required|max:255',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'postal_code' => 'required|max:255',
            'paymentGroup' => ['required', 'in:Paypal,Bank Transfer,Card'],
            'shippingGroup' => ['required', 'in:Standard Delivery,UPS Service,Parcel Service'],
        ]);
        $cart = Cart::getCart();
        if (!$cart) {
            return redirect('cart');
        }
        $payment = $request->input('paymentGroup');
        $shippingName = $request->input('shippingGroup');
        $shippingPrice = $this->getShipping($shippingName);

        ["products" => $products, "totalPrice" => $subtotal] = Cart::getProducts($cart);
        $totalPrice = $subtotal + $shippingPrice;

        $user = new User($user_data);
        return view('review',
            compact('products', 'totalPrice',
                'payment', 'shippingName', 'shippingPrice', 'subtotal', 'user'));
    }

    private function getShipping($shipping)
    {
        switch ($shipping) {
            case 'Standard Delivery':
                return 2.99;
            case 'UPS Service':
                return 5.49;
            case 'Parcel Service':
                return 4.99;
        }
        return abort(422);
    }

    public function completeOrder()
    {
        $cart = Cart::getCart();
        if (!$cart) {
            return redirect('cart');
        }
        return view("order-done");
    }
}
