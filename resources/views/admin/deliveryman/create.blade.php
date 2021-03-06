@extends('layouts.app')
@section('title', 'Deliveryman Create')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18"> Deliovery Man</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Add New  Delivery Man</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failed') }}</p>
                    @endif
                    <h5 class="card-title">Add New Delivery Man</h5>
                    <hr>
                    <form class="custom-validation" method="post" action="/deliveryman/store" novalidate=""
                          enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Name</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="Name"
                                       id="example-text-input-lg" name="delivery_man_name" required>
                                <input type="hidden" name="_token" value="{{{csrf_token()}}}"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Email</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="email" placeholder="Email"
                                       id="example-text-input-lg" name="delivery_man_email" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="number" placeholder="phone"
                                       id="example-text-input-lg" name="delivery_man_phone" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="Password" placeholder="Password"
                                       id="example-text-input-lg" name="password">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Address</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="Address"
                                       id="example-text-input-lg" name="delivery_man_address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Type</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-lg" id="test" onchange="showDiv('hidden_div', this)"
                                        name="delivery_man_type">


                                    <option value="1">Motorbike</option>
                                    <option value="2">Cycle</option>


                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Profile Image</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="file" placeholder=""
                                       id="example-text-input-lg" name="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> NID/Passport Document</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="file" placeholder=""
                                       id="example-text-input-lg" name="nid">
                            </div>
                        </div>
                        <div id="hidden_div">
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">License</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="file" placeholder=""
                                       id="example-text-input-lg" name="Driving_license">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Tax Token</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="file" placeholder=""
                                       id="example-text-input-lg" name="tax">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Blue Book</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="file" placeholder=""
                                       id="example-text-input-lg" name="blue">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"> Insurance</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="file" placeholder=""
                                       id="example-text-input-lg" name="insu">
                            </div>
                        </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                              {{--  <button type="reset" class="btn btn-secondary waves-effect">
                                    Reset
                                </button>--}}
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

    <script type="text/javascript">

        function showDiv(divId, element) {
            document.getElementById(divId).style.display = element.value == 1 ? 'block' : 'none';
        }

    </script>

@endsection
