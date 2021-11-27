@extends("layout.partials.admin")
@section('title', "Admin dashboard: Edit $product->name")
@section("admin-content")
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h2>Edit Product</h2>
            </div>
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="10"
                                  class="form-control">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher', $product->publisher) }}">
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" min=".01" step=".01" class="form-control"
                               value="{{ $product->price }}">
                    </div>
                    <div class="form-group">
                        <label for="image-main">Main Photo</label>
                        <input type="file" name="mainPhoto" id="image-main" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image-play">Play Photo</label>
                        <input type="file" name="playPhoto" id="image-play" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="image-back">Back Photo</label>
                        <input type="file" name="backPhoto" id="image-back" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if ($product->category->id === $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="subcategory">Subcategory</label>
                        <select name="subcategory" id="subcategory" class="form-control">
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                        @if($product->subcategory->id === $subcategory->id) selected>
                                    {{ $subcategory->name }}@endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                        <div class="col text-end">
                            <a href="{{ route('admin.products') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
