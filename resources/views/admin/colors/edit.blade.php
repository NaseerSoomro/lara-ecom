@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('colors.index') }}" class="btn btn-primary text-white float-right"> Back </a>
                </div>
                @if (session()->has('success'))
                    <h3 class="alert alert-success"> {{ session('success') }} </h3>
                @elseif (session()->has('error'))
                    <h3 class="alert alert-danger"> {{ session('error') }} </h3>
                @endif
                <div class="card-body">
                    <form action="{{ url('admin/colors/' . $color->id . '/update') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="product"> Product </label>
                                {{-- <select name="product_id" id="category_id" class="form-control rounded">
                                    <option value=""> --Select-- </option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"> {{ $product->name }} </option>
                                    @endforeach
                                </select> --}}
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="name"> Name </label>
                                <input type="text" name="name" id="name" class="form-control rounded"
                                    value="{{ $color->name }}">
                                <span class="text-danger"> @error('name')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="color_code"> Color Code </label>
                                <input type="text" name="color_code" id="color_code" class="form-control rounded"
                                    value="{{ $color->color_code }}">
                                <span class="text-danger"> @error('color_code')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="mb-3">
                                <label for="status"> Status </label>
                                @if ($color->status === 1)
                                    <input type="checkbox" name="status" id="status"
                                        {{ $color->status == 1 ? 'checked' : '' }} onclick="getStatus()">
                                @else
                                    <input type="checkbox" name="status" id="status" onclick="getStatus()">
                                @endif
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-5">
                                <input type="submit" value="Update Color" class="btn btn-primary text-white">
                            </div>

                            <div class="col-md-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
