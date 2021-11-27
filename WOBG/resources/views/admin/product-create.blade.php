@extends("layout.partials.admin")
@section('title', "Admin dashboard: Create product")
@section("admin-content")
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h2>Create product</h2>
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
                <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea required name="description" id="description" cols="30" rows="10"
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher*</label>
                        <input required type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="price">Price*</label>
                        <input required type="number" name="price" id="price" min=".01" step=".01" class="form-control"
                               value="{{ old('price') }}">
                    </div>
                    <h3>Photos</h3>

                    <div class="form-group">
                        <label for="image-main">Main Photo</label>
                        <input type="file" name="mainPhoto" id="image-main" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="photos">Other photos</label>
                        <input type="file" name="photosNew[]" id="photos" class="form-control" multiple>
                    </div>
                    <div class="form-group mb-2">
                        <label for="category">Category*</label>
                        <select name="category" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="subcategory">Subcategory*</label>
                        <select name="subcategory" id="subcategory" class="form-control">
                            @foreach($subcategories as $subcategory)
                                <option
                                    value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    Fields marked with * are required.
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Create</button>
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
