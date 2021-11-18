<button
    id="btn-add-tocart-{{$product->id}}"
    onclick="addProductToCart({{$product->id}})"
    type="button" class="{{$class}}" data-bs-toggle="modal"
    data-bs-target="#addtoCartModal-{{$product->id}}">
    Add to cart
</button>
<!--    Modal -->
@include('components.modals.add-to-cart-modal', ['product' => $product])
