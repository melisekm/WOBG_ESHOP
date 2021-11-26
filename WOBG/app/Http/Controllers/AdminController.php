<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'products' => Product::all()->count(),
            'categories' => ProductCategory::all()->count(),
            'subcategories' => ProductSubcategory::all()->count(),
            'users' => User::all()->count(),
            'orders' => Order::all()->count(),
            'orderProducts' => DB::table('order_product')->sum('quantity'),
            'productsInCart' => DB::table('product_user')->sum('quantity'),
            'usersHaveCart' => DB::table('product_user')->distinct()->count('user_id'),
        ];

        $active = "home";
        return view('admin.index', compact('active', 'stats'));
    }

    public function products(Request $request)
    {
        $per_page = (int)$request->query("per_page", 10);
        $products = Product::orderBy('id', 'asc')->paginate($per_page);
        $active = "products";
        $pagination = [
            "per_page" => $per_page,
        ];
        return view('admin.products', compact('active', 'products', 'pagination'));
    }
}
