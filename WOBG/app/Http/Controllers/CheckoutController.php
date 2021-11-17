<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
        $user = auth()->check() ? auth()->user() : new User();
        return view('checkout', compact('products', 'totalPrice', 'user'));
    }

    private function validateCheckout(Request $request)
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

        $save_address = $request->input('save_address');

        ["products" => $products, "totalPrice" => $subtotal] = Cart::getProducts($cart);
        $totalPrice = $subtotal + $shippingPrice;
        $price = [
            'subtotal' => $subtotal,
            'total' => $totalPrice
        ];
        $shipping = [
            'name' => $shippingName,
            'price' => $shippingPrice,
        ];

        $user = new User($user_data);
        session(["orderData" => compact('user', 'products', 'price', 'shipping', 'payment', 'save_address')]);
        return compact('user', 'products', 'price', 'shipping', 'payment', 'save_address');
    }


    public function review(Request $request)
    {
        return view('review', $this->validateCheckout($request));
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

    private function copyOrderUserData(Model $obj, $orderUser)
    {
        $obj->first_name = $orderUser->first_name;
        $obj->surname = $orderUser->surname;
        $obj->street = $orderUser->street;
        $obj->city = $orderUser->city;
        $obj->country = $orderUser->country;
        $obj->phone_number = $orderUser->phone_number;
        $obj->postal_code = $orderUser->postal_code;
    }

    public function completeOrder()
    {
        $orderData = session('orderData');
        if (!$orderData) {
            return redirect("cart");
        }
        Log::info($orderData);
        if (!empty($orderData["save_address"])) {
            $user = auth()->user();
            $this->copyOrderUserData($user, $orderData["user"]);
            $user->save();
        }
        $order = new Order();
        $order->payment = $orderData["payment"];
        $order->shipping = $orderData["shipping"]["name"];
        $order->total = $orderData["price"]["total"];
        if (auth()->check()) {
            $order->user_id = auth()->user()->id;
        }
        $this->copyOrderUserData($order, $orderData["user"]);
        $order->email = $orderData["user"]->email;
        $order->save();
        foreach ($orderData->products as $product) {
            $order->products()->attach($product->id, ['quantity' => $product->pivot->quantity, "price" => $product->price]);
        }
        return view("order-done");
    }
}
