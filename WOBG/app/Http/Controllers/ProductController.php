<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource. vsetky produkty VIEW
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = (int)$request->query("per_page", 3);
        $sortOption = $request->query("sort", "recommended");
        $order = $request->query("order", "asc");
        $search = $request->query("search", "");
        $minPrice = $request->query("min_price", "1");
        $maxPrice = $request->query("max_price", "100");
        if ($sortOption === "recommended") {
            $sort = "id";
        } else if ($sortOption === "top") {
            $sort = "name";
            $order = "asc";
        } else if ($sortOption === "recent") {
            $sort = "created_at";
            $order = "desc";
        } else {
            $sort = "price";
        }

        $products = Product::where("name", "ilike", "%$search%");
        $products = $products->whereBetween("price", [$minPrice, $maxPrice]);
        $products = $products->orderBy($sort, $order);

        $products = $products->paginate($per_page);
        $page = $request->query("page", 1);
        $lastpage = $products->lastPage();
        if($page > $lastpage) {
            return redirect("/products?page=$lastpage&per_page=$per_page&sort=$sortOption&order=$order&search=$search&min_price=$minPrice&max_price=$maxPrice");
        }
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        $price = [
            "min" => $minPrice,
            "max" => $maxPrice
        ];

        return view('product-catalog', compact('products', 'categories',
            'subcategories', 'per_page', 'sortOption', 'order', 'price'));
    }


    /**
     * Show the form for creating a new resource. VIEW
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage. POST API
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource. GET VIEW
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $relatedProducts = Product::with("mainPhoto")->select('name', 'price', 'id')->inRandomOrder()->take(4)->get();
        return view('product-page', compact('product', "relatedProducts"));
    }

    /**
     * Show the form for editing the specified resource. PUT API
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage. PATCH/PUT API
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage. DELETE API
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }


    public function getProductByQuery(Request $request)
    {
        $query = $request->query('query');
        $limit = $request->query('limit', 5);
        $products = Product::where('name', 'ilike', '%' . $query . '%')->select('name', 'id')->take($limit)->get();
        return response()->json($products);
    }
}

