<div class="col-lg-3">
    <aside class="mod-collapse">
        <div class="d-lg-none">
            <button class="btn btn-blue" type="button" data-bs-toggle="collapse"
                    data-bs-target="#filtersCollapse" aria-expanded="false" aria-controls="filtersCollapse">
                <i class="fas fa-sliders-h"></i>&nbsp;FILTERS
            </button>
        </div>
        <div class="collapse" id="filtersCollapse">
            <div class="darkRectangle mt-lg-0 mt-4 pb-3">
                <div class="ps-3 py-2">
                    <div class="text-end">
                        <a href="javascript:void(0)" onclick="window.location.href = url.href"
                                class="btn btn-blue border-0 bg-transparent pe-2 btn-sm">
                            <i class="fa fa-check"></i> Apply filters
                        </a>
                        <a href="{{route("products.index")}}"
                           class="btn btn-blue border-0 bg-transparent pe-2 btn-sm">
                            <i class="fas fa-times-circle"></i> Cancel filters
                        </a>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-11">
                                <div class="form-label fs-5 fw-bold">
                                    <label for="priceRange">
                                        Price
                                    </label>
                                </div>
                                <input id="priceRange" type="text" class="slider" value=""
                                       data-slider-min="0"
                                       data-slider-max="100" data-slider-step="5"
                                       data-slider-value="[{{$filters["price"]["min"]}},{{$filters["price"]["max"]}}]"/>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <span class="fs-6" id="priceMin"></span>
                                </div>
                                <div class="col text-end">
                                    <span class="fs-6" id="priceMax"></span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-11">
                            @include("components.product-catalog.range-slider", [
                                "label"=>"ageRange", "name" => "Minimum Age",
                                'min' => "0", "max"=>"18", "step" => "1",
                                "value" => $filters["minAge"], "id" => "minAge"
                            ])
                            @include("components.product-catalog.range-slider", [
                                "label"=>"playerRange", "name" => "Minimum players",
                                'min' => "0", "max"=>"10", "step" => "1",
                                "value" => $filters["minPlayers"], "id" => "minPlayers"
                            ])
                            @include("components.product-catalog.range-slider", [
                                "label"=>"playTimeRange", "name" => "Play Time",
                                'min' => "0", "max"=>"120", "step" => "1",
                                "value" => $filters["minPlayTime"], "id" => "minPlayTime"
                            ])

                            <div class="fs-5 fw-bold mt-3 py-3 border-top">Main Category</div>
                            @foreach($filters["categories"] as $category)
                                @include("components.product-catalog.category-checkbox",[
                                    "category" => $category, "name"=>"categories",
                                     "filters" => $filters["selectedCategories"]
                                ])
                            @endforeach
                            <div class="fs-5 fw-bold mt-3 py-3 border-top">Sub Category</div>
                            @foreach($filters["subcategories"] as $subcategory)
                                @include("components.product-catalog.category-checkbox",[
                                    "category" => $subcategory, "name"=>"subcategories",
                                     "filters" => $filters["selectedSubCategories"]
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</div>



@push("scripts")
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"
            integrity="sha512-f0VlzJbcEB6KiW8ZVtL+5HWPDyW1+nJEjguZ5IVnSQkvZbwBt2RfCBY0CBO1PsMAqxxrG4Di6TfsCPP3ZRwKpA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset("js/product_catalog/sliders.js")}}"></script>
    <script src="{{asset("js/product_catalog/filters.js")}}"></script>
@endpush
