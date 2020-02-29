@extends('layouts.default')

@section('content')
    <div class="login-page">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">

                    @if(Session::has('failed'))
                        <div class="alert alert-danger">
                            {{session('failed')}}
                        </div>
                    @endif


                    <form action="/login/check" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="email">Email address:</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" class="form-control" placeholder="Enter email" id="email"
                                       name="email">
                                <input type="hidden" class="form-control" placeholder="Enter email" id="email"
                                       name="_token" value="{{csrf_token()}}">
                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <label for="pwd">Password:</label>
                            </div>

                            <div class="col-md-8">
                                <input type="password" class="form-control" placeholder="Enter password"
                                       id="password"
                                       name="password">
                            </div>

                        </div>
                        <div class="row form-group form-check">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 float-right">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" checked> Remember me
                                </label>
                            </div>
                        </div>

                        <div class="row form-group form-check">
                            <div class="col-md-4"></div>
                            <div class="col-md-8 float-right">
                                <button type="submit" class="btn btn-success">Login</button>
                            </div>
                        </div>

                        {{--  <div class="form-group">
                              <label for="address"> address:</label>
                              <input type="text" class="form-control" placeholder="Enter address" id="address" name="address" value="{{ old('address') }}">
                          </div>--}}

                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection