@extends('layouts.default')

@section('content')
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">

                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failed') }}</p>
                    @endif


                    <div class="card overflow-hidden">
                        <div style="background: #1DC68C !important;">
                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Free Register</h5>
                                <p class="text-white">Get your free DeliveryMan account now.</p>
                                <a href="/" class="logo logo-admin">
                                    <img src="/assets/images/logo.png" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">


                                <form class="form-horizontal mt-4" method="post" action="/deliveryman/store"
                                      enctype='multipart/form-data'>

                                    <div class="form-group">
                                        <label for="useremail">Email</label>
                                        <input type="email" class="form-control" name="delivery_man_email">
                                        <input type="hidden" name="_token" value="{{{ csrf_token() }}}"/>
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" name="delivery_man_name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="userpassword">Password</label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword">Phone</label>
                                        <input type="number" class="form-control" name="delivery_man_phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword">Address</label>
                                        <input type="text" class="form-control" name="delivery_man_address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword">Type</label>
                                        <select class="form-control" id="test" onchange="showDiv('hidden_div', this)"
                                                name="delivery_man_type">


                                            <option value="1">Motorbike</option>
                                            <option value="2">Cycle</option>


                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword">Profile Image</label>
                                        <input type="file" class="form-control" name="image" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="userpassword">NID/Passport</label>
                                        <input type="file" class="form-control" name="nid" required>
                                    </div>
                                    <div id="hidden_div">
                                        <div class="form-group">
                                            <label for="userpassword">Driving License</label>
                                            <input type="file" class="form-control" name="licen">
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword">Tax Token</label>
                                            <input type="file" class="form-control" name="tax">
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword">Blue Book</label>
                                            <input type="file" class="form-control" name="blue">
                                        </div>

                                        <div class="form-group">
                                            <label for="userpassword">Insurance</label>
                                            <input type="file" class="form-control" name="insu">
                                        </div>

                                    </div>


                                    <div class="form-group row">
                                        <div class="col-12 text-right">
                                            <button class="btn  w-md waves-effect waves-light text-white"
                                                    style="background: #1DC68C !important;" type="submit">Register
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <p class="mb-0">By registering you agree to the Veltrix <a href="#"
                                                                                                       class="text-primary">Terms
                                                    of Use</a></p>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>

                    <div class="mt-5 text-center">

                        <p>Already have an account ? <a href="/merchant/login" class="font-weight-medium text-primary">
                                Login </a></p>
                        <p>©
                            <script>document.write(new Date().getFullYear())</script>
                            Logistics Crafted with <i class="mdi mdi-heart text-danger"></i> by PLab
                        </p>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">

        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
        }

    </script>



@endsection
