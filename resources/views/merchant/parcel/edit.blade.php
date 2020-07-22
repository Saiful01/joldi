@extends('layouts.merchant')
@section('title', 'Parcel Edit')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Edit Parcel</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->


    <div class="row" ng-controller="parcelController">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{--                    <h5 class="card-title">Add New Parcel</h5>
                                        <a href="/tttttt/view" type="butoon" class="card-title float-right"> Parcel View </a>
                                        <hr>--}}

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
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                    @endif

                    @if(Session::has('failed'))
                        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('failed') }}</p>
                    @endif

                    <form class="custom-validation" action="/merchant/parcel/update" method="post"
                          enctype="multipart/form-data"
                          novalidate="">
                        <div class="row">
                            <div class="col-md-4">
                                <h5 class=" mb-3">Customer Information </h5>
                                <hr>


                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Name</label>--}}
                                    <div class="col-sm-12">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                        <input type="hidden" name="customer_id" value="{{$result->customer_id}}">
                                        <input type="hidden" name="parcel_id" value="{{$result->parcel_id}}">

                                        <input class="form-control form-control-lg" type="text"
                                               placeholder="কাস্টমার নাম"
                                               id="example-text-input-lg" name="customer_name" value="{{$result->customer_name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Phone</label>--}}
                                    <div class="col-sm-12">
                                        <input class="form-control form-control-lg" type="number"
                                               placeholder=" কাস্টমার ফোন"
                                               id="example-text-input-lg" name="customer_phone" value="{{$result->customer_phone}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">Customer
                                        Address</label>--}}
                                    <div class="col-sm-12">
                               <textarea class="form-control form-control-lg" type="text" placeholder="কাস্টমার ঠিকানা"
                                         id="example-text-input-lg" name="customer_address">{{$result->customer_address}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label">--}}
                                    {{--Note</label>--}}
                                    <div class="col-sm-12">
                               <textarea class="form-control form-control-lg" type="text"
                                         placeholder="কোনো বিশেষ নির্দেশনা"
                                         id="example-text-input-lg" name="parcel_notes">{{$result->parcel_notes}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    {{--<label for="example-text-input-lg" class="col-sm-3 col-form-label"></label>--}}
                                    <div class="col-sm-12">
                                        <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                            Update
                                        </button>
                                        {{-- <button type="reset" class="btn btn-secondary waves-effect">
                                             Reset
                                         </button>--}}
                                    </div>
                                </div>


                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->




@endsection
