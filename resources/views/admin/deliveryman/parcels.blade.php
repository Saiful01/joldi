@extends('layouts.app')
@section('title', 'DeliveryMan Parcels')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18"> DeliveryMan Parcel Info</h4>
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
            @include('includes.message')
            <div class="card">
                <div class="card-body">

                    <div id="datatable-buttons_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer"
                         style='overflow-x:auto'>
                        <div class="row">
                            <div class="col-sm-12">

                                <table class="table mb-0 table-bordered">

                                    <thead>
                                    <tr role="row">
                                        <th>Invoice No</th>
                                        {{-- <th>D.Chrage</th>--}}
                                        <th>Amount</th>
                                        <th>Receivable Amount</th>
                                        <th>Deliveryman</th>
                                        <td>Area</td>
                                        <th>Status</th>
                                        <th>P. Status</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    @php($i=1)
                                    @foreach($results as $res)


                                        <tr role="row" class="odd">

                                            <th>{{$res->parcel_invoice}}</th>
                                            {{--                                <td>{{$res->parcel_type_id}}</td>--}}
                                            {{--     <td>{{$res->delivery_charge}}</td>--}}
                                            <td>{{$res->total_amount}}

                                                {{$res->payable_amount}}+{{$res->delivery_charge}}+{{$res->cod}}+{{$res->area_charge}}

                                            </td>
                                            <td>{{$res->receivable_amount}}</td>

                                            <td>{{$res->area_name}}</td>
                                            <td>
                                                @if($res->delivery_status=="pending")
                                                    <span class="badge badge-pill badge-primary">Pending</span>
                                                @elseif($res->delivery_status=="accepted")
                                                    <span class="badge badge-pill badge-secondary"> Accepted</span>
                                                @elseif($res->delivery_status=="cancelled")
                                                    <span class="badge badge-pill badge-danger"> Cancelled</span>
                                                @elseif($res->delivery_status=="on_the_way")
                                                    <span class="badge badge-pill badge-info"> On The Way</span>
                                                @elseif($res->delivery_status=="delivered")
                                                    <span class="badge badge-pill badge-success"> Delivered</span>
                                                @elseif($res->delivery_status=="returned")
                                                    <span class="badge badge-pill badge-warning"> Returned</span>
                                                @elseif($res->delivery_status=="returned_to_admin")
                                                    <span class="badge badge-pill badge-success"> Returned To Admin</span>
                                                @elseif($res->delivery_status=="partial_delivered")
                                                    <span class="badge badge-pill badge-warning"> Partial Delivered</span>
                                                @else
                                                    <span class="badge badge-pill badge-success">{{getFormattedStatus($res->delivery_status)}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($res->is_paid_to_merchant=="pending")
                                                    <span class="badge badge-pill badge-danger">Pending</span>
                                                @elseif($res->is_paid_to_merchant=="requested")
                                                    <span class="badge badge-pill badge-warning"> Requested</span>
                                                @elseif($res->is_paid_to_merchant=="received")
                                                    <span class="badge badge-pill badge-success"> Paid</span>

                                                @endif
                                            </td>

                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>


                    </div>
                </div>
                {{ $results->links() }}
            </div>

        </div> <!-- end col -->

    </div>

@endsection
