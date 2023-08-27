@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('products.index') }}" class="btn btn-primary text-white float-right"> Back </a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <h3 class="alert alert-success"> {{ session('success') }} </h3>
                @elseif (session()->has('success'))
                    <h3 class="alert alert-danger"> {{ session('error') }} </h3>
                @endif
                <form action="{{ url('admin/products/' . $product->id . '/update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                    aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seotag-tab" data-bs-toggle="pill" data-bs-target="#seotag"
                                    type="button" role="tab" aria-controls="seotag" aria-selected="false">SEO
                                    Tags</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details-tab" data-bs-toggle="pill" data-bs-target="#details"
                                    type="button" role="tab" aria-controls="details"
                                    aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image-tab" data-bs-toggle="pill" data-bs-target="#image"
                                    type="button" role="tab" aria-controls="image" aria-selected="false">
                                    Image(s)
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color-tab" data-bs-toggle="pill" data-bs-target="#color"
                                    type="button" srole="tab" aria-controls="color" aria-selected="false">
                                    Color(s)
                                </button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="mb-3">
                                    <label for="category_id"> Category </label>
                                    <select name="category_id" id="category_id" class="form-control rounded">
                                        <option value=""> --Select-- </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="name"> Name </label>
                                    <input type="text" name="name" id="name" class="form-control rounded"
                                        value="{{ $product->name }}">
                                    <span class="text-danger"> @error('name')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="slug"> Slug </label>
                                    <input type="text" name="slug" id="slug" class="form-control rounded"
                                        value="{{ $product->slug }}">
                                    <span class="text-danger"> @error('slug')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for=""> Brand </label>
                                    <select name="brand" id="brand" class="form-control rounded">
                                        <option value=""> --Select-- </option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}"
                                                {{ $product->brand == $brand->name ? 'selected' : '' }}>
                                                {{ $brand->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="small_description"> Small Description </label>
                                    <textarea name="small_description" id="description" class="form-control rounded" rows="3">{{ $product->small_description }}</textarea>
                                    <span class="text-danger"> @error('small_description')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="description"> Description </label>
                                    <textarea name="description" id="description" class="form-control rounded" rows="3"> {{ $product->description }} </textarea>
                                    <span class="text-danger"> @error('description')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="seotag" role="tabpanel" aria-labelledby="seotag-tab">
                                <div class="mb-3">
                                    <label for="meta_title"> Meta Title </label>
                                    <input type="text" name="meta_title" id="meta_title" class="form-control rounded"
                                        value="{{ $product->meta_title }}">
                                    <span class="text-danger"> @error('meta_title')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_keyword"> Meta Keyword </label>
                                    <input type="text" name="meta_keyword" id="meta_keyword"
                                        class="form-control rounded" value="{{ $product->meta_keyword }}">
                                    <span class="text-danger"> @error('meta_keyword')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="meta_description"> Meta Description </label>
                                    <textarea name="meta_description" id="meta_description" class="form-control rounded" rows="3"> {{ $product->meta_description }} </textarea>
                                    <span class="text-danger"> @error('meta_description')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="mb-3">
                                    <label for="original_price"> Original Price </label>
                                    <input type="number" name="original_price" id="original_price"
                                        class="form-control rounded" value="{{ $product->original_price }}">
                                    <span class="text-danger"> @error('original_price')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="selling_price"> Selling Price </label>
                                    <input type="number" name="selling_price" id="selling_price"
                                        class="form-control rounded" value="{{ $product->selling_price }}">
                                    <span class="text-danger"> @error('selling_price')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="quantity"> Quantity </label>
                                    <input type="number" name="quantity" id="quantity" class="form-control rounded"
                                        value="{{ $product->quantity }}">
                                    <span class="text-danger"> @error('quantity')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    <label for="trending"> Trending </label>
                                    @if ($product->trending === 1)
                                        <input type="checkbox" name="trending" id="status"
                                            value="{{ $product->trending }}"
                                            {{ $product->trending == 1 ? 'checked' : '' }}>
                                    @else
                                        <input type="checkbox" name="status" id="status">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label for="status"> Status </label>
                                    {{-- @if ($product->status === 1) --}}
                                    <input type="checkbox" name="status" id="status"
                                        value="{{ $product->status == 1 ? '1' : '0' }}" {{ $product->status == 1 ? 'checked' : '' }}>
                                    {{-- @else
                                        <input type="checkbox" name="status" id="status" value="1">
                                    @endif --}}
                                </div>
                            </div>
                            <div class="tab-pane fade" id="image" role="tabpanel" aria-labelledby="image-tab">
                                <div class="mb-3">
                                    <label for="images"> Upload Product Image(s) </label>
                                    <input type="file" name="image[]" id="image" class="form-control rounded"
                                        multiple>
                                    <span class="text-danger"> @error('image')
                                            {{ $message }}
                                        @enderror </span>
                                </div>
                                <div class="mb-3">
                                    @if ($product->productImages)
                                        <div class="row">
                                            @foreach ($product->productImages as $images)
                                                <div class="col-md-2 image-container">
                                                    <div class="removeImage">
                                                        <img src="{{ asset($images->image) }}"alt="Image"
                                                            width="100" height="100" class="me-4 border">
                                                        <button type="button" class="deleteRecord"
                                                            data-id="{{ $images->id }}"
                                                            value="{{ $images->id }}">Remove</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tab-pane fade" id="color" role="tabpanel" aria-labelledby="color-tab">
                                <h1> Add Product Color </h1>
                                <div class="mb-3">
                                    <label for="colors"> Select Color(s) </label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            @forelse ($colors as $color)
                                                <div class="d-flex">
                                                    <input type="checkbox" name="color[]" id="color"
                                                        value="{{ $color->id }}"> {{ $color->name }}
                                                    <input type="number" name="color_quantity[]" id="color_quantity">
                                                </div>
                                            @empty
                                                No Color(s) Available
                                            @endforelse
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered">
                                            <thead>
                                                <tr>
                                                    <td> ID </td>
                                                    <td> Quantity </td>
                                                    <td> Delete </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($product->colorProducts as $colorProduct)
                                                    <tr class="color-product-id">
                                                        <td> {{ $colorProduct->color->name }} </td>
                                                        <td>
                                                            <input type="text"
                                                                class="colorProductQuantity input-group mb-3"
                                                                value="{{ $colorProduct->color_quantity }}">
                                                            <button type="button"
                                                                class="colorProductUpdateBtn btn btn-sm btn-primary"
                                                                value="{{ $colorProduct->id }}">Update</button>
                                                        </td>
                                                        <td>
                                                            <button type="button"
                                                                class="colorProductDeleteBtn btn btn-sm btn-danger"
                                                                value="{{ $colorProduct->id }}">Delete</button>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="3">No Color Available</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-5">
                                <input type="submit" value="Update" id="insertbtn" class="btn btn-primary text-white">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.colorProductUpdateBtn', function() {
                var colorProductId = $(this).val();
                var productId = "{{ $product->id }}";
                var quantity = $(this).closest('.color-product-id').find('.colorProductQuantity').val();
                // var quantity  = $('#colorProductQuantity').val();
                // console.log("Quantity:", quantity);
                // alert(colorProductId);
                // alert(productId);

                if (quantity < 0 || quantity == null || quantity == '') {
                    alert('Quantity must be a positive value.');
                    return false;
                }

                var data = {
                    'product_id': productId,
                    'quantity': quantity
                };

                var url = "{{ url('admin/products/update-color-products') }}/" + colorProductId;

                $.ajax({
                    type: "POST",
                    url: url,
                    data: data,
                    // dataType: "json",
                    success: function(response) {
                        alert(response.message);
                    }
                });
            });

            $(document).on('click', '.colorProductDeleteBtn', function() {
                var colorProductId = $(this).val();
                alert(colorProductId);

                var url = "{{ url('admin/products/delete-color-products') }}/" + colorProductId;

                $.ajax({
                    type: "GET",
                    url: url,
                    // dataType: "json",
                    success: function(response) {
                        $(this).closest('.color-product-id').remove();
                        alert(response.message);
                    }
                });
            });
            $(document).on('click', '.deleteRecord', function() {
                // $('.removeImage').remove();
                var productImageId = $(this).val();
                // var clickedButton = $(this); // Store reference to the button for later use
                alert(productImageId);

                var url = "{{ url('admin/products/delete-product-image') }}/" + productImageId;

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(response) {
                        $(this).remove();
                        alert('Image Remove Successfully');
                    }
                });
            });

        });
    </script>


    {{-- <script>
        $(document).ready(function() {
            $('.deleteRecord').click(function() {
                let imageId = $(this).data('id');
                $.ajax({
                    // route: 'products.delete_image',
                    url: 'admin/products/product-image/'+imageId+'/delete',
                    // url: route('products.image.delete', { id: imageId }),
                    type: 'DELETE',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert(response.message);
                        // You can update the UI or refresh the image list here
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script> --}}
@endsection
