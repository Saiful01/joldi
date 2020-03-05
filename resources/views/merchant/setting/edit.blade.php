@extends('layouts.merchant')
@section('title', 'Merchant Edit')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Merchants</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Merchant Edit</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('failed') }}</p>
                    @endif


                    <form class="custom-validation" method="post" action="/merchant/setting/update" novalidate=""
                          enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Merchant Name</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="Name"
                                       id="example-text-input-lg" name="merchant_name"
                                       value="{{$result->merchant_name}}" required>
                                <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                <input type="hidden" name="merchant_id" value="{{$result->merchant_id}}"/>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Merchant Phone</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="text" placeholder="phone"
                                       id="example-text-input-lg" name="merchant_phone"
                                       value="{{$result->merchant_phone}}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Merchant Email</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="email" placeholder="Email"
                                       id="example-text-input-lg" name="merchant_email"
                                       value="{{$result->merchant_email}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label">Merchant Image</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-lg" type="file" placeholder="Email"
                                       id="example-text-input-lg" name="merchant_email"
                                       value="{{$result->merchant_image}}">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="area"  class="col-sm-2 col-form-label">Area</label>
                            <div class="col-sm-10">
                                <select class="form-control form-control-lg" name="area_id">
                                    @foreach ($areas as $res)
                                        <option
                                            @if ($res->area_id ==$result->area_id) selected @endif value="{{$res->area_id}}">{{$res->area_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-secondary waves-effect">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
