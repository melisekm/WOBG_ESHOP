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
            @include("product-catalog.filters")
            <!--    Catalog-->
            @include("product-catalog.catalog")
        </div>
    </main>
@endsection
