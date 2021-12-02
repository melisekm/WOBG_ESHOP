<a id="lightbox-{{$loop->index}}" href="{{asset(config('app.image_path') . $path)}}" data-lightbox="mygallery"
   data-title="{{$alt}}">
    <div class="ratio ratio-1x1 product-gallery">
        @include('components.image',['path' => $path, 'alt' => $alt, 'class' => $class])
    </div>
</a>
