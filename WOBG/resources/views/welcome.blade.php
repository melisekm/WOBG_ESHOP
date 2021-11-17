@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/landing_page.css")}}">
@endpush
@section('title', 'World of Board Games')
@section("content")
    <main class="container">
        <!--    Img a call to action-->
        <section>
            <div class="row">
                <div class="col-lg-4 m-lg-auto mb-4 order-lg-2 mt-5 ">
                    <div class="container text-center">
                        <h1 class="display-5"> World of <br> Board Games </h1>
                        <p class="fs-5"> Discover more than one <br> thousand board games </p>
                        <a class="btn btn-blue btn-browse" href={{route("products.index")}}>Browse now </a>
                    </div>
                </div>
                <div class="col-lg-8 mb-4 order-lg-1">
                    <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active ratio ratio-16x9">
                                <img src="{{asset("img/sales/sale1-900.jpg")}}"
                                     srcset="{{asset("img/sales/sale1-400.jpg")}} 400w,
                                             {{asset("img/sales/sale1-600.jpg")}} 600w,
                                             {{asset("img/sales/sale1-900.jpg")}} 900w"
                                     sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                                     class="d-block w-100" alt="sales banner 1">
                            </div>
                            <div class="carousel-item ratio ratio-16x9">
                                <img src="{{asset("img/sales/sale2-900.jpg")}}"
                                     srcset="{{asset("img/sales/sale2-400.jpg")}} 400w,
                                             {{asset("img/sales/sale2-600.jpg")}} 600w,
                                             {{asset("img/sales/sale2-900.jpg")}} 900w"
                                     sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                                     class="d-block w-100" alt="sales banner 2">
                            </div>
                            <div class="carousel-item ratio ratio-16x9">
                                <img src="{{asset("img/sales/sale3-900.jpg")}}"
                                     srcset="{{asset("img/sales/sale3-400.jpg")}} 400w,
                                             {{asset("img/sales/sale3-600.jpg")}} 600w,
                                             {{asset("img/sales/sale3-900.jpg")}} 900w"
                                     sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                                     class="d-block w-100" alt="sales banner 3">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <!--Most popular games-->
    @include('components.product-offers.product-offers',[
        'products' => $popular_games,
        'title' => 'Most popular games',
        'row_class' => 'row row-cols-1 row-cols-sm-2 row-cols-xl-4 mb-4 border-bottom border-4 pb-4',
    ])
    <!--    New arrivals -->
        @include('components.product-offers.product-offers', [
            'products' => $new_games,
            'title' => 'New arrivals',
            'row_class' => 'row row-cols-1 row-cols-sm-2 row-cols-lg-4 mb-4',
         ])
    </main>
@endsection
