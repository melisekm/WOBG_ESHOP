<?php /** @noinspection PhpUnused */

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    // naplni kosik z databazy alebo z sessionu
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

    // ak je pouzivatel prihlaseny na zaklade akcie prida novy item, updatne, alebo vymaze
    // ulozi vysledok do session
    public function saveCart(string $action, $productId, $cart, $amount = 1)
    {
        if (auth()->check()) {
            $user = auth()->user();
            switch ($action) {
                case "attach":
                    $user->products()->attach($productId, ['quantity' => $amount]);
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

    // po prihlaseni alebo registracii, nacita do kosika produkty
    // ak sa prihlasil a nemal produkty v kosiku, nakopiruje do sessonu cart z DB(ak tam nejaky bol)
    // ak mal pred prihlasenim mal produkty v kosiku, tak ich mergne s tymi co mal v DB
    public function loadCartOnLogin()
    {
        $user = auth()->user();
        $existingCart = $user->getProductsInCartWithQuantity();
        $cart = session()->get('cart', []);
        if (count($existingCart) > 0) {
            // merge existingCart from DB with cart from session
            foreach ($cart as $productId => $details) {
                if(!array_key_exists($productId, $existingCart)) {
                    $user->products()->attach($productId, ['quantity' => $details['quantity']]);
                } else {
                    $user->products()->updateExistingPivot($productId, ['quantity' => $details['quantity']]);
                }
            }
            $cart = array_merge($existingCart, $cart);
        } else {
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

    // na zaklade nacitaneho kosika vytiahne z DB konkretne produkty
    // vrati ku kazdemu objektu quantity z kosika a vyslednu cenu (item_cena * quantity)
    // taktiez spocita celkovu cenu vsetkych produktov v kosiku
    public function getProducts($cart): array
    {
        $products = Product::with("mainPhoto")->findMany(array_keys($cart), ['id', 'name', 'price']);
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

    public function clearCart()
    {
        session()->forget('cart');
        if (auth()->check()) {
            auth()->user()->products()->detach();
        }
    }
}
