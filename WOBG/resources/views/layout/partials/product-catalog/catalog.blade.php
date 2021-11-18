<div class="col-lg-9 py-lg-0 order-links">
    <section>
        <h1 class="my-3 display-6">Board Games</h1>
        @include('components.product-catalog.order-links')
        <!--    Products-->
        @if(count($products) === 0)
            <div class="fs-2 mt-4 text-center">
                <p>No results found</p>
                <a href="{{route("products.index")}}" class="btn mt-5 btn-blue btn-back-to-browsing">
                    Back to browsing
                </a>
            </div>
        @else
            <div class="tab-content ps-xl-3" id="pills-tabContent">
                <div class="tab-pane fade show active " id="pills-recommended" role="tabpanel"
                     aria-labelledby="pills-recommended-tab">
                    @foreach($products as $product)
                        @include("components.product-catalog.product", ["product" => $product])
                    @endforeach
                </div>
            </div>
        @endif
    </section>
    @include('components.product-catalog.pagination')
</div>
