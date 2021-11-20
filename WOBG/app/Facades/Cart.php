<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static getCart()
 * @method static getCartCount()
 * @method static getProducts($cart)
 * @method static loadCartOnLogin()
 * @method static saveCart(string $string, mixed $id, $cart, $amount = 1)
 * @method static clearCart()
 */
class Cart extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'cart';
    }

}
