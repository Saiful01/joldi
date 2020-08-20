@extends('layouts.app')
@section('title', 'Consignment Reports')

@section('content')

    <!-- start page title -->
        <div class="row align-items-center">
            <div class="col-sm-6">
                <div class="page-title-box">
                    <h4 class="font-size-18">Parcel Info</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Consignment Report</a></li>
                    </ol>
                </div>
            </div>

        </div>
    <!-- end page title -->


            <div class="card">
                        <div class="card-body">

                            <form class="form-inline" action="/admin/consignment/report">
                                    <div class="form-group mx-sm-3 ">
                                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                                            <select class="form-control" name="status">
                                                <option value="pending">pending</option>
                                                <option value="pickup_man_assigned">pickup_man_assigned</option>
                                                <option value="accepted">accepted</option>
                                                <option value="delivery_man_assigned">delivery_man_assigned</option>
                                                <option value="on_the_way">on_the_way</option>
                                                <option value="delivered">delivered</option>
                                                <option value="returned">returned</option>
                                                <option value="partial_delivered">partial_delivered</option>
                                                <option value="returned_to_admin">returned_to_admin</option>

                                            </select>
                                            <label for="date">From:</label>
                                            <input type="date" class="form-control" placeholder="" id="email" name="from">
                                            <label for="date">To:</label>
                                            <input type="date" class="form-control" placeholder="" id="email" name="to">
                                
                                    
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                    </div
                            </form>
                     </div>


            </div>



   

   


@endsection