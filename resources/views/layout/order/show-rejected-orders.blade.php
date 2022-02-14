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
                                <th class="sorting">My Order note</th>
                                {{--                                <th class="sorting">Action</th>--}}
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
                                    <td class="text-ov">{{$o->total_cost_before}}</td>
                                    <td class="text-ov">{{$o->pay_type_name}}</td>
                                    <td><span
                                            class="btn @if($o->step_id==1) badge badge-secondary @elseif($o->step_id==2) badge badge-primary @elseif($o->step_id==3) badge badge-primary-dark @elseif($o->step_id==4) badge badge-warning @elseif($o->step_id==5) badge badge-success @else btn-danger  @endif  btn-rounded btn-sm">{{$o->step_name_en}}</span>
                                    </td>
                                    <td>{{$o->note}}</td>

                                    <td>{{$o->restaurant_note}}</td>
                                    {{--                                    <td>--}}
                                    {{--                                        <div class="dropdown ml-auto">--}}
                                    {{--                                            <div class="btn-link" data-bs-toggle="dropdown">--}}
                                    {{--                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"--}}
                                    {{--                                                     xmlns="http://www.w3.org/2000/svg">--}}
                                    {{--                                                    <path--}}
                                    {{--                                                        d="M11.0005 12C11.0005 12.5523 11.4482 13 12.0005 13C12.5528 13 13.0005 12.5523 13.0005 12C13.0005 11.4477 12.5528 11 12.0005 11C11.4482 11 11.0005 11.4477 11.0005 12Z"--}}
                                    {{--                                                        stroke="#3E4954" stroke-width="2" stroke-linecap="round"--}}
                                    {{--                                                        stroke-linejoin="round"></path>--}}
                                    {{--                                                    <path--}}
                                    {{--                                                        d="M18.0005 12C18.0005 12.5523 18.4482 13 19.0005 13C19.5528 13 20.0005 12.5523 20.0005 12C20.0005 11.4477 19.5528 11 19.0005 11C18.4482 11 18.0005 11.4477 18.0005 12Z"--}}
                                    {{--                                                        stroke="#3E4954" stroke-width="2" stroke-linecap="round"--}}
                                    {{--                                                        stroke-linejoin="round"></path>--}}
                                    {{--                                                    <path--}}
                                    {{--                                                        d="M4.00049 12C4.00049 12.5523 4.4482 13 5.00049 13C5.55277 13 6.00049 12.5523 6.00049 12C6.00049 11.4477 5.55277 11 5.00049 11C4.4482 11 4.00049 11.4477 4.00049 12Z"--}}
                                    {{--                                                        stroke="#3E4954" stroke-width="2" stroke-linecap="round"--}}
                                    {{--                                                        stroke-linejoin="round"></path>--}}
                                    {{--                                                </svg>--}}
                                    {{--                                            </div>--}}
                                    {{--                                            <div class="dropdown-menu dropdown-menu-right">--}}
                                    {{--                                                <a class="dropdown-item text-black" href="javascript:void(0);"--}}
                                    {{--                                                   onclick="return pass_order({{$o->id}},{{$o->order_stop_log_id}},{{$o->step_id}},1,'{{$o->created_at}}','{{$o->customer}}')"><i--}}
                                    {{--                                                        class="far fa-check-circle me-1 text-success"></i>Accept--}}
                                    {{--                                                    order</a>--}}
                                    {{--                                                <a class="dropdown-item text-black"--}}
                                    {{--                                                   --}}{{--                                                   @if($o->step_id==2) hidden @endif --}}
                                    {{--                                                   href="javascript:void(0);"--}}
                                    {{--                                                   onclick="return pass_order({{$o->id}},{{$o->order_stop_log_id}},{{$o->step_id}},0,'{{$o->created_at}}','{{$o->customer}}')"><i--}}
                                    {{--                                                        class="far fa-times-circle me-1 text-danger"></i>Reject--}}
                                    {{--                                                    order</a>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </td>--}}
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
    </form>
    <a style="display: none" href="{{route('print-order')}}"
       id="print_submit"></a>
@endsection
@section('js')
    <script>
        $('#print_submit').click(function () {

            document.forms['myform'].submit();
            return false;


        });

        function pass_order(order_id, ord_step_id, step_id, flag, create_date, customer_name) {

            var url = 'pass_order';
            console.log(step_id);
            console.log(flag);
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

                },
                success: function (data) {

                    if (data.status) {
                        // setTimeout(() => {
                        //     toastr.success('marked as read ','Read');
                        // },3000);
                        document.getElementById("order_id").value = order_id;
                        document.getElementById("create_date").value = create_date;
                        document.getElementById("customer_name").value = customer_name;
                        if (step_id == 1 && flag == 1) {
                            console.log('sdsf');
                            $('#print_submit').trigger('click');
                        }

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
                        toast
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
