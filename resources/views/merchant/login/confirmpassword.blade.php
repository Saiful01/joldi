@extends('layouts.default')

@section('content')
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-success">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                <p class="text-white-50">Reset Your Password to JOLDI.</p>
                                <a href="#" class="logo logo-admin">
                                    <img src="/assets/images/logo.png" height="20" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">

                                @if(Session::has('success'))
                                    <div class="alert alert-success mt-5" role="alert">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif

                                @if(Session::has('failed'))
                                    <div class="alert alert-danger mt-5" role="alert">
                                        {{ Session::get('failed') }}
                                    </div>
                                @endif


                                <form class="form-horizontal mt-4" action="/merchant/confirm-password" method="post">


                                    <div class="form-group">
                                        <label for="username">Password</label>
                                        <input type="password" class="form-control" id="username" name="merchant_password"
                                               placeholder="Enter password">

                                        <input type="hidden" class="form-control" value="{{csrf_token()}}" name="_token">
                                        <input type="hidden" class="form-control" value="{{$id}}" name="id">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Confirm Password</label>
                                        <input type="password" class="form-control" id="username" name="merchant_password"
                                               placeholder="confirm password">

                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-success w-md waves-effect waves-light" type="submit">Reset Password
                                            </button>
                                        </div>
                                    </div>


                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p>Don't have an account ? <a href="/merchant/registration" class="font-weight-medium text-primary">
                                Signup now </a></p>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
