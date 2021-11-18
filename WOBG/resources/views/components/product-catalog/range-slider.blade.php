<div class="form-label fs-5 fw-bold mt-3 pt-3 border-top">
    <label for="{{$label}}">
        {{$name}}
    </label>
</div>
<input id="{{$label}}" type="text" class="slider" value=""
       data-slider-min="{{$min}}"
       data-slider-max="{{$max}}" data-slider-step="{{$step}}"
       data-slider-value="{{$value}}"/>
<span class="fs-6" id="{{$id}}"></span>
