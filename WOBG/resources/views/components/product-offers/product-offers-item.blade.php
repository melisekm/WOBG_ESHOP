<div class="col mt-3 mt-lg-0">
    <a href={{url("products", [$product->id])}}>
        <div class="ratio ratio-1x1">
            <img src="{{asset($product->mainPhotos[2]->path)}}"
                 srcset="{{asset($product->mainPhotos[0]->path)}} 400w,
                          {{asset($product->mainPhotos[1]->path)}} 600w,
                          {{asset($product->mainPhotos[2]->path)}} 900w"
                 sizes="(max-width:576px) 400px, (max-width:991px) 600px, 900px"
                 class="img-fluid" alt="popular game image {{$product->name}}">
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
        @include('components.modals.add-to-cart-modal', ['product' => $product])
    </div>
</div>

