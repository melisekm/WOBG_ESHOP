<section>
    <h2 class="mb-3">{{$title}}</h2>
    <div class="{{$row_class}}">
        @foreach($products as $product)
            @include('components.product-offers.product-offers-item', ['product' => $product])
        @endforeach
    </div>
</section>
