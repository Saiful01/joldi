@extends('layouts.app')
@section('title', 'Customer')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Assign Pickup Man</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Assign Pickup Man</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Assign Pickup Man</h5>
                    <hr>
                    <form method="post" action="/multiple-pickupman/store"
                          enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-4 col-form-label">Select PickUp
                                Man</label>
                            <div class="col-sm-8">
                                <select class="form-control form-control-lg" type="text" placeholder="Name"
                                        id="example-text-input-lg" name="delivery_man_id" required>
                                    @foreach($men as $res)
                                        <option value="{{$res->delivery_man_id}}">{{$res->delivery_man_name}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="_token" value="{{{csrf_token()}}}"/>
                            </div>
                            @foreach($parcel_data as $res)
                                <input type="hidden" name="parcel_id[]" value="{{$res->parcel_id}} ">
                            @endforeach
                        </div>


                        <div class="form-group row">
                            <label for="example-text-input-lg" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Update
                                </button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
