<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Shipping;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
        $payments = Payment::all();
        $shippings = Shipping::all();
        return view('cart.checkout', compact('products', 'totalPrice', 'user', 'payments', 'shippings'));
    }

    private function getCartData($shipping, $cart)
    {
        ["products" => $products, "totalPrice" => $subtotal] = Cart::getProducts($cart);
        $totalPrice = $subtotal + $shipping->price;
        $price = [
            'subtotal' => $subtotal,
            'total' => $totalPrice
        ];
        return compact('products', 'price');
    }


    public function review(Request $request)
    {
        $cart = Cart::getCart();
        if (!$cart) {
            return redirect('cart');
        }
        // ak nie je prihlaseny v tomto kroku zvalidujeme aj mail
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
            'phone_number' => 'required|max:255|starts_with:+|regex:/^\+[0-9]*$/',
            'postal_code' => 'required|max:255',
            'paymentGroup' => ['required', 'in:Paypal,Bank Transfer,Card'],
            'shippingGroup' => ['required', 'in:Standard Delivery,UPS Service,Parcel Service'],
        ]);

        $payment = Payment::where("name", $request->paymentGroup)->first();
        $shipping = Shipping::where("name", $request->shippingGroup)->first();

        ["products" => $products, "price" => $price] = $this->getCartData($shipping, $cart);
        $save_address = $request->save_address;


        $user = new User($user_data);

        // aby sa lahsie dalo preposlat do dalsieho view data ulozime ich do session
        // ide najma o usera - kto to teda vytvara ten order, podla mna nejde o security risk,
        // lebo ajtak moze vyplnit niekoho ineho udaje
        session(["orderData" => compact('user', 'payment', 'shipping', 'save_address')]);
        return view('cart.review',
            compact('user', 'products', 'price', 'shipping', 'payment', 'save_address'));
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
        // musel prejst cez krok review na to aby mal sessione na servery orderData
        $orderData = session('orderData');
        if (!$orderData) {
            return redirect("cart");
        }
        // zvolil ze si chce ulozit adresu
        if (!empty($orderData["save_address"])) {
            $user = auth()->user();
            $this->copyOrderUserData($user, $orderData["user"]);
            $user->save();
        }

        $order = new Order();
        $payment = Payment::find($orderData["payment"]->id);
        $order->payment()->associate($payment);
        $shipping = Shipping::find($orderData["shipping"]->id);
        $order->shipping()->associate($shipping);

        $cart = Cart::getCart();
        if (!$cart) {
            return redirect('cart');
        }
        // v kazdom kroku vyberame itemy z databazy, aby si tam nemohol nieco sam napisat
        ["products" => $products, "price" => $price] = $this->getCartData($shipping, $cart);

        $order->total = $price["total"];
        if (auth()->check()) {
            $order->user_id = auth()->user()->id;
        }
        // aj do orderu nakopirujeme data pouzivatela, ktory vytvoril order
        $this->copyOrderUserData($order, $orderData["user"]);
        $order->email = $orderData["user"]->email;

        $order->save();
        // naplnime medzivezbovu tabulku
        // quantita je ulozena v carte ktory je z db, pristupime k nej cez id produktu
        foreach ($products as $product) {
            $quantity = $cart[$product->id]["quantity"];
            if($quantity < 1){
                abort(422);
            }
            $order->products()->attach($product->id, ["quantity" => $quantity, "price" => $product->price]);
        }
        Cart::clearCart();
        session()->forget("orderData");
        return view("cart.order-done");
    }
}
