@extends("layout.partials.admin")
@section('title', "Admin dashboard: Edit $product->name")
@section("admin-content")
    <div class="col-lg-9">
        <div class="card">
            <div class="card-header">
                <h2>Edit Product</h2>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{route('products.show', $product->id)}}" class="btn btn-secondary my-2">View product</a>
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
                        <label for="name">Name*</label>
                        <input type="text" name="name" id="name" class="form-control"
                               value="{{ old('name', $product->name) }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description*</label>
                        <textarea name="description" id="description" cols="30" rows="10"
                                  class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="publisher">Publisher*</label>
                        <input type="text" name="publisher" id="publisher" class="form-control"
                               value="{{ old('publisher', $product->publisher) }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="price">Price*</label>
                        <input type="number" name="price" id="price" min=".01" step=".01" class="form-control"
                               value="{{ old('price', $product->price) }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="min_age">Minimum age*</label>
                        <input type="number" name="min_age" id="min_age" step="1" class="form-control"
                               value="{{ old('min_age', $product->min_age)}}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="min_players">Minimum players*</label>
                        <input type="number" name="min_players" id="min_players" step="1" class="form-control"
                               value="{{ old('min_players', $product->min_players) }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="max_players">Maximum players*</label>
                        <input type="number" name="max_players" id="max_players" step="1" class="form-control"
                               value="{{ old('max_players', $product->max_players) }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="min_play_time">Play time in minutes*</label>
                        <input type="number" name="min_play_time" id="min_play_time" step="5" class="form-control"
                               value="{{ old('min_play_time', $product->min_play_time) }}">
                    </div>
                    <div class="form-group mb-2">
                        <label for="release_date">Release date*</label>
                        <input type="number" name="release_date" id="release_date" step="1" class="form-control"
                               value="{{ old('release_date', $product->release_date) }}">
                    </div>
                    <div class="form-group">
                        <label for="language">Language*</label>
                        <input type="text" name="language" id="language" class="form-control"
                               value="{{ $product->language }}">
                    </div>

                    <div class="form-group">
                        <label for="includes">Includes, separate each with new line*</label>
                        <textarea name="includes" id="includes" cols="30" rows="10"
                                  class="form-control">{{ old('includes', $product->includes) }}</textarea>
                    </div>

                    <h3>Photos</h3>
                    <div class="row">
                        @foreach($product->photos as $photo)
                            <div class="col-2 text-center mb-2">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="ratio ratio-1x1">
                                            @include("components.image", [
                                                 "path" => $photo->name,
                                                 "class" => "img-thumbnail",
                                                 "alt"=>'Photo' . ($loop->index+1)
                                            ])
                                        </div>
                                        <input type="hidden" name="photos[]" value="{{ $photo->id }}">
                                        @if($photo != $product->mainPhoto)
                                            <button type="button" class="btn btn-danger btn-sm mt-2"
                                                    onclick="$(this).parent().parent().parent().remove()">Delete
                                            </button>
                                        @else
                                            @if($photo == $product->mainPhoto)
                                                <span class="badge bg-success">Main</span>
                                            @endif
                                        @endif
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="photos">Add photos</label>
                        <input type="file" name="photosNew[]" id="photos" class="form-control" multiple>
                    </div>
                    <div class="form-group mb-2">
                        <label for="category">Category*</label>
                        <select name="category" id="category" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                        @if ($product->category->id === $category->id) selected @endif>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <label for="subcategory">Subcategory*</label>
                        <select name="subcategory" id="subcategory" class="form-control">
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}"
                                        @if($product->subcategory->id === $subcategory->id) selected @endif>
                                    {{ $subcategory->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    Fields marked with * are required.
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
