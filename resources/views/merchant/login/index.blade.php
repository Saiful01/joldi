@extends('layouts.default')
@section('title', 'Merchant Login')


@section('content')
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

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

                    <div class="card overflow-hidden">
                        <div style="background: #1DC68C !important;">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                <p class="text-white">Sign in to continue to JOLDI.</p>
                                <a href="#" class="logo logo-admin">
                                    <img src="/assets/images/logo.png" height="20" width="85%" alt="logo">
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <div class="p-3">

                                <form class="form-horizontal mt-4" action="/merchant/login-check" method="post">

                                    <div class="form-group">
                                        <label for="username">Email</label>
                                        <input type="text" class="form-control" id="username" name="merchant_email"
                                               placeholder="Enter username">
                                        <input type="hidden" class="form-control" value="{{csrf_token()}}"
                                               name="_token">
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" id="userpassword"
                                               placeholder="Enter password" name="password">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                       id="customControlInline">
                                                <label class="custom-control-label" for="customControlInline">Remember
                                                    me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn text-white w-md waves-effect waves-light" style="background: #1DC68C !important;" type="submit">
                                                Log
                                                In
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="/merchant/forgot-password"><i class="mdi mdi-lock"></i> Forgot your
                                                password?</a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">
                        <p>Don't have an account ? <a href="/merchant/registration"
                                                      class="font-weight-medium text-primary">
                                Signup now </a></p>
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection
