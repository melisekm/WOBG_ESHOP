<button
    id="btn-add-tocart-{{$product->id}}"
    onclick="addProductToCart({{$product->id}})"
    type="button" class="btn rounded btn-blue fs-4" data-bs-toggle="modal"
    data-bs-target="#addtoCartModal-{{$product->id}}">
    Add to cart
</button>
<!--    Modal -->
@include('components.add-to-cart-modal', ['product' => $product])
{{--@push("scripts")--}}
{{--    <script>--}}
{{--        $("btn-add-to-cart-{{$product->id}}").click(() => {--}}
{{--            console.log("hello")--}}
{{--            $.post("api/cart/{{$product->id}}");--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}


{{--<a class="nav-link" href="{{route("logout")}}" onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">Logout</a>--}}
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        $("btn-add-to-cart-{{$product->id}}").click( (e) => {--}}
{{--            e.preventDefault();--}}
{{--            fetch("/cart/{{$product->id}}")--}}
{{--        });--}}
{{--    </script>--}}
{{--    <script>--}}
{{--        ${"btn-add-to-cart-{{$product->id}}"}.click((e) =>{--}}
{{--            e.preventDefault();--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
