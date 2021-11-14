<div class="modal fade" id="addtoCartModal" tabindex="-1" aria-labelledby="addtoCartModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title fs-5" id="addtoCartModalLabel">Added to cart</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{asset($product->mainPhotos[2]->path)}}"
                                 srcset="{{asset($product->mainPhotos[0]->path)}} 400w,
                                        {{asset($product->mainPhotos[1]->path)}} 600w,
                                        {{asset($product->mainPhotos[2]->path)}} 900w"
                                 sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                                 class="img-fluid product-img" alt="product {{$product->name}} image">
                        </div>
                        <div class="col-md">{{$product->name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 text-end">1x</div>
                        <div class="col-md text-end">{{$product->price}}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Back to Browsing
                </button>
                <a class="btn btn-blue" href="{{url("cart")}}">View Shopping Cart </a>
            </div>
        </div>
    </div>
</div>
