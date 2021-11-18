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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = (int)$request->query("per_page", 3);
        $sortOption = $request->query("sort", "recommended");
        $order = $request->query("order", "asc");
        $search = $request->query("search", "");
        $minPrice = $request->query("min_price", "0");
        $maxPrice = $request->query("max_price", "100");
        $categories = $request->query("cat", "");
        $subCategories = $request->query("subcat", "");
        // potrebujeme splitnut string lebo je v tvare [1,2,3], konverziu na inty
        $selectedCategories = array_map('intval', explode(',', $categories));
        $selectedSubCategories = array_map('intval', explode(',', $subCategories));
        $minAge = $request->query("minAge", "0");
        $minPlayers = $request->query("minPlayers", "0");
        $minPlayTime = $request->query("minPlayTime", "0");

        $products = Product::where("name", "ilike", "%$search%")
            ->whereBetween("price", [$minPrice, $maxPrice])
            ->where("min_age", ">=", $minAge)
            ->where("max_players", ">=", $minPlayers)
            ->where("min_play_time", ">=", $minPlayTime);

        // hladame produkty podla kategorie
        // ak je zadana kategoria, tak sa vyberu produkty ktore su v tejto kategorie
        if (!empty($categories)) {
            $products = $products->whereHas("category", function ($query) use ($selectedCategories) {
                $query->whereIn("id", $selectedCategories);
            });
        }
        if (!empty($subCategories)) {
            $products = $products->whereHas("subcategory", function ($query) use ($selectedSubCategories) {
                $query->whereIn("id", $selectedSubCategories);
            });
        }
        // trocha custom sorting
        [$sort, $order] = $this->getSorting($sortOption, $order);

        // order a limit + offset
        $products = $products->orderBy($sort, $order)->paginate($per_page);

        // tuto sa musime pozriet, ci si neziadame viac ako je stran, ak ano tak nastav na poslednu stranu
        $lastpage = $products->lastPage();
        $isMorePagesRequestedThanLast = $request->query("page", 1) > $lastpage;
        if ($isMorePagesRequestedThanLast) {
            // vratime sa s rovnakym requestom ale upravenym lastpage
            return redirect()->route("products.index", array_merge($request->query(), ["page" => $lastpage]));
        }

        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();


        // len to dame do poli, z ktorych vo view sa vyberaju udaje aby elementy mali aktivny stav
        // napr zaciarknuty checkbox, pre kategoriu ktora je vybrana
        $filters = [
            "categories" => $categories,
            "subcategories" => $subcategories,
            "price" => [
                "min" => $minPrice,
                "max" => $maxPrice
            ],
            "minAge" => $minAge,
            "minPlayers" => $minPlayers,
            "selectedCategories" => $selectedCategories,
            "selectedSubCategories" => $selectedSubCategories,
            "sortOption" => $sortOption,
            "order" => $order,
            "minPlayTime" => $minPlayTime
        ];
        $pagination = [
            "per_page" => $per_page,
        ];


        return view('product-catalog', compact('products', 'filters', 'pagination'));
    }

    private function getSorting($sortOption, $order): array
    {
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
        return [$sort, $order];
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

