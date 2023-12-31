@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @foreach ($sliders as $key => $slider)
                <div class="carousel-item {{ $key == 1 ? 'active' : '' }}">
                    <img src="{{ asset($slider->image) }}" class="d-block w-100" alt="..." height="500">
                    <div class="carousel-caption d-none d-md-block">
                        <div class="custom-carousel-content">
                            <h1>
                                <span>{!! $slider->title !!}</span>
                            </h1>
                            <p>
                                {!! $slider->description !!}
                            </p>
                            <div>
                                <a href="#" class="btn btn-slider">
                                    Get Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <div class="py-5 bg-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <h4> Trending Products </h4>
                    <div class="underline"></div>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit quam sit quos doloremque animi
                        possimus consectetur, voluptatum accusantium provident tempore enim, fugit quaerat sed. Rem magnam
                        possimus asperiores dolorum quasi.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5 bg-white">
        <div class="container">
            @if ($trendingProducts)
                <div class="row">
                    <div class="owl-carousel owl-theme trending-product">
                        @foreach ($trendingProducts as $productItem)
                            <div class="item">
                                <div class="col-md-12">
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
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                No Proudct Available {{ $category->name ?? '--' }}
            @endif
        </div>
    </div>

@endsection

@section('script')
<script>
    $('.trending-product').owlCarousel({
        loop:true,
    margin:10,
    nav:true,
    responsive:{
    0:{
    items:1
    },
    600:{
    items:3
    },
    1000:{
        items:5
    }
    }
})
</script>
@endsection
