<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Landing Page
Route::get('/', [LandingController::class, 'index']);

//Cart
Route::get('/cart', [CartController::class, 'show'])
    ->name('cart.show');
Route::post('cart/{product}/{amount}', [CartController::class, 'store'])
    ->name('cart.store');
Route::delete('cart/{product}', [CartController::class, 'destroy'])
    ->name('cart.destroy');
Route::patch('cart/{product}/increment', [CartController::class, 'increment'])
    ->name('cart.increment');
Route::patch('cart/{product}/decrement', [CartController::class, 'decrement'])
    ->name('cart.decrement');

//Review and Checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])
    ->name('checkout.checkout');
Route::post('/review', [CheckoutController::class, 'review'])
    ->name('checkout.review');
Route::get('/order-completed', [CheckoutController::class, 'completeOrder'])
    ->name('checkout.complete');

Route::get("/review", function () {
    return view('cart.cart');
});

// Admin routes
Route::get("/admin", [AdminController::class, 'index'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('admin.index');

Route::get("/admin/products", [AdminController::class, 'products'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('admin.products');

Route::get("/admin/orders", [AdminController::class, 'orders'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('admin.orders');

Route::get("/admin/users", [AdminController::class, 'users'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('admin.users');

Route::get("/admin/categories", [AdminController::class, 'categories'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('admin.categories');

Route::get("/admin/subcategories", [AdminController::class, 'subcategories'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('admin.subcategories');


// Products
Route::get('/products', [ProductController::class, 'index'])
    ->name("products.index");
Route::get('/products/create', [ProductController::class, 'create'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('products.create');

Route::post('/products', [ProductController::class, 'store'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('products.store');

Route::get('/products/{product}', [ProductController::class, 'show'])
    ->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('products.edit');
Route::patch('/products/{product}', [ProductController::class, 'update'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])
    ->middleware(['auth', 'can:viewAdmin,App\Models\Product'])
    ->name('products.destroy');

//Profile
Route::get('/profile', [UserController::class, 'index'])
    ->middleware(['auth'])
    ->name('profile');
Route::post('/updateEmailAndPhone', [UserController::class, 'updateEmailAndPhone'])
    ->middleware(['auth'])
    ->name('profile.update');
Route::post('/updateAddress', [UserController::class, 'updateAddress'])
    ->middleware(['auth'])
    ->name('address.update');

// Footer
Route::get("/about", function () {
    return view('footer_links.about_us');
});
Route::get("/contacts", function () {
    return view('footer_links.contacts');
});
Route::get("/delivery-shipping", function () {
    return view('footer_links.delivery_shipping');
});
Route::get("/faq", function () {
    return view('footer_links.faq');
});
Route::get("/how-to-shop", function () {
    return view('footer_links.how_to_shop');
});
Route::get("/privacy-policy", function () {
    return view('footer_links.privacy_policy');
});

require __DIR__ . '/auth.php';
