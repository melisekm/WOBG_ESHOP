<div class="row">
    <div class="col-6 col-md-5">
        <div class="form-check">
            <input name="shippingGroup" class="form-check-input" type="radio"
                   id="{{$label}}"
                   value="{{$label}}" @if($loop->first) checked @endif>
            <label onclick="updateShippingMethod({{$price}},{{$totalPrice}})" class="form-check-label" for="{{$label}}">
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
