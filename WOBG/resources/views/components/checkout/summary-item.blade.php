<div class="row py-3 align-items-center border-bottom">
    <div class="col-3">
        <a href={{route("products.show", [$product->id])}}>
            @include("components.image", [
                "class" => "img-fluid product-img",
                "alt" => "product image $product->name",
                "path" => $product->mainPhoto->name
            ])
        </a>
    </div>
    <div class="col text-truncate">
        <a class="text-white" href="{{route("products.show", [$product->id])}}"> {{$product->name}} </a>
    </div>
    <div class="col-1">{{$product->quantity}}x</div>
    <div class="col-3 text-end">@money($product->price)</div>
</div>
