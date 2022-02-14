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

        function pass_order(order_id, ord_step_id, step_id, flag,create_date,customer_name) {

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
                        if (step_id == 1 && flag == 1){
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
