@extends("layout.partials.admin")
@section('title', "Admin dashboard: Products")
@section("admin-content")
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h2>Products</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <a href="{{route('products.create') }}" class="btn btn-primary mb-2">Create Product</a>
                <div class="table-responsive table-bordered ">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model_collection as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>
                                    <a class="text-decoration-underline"
                                       href="{{route("products.show",[$product->id])}}">
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td> @money($product->price)</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{route("products.edit", [$product->id])}}"
                                           class="btn btn-primary">Edit</a>&nbsp;&nbsp;
                                        <form action="{{route('products.destroy', [$product->id])}}" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            @csrf
                                            <input type="submit" class="btn btn-danger" value="Delete"/>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('components.product-catalog.pagination', ['paginator' => $model_collection])

    </div>
@endsection
