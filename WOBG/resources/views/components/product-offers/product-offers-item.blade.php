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
    <p class="fs-3 fw-bold">{{$product->price}}&dollar;</p>
    <div class="d-grid">
        <button type="button" class="btn rounded btn-blue fs-4" data-bs-toggle="modal"
                data-bs-target="#addtoCartModal-{{$product->id}}">
            Add to cart
        </button>
        <!--    Modal -->
        @include('components.add-to-cart-modal', ['product' => $product])
    </div>
</div>

