<?php

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

Route::get("products/1", function () {
    $popular_games = Product::with("mainPhotos")->select('name','price', 'id')->inRandomOrder()->take(4)->get();
        $new_games = Product::with("mainPhotos")->select('name','price', 'id')->inRandomOrder()->take(4)->get();
//    return Product::with("mainPhotos")->find(1);
    return response()->json([
        "popular_games" => $popular_games,
        "new_games" => $new_games
    ]);


});
