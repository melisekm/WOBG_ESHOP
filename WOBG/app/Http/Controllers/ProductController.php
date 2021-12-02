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
        $maxPrice = $request->query("max_price", $totalMax);
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
                "totalMax" => $totalMax
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
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0.01|max:100000000|regex:/^[0-9]+[\.\,]?[0-9]{0,2}$/',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'publisher' => 'required|max:255',
            'min_age' => 'required|numeric|between:0,18',
            'min_players' => 'required|numeric|between:1,10',
            'max_players' => 'required|numeric|between:1,10',
            'min_play_time' => 'required|numeric|between:1,120',
            'language' => 'required|max:255',
            'release_date' => 'required|numeric',
            'includes' => 'required',
            'mainPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photosNew.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->publisher = $request->publisher;
        $product->min_age = $request->min_age;
        $product->min_play_time = $request->min_play_time;
        $product->min_players = $request->min_players;
        $product->max_players = $request->max_players;
        $product->release_date = $request->release_date;
        $product->includes = $request->includes;
        $product->language = $request->language;
        $product->category()->associate(ProductCategory::find($request->category));
        $product->subcategory()->associate(ProductSubcategory::find($request->subcategory));

        $product->save();

        $this->addPhotosToProduct($request->file('photosNew'), $product);

        $photo = $request->file("mainPhoto");
        $name = $product->id . "main_" .
            md5(time() . $photo->getClientOriginalName()) . "." . $photo->getClientOriginalExtension();
        $this->createPhoto($photo, $name, $product);

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
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0.01|max:100000000|regex:/^[0-9]+[\.\,]?[0-9]{0,2}$/',
            'description' => 'required',
            'category' => 'required',
            'subcategory' => 'required',
            'publisher' => 'required|max:255',
            'min_age' => 'required|numeric|between:0,18',
            'min_players' => 'required|numeric|between:1,10',
            'max_players' => 'required|numeric|between:1,10',
            'min_play_time' => 'required|numeric|between:0,120',
            'language' => 'required|max:255',
            'release_date' => 'required|numeric|between:-3000,3000',
            'includes' => 'required',
            'photosNew.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category = ProductCategory::find($request->category);
        $subcategory = ProductSubcategory::find($request->subcategory);
        $product->category()->associate($category);
        $product->subcategory()->associate($subcategory);
        $product->update([
            "name" => $request->name,
            "description" => $request->description,
            "price" => $request->price,
            "publisher" => $request->publisher,
            "min_age" => $request->min_age,
            "min_play_time" => $request->min_play_time,
            "min_players" => $request->min_players,
            "max_players" => $request->max_players,
            "release_date" => $request->release_date,
            "includes" => $request->includes,
            "language" => $request->language,

        ]);
        $product->save();

        $existingPhotos = $request->photos;
        if ($existingPhotos) {
            $productPhotos = $product->photos;
            foreach ($productPhotos as $photo) {
                if (!in_array($photo->id, $existingPhotos)) {
                    $this->hardDeletePhoto($photo);
                    $photo->delete();
                }
            }
        }
        $this->addPhotosToProduct($request->file('photosNew'), $product);

        $request->session()->flash('success', 'Product updated!');
        return back();
    }

    /**
     * Remove the specified resource from storage. DELETE API
     *
     */
    public function destroy(Product $product, Request $request)
    {
        foreach ($product->photos as $photo) {
            $this->hardDeletePhoto($photo);
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

    private function hardDeletePhoto($photo)
    {
        $photoPath = public_path(config('app.image_path') . $photo->name);
        if (file_exists($photoPath)) {
            unlink($photoPath);
        }
    }


    private function addPhotosToProduct($photos, $product)
    {
        if ($photos) {
            foreach ($photos as $photo) {
                $name = md5(time() . $photo->getClientOriginalName()) . "." . $photo->getClientOriginalExtension();
                $this->createPhoto($photo, $name, $product);
            }
        }
    }

    private function createPhoto($photo, $name, $product)
    {
        $image_width = getimagesize($photo->getRealPath())[0];
        $image = Image::make($photo->getRealPath());
        if ($image_width > 900) {
            $image->resize(900, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $image->save(public_path(config('app.image_path') . $name));

        $photoDB = new ProductPhoto();
        $photoDB->name = $name;
        $photoDB->product()->associate($product);
        $photoDB->save();
    }
}
