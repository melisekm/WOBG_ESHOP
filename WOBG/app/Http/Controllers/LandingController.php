<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // get 4 random products
        $popular_games = Product::with("mainPhotos")->select('name','price', 'id')->inRandomOrder()->take(4)->get();
        $new_games = Product::with("mainPhotos")->select('name','price', 'id')->inRandomOrder()->take(4)->get();

        return view('welcome', compact('popular_games', 'new_games'));
    }
}
