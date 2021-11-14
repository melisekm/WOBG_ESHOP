@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/cart.css")}}">
@endpush
@section('title', 'WOBG - Cart')
@section("content")
{{--    @unless($cart->count())--}}
{{--        <main class="container m-auto">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-4 m-lg-auto mb-4 order-lg-2 mt-5">--}}
{{--                    <div class="container text-center">--}}
{{--                        <p class="fs-3"> Your cart is empty </p>--}}
{{--                        <a href="{{url("products")}}" class="btn btn-blue btn-back-to-browsing">--}}
{{--                            Back to browsing--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </main>--}}
{{--    @else--}}
        <main class="container container-small">
            <!--    Items-->
            <section>
                <h1 class="mt-3">Cart</h1>
                <!--    Column names-->
                <div class="row text-muted text-center border-bottom">
                    <div class="offset-lg-2 col-lg-4 d-lg-grid d-none">Product</div>
                    <div class="col col-lg-1">Price</div>
                    <div class="col col-lg-2">Quantity</div>
                    <div class="col col-lg-2">Total</div>
                </div>
                @include("components.cart.cart-item")
                @include("components.cart.cart-item")
                @include("components.cart.cart-item")
            </section>
            <!--    Buttons-->
            <section>
                <h2 class="mt-3 fs-3 text-end">
                    Total: 199.96&dollar;
                </h2>
                <div class="row mt-2">
                    <div class="col ps-4">
                        <a class="btn lower-row-btns btn-blue" href="{{url("products")}}">Back to shop</a>
                    </div>
                    <div class="col text-end">
                        <p><a class="btn rounded btn-blue lower-row-btns checkout-btn"
                              href="{{url("checkout")}}">Checkout </a></p>
                    </div>
                </div>
            </section>
        </main>
{{--    @endunless--}}
@endsection
