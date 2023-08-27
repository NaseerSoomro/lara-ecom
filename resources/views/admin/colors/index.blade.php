@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('colors.create') }}" class="btn btn-primary text-white float-end"> Add Product Color
                    </a>
                </div>
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
                                <th>Color Code</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($colors as $color)
                                <tr>
                                    <td>{{ $color->id }}</td>
                                    <td>{{ $color->name }}</td>
                                    <td>{{ $color->color_code }}</td>
                                    {{-- @if ($color->products)
                                        <td>{{ $color->products->name }}</td>
                                    @else --}}
                                        <td>--</td>
                                    {{-- @endif --}}
                                    <td>
                                        @if ($color->status === 1)
                                            <input type="checkbox" name="status" id="status"
                                                {{ $color->status == 1 ? 'checked' : '' }} onclick="getStatus()">
                                        @else
                                            <input type="checkbox" name="status" id="status" onclick="getStatus()">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/colors/' . $color->id . '/show') }}"
                                            class="btn btn-primary btn-sm text-white">View</a>
                                        <a href="{{ url('admin/colors/' . $color->id . '/edit') }}"
                                            class="btn btn-success btn-sm text-white">Edit</a>
                                        <a href="{{ url('admin/colors/' . $color->id . '/delete') }}"
                                            class="btn btn-danger btn-sm text-white" onclick="return confirm('Are you sure?')">Delete</a>
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
                        {{-- {{ $colors->links() }} --}}
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
