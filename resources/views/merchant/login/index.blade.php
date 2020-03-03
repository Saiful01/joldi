<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css"/>

</head>

<body>

<div class="home-btn d-none d-sm-block">
    <a href="index.html" class="text-dark"><i class="fas fa-home h2"></i></a>
</div>
<div class="account-pages my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card overflow-hidden">
                    <div class="bg-primary">
                        <div class="text-primary text-center p-4">
                            <h5 class="text-white font-size-20">Welcome Back !</h5>
                            <p class="text-white-50">Sign in to continue to JOLDI.</p>
                            <a href="index.html" class="logo logo-admin">
                                <img src="/assets/images/logo-sm.png" height="24" alt="logo">
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


                            <form class="form-horizontal mt-4" action="/merchant/login-check" method="post">

                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="text" class="form-control" id="username" name="merchant_email"
                                           placeholder="Enter username">
                                    <input type="hidden" class="form-control" value="{{csrf_token()}}" name="_token">
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
                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log
                                            In
                                        </button>
                                    </div>
                                </div>

                                <div class="form-group mt-2 mb-0 row">
                                    <div class="col-12 mt-4">
                                        <a href="#"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>

                </div>

                <div class="mt-5 text-center">
                    <p>Don't have an account ? <a href="#" class="font-weight-medium text-primary">
                            Signup now </a></p>
                </div>


            </div>
        </div>
    </div>
</div>

<!-- JAVASCRIPT -->
<script src="/assets/libs/jquery/jquery.min.js"></script>
<script src="/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/metismenu/metisMenu.min.js"></script>
<script src="/assets/libs/simplebar/simplebar.min.js"></script>
<script src="/assets/libs/node-waves/waves.min.js"></script>

<script src="/assets/js/app.js"></script>

</body>


</html>