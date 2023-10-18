<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            @if (count($cartItems) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="shopping-cart">

                            <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Products</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Price</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Quantity</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Total</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <h4>Remove</h4>
                                    </div>
                                </div>
                            </div>
                            @forelse ($cartItems as $cartItem)
                                @if ($cartItem->product)
                                    <div class="cart-item">
                                        <div class="row">
                                            <div class="col-md-4 my-auto">
                                                <a
                                                    href="{{ url('collections/' . $cartItem->product->category->slug . '/' . $cartItem->product->slug) }}">
                                                    <label class="product-name">
                                                        @if ($cartItem->product->productImages)
                                                            <img src="{{ asset($cartItem->product->productImages[0]->image) }} "style="width: 50px; height: 50px"
                                                                alt="">
                                                        @else
                                                            <img src="https://www.google.com/imgres?imgurl=x-raw-image%3A%2F%2F%2F691650ab2cfdead2e1377aa7064a77c91b50c960014e265d529a024d198aeb6f&tbnid=0ur9LKtQFmmT_M&vet=12ahUKEwiJ1Jyp8OqBAxW3mycCHfG4ACQQMygfegUIARCdAQ..i&imgrefurl=https%3A%2F%2Fwww.fundaofwebit.com%2Fecommerce-template%2Fproducts-view-template-design-using-html-css-bootstrap5&docid=5ppuXgN3J-6tXM&w=1252&h=647&q=ecommerce%20cart%20%2F%20wishlist%20design%20by%20funda%20web%20it&client=firefox-b-d&ved=2ahUKEwiJ1Jyp8OqBAxW3mycCHfG4ACQQMygfegUIARCdAQ"
                                                                style="width: 50px; height: 50px" alt="">
                                                        @endif
                                                        {{ $cartItem->product->name }}
                                                        @if ($cartItem->color_products)
                                                            <br>
                                                            @if ($cartItem->color_products->color)
                                                                <span> with color
                                                                    {{ $cartItem->color_products->color->name }}
                                                                </span>
                                                            @endif
                                                        @endif
                                                    </label>
                                                </a>
                                            </div>
                                            <div class="col-md-2 my-auto">
                                                <label class="price"> ${{ $cartItem->product->selling_price }} </label>
                                            </div>
                                            <div class="col-md-2 col-7 my-auto">
                                                <div class="quantity">
                                                    <div class="input-group">
                                                        <button type="button" wire:loading.attr="disabled"
                                                            wire:click="decreaseQuantity({{ $cartItem->id }})"
                                                            class="btn btn1"><i class="fa fa-minus"></i></button>
                                                        <input type="text" value="{{ $cartItem->quantity }}"
                                                            class="input-quantity" />
                                                        <button type="button" wire:loading.attr="disabled"
                                                            wire:click="increaseQuantity({{ $cartItem->id }})"
                                                            class="btn btn1"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 my-auto">
                                                <label class="price">
                                                    ${{ $cartItem->product->selling_price * $cartItem->quantity }}
                                                </label>
                                            </div>
                                            @php
                                                $totalPrice += $cartItem->product->selling_price * $cartItem->quantity;
                                            @endphp
                                            <div class="col-md-2 col-5 my-auto">
                                                <div class="remove">
                                                    <button wire:click="removeCartItem({{ $cartItem->id }})"
                                                        class="btn btn-danger btn-sm">
                                                        <span wire:loading.remove
                                                            wire:target="removeCartItem({{ $cartItem->id }})">
                                                            <i class="fa fa-trash"></i> Remove
                                                        </span>
                                                        <span wire:loading
                                                            wire:target="removeCartItem({{ $cartItem->id }})">
                                                            <i class="fa fa-trash"></i> Removing...
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="4"> No Item in Cart </td>
                                </tr>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 my-md-auto mt-3">
                        <h5> Get the best deals & offers <a href="{{ route('collections') }}"
                                class="btn btn-primary btn-sm"> Shop Now </a>
                        </h5>
                    </div>
                    <div class="col-md-4 mt-3">
                        <div class="shadow-sm bg-white p-3">
                            <h4> Total:
                                <span class="float-end"> ${{ $totalPrice }} </span>
                            </h4>
                        </div>
                        <hr />
                        <a href="{{ route('checkout') }}" class="btn btn-warning w-100"> Checkout </a>
                    </div>
                </div>
            @else
                <div class="py-3 py-md-4 checkout">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <div class="p-4 shadow bg-white">
                                    <h4> No Items in Cart </h4>
                                    <a href="{{ route('collections') }}" class="btn btn-primary btn-sm">Shop More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
