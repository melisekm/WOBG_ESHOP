<div class="row">
    <div class="col-6 col-md-5">
        <div class="form-check">
            <input name="shippingGroup" class="form-check-input" type="radio"
                   id="{{$id}}"
                   value="{{$id}}" {{!empty($checked) ? "checked=checked" : ""}}>
            <label onclick="updateShippingMethod({{$price}},{{$totalPrice}})" class="form-check-label" for="{{$id}}">
                {{$label}}
            </label>
        </div>
    </div>
    @if(!empty($price))
        <div class="col">
            @money($price)
        </div>
    @endif
</div>
