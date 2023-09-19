<div>
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
            No Proudct Available {{ $category_products->name ?? '--' }}
        @endforelse
    </div>
</div>
