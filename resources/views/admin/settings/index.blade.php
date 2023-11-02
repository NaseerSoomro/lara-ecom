@extends('layouts.admin')

@section('title', 'Webiste Setting')

@section('content')
    @if (session('success'))
        <h3 class="alert alert-success"> {{ session('success') }} </h3>
    @elseif (session('error'))
        <h3 class="alert alert-danger"> {{ session('error') }} </h3>
    @endif
    <div class="row">
        <div class="col-md-12 grid-margin">
            <form action="{{ route('website_setting.store') }}" method="post">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0"> Website Setting </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="website_name"> Website Name </label>
                                <input type="text" name="website_name" class="form-control"
                                    value="{{ $setting->website_name }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="website_url"> Website URL </label>
                                <input type="text" name="website_url" class="form-control"
                                    value="{{ $setting->website_url }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="page_title"> Page Title </label>
                                <input type="text" name="page_title" class="form-control"
                                    value="{{ $setting->page_title }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="meta_keyword"> Meta Keyword </label>
                                <input type="text" name="meta_keyword" class="form-control"
                                    value="{{ $setting->meta_keyword }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="meta_description"> Meta Description </label>
                                <input type="text" name="meta_description" class="form-control"
                                    value="{{ $setting->meta_description }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0"> Website Information </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="address"> Address </label>
                                <textarea name="address" rows="3" class="form-control">{{ $setting->address }}"</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone_1"> Phone 1 </label>
                                <input type="text" name="phone_1" class="form-control" value="{{ $setting->phone_1 }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone_2"> Phone 2 </label>
                                <input type="text" name="phone_2" class="form-control" value="{{ $setting->phone_2 }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email_1"> Email 1 </label>
                                <input type="text" name="email_1" class="form-control" value="{{ $setting->email_1 }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="email_2"> Email 2 </label>
                                <input type="text" name="email_2" class="form-control" value="{{ $setting->email_2 }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0"> Website - Social Media </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="facebook"> Facebook </label>
                                <input type="text" name="facebook" class="form-control"
                                    value="{{ $setting->facebook }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="twitter"> Twitter </label>
                                <input type="text" name="twitter" class="form-control" value="{{ $setting->twitter }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="instagram"> Instagram </label>
                                <input type="text" name="instagram" class="form-control"
                                    value="{{ $setting->instagram }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="youtube"> Youtube </label>
                                <input type="text" name="youtube" class="form-control"
                                    value="{{ $setting->youtube }}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="whatsapp"> Whatsapp </label>
                                <input type="text" name="whatsapp" class="form-control"
                                    value="{{ $setting->whatsapp }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary text-white"> Save
                        Settings </button>
                </div>
            </form>
        </div>
    </div>
@endsection
