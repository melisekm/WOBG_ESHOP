@extends("layout.partials.admin")
@section('title', "Admin dashboard")
@section("admin-content")
    <div class="col-lg-7">
        <p class="fs-3">
            Welcome to the admin dashboard section. </p>
        <p> Here you can view and edit products with their categories. </p>
        <p> You can also add new products and categories. </p>
        <p>We currently sell <strong>{{$stats["products"]}}</strong> products.</p>
        <p>Products belong to <strong>{{$stats["categories"]}}</strong> categories.</p>
        <p>Some products also belong to one of <strong>{{$stats["subcategories"]}}</strong> subcategories.</p>
        <p><strong>{{$stats["users"]}}</strong> users are registered.</p>
        <p><strong>{{$stats["orders"]}}</strong> orders were created.</p>
        <p><strong>{{$stats["orderProducts"]}}</strong> products have been bought.</p>
        <p><strong>{{$stats["usersHaveCart"]}}</strong> user(s) have <strong>{{$stats["productsInCart"]}}</strong>
            product(s) in the cart right <strong>now</strong>.</p>
    </div>
@endsection
