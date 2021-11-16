<div class="col mt-3 mt-lg-0">
    <a href={{route("products.show", [$product->id])}}>
        <div class="ratio ratio-1x1">
            @include("components.image", [
                "class" => "img-fluid",
                "alt" => "popular game image $product->name"
            ])
        </div>
        <p class="text-truncate fs-4 mt-3">{{$product->name}}</p>
    </a>
    <p class="fs-3 fw-bold">@money($product->price)</p>
    <div class="d-grid">
        @include("components.btn-add-to-cart", ["product" => $product])
    </div>
</div>

