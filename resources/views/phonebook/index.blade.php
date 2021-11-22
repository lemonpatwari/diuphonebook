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
                        <a href="{{ route('phonebook.create') }}" class="btn btn-info">Add Contact</a>
                        <hr>
                    </div>

                    <div class="col-12">

                        <form action="{{ route('phonebook.index') }}">
                            <div class="input-group mb-3">
                                <input type="text" name="search_key" value="{{ request()->input('search_key') ?? '' }}" class="form-control" placeholder="Enter name"
                                       aria-label="enter name" aria-describedby="button-addon2">
                                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button
                                </button>
                            </div>
                        </form>

                        <div class="card card-default" id="card_contacts">
                            <div id="contacts" class="panel-collapse collapse show" aria-expanded="true" style="">
                                <ul class="list-group pull-down" id="contact-list">

                                    @foreach($phonebooks as $phonebook)
                                        <li class="list-group-item">
                                            <div class="row w-100">
                                                <div class="col-12 col-sm-6 col-md-3 px-0">

                                                    <img
                                                        src="{{ \Storage::url($phonebook->image_url) }}"
                                                        alt="{{ $phonebook->full_name }}"
                                                        class="rounded-circle mx-auto d-block img-fluid"
                                                        style="width: 100%;height: 80px">

                                                </div>
                                                <div class="col-12 col-sm-6 col-md-9 text-center text-sm-left">
                                    <span class="fa fa-mobile fa-2x text-success float-right pulse"
                                          title="online now"></span>
                                                    <label class="name lead">{{ $phonebook->full_name }}</label>
                                                    <br>
                                                    <span class="fa fa-phone fa-fw text-muted" data-toggle="tooltip"
                                                          title=""
                                                          data-original-title="{{ $phonebook->phone_number }}"></span>
                                                    <span class="text-muted small">{{ $phonebook->phone_number }}</span>

                                                    @if($phonebook->email)
                                                        <br>
                                                        <span class="fa fa-envelope fa-fw text-muted"
                                                              data-toggle="tooltip"
                                                              data-original-title="" title=""></span>
                                                        <span
                                                            class="text-muted small text-truncate">{{ $phonebook->email ?? 'N/A' }}</span>
                                                    @endif

                                                    <br>

                                                    <form action="{{route('phonebook.destroy',$phonebook->id)}}"
                                                          method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a class="btn btn-info btn-sm"
                                                           href="{{ route('phonebook.edit',$phonebook) }}">Edit</a>
                                                        <button class="btn btn-danger btn-sm"
                                                                onclick="return confirm('Are you sure you want to delete this?');"
                                                                type="submit">Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </div>
                                        </li>



                                    @endforeach

                                </ul>
                                <!--/contacts list-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
