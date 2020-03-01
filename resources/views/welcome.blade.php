
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
