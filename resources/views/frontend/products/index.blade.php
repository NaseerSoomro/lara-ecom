@extends('layouts.app')

@section('title')
    {{ $category_products->meta_title }}
@endsection
@section('meta keyword')
    {{ $category_products->meta_keyword }}
@endsection
@section('meta description')
    {{ $category_products->meta_description }}
@endsection

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Our Products</h4>
                </div>
                <livewire: frontend.products.index $products="$products" $category_products="$category_products"/>
            </div>
        </div>
    </div>
@endsection
