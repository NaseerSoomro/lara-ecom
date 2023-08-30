@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('sliders.index') }}" class="btn btn-primary text-white float-right"> Back </a>
                </div>
                @if (session()->has('success'))
                    <h3 class="alert alert-success"> {{ session('success') }} </h3>
                @elseif (session()->has('error'))
                    <h3 class="alert alert-danger"> {{ session('error') }} </h3>
                @endif
                <div class="card-body">
                    <form action="{{ route('sliders.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="name"> Name </label>
                                <input type="text" name="name" id="name" class="form-control rounded">
                                <span class="text-danger"> @error('name')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="color_code"> Description </label>
                                <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
                                <span class="text-danger"> @error('description')
                                        {{ $message }}
                                    @enderror </span>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="image"> Image </label>
                                <input type="file" name="image" id="image" class="form-control rounded">
                                <span class="text-danger"> @error('image')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="mb-3 text-center">
                                <label for="status"> Status </label>
                                <input type="checkbox" name="status" id="status">
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-5">
                                <input type="submit" value="Create Slider" class="btn btn-primary text-white">
                            </div>

                            <div class="col-md-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
