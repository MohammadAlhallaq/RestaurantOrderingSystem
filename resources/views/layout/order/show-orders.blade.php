@extends('layout.mainlayout')
@section('content')
    <!-- start page title -->
    {{--    <div class="row page-titles">--}}
    {{--        <ol class="breadcrumb">--}}
    {{--            <li class="breadcrumb-itemController active"><a href="javascript:void(0)">restaurant Admin</a></li>--}}
    {{--            <li class="breadcrumb-itemController"><a href="javascript:void(0)">Restaurant Category</a></li>--}}
    {{--        </ol>--}}
    {{--    </div>--}}

    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Restaurant Orders</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3"
                               class="table display mb-4 dataTablesCard order-table shadow-hover card-table text-black dataTable no-footer"
                               style="min-width: 845px">
                            <thead>
                            <tr>
                                <th class="sorting">Customer Name</th>
                                @if($acct_type_id==1)
                                    <th class="sorting">Restaurant Name</th> @endif
                                <th class="sorting">Create Date</th>
                                <th class="sorting">Location</th>
                                <th class="sorting">Order Cost</th>
                                <th class="sorting">Payment Type</th>
                                <th class="sorting">Order Status</th>
                                <th class="sorting">Order note</th>

                                <th class="sorting">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $o)
                                <tr>
                                    <td>{{$o->customer}}</td>
                                    @if($acct_type_id==1)
                                        <td>{{$o->restaurant}}</td> @endif
                                    <td class="wspace-no">{{$o->created_at}}</td>
                                    <td class="text-ov">{{$o->address}}</td>
                                    <td class="text-ov">{{$o->total_cost_after}}</td>
                                    <td class="text-ov">{{$o->pay_type_name}}</td>
                                    <td><span
                                            class="btn @if($o->step_id==1) badge badge-secondary @elseif($o->step_id==2) badge badge-primary @elseif($o->step_id==3) badge badge-primary-dark @elseif($o->step_id==4) badge badge-warning @elseif($o->step_id==5) badge badge-success @else btn-danger  @endif  btn-rounded btn-sm">{{$o->step_name_en}}</span>
                                    </td>
                                    <td id="customer_note{{$o->id}}">{{$o->note}}</td>
                                    @if($o->step_id==1||$o->step_id==2||$o->step_id==4)
                                        <td>
                                            {{--                                            <div class="dropdown ml-auto">--}}
                                            {{--                                                <button type="button" class="btn btn-primary light sharp"--}}
                                            {{--                                                        data-bs-toggle="dropdown">--}}
                                            {{--                                                    <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1">--}}
                                            {{--                                                        <g stroke="none" stroke-width="1" fill="none"--}}
                                            {{--                                                           fill-rule="evenodd">--}}
                                            {{--                                                            <rect x="0" y="0" width="24" height="24"></rect>--}}
                                            {{--                                                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>--}}
                                            {{--                                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>--}}
                                            {{--                                                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>--}}
                                            {{--                                                        </g>--}}
                                            {{--                                                    </svg>--}}
                                            {{--                                                </button>--}}
                                            {{--                                                <div class="dropdown-menu dropdown-menu-end">--}}
                                            {{--                                                    <a class="dropdown-item text-black" href="javascript:void(0);"--}}
                                            {{--                                                       onclick="return pass_order({{$o->id}},{{$o->order_stop_log_id}},{{$o->step_id}},1,'{{$o->created_at}}','{{$o->customer}}')"><i--}}
                                            {{--                                                            class="far fa-check-circle me-1 text-success"></i>Accept--}}
                                            {{--                                                        order</a>--}}
                                            {{--                                                    <a class="dropdown-item text-black"--}}
                                            {{--                                                       --}}{{--                                                   @if($o->step_id==2) hidden @endif --}}
                                            {{--                                                       href="javascript:void(0);"--}}
                                            {{--                                                       onclick="return pass_order({{$o->id}},{{$o->order_stop_log_id}},{{$o->step_id}},0,'{{$o->created_at}}','{{$o->customer}}')"><i--}}
                                            {{--                                                            class="far fa-times-circle me-1 text-danger"></i>Reject--}}
                                            {{--                                                        order</a>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}


                                            {{--                                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#basicModal">Process Order</button>--}}

                                            <button id="{{$o->id}}" type="button"
                                                    class="btn btn-primary light sharp load-ajax-modal"
                                                    data-path="{{ route('order-details',array('order_id'=>$o->id)) }}">
                                                <svg width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none"
                                                       fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                                    </g>
                                                </svg>
                                            </button>
                                            <div class="modal fade" id="basicModal{{$o->id}}" style="display: none;"
                                                 aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Order Details</h5>
                                                            <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal">
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" id="bodyModal{{$o->id}}">
                                                            <div class="row">
                                                                <div class="card-body" id="content{{$o->id}}">

                                                                    {{--                                                                    <div class="imfo align-items-center mb-4">--}}
                                                                    {{--                                                                        <i class="fa fa-user" aria-hidden="true"></i>--}}
                                                                    {{--                                                                        <h4 class="mb-0 text-black ms-3">{{$order_customer->username}}</h4>--}}
                                                                    {{--                                                                    </div>--}}
                                                                    {{--                                                                </div>--}}
                                                                </div>
                                                            </div>
                                                            <div class="row col-12">
                                                                <h5 class="modal-title">Restaurant Note :</h5>
                                                                <textarea class="row col-12" rows="5"
                                                                          style="margin-left: 2%;"
                                                                          id="restaurant_note{{$o->id}}"></textarea>
                                                            </div>

                                                            <div class="modal-footer" id="footerModal{{$o->id}}">
                                                                @if($o->step_id==1 ||$o->step_id==4)

                                                                    <button type="button" class="btn btn-danger light"
                                                                            data-bs-dismiss="modal"
                                                                            onclick="pass_order({{$o->id}},{{$o->order_stop_log_id}},{{$o->step_id}},0,'{{$o->created_at}}','{{$o->customer}}','{{$o->address}}','{{$o->total_cost_after}}')">
                                                                        Reject
                                                                    </button>
                                                                @endif
                                                                <button type="button" class="btn btn-primary"
                                                                        onclick="return pass_order({{$o->id}},{{$o->order_stop_log_id}},{{$o->step_id}},1,'{{$o->created_at}}','{{$o->customer}}','{{$o->address}}','{{$o->total_cost_after}}')">
                                                                    Approve
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form name="myform" method="get" action="{{route('print-order')}}"
          target="_blank">
        <input type="hidden" name="order_id" value="" id="order_id">
        <input type="hidden" name="customer_name" value="" id="customer_name">
        <input type="hidden" name="create_date" value="" id="create_date">
        <input type="hidden" name="location" value="" id="location">
        <input type="hidden" name="cost" value="" id="cost">
        <input type="hidden" name="rest_note" value="" id="rest_note">
        <input type="hidden" name="customer_note" value="" id="customer_note">
    </form>
    <a style="display: none" href="{{route('print-order')}}"
       id="print_submit"></a>
@endsection
@section('js')
    <script>
        $(document).on('click', "#print_submit", function () {
            document.forms['myform'].submit();
            return false;
        });
        $(document).on('click', ".load-ajax-modal", function () {
            // fetch($(this).attr('data-path'))
            //     .then(response => response.text())
            //     .then(html => {
            //         $('body').append(html);
            //         $('#order-details').modal('show');
            //     })
            var trid = $(this).attr('id');
            $.ajax({
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).data('path'),
                success: function (result) {
                    console.log(result[0]);
                    var address = result[0]['order_customer']['address'];
                    var username = result[0]['order_customer']['username'];
                    var phone_number = result[0]['order_customer']['phone_number'];
                    var items = result[0]['order_items'];
                    // $('body').append(html);
                    // $('#order-details').modal('show');
                    // $('#basicModal'+trid).modal("show");
                    // $('#bodyModal'+trid).html(result).show();
                    // $('#footerModal'+trid).modal("show");

                    var html = "";
                    var htm = '<div class="row" >\
                        <div class="card-body">\
                        <div class="imfo container" >\
                        \<div class="col-4 btn-group m-2" ><i class="fa fa-user" aria-hidden="true">\
                           </i> <h4 class="mb-0 text-black ms-3">' + username + '</h4></div>\
                           \<div class="col-4 btn-group m-2"><i class="fas fa-map-marker-alt" aria-hidden="true"></i> \
                              <h4 class="mb-0 text-black ms-3">' + address + '</h4></div>\
                           \<div class="col-4 btn-group m-2"> <i class="fas fa-phone-alt" aria-hidden="true">\
                           </i> <h4 class="mb-0 text-black ms-3">' + phone_number + '</h4></div>\
                        </div>\
        </div>\
                    </div>';
                    htm += '<div class="row" >\
                        <div class="card-body">\
                        <div class="table-responsive">\
                        <table id="example3" class="table display mb-4  order-table shadow-hover card-table text-black  no-footer">\
                        \<thead>\
                        \<tr> <th > Meal Id\
                        \<th >Meal Name</th>\
                      \<th >Meal Count</th>\
                    <th >Meal Component</th>\
                    \</tr>\
               \ </thead>\
                <tbody>\
                       ';
                    var end = ' </div>\
                         </div>\
                    </div>'
                    for (var i = 0; i < items.length; i++) {
                        htm += '<tr> ';
                        var component = items[i].item_component;
                        var component_name = '';
                        for (var j = 0; j < component.length; j++) {
                            component_name += component[j].component_name_en;
                            if (j != component.length - 1)
                                component_name += " , ";
                        }
                        var item_id = items[i].item_id;
                        var item_name = items[i].item_name_en;
                        var item_count = items[i].item_count;
                        htm += '<td>' + item_id + '</td><td>' + item_name + '</td><td>' + item_count + '</td><td>' + component_name + '</td></tr>'

                    }
                    var note = result[0]['order_customer']['note'];
                    htm += '</tbody></table> <div class="row" >\
                     <div class="imfo" ><div class="col-12"><h4 style="color: #ed613a !important">NOTE : </h4></div></div></div><div class="row" ><div class="imfo" ><div class="col-12 mb-3"><h4>' + ' ' + note + '</h4></div></div></div>';
                    $('#content' + trid).html(htm);
                    $('#basicModal' + trid).modal('show');
                }
            });
        });


        function pass_order(order_id, ord_step_id, step_id, flag, create_date, customer_name, location, cost) {
            var url = 'pass_order';
            var restaurant_note = document.getElementById("restaurant_note" + order_id).value;
            var customer_note = document.getElementById("customer_note" + order_id).innerText;
            // console.log(customer_note);
            //
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    step_id: step_id,
                    order_id: order_id,
                    ord_step_id: ord_step_id,
                    flag: flag,
                    restaurant_note: restaurant_note,
                    customer_note: customer_note
                },
                success: function (data) {

                    if (data.status) {
                        // setTimeout(() => {
                        //     toastr.success('marked as read ','Read');
                        // },3000);
                        document.getElementById("order_id").value = order_id;
                        document.getElementById("create_date").value = create_date;
                        document.getElementById("customer_name").value = customer_name;
                        document.getElementById("location").value = location;
                        document.getElementById("cost").value = cost;
                        document.getElementById("rest_note").value = restaurant_note;
                        document.getElementById("customer_note").value = customer_note;


                        if (step_id == 1 && flag == 1) {
                            console.log('sdsf');
                            $('#print_submit').trigger('click');
                        }
                        // $('#basicModal' + order_id).modal('toggle');
                        window.location.reload(true);


                        // toastr.success(
                        //     'pass to next step',
                        //     'Orders',
                        //     {
                        //         timeOut: 2000,
                        //         fadeOut: 1000,
                        //         onHidden: function () {
                        //             window.location.reload();
                        //         }
                        //     }
                        // );
                        // location.reload();
                    } else {
                        // setTimeout(() => {
                        //     toastr.error('error in app','s');
                        // },3000);
                        // location.reload();
                        // $('#basicModal' + order_id).modal('toggle');
                        window.location.reload(true);

                        toastr.success(
                            'error in app',
                            'Notification',
                            {
                                timeOut: 2000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.reload();
                                }
                            }
                        );
                    }

                }
            });
        }
    </script>
@endsection
