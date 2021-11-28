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
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea name="description" id="description" cols="30" rows="10"
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher*</label>
                        <input type="text" name="publisher" id="publisher" class="form-control" value="{{ old('publisher') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="price">Price*</label>
                        <input type="number" name="price" id="price" min=".01" step=".01" class="form-control"
                               value="{{ old('price') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="min_age">Minimum age*</label>
                        <input type="number" name="min_age" id="min_age" step="1" class="form-control"
                               value="{{ old('min_age')}}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="min_players">Minimum players*</label>
                        <input type="number" name="min_players" id="min_players" step="1" class="form-control"
                               value="{{ old('min_players') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="max_players">Maximum players*</label>
                        <input type="number" name="max_players" id="max_players" step="1" class="form-control"
                               value="{{ old('max_players') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="min_play_time">Play time in minutes*</label>
                        <input type="number" name="min_play_time" id="min_play_time" step="5" class="form-control"
                               value="{{ old('min_play_time') }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="release_date">Release date*</label>
                        <input type="number" name="release_date" id="release_date" step="1" class="form-control"
                               value="{{ old('release_date') }}">
                    </div>
                    <div class="form-group">
                        <label for="language">Language*</label>
                        <input type="text" name="language" id="language" class="form-control" value="{{ old('language') }}">
                    </div>

                    <div class="form-group">
                        <label for="includes">Includes, separate each with new line*</label>
                        <textarea name="includes" id="includes" cols="30" rows="10"
                                  class="form-control">{{ old('includes') }}</textarea>
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
