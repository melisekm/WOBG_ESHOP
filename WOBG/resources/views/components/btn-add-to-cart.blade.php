<button
    id="btn-add-tocart-{{$product->id}}"
    onclick="addProductToCart({{$product->id}})"
    type="button" class="btn rounded btn-blue fs-4" data-bs-toggle="modal"
    data-bs-target="#addtoCartModal-{{$product->id}}">
    Add to cart
</button>
<!--    Modal -->
@include('components.add-to-cart-modal', ['product' => $product])
