<!--    Ordering-->
<ul class="nav nav-pills mb-3 d-none d-xl-flex" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
        <a id="recommended"
           class="nav-link link-dark sort-option @if($filters["sortOption"] == "recommended") active @endif">
            Recommended
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a id="top"
           class="nav-link link-dark sort-option @if($filters["sortOption"] === "top") active @endif">
            Top Sellers
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a id="recent"
           class="nav-link link-dark sort-option @if($filters["sortOption"] === "recent") active @endif">
            Most Recent
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a id="price_desc"
           class="nav-link link-dark sort-option @if($filters["sortOption"] === "price" && $filters["order"] == "desc") active @endif">
            Highest Price</a>

    </li>
    <li class="nav-item" role="presentation">
        <a id="price_asc"
           class="nav-link link-dark sort-option @if($filters["sortOption"] === "price" && $filters["order"] == "asc") active @endif">
            Lowest Price
        </a>
    </li>
</ul>
<!--    Dropdown ordering-->
<div class="d-xl-none my-3">
    <select class="form-select" id="mobile_sort" aria-label="Mobile order select">
        <option @if($filters["sortOption"] === "recommended") selected @endif value="recommended">
            Order by
            Recommended
        </option>
        <option @if($filters["sortOption"] === "top") selected @endif value="top">Order by Top
            Sellers
        </option>
        <option @if($filters["sortOption"] === "recent") selected @endif value="recent">Order by
            Most
            Recent
        </option>
        <option @if($filters["sortOption"] === "price" && $filters["order"] == "desc") selected
                @endif value="price_desc">Order by
            Highest Price
        </option>
        <option @if($filters["sortOption"] === "price" && $filters["order"] == "asc") selected
                @endif value="price_asc">Order by
            Lowest Price
        </option>
    </select>
</div>
