@extends('layout.master')

@push('style')
    <style>
        .box {
            border: 1px solid #ddd;
            height: 600px;
            overflow-y: scroll;
        }

        .sub-box {
            padding: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <div class="col-lg-6 col-md-6 col-sm-12 offset-lg-3 offset-md-3 box">
            <div class="col-lg-10 col-md-10 col-sm-12 offset-lg-1 offset-mf-1 sub-box">
                <div class="row">

                    <div class="col-12 mb-2">
                        <a href="{{ route('phonebook.index') }}" class="btn btn-info">See Lists</a>
                    </div>

                    <div class="col-12">

                        <form action="{{ route('phonebook.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="first_name">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" placeholder="Enter first name"
                                           name="first_name" value="{{ old('first_name') }}" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter last name"
                                           name="last_name" value="{{ old('last_name') }}">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="phone_number">Phone Number <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" placeholder="Enter phone number"
                                           name="phone_number" value="{{ old('phone_number') }}" required>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" placeholder="Enter email"
                                           name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="image_url">Profile</label>
                                    <input type="file" class="form-control"
                                           name="image_url" accept="image/*">
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 mt-2">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
