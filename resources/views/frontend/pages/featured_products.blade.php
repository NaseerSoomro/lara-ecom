@extends('layouts.app')

@section('title', 'Featured Products')

@section('content')


    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4> Featured Products </h4>
                    <div class="underline" style="margin: auto; width:140px"></div>
                </div>
            </div>
        </div>
    </div>
    {{-- @dd($newArrivals) --}}
    <div class="py-5 bg-white">
        <div class="container">
            @if ($featuredProducts)
                <div class="row">
                    @foreach ($featuredProducts as $productItem)
                        <div class="col-md-3">
                            <div class="product-card">
                                <div class="product-card-img">
                                    @if (count($productItem->productImages) > 0)
                                        <a
                                            href="{{ url('/collections' . '/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                            <img src="{{ asset($productItem->productImages[0]->image) }}"
                                                alt="{{ $productItem->name }}">
                                        </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $productItem->brand }}</p>
                                    <h5 class="product-name">
                                        <a
                                            href="{{ url('/collections' . '/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                            {{ $productItem->name }}
                                        </a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">${{ $productItem->selling_price }}</span>
                                        <span class="original-price">${{ $productItem->original_price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                No Featured Proudct Available {{ $category->name ?? '--' }}
            @endif
        </div>
        <div class="text-center">
            <a href="{{ route('collections') }}" class="btn btn-warning btn-sm"> View More </a>
        </div>
    </div>

@endsection
