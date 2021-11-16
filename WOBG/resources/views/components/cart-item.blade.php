<div class="row ps-4 ps-lg-0 my-2 align-items-center text-lg-center border-lg-bottom pb-lg-2">
    <div class="col-4 col-lg-2">
        <a href={{route("products.show", [$product->id])}}>
            @include("components.image", ["class"=>"img-fluid","alt"=>"$product->name image"])
        </a>
    </div>

    <div class="col-6 col-lg-4 text-truncate">
        <a href={{route("products.show", [$product->id])}}>
            {{$product->name}}
        </a>
    </div>

    <div class="col-1 d-lg-block d-none">
        @money($product->price)
    </div>

    <div class="col-2 d-lg-block d-none">
        <ul class="pagination justify-content-center quantity my-auto" aria-label="Quantity selector">
            <li class="page-item">
                <form action="{{route("cart.decrement", [$product->id])}}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button class="page-link"><i class="fas fa-minus"></i></button>
                </form>
            </li>
            <li class="page-item">
                <label class="d-none" for="quantity1"></label>
                <input disabled name="quantity" type="text" class="form-control" id="quantity1"
                       value="{{$product->quantity}}">
            </li>
            <li class="page-item">
                <form action="{{route("cart.increment", [$product->id])}}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button class="page-link"><i class="fas fa-plus"></i></button>
                </form>
            </li>
        </ul>
    </div>

    <div class="col-2 d-lg-block d-none">
        @money($product->total_price)
    </div>

    <div class="col text-end">
        <form method="POST" action="{{route("cart.destroy", [$product->id])}}">
            @csrf
            @method("DELETE")
            <button type="submit" class="btn btn-link black-link"><i class="fas fa-trash-alt"></i></button>
        </form>
    </div>
</div>
<div class="row d-lg-none d-flex text-center py-2 border-bottom">
    <div class="col my-auto">
        @money($product->price)
    </div>
    <div class="col">
        <ul class="pagination justify-content-center quantity my-auto" aria-label="Quantity selector">
            <li class="page-item">
                <form action="{{route("cart.decrement", [$product->id])}}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button class="page-link"><i class="fas fa-minus"></i></button>
                </form>
            </li>
            <li class="page-item input">
                <label class="d-none" for="quantity2"></label>
                <input type="text" class="form-control" id="quantity2" value="{{$product->quantity}}">
            </li>
            <li class="page-item">
                <form action="{{route("cart.increment", [$product->id])}}" method="POST">
                    @csrf
                    @method("PATCH")
                    <button class="page-link"><i class="fas fa-plus"></i></button>
                </form>
            </li>
        </ul>
    </div>
    <div class="col my-auto">
        @money($product->total_price)
    </div>
</div>
