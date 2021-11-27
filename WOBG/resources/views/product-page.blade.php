@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/product_page.css")}}">
    <link rel="stylesheet" href="{{asset("css/lightbox.css")}}">
@endpush
@push("scripts")
    <script src="{{asset("js/lightbox-plus-jquery.min.js")}}"></script>
@endpush
@section('title', "WOBG - " . $product->name)
@section("content")
    <main class="container px-3 px-lg-0">
        <!--    Breadcumbs-->
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <!-- local css custom property by bs5.1 -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{url("/")}}"> <i class="fas fa-home"></i>&nbsp;Home </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route("products.index")}}">Board Games</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route("products.index", ["cat"=>$product->category->id])}}">
                        {{$product->category->name}}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
            </ol>
        </nav>
        <!--    Main product row-->
        <section>
            <div class="row">
                <!--    Fotky-->
                <div class="col-lg-4 order-2 order-lg-1 text-lg-start text-center">
                    <a href="{{asset($product->mainPhoto->path)}}" data-lightbox="mygallery"
                       data-title="product {{$product->name}} main image">
                        <img src="{{asset($product->mainPhoto->path)}}" class="img-fluid main-product-img"
                             alt="product {{$product->name}} main image">
                    </a>

                    <!--        Po kliknuti sa otvori na full-->
                    <div class="row my-2">
                        @foreach($product->photos as $photo)
                            @if($photo == $product->mainPhoto)
                                @continue
                            @endif
                            <div class="@if($loop->index < 3) col d-flex justify-content-center @else d-none @endif">
                                @include("components.product-page-image", [
                                     "class" => "img-fluid",
                                     "alt" => "$product->name image $loop->index",
                                     "path" => $photo->path
                                 ])
                            </div>
                        @endforeach
                        @if(count($product->photos) > 3)
                            <div class="col text-center">
                                <button class="btn dark-link openGallery">
                                    Open Gallery
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <!--    Product info-->
                <div class="col-lg-6 order-1 order-lg-2">
                    <h1>{{$product->name}}</h1>
                    <p>
                        {{$product->publisher}}<br>
                        <span class="text-muted">{{$product->min_age}}+ | {{$product->min_play_time}} min | {{$product->min_players . " - ". $product->max_players}} | {{$product->category->name}}</span>
                    </p>
                    <h2 class="fw-bold">@money($product->price)</h2>
                    <!--    Quantity-->
                    <ul class="pagination quantity" aria-label="Quantity selector">
                        <li class="page-item">
                            <button id="quantity-decrement" class="page-link"><i
                                    class="fas fa-minus"></i></button>
                        </li>
                        <li class="page-item">
                            <label class="d-none" for="quantity"></label>
                            <input disabled type="text" class="form-control" id="quantity" value="1">
                        </li>
                        <li class="page-item">
                            <button id="quantity-increment" class="page-link"><i
                                    class="fas fa-plus"></i></button>
                        </li>
                    </ul>
                    <div class="border-sm-bottom pb-3">
                        <button
                            id="btn-add-tocart-main"
                            type="button" class="btn btn-blue btn-add-to-cart" data-bs-toggle="modal"
                            data-bs-target="#addtoCartModal-{{$product->id}}">
                            Add to cart
                        </button>
                        <div class="modal fade" id="addtoCartModal-{{$product->id}}" tabindex="-1"
                             aria-labelledby="addtoCartModal-{{$product->id}}Label"
                             aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title fs-5"
                                             id="addtoCartModal-{{$product->id}}Label">Added to
                                            cart
                                        </div>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    @include("components.image", [
                                                            "class" => "img-fluid product-img",
                                                            "alt" => "product $product->name image",
                                                            "path" => $product->mainPhoto->path
                                                    ])
                                                </div>
                                                <div class="col-md">{{$product->name}}</div>
                                            </div>
                                            <div class="row">
                                                <div id="cartQuantityMain" class="col-md-9 text-end">
                                                    1x
                                                </div>
                                                <div class="col-md text-end">@money($product->price)
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal"> Back to
                                            Browsing
                                        </button>
                                        <a class="btn btn-blue" href="{{url("cart")}}">View Shopping
                                            Cart </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <p class="pt-3">
                        {{$product->getShortenedDescription()}}
                        <a class="black-link" href="#description"> Read more</a>
                    </p>
                    <div class="lh-sm border-sm-bottom pb-3">
                        <span class="fw-bold">Language:</span> {{$product->language}}
                        <br>
                        <span class="fw-bold">Release date:</span> {{$product->release_date}}
                    </div>
                </div>
            </div>
            <!--    Description-->
            <div class="row">
                <div class="col-lg">
                    <h2 id="description">Description</h2>
                    <p>{{$product->description}}</p>
                </div>
                <div class="col-lg">
                    <!--    Includes-->
                    <h2>Includes</h2>
                    <ul class="ps-3">
                        @foreach($product->getParsedIncludes() as $include)
                            <li>{{$include}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>


        </section>
        <!--    Related prodcuts-->
        @component("components.product-offers.product-offers", [
            "products" => $relatedProducts,
            "title" => "Related Products",
            "row_class" => "row row-cols-2 row-cols-lg-4 mb-4"])
        @endcomponent
        <div class="text-center mb-3">
            <a href="{{route("products.index")}}" class="btn btn-blue fs-4">Show more</a>
        </div>
    </main>
@endsection

@push("scripts")
    <script>
        $(document).ready(function () {
            const quanityIncrement = $("#quantity-increment");
            const quanityDecrement = $("#quantity-decrement");
            const currentQuantity = $("#quantity");
            quanityIncrement.click(function () {
                let quantity = parseInt(currentQuantity.val());
                quantity++;
                currentQuantity.val(quantity);
            });
            quanityDecrement.click(function () {
                let quantity = parseInt(currentQuantity.val());
                if (quantity > 1) {
                    quantity--;
                    $("#quantity").val(quantity);
                }
            });
            const btnAddToCart = $("#btn-add-tocart-main");
            btnAddToCart.click(function () {
                const quantity = parseInt($("#quantity").val());
                $("#cartQuantityMain").html(quantity + "x");
                addProductToCart({{$product->id}}, quantity);
            });
            $('.openGallery').click(function () {
                $('#lightbox-4').trigger('click');
            });
        });
    </script>
@endpush
