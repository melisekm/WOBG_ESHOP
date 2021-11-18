<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("testapi", function () {
    $popular_games = Product::with("mainPhotos")->select('name', 'price', 'id')->inRandomOrder()->take(4)->get();
    $new_games = Product::with("mainPhotos")->select('name', 'price', 'id')->inRandomOrder()->take(4)->get();
    return response()->json([
        "popular_games" => $popular_games,
        "new_games" => $new_games
    ]);
});

Route::get("testapi2", function (Request $request) {
    $categories = $request->get("cat", "all");
    $q = json_decode($categories);
    Log::info($q);
    return $q;
//    $user_products = User::find(4)->products()->get();
//    $cart_items = [];
//    foreach ($user_products as $user_product) {
//        $cart_items[$user_product->id] = [
//            "quantity" => $user_product->pivot->quantity
//        ];
//    }
//    return $cart_items;
});

// get products by query
Route::get("products/search", [ProductController::class, "getProductByQuery"])->name("products.search");
