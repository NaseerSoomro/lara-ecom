@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('products.create') }}" class="btn btn-primary text-white float-end"> Add Product </a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                <th>ID </th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="{{ route('products/'.$product->id.'/edit') }}"
                                            class="btn btn-primary btn-sm text-white">Edit</a>
                                        <a href="{{ route('products/'.$product->id.'/delete') }}"
                                            class="btn btn-primary btn-sm text-white">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No Record Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{-- <div>
                        {{ $products->links() }}
                    </div> --}}
                </div>
            </div>
        </div>
    @endsection
