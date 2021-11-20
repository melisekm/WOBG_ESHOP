@extends("layout.app")
@push("styles")
    <link rel="stylesheet" href="{{asset("css/checkout.css")}}">
@endpush
@section('title', 'WOBG - Review')
@section("content")
    <main class="container">
        @include("components.checkout.steps", ["step" => 4])
        <div class="m-auto text-center ">
            <h1>Thank you for your order!</h1>
            <div><i class="fas fa-check-circle fa-8x"></i></div>

            <div class="darkRectangle p-3 my-3" id="summary-rectangle">
                <div class="text-center">
                    <h2 class="fw-bold">Order Successful</h2>
                    <p>We sent e-mail you with order confirmation and order details. We’ll send you a shipping
                        confirmation email as soon as your order ships.</p>
                </div>
            </div>

        </div>
        <div class="mb-3 text-center">
            <a href="{{route("products.index")}}" class="btn-lg btn-secondary summary-btns"> Return to Store </a>
        </div>

    </main>

@endsection
