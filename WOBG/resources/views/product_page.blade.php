@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/product_page.css")}}">
@endpush
@section('title', "WOBG - " . $product->name)
@section("content")
    <main class="container px-3 px-lg-0">
        <!--    Breadcumbs-->
        <nav class="mt-3" style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <!-- local css custom property by bs5.1 -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url("/")}}"><i class="fas fa-home"></i>&nbsp;Home</a></li>
                <li class="breadcrumb-item"><a href="{{url("products")}}">Board Games</a></li>
                <li class="breadcrumb-item"><a href="{{url("products")}}">{{$product->category->name}}</a></li>
                <li class="breadcrumb-item active" aria-current="page">Ticket to Ride: Europe Edition</li>
            </ol>
        </nav>
        <!--    Main product row-->
        <section>
            <div class="row">
                <!--    Fotky-->
                <div class="col-lg-4 order-2 order-lg-1 text-lg-start text-center">
                    <img src="{{asset($product->mainPhotos[2]->path)}}"
                         srcset="{{asset($product->mainPhotos[0]->path)}} 400w,
                          {{asset($product->mainPhotos[1]->path)}} 600w,
                          {{asset($product->mainPhotos[2]->path)}} 900w"
                         sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                         class="img-fluid main-product-img" alt="product image">
                    <!--        Po kliknuti sa otvori na full-->
                    <div class="row align-items-center my-2">
                        <div class="col-1">
                            <a href="#">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <div class="col">
                            <div class="ratio ratio-1x1">
                                <img src="../img/games/ticket_to_ride/main/ticket2ride1-900.jpg"
                                     srcset="../img/games/ticket_to_ride/main/ticket2ride1-400.jpg 400w,
                          ../img/games/ticket_to_ride/main/ticket2ride1-600.jpg 600w,
                          ../img/games/ticket_to_ride/main/ticket2ride1-900.jpg 900w"
                                     sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                                     class="img-fluid" alt="product image">
                            </div>
                        </div>

                        <div class="col">
                            <div class="ratio ratio-1x1">
                                <img src="../img/games/ticket_to_ride/back/ticket2ride2-900.jpg"
                                     srcset="../img/games/ticket_to_ride/back/ticket2ride2-400.jpg 400w,
                          ../img/games/ticket_to_ride/back/ticket2ride2-600.jpg 600w,
                          ../img/games/ticket_to_ride/back/ticket2ride2-900.jpg 900w"
                                     sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                                     class="img-fluid" alt="product image">
                            </div>
                        </div>

                        <div class="col">
                            <div class="ratio ratio-1x1">
                                <img src="../img/games/ticket_to_ride/play/ticket2ride3-900.jpg"
                                     srcset="../img/games/ticket_to_ride/play/ticket2ride3-400.jpg 400w,
                          ../img/games/ticket_to_ride/play/ticket2ride3-600.jpg 600w,
                          ../img/games/ticket_to_ride/play/ticket2ride3-900.jpg 900w"
                                     sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                                     class="img-fluid" alt="product image">
                            </div>

                        </div>
                        <div class="col-1 text-end">
                            <a href="#">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!--    Product info-->
                <div class="col-lg-6 order-1 order-lg-2">
                    <h1>{{$product->name}}</h1>
                    <p>
                        {{$product->publisher}}<br>
                        <span class="text-muted">{{$product->min_age}}+ | {{$product->min_play_time}} min | {{$product->min_players . " - ". $product->max_players}} | {{$product->category->name}}</span>
                    </p>
                    <h2 class="fw-bold">{{$product->price}}&dollar;</h2>
                    <!--    Quantity-->
                    <ul class="pagination quantity" aria-label="Quantity selector">
                        <li class="page-item">
                            <button class="page-link"><i class="fas fa-minus"></i></button>
                        </li>
                        <li class="page-item">
                            <label class="d-none" for="quantity"></label>
                            <input type="text" class="form-control" id="quantity" value="1">
                        </li>
                        <li class="page-item">
                            <button class="page-link"><i class="fas fa-plus"></i></button>
                        </li>
                    </ul>
                    <div class="border-sm-bottom pb-3">
                        <button type="button" class="btn btn-blue btn-add-to-cart" data-bs-toggle="modal"
                                data-bs-target="#addtoCartModal-{{$product->id}}">
                            Add to cart
                        </button>
                        <!--    Modal-->
                        @include("components.modals.add-to-cart-modal", ["product" => $product])

                    </div>
                    <p class="pt-3">
                        {{$product->getShortenedDescription()}}
                        <a class="black-link" href="#description"> Read more</a>
                    </p>
                    <div class="lh-sm border-sm-bottom pb-3">
                        <span class="fw-bold">Language:</span> English
                        <br>
                        <span class="fw-bold">Release date:</span> 2005
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
            <a href="{{url("products")}}" class="btn btn-blue fs-4">Show more</a>
        @endcomponent
        <div class="text-center mb-3">
            <a href="{{url("products")}}" class="btn btn-blue fs-4">Show more</a>
        </div>
    </main>
@endsection
