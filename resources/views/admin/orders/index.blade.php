@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

    <div class="py-3 py-md-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <h4> My Orders </h4>
                        <hr />
                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <label for="Date"> Date </label>
                                    <input type="date" name="date" id="date"
                                        value="{{ Request::get('date') ?? date('Y-m-d') }}" class="form-control">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <label for="Status"> Filter by status </label>
                                    <select name="status" id="status" class="form-select">
                                        <option value="">Show All</option>
                                        <option value="In_Process"
                                            {{ Request::get('status') == 'In_Process' ? 'selected' : '' }}>
                                            In Process</option>
                                        <option value="Completed"
                                            {{ Request::get('status') == 'Completed' ? 'selected' : '' }}>
                                            Completed</option>
                                        <option value="Pending" {{ Request::get('status') == 'Pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="Cancelled"
                                            {{ Request::get('status') == 'Cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                        <option value="Out_For_Delivery"
                                            {{ Request::get('status') == 'Our_For_Delivery' ? 'selected' : '' }}>
                                            Out For Delivery</option>
                                    </select>
                                </div>
                                <div class="col-md-4" mb-2>
                                    <input type="submit" value="Filter" class="form-control btn btn-primary">
                                </div>
                            </div>
                        </form>
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
                                            <td>
                                                <a href="{{ route('orders.show', $order->id) }}"
                                                    class="btn btn-primary btn-sm text-white">
                                                    View
                                                </a>
                                            </td>
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
