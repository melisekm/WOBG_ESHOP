<div class="form-check">
    <input class="form-check-input"
           @if(in_array($category->id, $filters)) checked
           @endif name={{$name}} type="checkbox"
           value="{{$category->id}}"
           id="{{$category->name}}">
    <label class="form-check-label" for="{{$category->name}}">
        {{$category->name}}
    </label>
</div>
