<?php

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

Route::get('/', [LandingController::class, 'index']);


Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('cart/{product}', [CartController::class, 'store'])->name('cart.store');
Route::delete('cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::patch('cart/{product}/increment', [CartController::class, 'increment'])->name('cart.increment');
Route::patch('cart/{product}/decrement', [CartController::class, 'decrement'])->name('cart.decrement');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout.checkout');
Route::post('/review', [CheckoutController::class, 'review'])->name('checkout.review');
Route::get('/order-completed', [CheckoutController::class, 'completeOrder'])->name('checkout.complete');

Route::get("/review", function(){
    return view('cart');
});




//Route::resource('/products', ProductController::class);
Route::get('/products', [ProductController::class, 'index'])->name("products.index");
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


//Route::get('/products', [ProductController::class, 'sortProductsByPrice']);
//Route::get('/products/{perPage}',  [ProductController::class, 'index']);
// route for paging and sorting
//Route::get('/products/{page}', [ProductController::class, 'sortProductsByPrice']);





Route::get('/profile', [UserController::class, 'index'])->middleware(['auth'])->name('profile');
Route::post('/updateEmailAndPhone', [UserController::class, 'updateEmailAndPhone'])->middleware(['auth'])->name('profile.update');
Route::post('/updateAddress', [UserController::class, 'updateAddress'])->middleware(['auth'])->name('address.update');


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
