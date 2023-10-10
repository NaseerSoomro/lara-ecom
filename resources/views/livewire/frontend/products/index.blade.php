<div>
    <div class="row">
        <div class="col-md-3">
            @if ($category->brands)
                <div class="card">
                    <div class="card-header">
                        <h4> Brands </h4>
                    </div>
                    @foreach ($category->brands as $brand)
                        <div class="card-body">
                            <input type="checkbox" wire:model="brandList" value="{{ $brand->name }}"> {{ $brand->name }}
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="card mt-3">
                <div class="card-header">
                    <h4> Price </h4>
                </div>
                <div class="card-body">
                    <input type="radio" name="sortByPrice" wire:model="sortByPrice" value="high-to-low"> High To Low
                </div>
                <div class="card-body">
                    <input type="radio" name="sortByPrice" wire:model="sortByPrice" value="low-to-high"> Low To High
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                @forelse ($products as $productItem)
                    <div class="col-md-3">
                        <div class="product-card">
                            <div class="product-card-img">
                                @if ($productItem->quantity)
                                    <label class="stock bg-success">In Stock</label>
                                @else
                                    <label class="stock bg-danger">Out of Stock</label>
                                @endif

                                @if (count($productItem->productImages) > 0)
                                    {{-- @foreach ($productItem->productImages as $productImage) --}}
                                    <a
                                        href="{{ url('/collections' . '/' . $productItem->category->slug . '/' . $productItem->slug) }}">
                                        <img src="{{ asset($productItem->productImages[0]->image) }}"
                                            alt="{{ $productItem->name }}">
                                    </a>
                                    {{-- @endforeach --}}
                                @else
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcR7XYSujNj5GA_IXvG16BY7rgc3V868_Gu6SA&usqp=CAU"
                                        alt="Image">
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
                @empty
                    No Proudct Available {{ $category->name ?? '--' }}
                @endforelse
            </div>
        </div>
    </div>

</div>
