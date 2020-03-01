@extends('layouts.app')
@section('title', 'Customer')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Parcel Information</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Parcel Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Buttons example</h4>
                    <p class="card-title-desc">
                    </p>

                    <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="datatable-buttons"
                                       class="table table-striped table-bordered dt-responsive nowrap dataTable no-footer dtr-inline"
                                       style="border-collapse: collapse; border-spacing: 0px; width: 100%;" role="grid"
                                       aria-describedby="datatable-buttons_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons"
                                            rowspan="1" colspan="1" style="width: 151px;" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending">#
                                        </th> <th class="sorting_asc" tabindex="0" aria-controls="datatable-buttons"
                                            rowspan="1" colspan="1" style="width: 151px;" aria-sort="ascending"
                                            aria-label="Name: activate to sort column descending">Invoice No
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 231px;"
                                            aria-label="Position: activate to sort column ascending">COD
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 110px;"
                                            aria-label="Office: activate to sort column ascending">Delivery Chrage
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 49px;"
                                            aria-label="Age: activate to sort column ascending">Totall Amount
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 100px;"
                                            aria-label="Start date: activate to sort column ascending">Same day
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 85px;"
                                            aria-label="Salary: activate to sort column ascending">Delivery date
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 85px;"
                                            aria-label="Salary: activate to sort column ascending">Customer Name
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 85px;"
                                            aria-label="Salary: activate to sort column ascending">Phone
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 85px;"
                                            aria-label="Salary: activate to sort column ascending">Address
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 85px;"
                                            aria-label="Salary: activate to sort column ascending">Status
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="datatable-buttons" rowspan="1"
                                            colspan="1" style="width: 85px;"
                                            aria-label="Salary: activate to sort column ascending">Action
                                        </th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @php($i=1)
                                    @foreach($results as $res)


                                    <tr role="row" class="odd">
                                        <td tabindex="0" class="sorting_1">{{$i++}}</td>
                                        <td>{{$res->parcel_invoice}}</td>
                                        {{--                                <td>{{$res->parcel_type_id}}</td>--}}
                                        <td>{{$res->cod}}</td>
                                        <td>{{$res->delivery_charge}}</td>
                                        <td>{{$res->total_amount}}</td>
                                        <td>
                                            @if($res->is_same_day==0)
                                                <span class="badge badge-pill badge-info">Yes</span>
                                            @else
                                                <span class="badge badge-pill badge-danger">No</span>

                                            @endif
                                        </td>
                                        <td>{{$res->delivery_date}}</td>
                                        <td>{{$res->customer_name}}</td>
                                        <td>{{$res->customer_phone}}</td>
                                        <td>{{$res->customer_address}}</td>
                                        <td>{{$res->delivery_status}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-info dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="/parcel/edit/{{$res->parcel_id}}">Edit</a>
                                                    <a class="dropdown-item"
                                                       href="/parcel/delete/{{$res->parcel_id}}">Delete</a>

                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>

@endsection
