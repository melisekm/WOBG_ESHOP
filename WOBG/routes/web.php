<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
Route::get('/cart', [CartController::class, 'index']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/review', [CheckoutController::class, 'review']);
Route::get('/order-completed', [CheckoutController::class, 'completeOrder']);


Route::resource('/products', ProductController::class);

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');

Auth::routes();


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
