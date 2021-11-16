<div class="row">
    <div class="col-6 col-md-5">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="shippingRadios"
                   id="{{$id}}"
                   value="shippingStandard" {{!empty($checked) ? "checked=checked" : ""}}>
            <label class="form-check-label" for="shippingStandard">
                {{$label}}
            </label>
        </div>
    </div>
    @if(!empty($price))
        <div class="col">
            {{$price}}
        </div>
    @endif
</div>
