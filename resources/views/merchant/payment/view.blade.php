@extends('layouts.merchant')
@section('title', 'View Payment Status')

@section('content')

    <!-- start page title -->
    <div class="row align-items-center">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4 class="font-size-18">Payment Information</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Payment Table</a></li>
                </ol>
            </div>
        </div>

    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">
                        Payment Datatable</h4>
                    {{--                    <p class="card-title-desc">DataTables has most features enabled by--}}
                    {{--                        default, so all you need to do to use it with your own tables is to call--}}
                    {{--                        the construction function: <code>$().DataTable();</code>.--}}
                    {{--                    </p>--}}

                    <table id="datatablef" class="table table-bordered dt-responsive nowrap"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Payable Amount</th>
                            <th>Payment for</th>
                            <th>Status</th>
                            <th>Merchant Approval</th>
                            <th>Approval Date</th>

                        </tr>
                        </thead>


                        <tbody>
                        @php($i=1)
                        @foreach($results as $res)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$res->payable_amount}}</td>


                                <td><a href="#">{{count(json_decode($res->parcels))}} Parcel</a> </td>
                                <td>
                                @if($res->paid_status=='pending')
                                        <span class="badge badge-pill badge-warning">Pending</span>
                                    @elseif($res->paid_status=='cancel')

                                        <span class="badge badge-pill badge-danger">Cancel</span>
                                    @elseif($res->paid_status=='approved')
                                        <span class="badge badge-pill badge-success">Approved</span>
                                    @endif

                                </td>
                                <td>
                                    @if($res->is_merchant_approved)
                                        <span class="badge badge-pill badge-success">Approved</span>

                                    @else
                                        <span class="badge badge-pill badge-warning">Not Approved</span>
                                    @endif

                                </td>
                                <td>{{$res->updated_at}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->

@endsection
