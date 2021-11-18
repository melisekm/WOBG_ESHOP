@extends("layout.app")
@push("styles")
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css"
          integrity="sha512-SZgE3m1he0aEF3tIxxnz/3mXu/u/wlMNxQSnE0Cni9j/O8Gs+TjM9tm1NX34nRQ7GiLwUEzwuE3Wv2FLz2667w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset("css/product_catalog.css")}}">
@endpush
@section('title', 'WOBG - Product Catalog')
@section("content")
    <main class="container">
        <div class="row mb-5 mt-3">

            <!--    Filters-->
            <div class="col-lg-3">
                <aside class="mod-collapse">
                    <div class="d-lg-none">
                        <button class="btn btn-blue" type="button" data-bs-toggle="collapse"
                                data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
                            <i class="fas fa-sliders-h"></i>&nbsp;FILTERS
                        </button>
                    </div>
                    <div class="collapse" id="filtersCollapse">
                        <div class="darkRectangle mt-lg-0 mt-4 pb-3">
                            <div class="ps-3 py-2">
                                <div class="text-end">
                                    <a href="{{route("products.index")}}"
                                       class="btn btn-blue border-0 bg-transparent pe-2 btn-sm">
                                        <i class="fas fa-times-circle"></i> Cancel filters
                                    </a>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-11">
                                            <div class="form-label fs-5 fw-bold">
                                                <label for="priceRange">
                                                    Price
                                                </label>
                                            </div>

                                            <input id="priceRange" type="text" class="slider" value=""
                                                   data-slider-min="0"
                                                   data-slider-max="100" data-slider-step="5"
                                                   data-slider-value="[{{$filters["price"]["min"]}},{{$filters["price"]["max"]}}]"/>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <span class="fs-6" id="priceMin"></span>
                                            </div>
                                            <div class="col text-end">
                                                <span class="fs-6" id="priceMax"></span>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-11">
                                        <div class="form-label fs-5 fw-bold mt-3 pt-3 border-top">
                                            <label for="ageRange">
                                                Minimum Age
                                            </label>
                                        </div>
                                        <input id="ageRange" type="text" class="slider" value=""
                                               data-slider-min="0"
                                               data-slider-max="18" data-slider-step="1"
                                               data-slider-value="{{$filters["minAge"]}}"/>
                                        <span class="fs-6" id="minAge"></span>

                                        <div class="form-label fs-5 fw-bold">
                                            <label for="playerRange">
                                                Minimum players
                                            </label>
                                        </div>
                                        <input id="playerRange" type="text" class="slider" value=""
                                               data-slider-min="0"
                                               data-slider-max="10" data-slider-step="1"
                                               data-slider-value="{{$filters["minPlayers"]}}"/>
                                        <span class="fs-6" id="minPlayers"></span>

                                        <div class="form-label fs-5 fw-bold">
                                            <label for="playTimeRange">
                                                Play Time
                                            </label>
                                        </div>
                                        <input id="playTimeRange" type="text" class="slider" value=""
                                               data-slider-min="0"
                                               data-slider-max="120" data-slider-step="10"
                                               data-slider-value="{{$filters["minPlayTime"]}}"/>
                                        <span class="fs-6" id="minPlayTime"></span>

                                        <div class="fs-5 fw-bold mt-3 py-3 border-top">Main Category</div>
                                        @foreach($filters["categories"] as $category)
                                            <div class="form-check">
                                                <input class="form-check-input"
                                                       @if(in_array($category->id, $filters["selectedCategories"])) checked
                                                       @endif name="category" type="checkbox"
                                                       value="{{$category->id}}"
                                                       id="{{$category->name}}">
                                                <label class="form-check-label" for="{{$category->name}}">
                                                    {{$category->name}}
                                                </label>
                                            </div>
                                        @endforeach


                                        <div class="fs-5 fw-bold mt-3 py-3 border-top">Sub Category</div>

                                        @foreach($filters["subcategories"] as $subcategory)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="subcategory"
                                                       @if(in_array($subcategory->id, $filters["selectedSubCategories"])) checked
                                                       @endif
                                                       value="{{$subcategory->id}}"
                                                       id="{{$subcategory->name}}">
                                                <label class="form-check-label" for="{{$subcategory->name}}">
                                                    {{$subcategory->name}}
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
            <!--    Catalog-->
            <div class="col-lg-9 py-lg-0 order-links">

                <section>
                    <h1 class="my-3 display-6">Board Games</h1>
                    <!--    Ordering-->
                    <ul class="nav nav-pills mb-3 d-none d-xl-flex" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a id="recommended"
                               class="nav-link link-dark sort-option @if($filters["sortOption"] == "recommended") active @endif">
                                Recommended
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="top"
                               class="nav-link link-dark sort-option @if($filters["sortOption"] === "top") active @endif">
                                Top Sellers
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="recent"
                               class="nav-link link-dark sort-option @if($filters["sortOption"] === "recent") active @endif">
                                Most Recent
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="price_desc"
                               class="nav-link link-dark sort-option @if($filters["sortOption"] === "price" && $filters["order"] == "desc") active @endif">
                                Highest Price</a>

                        </li>
                        <li class="nav-item" role="presentation">
                            <a id="price_asc"
                               class="nav-link link-dark sort-option @if($filters["sortOption"] === "price" && $filters["order"] == "asc") active @endif">
                                Lowest Price
                            </a>
                        </li>
                    </ul>
                    <!--    Dropdown ordering-->
                    <div class="d-xl-none my-3">
                        <select class="form-select" id="mobile_sort" aria-label="Mobile order select">
                            <option @if($filters["sortOption"] === "recommended") selected @endif value="recommended">
                                Order by
                                Recommended
                            </option>
                            <option @if($filters["sortOption"] === "top") selected @endif value="top">Order by Top
                                Sellers
                            </option>
                            <option @if($filters["sortOption"] === "recent") selected @endif value="recent">Order by
                                Most
                                Recent
                            </option>
                            <option @if($filters["sortOption"] === "price" && $filters["order"] == "desc") selected
                                    @endif value="price_desc">Order by
                                Highest Price
                            </option>
                            <option @if($filters["sortOption"] === "price" && $filters["order"] == "asc") selected
                                    @endif value="price_asc">Order by
                                Lowest Price
                            </option>
                        </select>
                    </div>
                    <!--    Products-->
                    @if(count($products) === 0)
                        <div class="fs-2 mt-4 text-center">
                            <p>No results found</p>
                            <a href="{{route("products.index")}}" class="btn mt-5 btn-blue btn-back-to-browsing">
                                Back to browsing
                            </a>
                        </div>

                    @else
                        <div class="tab-content ps-xl-3" id="pills-tabContent">
                            <div class="tab-pane fade show active " id="pills-recommended" role="tabpanel"
                                 aria-labelledby="pills-recommended-tab">
                                @foreach($products as $product)
                                    <article>
                                        <div class="row pb-2 border-bottom">
                                            <div class="col-md-3 py-3 text-center text-lg-start">
                                                <div class="ratio ratio-1x1">
                                                    @include("components.image", [
                                                        "class" => "img-fluid",
                                                        "alt" => "product image 1",
                                                        "path" => $product->mainPhoto->path
                                                    ])
                                                </div>
                                            </div>
                                            <div class="col d-flex flex-column">
                                                <div class="row pt-3 text-center text-sm-start">
                                                    <div class="col-sm-8">
                                                        <a href={{route("products.show", [$product->id])}}>
                                                            <h2 class="fs-5  fw-bold text-truncate">{{$product->name}}</h2>
                                                        </a>
                                                    </div>
                                                    <div class="col-sm">
                                                        <p class="fs-5 fw-bold text-sm-end ">@money($product->price)</p>
                                                    </div>
                                                </div>
                                                <div class="row d-none d-sm-block">
                                                    <div class="col-sm-8">
                                                        <p class="description">{{$product->description}}</p>
                                                    </div>
                                                </div>
                                                <div class="row mt-auto">
                                                    <div class="col-sm-8 d-none d-sm-block">
                                                        <p class="text-muted">{{$product->min_age}}+
                                                            | {{$product->min_play_time}} min
                                                            | {{$product->min_players . " - ". $product->max_players}}
                                                            | {{$product->category->name}}</p>
                                                    </div>
                                                    <div class="col-sm text-center text-sm-end ">
                                                        <button
                                                            id="btn-add-tocart-{{$product->id}}"
                                                            onclick="addProductToCart({{$product->id}})"
                                                            type="button" class="btn btn-blue add-to-cart-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#addtoCartModal-{{$product->id}}">
                                                            Add to cart
                                                        </button>
                                                        <!--    Modal -->
                                                        @include('components.add-to-cart-modal', ['product' => $product])
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </section>
                <div class="row mt-5">
                    <div class="col">
                        {{ $products->links("pagination::bootstrap-4") }}
                    </div>
                    <div class="col-lg-3 col-md-4 pt-2">
                        <select class="form-select" id="per_page" aria-label="Per page select">
                            <option value="3" @if($pagination["per_page"] == 3) selected @endif>Per page 3</option>
                            <option value="10" @if($pagination["per_page"] == 10) selected @endif>Per page 10</option>
                            <option value="25" @if($pagination["per_page"] == 25) selected @endif>Per page 25</option>
                        </select>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"
            integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset("js/product_catalog/sliders.js")}}"></script>
    <script src="{{asset("js/product_catalog/filters.js")}}"></script>
@endpush
