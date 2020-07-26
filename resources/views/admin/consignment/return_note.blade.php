@extends('layouts.app')
@section('title', 'Customer')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Admin Returned Note</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Admin Returned Note</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Admin Returned Note</h5>
                    <hr>
                    <form method="get"
                          action="/admin/parcel/receive-by-admin">
                        <div class="form-group">
                            <label
                                class="control-label">Notes</label>

                            <input name="_token"
                                   value="{{csrf_token()}}"
                                   type="hidden"/>
                            <input name="parcel_id"
                                   value="{{$res->parcel_id}}"
                                   type="hidden"/>


                            <textarea class="form-control"
                                      name="admin_notes"></textarea>

                        </div>

                        <div class="form-group col-2 mx-auto">
                            <button type="submit"
                                    class="btn btn-block btn-primary btn-sm waves-effect waves-light float-right">
                                Save
                            </button>
                        </div>


                    </form>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
