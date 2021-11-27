<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductPhoto;
use App\Models\ProductSubCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource. vsetky produkty VIEW
     *
     */
    public function index(Request $request)
    {
        $per_page = (int)$request->query("per_page", 3);
        $sortOption = $request->query("sort", "recommended");
        $order = $request->query("order", "asc");
        $search = $request->query("search", "");
        $minPrice = $request->query("min_price", "0");
        // get max price of all products
        $totalMax = Product::max('price');
        $maxPrice = $request->query("max_price",$totalMax);
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
            ->where("max_players", ">=", $minPlayers) // ?
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
                "max" => $maxPrice,
                "totalMax"=> $totalMax
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
        $active = "products";
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        return view('admin.product-create', compact('active', 'categories', 'subcategories'));
    }

    /**
     * Store a newly created resource in storage. POST API
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0.01|regex:/^[0-9]+[\.\,]?[0-9]{0,2}$/',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'publisher' => 'required|max:255',
            'mainPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'backPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'playPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->publisher = $request->publisher;
        $product->min_age = rand(0, 18);
        $product->min_play_time = rand(20, 120);
        $product->min_players = rand(2, 4);
        $product->max_players = rand(4, 10);
        $product->release_date = rand(2005, 2021);
        $product->includes = "One board\nManual in Polish\nManual in English\nManual in German";
        $product->language = "English";
        $product->category()->associate(ProductCategory::find($request->category));
        $product->subcategory()->associate(ProductSubcategory::find($request->subcategory));

        $product->save();

        $image_codes = [
            "mainPhoto" => "_main.",
            "backPhoto" => "_back.",
            "playPhoto" => "_play.",
        ];

        foreach ($image_codes as $key => $value) {
            if ($request->hasFile($key)) {
                $photo = $request->file($key);
                $filename = $product->id . $value . $photo->getClientOriginalExtension();
                $public_path = "img\\games\\" . $filename;
                $location_full = public_path($public_path);
                Image::make($photo->getRealPath())->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($location_full);
                $photoDB = new ProductPhoto();
                $photoDB->path = $public_path;
                $photoDB->name = $filename;
                $photoDB->product()->associate($product);
                $photoDB->save();
            }
        }

        $request->session()->flash('success', 'Product created successfully!');
        return redirect()->route('admin.products');
    }

    /**
     * Display the specified resource. GET VIEW
     *
     */
    public function show(Product $product)
    {
        $relatedProducts = Product::with("mainPhoto")->select('name', 'price', 'id')->inRandomOrder()->take(4)->get();
        return view('product-page', compact('product', "relatedProducts"));
    }

    /**
     * Show the form for editing the specified resource. PUT API
     *
     */
    public function edit(Product $product)
    {
        $active = "products";
        $product = Product::with("photos")->find($product->id);
        $categories = ProductCategory::all();
        $subcategories = ProductSubcategory::all();
        return view('admin.product-edit', compact('product', 'categories', 'active', 'subcategories'));
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
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0.01|regex:/^[0-9]+[\.\,]?[0-9]{0,2}$/',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'publisher' => 'required|max:255',

//            'mainPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
//            'backPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
//            'playPhoto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $category = ProductCategory::find($request->category);
        $subcategory = ProductSubcategory::find($request->subcategory);
        // update product with category
        $product->category()->associate($category);
        $product->subcategory()->associate($subcategory);
        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "publisher" => $request->publisher,
        ]);
        $product->save();
        // update product photos
//        $mainPhoto = $request->file('mainPhoto');
//        $backPhoto = $request->file('backPhoto');
//        $playPhoto = $request->file('playPhoto');
//        $mainPhotoName = $product->id . '_main.' . $mainPhoto->getClientOriginalExtension();
//        $backPhotoName = $product->id . '_back.' . $backPhoto->getClientOriginalExtension();
//        $playPhotoName = $product->id . '_play.' . $playPhoto->getClientOriginalExtension();
//        $mainPhoto->move(public_path('img\\games'), $mainPhotoName);
//        $backPhoto->move(public_path('img\\games'), $backPhotoName);
//        $playPhoto->move(public_path('img\\games'), $playPhotoName);
//        $product->update([
//            "main_photo" => $mainPhotoName,
//            "back_photo" => $backPhotoName,
//            "play_photo" => $playPhotoName
//        ]);


        $request->session()->flash('success', 'Product updated!');
        return redirect()->route('admin.products');
    }

    /**
     * Remove the specified resource from storage. DELETE API
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Request $request)
    {
        foreach ($product->photos as $photo) {
            $photoPath = public_path($photo->path);
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }
        // delete product
        $product->photos()->delete();
        $product->delete();
        $request->session()->flash('success', 'Product deleted successfully!');
        return back();
    }


    public function getProductByQuery(Request $request)
    {
        $query = $request->query('query');
        $limit = $request->query('limit', 5);
        $products = Product::where('name', 'ilike', '%' . $query . '%')->select('name', 'id')->take($limit)->get();
        return response()->json($products);
    }
}

