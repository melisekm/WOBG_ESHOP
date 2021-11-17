@extends("layout.app")
@push("styles")
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
                                                   data-slider-min="10"
                                                   data-slider-max="1000" data-slider-step="5"
                                                   data-slider-value="[10,1000]"/>
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
                                                <input class="form-check-input" type="checkbox" checked value=""
                                                       id="mainCategoryCheckbox1">
                                                <label class="form-check-label" for="mainCategoryCheckbox1">
                                                    {{$category->name}}
                                                </label>
                                            </div>
                                        @endforeach


                                        <div class="fs-5 fw-bold mt-3 py-3 border-top">Sub Category</div>

                                        @foreach($subcategories as $subcategory)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" checked value=""
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
                <section>
                    <h1 class="my-3 display-6"> Family Games</h1>
                    <!--    Ordering-->

                    <div class="col-md-12 mb-3 d-none d-xl-flex">
                        <a href="{{ url()->current() }}" class="sort-font">Recommended</a>
                        <a href="{{ url()->current()."?sort=top" }}" class="sort-font">Top Sellers</a>
                        <a href="{{ url()->current()."?sort=recent" }}" class="sort-font">Most Recent</a>
                        <a href="{{ url()->current()."?sort=price_desc" }}" class="sort-font">Highest Price</a>
                        <a href="{{ url()->current()."?sort=price_asc" }}" class="sort-font">Lowest Price</a>
                    </div>
                {{--                    <ul class="nav nav-pills mb-3 d-none d-xl-flex" id="pills-tab" role="tablist">--}}
                {{--                        <li class="nav-item" role="presentation">--}}
                {{--                            <button class="nav-link link-dark active" id="pills-recommended-tab"--}}
                {{--                                    data-bs-toggle="pill"--}}
                {{--                                    data-bs-target="#pills-recommended" type="button" role="tab"--}}
                {{--                                    aria-controls="pills-recommended"--}}
                {{--                                    aria-selected="true">Recommended--}}
                {{--                            </button>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item" role="presentation">--}}
                {{--                            <button class="nav-link link-dark" id="pills-topsellers-tab" data-bs-toggle="pill"--}}
                {{--                                    data-bs-target="#pills-topsellers" type="button" role="tab"--}}
                {{--                                    aria-controls="pills-topsellers" aria-selected="false">Top Sellers--}}
                {{--                            </button>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item" role="presentation">--}}
                {{--                            <button class="nav-link link-dark" id="pills-mostrecent-tab" data-bs-toggle="pill"--}}
                {{--                                    data-bs-target="#pills-mostrecent" type="button" role="tab"--}}
                {{--                                    aria-controls="pills-mostrecent" aria-selected="false">Most Recent--}}
                {{--                            </button>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item" role="presentation">--}}
                {{--                            <button class="nav-link link-dark" id="pills-highestprice-tab" data-bs-toggle="pill"--}}
                {{--                                    data-bs-target="#pills-highestprice" type="button" role="tab"--}}
                {{--                                    aria-controls="pills-highestprice" aria-selected="false">Highest Price--}}
                {{--                            </button>--}}
                {{--                        </li>--}}
                {{--                        <li class="nav-item" role="presentation">--}}
                {{--                            <button class="nav-link link-dark" id="pills-lowestprice-tab" data-bs-toggle="pill"--}}
                {{--                                    data-bs-target="#pills-lowestprice" type="button" role="tab"--}}
                {{--                                    aria-controls="pills-lowestprice" aria-selected="false">Lowest Price--}}
                {{--                            </button>--}}
                {{--                        </li>--}}
                {{--                    </ul>--}}
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
                                                    "alt" => "product image 1"
                                                ])
                                            </div>
                                        </div>
                                        <div class="col d-flex flex-column">
                                            <div class="row pt-3 text-center text-sm-start">
                                                <div class="col-sm-8">
                                                    <a href="">
                                                        <h2 class="fs-5  fw-bold text-truncate">{{$product->name}}</h2>
                                                    </a>
                                                </div>
                                                <div class="col-sm">
                                                    <p class="fs-5 fw-bold text-sm-end ">{{$product->price}}</p>
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
                                                    <button class="btn btn-blue add-to-cart-btn">
                                                        Add to cart
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                        {{--                        <div class="tab-pane fade" id="pills-topsellers" role="tabpanel"--}}
                        {{--                             aria-labelledby="pills-topsellers-tab">--}}


                        {{--                        </div>--}}
                        {{--                        <div class="tab-pane fade" id="pills-mostrecent" role="tabpanel"--}}
                        {{--                             aria-labelledby="pills-mostrecent-tab">--}}

                        {{--                        </div>--}}
                        {{--                        <div class="tab-pane fade" id="pills-highestprice" role="tabpanel"--}}
                        {{--                             aria-labelledby="pills-highestprice-tab">--}}
                        {{--                        </div>--}}
                        {{--                        <div class="tab-pane fade" id="pills-lowestprice" role="tabpanel"--}}
                        {{--                             aria-labelledby="pills-lowestprice-tab">--}}
                        {{--                        </div>--}}
                    </div>

                    {{--                    <div class="row mt-5">--}}
                    {{--                        <div class="col">--}}

                    {{--                            <nav aria-label="Page navigation">--}}
                    {{--                                <ul class="pagination pagination-lg justify-content-center">--}}
                    {{--                                    <li class="page-item disabled">--}}
                    {{--                                        <a aria-hidden="true" class="page-link"><i--}}
                    {{--                                                class="fas fa-chevron-circle-left"></i></a>--}}
                    {{--                                        <span class="sr-only">Previous</span>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="page-item active"><a class="page-link" href="#">&nbsp;1&nbsp;</a></li>--}}
                    {{--                                    <li class="page-item"><a class="page-link" href="#">2</a></li>--}}
                    {{--                                    <li class="page-item"><a class="page-link" href="#">3</a></li>--}}
                    {{--                                    <li class="page-item">--}}
                    {{--                                        <span class="page-link">&hellip;</span>--}}
                    {{--                                    </li>--}}
                    {{--                                    <li class="page-item"><a class="page-link" href="#">15</a></li>--}}

                    {{--                                    <li class="page-item">--}}
                    {{--                                        <a aria-hidden="true" class="page-link" href="#"><i--}}
                    {{--                                                class="fas fa-chevron-circle-right"></i></a>--}}
                    {{--                                        <span class="sr-only">Next</span>--}}

                    {{--                                    </li>--}}
                    {{--                                </ul>--}}
                    {{--                            </nav>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="col-lg-3 col-md-4 pt-2">--}}

                    {{--                            <select class="form-select" aria-label="Per page select">--}}
                    {{--                                <option value="3">Per page 3</option>--}}
                    {{--                                <option value="10">Per page 10</option>--}}
                    {{--                                <option value="25">Per page 25</option>--}}
                    {{--                            </select>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    {{--                    {{ $products->links() }}--}}
                </section>
                <div class="row mt-3">

                    <p class="text-muted">Per page:
                        {{--                        <a href="{{ url()->current()."?sort=top" }}" class="sort-font">Top Sellers</a>--}}
                        | 3
                        | 10
                        | 20

                        {{ $products->links("pagination::bootstrap-4") }}

                    </p>
                </div>
            </div>

        </div>

    </main>

@endsection
