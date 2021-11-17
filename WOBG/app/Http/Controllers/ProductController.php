<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource. vsetky produkty VIEW
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index($perPage)
    {
        //$products = Product::all();
        $products = Product::paginate($perPage);
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        return view('product-catalog', compact('products', 'categories', 'subcategories'));
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

    // read name from request query, find product by name, limit to 5 results
    public function getProductByQuery(Request $request)
    {
        $query = $request->query('query');
        $limit = $request->query('limit', 5);
        $products = Product::where('name', 'ilike', '%' . $query . '%')->select('name', 'id')->take($limit)->get();
        return response()->json($products);
    }


    public function sortProductsByPrice(Request $request)
    {
        $per_page = (int)$request->query('per_page', 3);
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();

        if(request()->get('sort') == 'price_asc')
        {
            $products = Product::orderBy('price', 'asc')->paginate($per_page);

        }

        else if (request()->get('sort') == 'price_desc')
        {
            $products = Product::orderBy('price', 'desc')->paginate($per_page);
        }

        else if (request()->get('sort') == 'sort=recent')
        {
            $products = Product::orderBy('updated_at', 'desc')->paginate($per_page);
        }

        else
        {
            $products = Product::paginate($per_page);
        }

        return view('product-catalog', compact('products', 'categories', 'subcategories'));

    }



}

