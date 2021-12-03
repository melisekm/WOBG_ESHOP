<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        $popular_games = Cache::rememberForever('popular_games', function () {
            return Product::with("mainPhoto")
                ->select('name', 'price', 'id')
                ->orderBy('id')
                ->take(4)
                ->get();
        });

        $new_games = Cache::rememberForever('new_games', function () {
            return Product::with("mainPhoto")
                ->select('name', 'price', 'id')
                ->orderBy('created_at', 'desc')
                ->take(4)
                ->get();
        });

        return view('welcome', compact('popular_games', 'new_games'));
    }
}
