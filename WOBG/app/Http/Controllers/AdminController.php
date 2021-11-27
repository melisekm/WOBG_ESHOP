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

    private function simpleAdminRetrieve($model, $request, $view)
    {
        $per_page = (int)$request->query("per_page", 10);
        $model_collection = $model::orderBy('id', 'asc')->paginate($per_page);
        $pagination = [
            "per_page" => $per_page,
        ];
        $active = $view;
        return view('admin.' . $view, compact('active', 'model_collection', 'pagination'));
    }

    public function products(Request $request)
    {
        return $this->simpleAdminRetrieve(Product::class, $request, "products");
    }

    public function orders(Request $request)
    {
        return $this->simpleAdminRetrieve(Order::class, $request, "orders");
    }

    public function users(Request $request)
    {
        return $this->simpleAdminRetrieve(User::class, $request, "users");
    }

    public function categories(Request $request)
    {
        return $this->simpleAdminRetrieve(ProductCategory::class, $request, "categories");
    }

    public function subcategories(Request $request)
    {
        return $this->simpleAdminRetrieve(ProductSubCategory::class, $request, "subcategories");
    }


}
