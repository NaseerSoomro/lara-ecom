@extends('layouts.app')

@section('title', 'Orders')

@section('content')

    <div class="py-3 py-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4> My Orders </h4>
                        <hr />
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Tracking ID</th>
                                        <th>Username</th>
                                        <th>Payment Mode</th>
                                        <th>Ordered Date</th>
                                        <th>Status Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->tracking_no }}</td>
                                            <td>{{ $order->full_name }}</td>
                                            <td>{{ $order->payment_mode }}</td>
                                            <td>{{ $order->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $order->status_message }}</td>
                                            <td><a href="{{ route('order.show', $order->id) }}" class="btn btn-primary btn-sm text-white">
                                                    View </a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7"> No Orders Available </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
