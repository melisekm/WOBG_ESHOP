<div class="col-lg-3">
    <div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
        <a href="/"
           class="d-flex  align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <h1 class="fs-4">Admin dashboard</h1>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="{{route("admin.index")}}"
                   class="nav-link pb-2 @if($active==="home") active aria-current='page' @else text-white @endif">
                    Home
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("admin.products")}}"
                   class="nav-link pb-2 @if($active==="products") active aria-current='page' @else text-white @endif">
                    Products
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("admin.users")}}"
                   class="nav-link pb-2 @if($active==="users") active aria-current='page' @else text-white @endif">
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("admin.categories")}}"
                   class="nav-link pb-2 @if($active==="categories") active aria-current='page' @else text-white @endif">
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("admin.subcategories")}}"
                   class="nav-link pb-2 @if($active==="subcategories") active aria-current='page' @else text-white @endif">
                    Sub Categories
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route("admin.orders")}}"
                   class="nav-link pb-2 @if($active==="orders") active aria-current='page' @else text-white @endif">
                    Orders
                </a>
            </li>
        </ul>
        <hr>
        <a href="{{ route('profile') }}" class="nav-link text-white btn-secondary "> Back to profile </a>
    </div>
</div>
