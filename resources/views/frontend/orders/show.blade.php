@extends('layouts.app')

@section('title', 'View Order')

@section('content')

    <div class="py-3 py-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4>
                            <i class="fa fa-shopping-cart text-dart"> Order Details </i>
                            <a href="{{ route('orders.index') }}" class="btn btn-primary btn-sm float-end text-white">Back</a>
                        </h4>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <h4> Order Details </h4>
                                <hr />
                                <h6> Order Id: {{ $order->id }} </h6>
                                <h6> Tracking Id/No: {{ $order->tracking_no }}</h6>
                                <h6> Order Created Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h6>
                                <h6> Payment Mode: {{ $order->payment_mode }}</h6>
                                <h6 class="border p-2 text-success"> Order Status: <span> {{ $order->status_message }}
                                    </span> </h6>
                            </div>
                            <div class="col-md-6">
                                <h4> User Details </h4>
                                <hr />
                                <h6> Full Name: {{ $order->full_name }} </h6>
                                <h6> Email: {{ $order->email }} </h6>
                                <h6> Phone: {{ $order->phone }} </h6>
                                <h6> Address: {{ $order->address }} </h6>
                                <h6> Pin Code: {{ $order->pin_code }} </h6>
                            </div>
                        </div>
                        <br />
                        <h5> Order Items </h5>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Item ID</th>
                                        <th>Image</th>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalProductAmount = 0;
                                    @endphp
                                    @forelse($order->order_items as $orderItem)
                                        <tr>
                                            <td>{{ $orderItem->id }}</td>
                                            <td>
                                                @if ($orderItem->product->productImages)
                                                    <img src="{{ asset($orderItem->product->productImages[0]->image) }} "style="width: 50px; height: 50px"
                                                        alt="">
                                                @else
                                                    <img src="https://www.google.com/imgres?imgurl=x-raw-image%3A%2F%2F%2F691650ab2cfdead2e1377aa7064a77c91b50c960014e265d529a024d198aeb6f&tbnid=0ur9LKtQFmmT_M&vet=12ahUKEwiJ1Jyp8OqBAxW3mycCHfG4ACQQMygfegUIARCdAQ..i&imgrefurl=https%3A%2F%2Fwww.fundaofwebit.com%2Fecommerce-template%2Fproducts-view-template-design-using-html-css-bootstrap5&docid=5ppuXgN3J-6tXM&w=1252&h=647&q=ecommerce%20cart%20%2F%20wishlist%20design%20by%20funda%20web%20it&client=firefox-b-d&ved=2ahUKEwiJ1Jyp8OqBAxW3mycCHfG4ACQQMygfegUIARCdAQ"
                                                        style="width: 50px; height: 50px" alt="">
                                                @endif
                                            </td>
                                            <td>
                                                {{ $orderItem->product->name }}
                                                @if ($orderItem->color_product)
                                                    <br>
                                                    @if ($orderItem->color_product->color)
                                                        <span> with color
                                                            {{ $orderItem->color_product->color->name }}
                                                        </span>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                ${{ $orderItem->price }}
                                            </td>
                                            <td>
                                                {{ $orderItem->quantity }}
                                            </td>
                                            <td class="fw-bold">
                                                ${{ $orderItem->quantity * $orderItem->price }}
                                            </td>

                                            @php
                                                $totalProductAmount += $orderItem->quantity * $orderItem->price;
                                            @endphp
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"> No Orders Available </td>
                                        </tr>
                                    @endforelse
                                        <tr>
                                            <td colspan="5" class="fw-bold bg-primary text-white"> Total Amount </td>
                                            <td colspan="5" class="fw-bold bg-primary text-white"> ${{ $totalProductAmount }} </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
