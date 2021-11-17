@extends("layout.app")
@push("styles")
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/css/bootstrap-slider.css"
          integrity="sha512-SZgE3m1he0aEF3tIxxnz/3mXu/u/wlMNxQSnE0Cni9j/O8Gs+TjM9tm1NX34nRQ7GiLwUEzwuE3Wv2FLz2667w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="{{asset("css/product_catalog.css")}}">
@endpush
@section('title', 'Product Catalog')
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
                                    <a href="#" class="btn btn-blue border-0 bg-transparent pe-2 btn-sm">
                                        <i class="fa fa-check"></i> Apply filters
                                    </a>
                                    <a href="#" class="btn btn-blue border-0 bg-transparent pe-2 btn-sm">
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
                                                   data-slider-min="1"
                                                   data-slider-max="100" data-slider-step="5"
                                                   data-slider-value="[{{$price["min"]}},{{$price["max"]}}]"/>
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
                                            <label for="minimumAge">
                                                Minimum Age
                                            </label>
                                        </div>
                                        <input type="range" class="form-range w-100" id="minimumAge">
                                        <p class="fs-6">5</p>

                                        <div class="form-label fs-5 fw-bold">
                                            <label for="minimumPlayers">
                                                Minimum players
                                            </label>
                                        </div>
                                        <input type="range" class="form-range w-100" id="minimumPlayers">
                                        <p class="fs-6">2</p>

                                        <div class="form-label fs-5 fw-bold">
                                            <label for="playTime">
                                                Play Time
                                            </label>
                                        </div>
                                        <input type="range" class="form-range w-100" id="playTime">
                                        <p class="fs-6">45min</p>

                                        <div class="fs-5 fw-bold mt-3 py-3 border-top">Main Category</div>
                                        @foreach($categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="mainCategoryCheckbox1">
                                                <label class="form-check-label" for="mainCategoryCheckbox1">
                                                    {{$category->name}}
                                                </label>
                                            </div>
                                        @endforeach


                                        <div class="fs-5 fw-bold mt-3 py-3 border-top">Sub Category</div>

                                        @foreach($subcategories as $subcategory)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                       id="mainCategoryCheckbox1">
                                                <label class="form-check-label" for="mainCategoryCheckbox1">
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
                @if(count($products) === 0)
                    <div class="fs-2 mt-4 text-center">
                        <p>No results found</p>
                        <a href="{{route("products.index")}}" class="btn mt-5 btn-blue btn-back-to-browsing">
                            Back to browsing
                        </a>
                    </div>

                @else
                    <section>
                        <h1 class="my-3 display-6"> Family Games</h1>
                        <!--    Ordering-->
                        <ul class="nav nav-pills mb-3 d-none d-xl-flex" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a id="sort-recommended"
                                   class="nav-link link-dark @if($sortOption == "recommended") active @endif">
                                    Recommended
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="sort-top" class="nav-link link-dark @if($sortOption == "top") active @endif">
                                    Top Sellers
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="sort-recent"
                                   class="nav-link link-dark @if($sortOption == "recent") active @endif">
                                    Most Recent
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="sort-price-desc"
                                   class="nav-link link-dark @if($sortOption == "price" && $order == "desc") active @endif">
                                    Highest Price</a>

                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="sort-price-asc"
                                   class="nav-link link-dark @if($sortOption == "price" && $order == "asc") active @endif">
                                    Lowest Price
                                </a>
                            </li>
                        </ul>
                        <!--    Dropdown ordering-->
                        <div class="d-xl-none my-3">
                            <select class="form-select" aria-label="Default select">
                                <option value="recommended">Order by Recommended</option>
                                <option value="sop_sellers">Order by Top Sellers</option>
                                <option value="most_recent">Order by Most Recent</option>
                                <option value="highest_price">Order by Highest Price</option>
                                <option value="lowest_price">Order by Lowest Price</option>
                            </select>
                        </div>
                        <!--    Products-->
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
                                                        </p>
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

                    </section>
                    <div class="row mt-5">
                        <div class="col">
                            {{ $products->links("pagination::bootstrap-4") }}
                        </div>
                        <div class="col-lg-3 col-md-4 pt-2">
                            <select class="form-select" id="per_page" aria-label="Per page select">
                                <option value="3" @if($per_page == 3) selected @endif>Per page 3</option>
                                <option value="10" @if($per_page == 10) selected @endif>Per page 10</option>
                                <option value="25" @if($per_page == 25) selected @endif>Per page 25</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>

        </div>

    </main>

@endsection

@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"
            integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const url = new URL(window.location.href);

        //Prodcut catalog slider
        //https://github.com/seiyria/bootstrap-slider
        const minTag = document.getElementById("priceMin")
        const maxTag = document.getElementById("priceMax")
        const priceRange = new Slider('#priceRange', {"tooltip": "hide"});
        const priceRangeElement = priceRange.getElement()
        minTag.innerHTML = priceRange.getValue()[0] + "$"
        maxTag.innerHTML = priceRange.getValue()[1] + "$"

        const updatePriceSliderValues = () => {
            const [low, high] = priceRange.getValue()
            minTag.innerHTML = low + "$"
            maxTag.innerHTML = high + "$"
        }

        priceRangeElement.slide = () => {
            updatePriceSliderValues()

        }
        priceRangeElement.onmouseup = () =>{
            url.searchParams.set("min_price", priceRange.getValue()[0])
            url.searchParams.set("max_price", priceRange.getValue()[1])
            window.location.href = url.href;

        }

        priceRangeElement.change = () => {
            updatePriceSliderValues()
        }


        document.getElementById('per_page').onchange = function () {
            url.searchParams.set('per_page', this.value);
            window.location.href = url.href;
        };
        document.getElementById('sort-recommended').onclick = () => {
            url.searchParams.set('sort', 'recommended');
            url.searchParams.delete("order")
            window.location.href = url.href;
        };
        document.getElementById('sort-recent').onclick = () => {
            url.searchParams.set('sort', 'recent');
            url.searchParams.delete("order")
            window.location.href = url.href;
        };
        document.getElementById('sort-top').onclick = () => {
            url.searchParams.set('sort', 'top');
            url.searchParams.delete("order")
            window.location.href = url.href;
        };
        document.getElementById('sort-price-asc').onclick = () => {
            url.searchParams.set('sort', 'price');
            url.searchParams.set('order', 'asc');
            window.location.href = url.href;
        };
        document.getElementById('sort-price-desc').onclick = () => {
            url.searchParams.set('sort', 'price');
            url.searchParams.set('order', 'desc');
            window.location.href = url.href;
        };
    </script>

@endpush
