<div class="modal fade" id="addtoCartModal-{{$product->id}}" tabindex="-1"
     aria-labelledby="addtoCartModal-{{$product->id}}Label"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title fs-5" id="addtoCartModal-{{$product->id}}Label">Added to cart</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            @include("components.image", [
                                    "class" => "img-fluid product-img",
                                    "alt" => "product $product->name image",
                                    "path" => $product->mainPhoto->path
                            ])
                        </div>
                        <div class="col-md">{{$product->name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 text-end">1x</div>
                        <div class="col-md text-end">@money($product->price)</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Back to Browsing</button>
                <a class="btn btn-blue" href="{{url("cart")}}">View Shopping Cart </a>
            </div>
        </div>
    </div>
</div>
