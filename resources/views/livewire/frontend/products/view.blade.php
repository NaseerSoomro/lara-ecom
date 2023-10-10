<div class="py-3 py-md-5">
    @if (session()->has('message'))
        <div class="alert alert-success">

            {{ session('message') }}

        </div>
    @endif
    <div class="container">
        <a href="{{ route('category_products', $category->slug) }}" class="btn btn-primary btn-sm">Go Back</a>
        <div class="row">
            @if ($product_images)
                <div class="col-md-5 mt-3">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            @foreach ($product_images as $key => $product_image)
                                <div class="carousel-item {{ $key == 1 ? 'active' : '' }}">
                                    <div class="bg-white border">
                                        <img src="{{ asset($product_image->image) }}" class="w-100" alt="Img">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            @else
                <div class="col-md-5 mt-3">
                    @foreach ($product_images as $product_image)
                        <div class="bg-white border">
                            <img src="https://cdn.pixabay.com/photo/2018/08/26/23/55/woman-3633737_1280.jpg"
                                class="w-100" alt="Img">
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="col-md-7 mt-3">
                <div class="product-view">
                    <h4 class="product-name">
                        {{ $product->name }}
                    </h4>
                    <hr>
                    <p class="product-path">
                        Home / {{ $category->name }} / {{ $product->name }}
                    </p>
                    <div>
                        <span class="selling-price">{{ $product->selling_price }}</span>
                        <span class="original-price">{{ $product->original_price }}</span>
                    </div>
                    <div>
                        @if ($product->colors)
                            @foreach ($product->colors as $color_product)
                                <input type="radio" name="colorSelection" value="{{ $color_product->pivot->id }}"
                                    wire:click="colorSelected({{ $color_product->pivot->id }})">
                                @if ($color_product->pivot->color_id == 1)
                                    <span> Red </span>
                                @elseif ($color_product->pivot->color_id == 2)
                                    <span> Blue </span>
                                @elseif ($color_product->pivot->color_id == 3)
                                    <span> Green </span>
                                @elseif ($color_product->pivot->color_id == 4)
                                    <span> Yellow </span>
                                @elseif ($color_product->pivot->color_id == 5)
                                    <span> Cyan </span>
                                @elseif ($color_product->pivot->color_id == 6)
                                    <span> Magento </span>
                                @endif
                            @endforeach
                            <div>
                                @if ($this->productColorQuantity == 'Out of Stock')
                                    <label class="btn btn-sm py-1 m-1 text-white label-stock bg-danger">
                                        Out of Stock
                                    </label>
                                @elseif ($this->productColorQuantity)
                                    <label class="btn btn-sm py-1 m-1 text-white label-stock bg-success">
                                        In Stock
                                    </label>
                                    </label>
                                @endif
                            </div>
                        @else
                            @if ($product->quantity)
                                <label class="btn btn-sm py-1 m-1 text-white label-stock bg-success">
                                    In Stock
                                </label>
                            @else
                                <label class="btn btn-sm py-1 m-1 text-white label-stock bg-danger">
                                    Out of Stock
                                </label>
                            @endif
                        @endif
                    </div>
                    <div class="mt-2">
                        <div class="input-group">
                            <span class="btn btn1" wire:click="quantityDecrement()"><i class="fa fa-minus"></i></span>
                            <input type="text" wire:model="quantityCount" value="{{ $this->quantityCount }}"
                                class="input-quantity" readonly />
                            <span class="btn btn1" wire:click="quantityIncrement()"><i class="fa fa-plus"></i></span>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button class="btn btn1" wire:click="addToCart({{ $product->id }})">
                            <span wire:loading.remove wire:target="addToCart">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </span>
                            <span wire:loading wire:target="addToCart">
                                Adding...
                            </span>
                        </button>
                        <button wire:click="addToWishlist({{ $product->id }})" class="btn btn1">
                            <span wire:loading.remove wire:target="addToWishlist">
                                <i class="fa fa-heart"></i> Add To Wishlist
                            </span>
                            <span wire:loading wire:target="addToWishlist">
                                Adding...
                            </span>
                        </button>
                    </div>
                    <div class="mt-3">
                        <h5 class="mb-0">Small Description</h5>
                        <p>
                            {!! $product->small_description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card">
                    <div class="card-header bg-white">
                        <h4>Description</h4>
                    </div>
                    <div class="card-body">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
