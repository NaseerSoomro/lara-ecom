@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('products.create') }}" class="btn btn-primary text-white float-end"> Add Product </a>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session()->has('success'))
                    <h3 class="alert alert-success"> {{ session('success') }} </h3>
                @elseif (session()->has('error'))
                    <h3 class="alert alert-danger"> {{ session('error') }} </h3>
                @endif
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                <th>ID </th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->brand }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>
                                        @if ($product->status === 1)
                                            <input type="checkbox" name="status" id="status"
                                                {{ $product->status == 1 ? 'checked' : '' }} onclick="getStatus()">
                                        @else
                                            <input type="checkbox" name="status" id="status"
                                                onclick="getStatus()">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/products/' . $product->id . '/show') }}"
                                            class="btn btn-primary btn-sm text-white">View</a>
                                        <a href="{{ url('admin/products/' . $product->id. '/edit') }}"
                                            class="btn btn-success btn-sm text-white">Edit</a>
                                        <a href="{{ url('admin/products/' . $product->id . '/delete') }}"
                                            class="btn btn-danger btn-sm text-white">Delete</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>

        <script>
            function getStatus() {
                var status = document.getElementById('status').value;
                alert(status);
            }
        </script>
    @endsection
