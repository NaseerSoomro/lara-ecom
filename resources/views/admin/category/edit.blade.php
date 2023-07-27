@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('category.index') }}" class="btn btn-primary text-white float-right"> Back </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('category.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name"> Name </label>
                                <input type="text" name="name" id="name" class="form-control rounded"
                                    value="{{ $category->name }}">
                                <span class="text-danger"> @error('name')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="slug"> Slug </label>
                                <input type="text" name="slug" id="slug" class="form-control rounded"
                                    value="{{ $category->slug }}">
                                <span class="text-danger"> @error('slug')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="description"> Description </label>
                                <textarea name="description" id="description" class="form-control rounded" rows="3"> {{ $category->meta_description }} </textarea>
                                <span class="text-danger"> @error('description')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-12 mb-5">
                                <label for="image"> Image </label>
                                <input type="file" name="image" id="image" class="form-control rounded">
                                <img src="{{ asset('uploads/category/' . $category->image) }}" alt="" width="80px"
                                    height="80px" class="mt-3">
                            </div>
                            <div class="col-md-6 mb-3">
                                <h3> SEO Tags </h3>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="status"> Status </label>
                                @if ($category->status == '1')
                                    <input type="checkbox" name="status" id="status"
                                        {{ $category->status == '1' ? 'checked' : '' }}>
                                @else
                                    <input type="checkbox" name="status" id="status">
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_title"> Meta Title </label>
                                <input type="text" name="meta_title" id="meta_title" class="form-control rounded"
                                    value="{{ $category->meta_title }}">
                                <span class="text-danger"> @error('meta_title')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_keyword"> Meta Keyword </label>
                                <input type="text" name="meta_keyword" id="meta_keyword" class="form-control rounded"
                                    value="{{ $category->meta_keyword }}">
                                <span class="text-danger"> @error('meta_keyword')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_description"> Meta Description </label>
                                <textarea name="meta_description" id="meta_description" class="form-control rounded" rows="3"> {{ $category->meta_description }}</textarea>
                                <span class="text-danger"> @error('meta_keyword')
                                        {{ $message }}
                                    @enderror </span>
                            </div>
                            <div class="col-md-5"></div>
                            <div class="col-md-5">
                                <input type="submit" value="Update" class="btn btn-primary text-white">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
