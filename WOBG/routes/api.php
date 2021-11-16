<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
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

Route::get("testapi2", function () {
//    $product = Product::find(1);
//    $test = Product::where("product_category_id", 1)->get();
//    return $test;
//    return Product::select('name', 'price', 'id')->where("product_category_id", $product->product_category_id)->with("mainPhotos")->get();
    return Product::find(2)->mainPhotos;
//    return Product::find(1)->with("photos", "category", "subcategory")->get();
//    return Product::find(1)->with("category")->get();
});

// get products by query
Route::get("products/search", [ProductController::class, "getProductByQuery"])->name("products.search");

