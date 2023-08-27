

@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('products.index') }}" class="btn btn-primary text-white float-right"> Back </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name"> Name: </label>
                            <span> {{ $product->name }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slug"> Slug: </label>
                            <span> {{ $product->slug }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="small_description"> Small Description: </label>
                            <span> {{ $product->small_description }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="description"> Description: </label>
                            <span> {{ $product->description }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h3> SEO Tags </h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="meta_title"> Meta Title: </label>
                            <span> {{ $product->meta_title }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="meta_keyword"> Meta Keyword: </label>
                            <span> {{ $product->meta_keyword }} </span>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="meta_description"> Meta Description: </label>
                            <span> {{ $product->meta_description }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h3> Details </h3>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="original_price"> Original Price: </label>
                            <span> {{ $product->original_price }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="selling_price"> Selling Price: </label>
                            <span> {{ $product->selling_price }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="quantity"> Quantity: </label>
                            <span> {{ $product->quantity }} </span>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status"> Status: </label>
                            <span> {{ $product->status }} </span>
                            {{-- @if ($proudct->status )
                                <input type="checkbox" name="status" id="status"
                                    {{ $proudct->status == '1' ? 'checked' : '' }}>
                            @else
                                <input type="checkbox" name="status" id="status">
                            @endif --}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="trending"> Trending: </label>
                            <span> {{ $product->trending }} </span>
                            {{-- @if ($proudct->status )
                                <input type="checkbox" name="status" id="status"
                                    {{ $proudct->status == '1' ? 'checked' : '' }}>
                            @else
                                <input type="checkbox" name="status" id="status">
                            @endif --}}
                        </div>
                        <div class="col-md-6 mb-3">
                            <h3> Product Image(s) </h3>
                        </div>
                        <div class="col-md-12 mb-5">
                            <label for="image"> Image </label>
                            <input type="file" name="image" id="image" class="form-control rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection