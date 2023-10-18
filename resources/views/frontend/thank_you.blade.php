@extends('layouts.app')

@section('title', 'Thank you')

@section('content')

    <div class="py-3 py-md-4 checkout">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if (session('message'))
                        <h4 class="alert alert-success"> {{ session('message') }} </h4>
                    @endif
                    <div class="p-4 shadow bg-white">
                        <h4> Logo if available </h4>
                        <h4> Thank you for shopping with us </h4>
                        <a href="{{ route('collections') }}" class="btn btn-primary btn-sm">Shop More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
