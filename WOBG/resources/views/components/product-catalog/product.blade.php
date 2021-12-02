<article>
    <div class="row pb-2 border-bottom">
        <div class="col-md-3 py-3 text-center text-lg-start">
            <div class="ratio ratio-1x1">
                <a href={{route("products.show", [$product->id])}}>
                    @include("components.image", [
                        "class" => "img-fluid",
                        "alt" => "product image $product->name",
                        "path" => $product->mainPhoto->name
                    ])
                </a>
            </div>
        </div>
        <div class="col d-flex flex-column">
            <div class="row pt-3 text-center text-sm-start">
                <div class="col-sm-8">
                    <a href={{route("products.show", [$product->id])}}>
                        <h2 class="fs-5  fw-bold text-truncate">{{$product->name}}</h2>
                    </a>
                </div>
                <div class="col-sm">
                    <p class="fs-5 fw-bold text-sm-end ">@money($product->price)</p>
                </div>
            </div>
            <div class="row d-none d-sm-block">
                <div class="col-sm-8">
                    <p class="description">{{$product->description}}</p>
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
                    @include("components.btn-add-to-cart", [
                        "product" => $product,
                        "class" => "btn btn-blue add-to-cart-btn"
                    ])
                </div>
            </div>
        </div>
    </div>
</article>
