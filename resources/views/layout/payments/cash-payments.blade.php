@extends('layout.mainlayout')
<link href="{{asset('dashboard-layout/css/spinner.css')}}" rel="stylesheet">
@section('content')
    <div class="circles-to-rhombuses-spinner overlay" id="spinner" style=" display: none; position: fixed;
  z-index: 999;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;">
        <div class="circle"></div>
        <div class="circle"></div>
        <div class="circle"></div>
    </div>
    <!-- start page title -->
    {{--    <div class="row page-titles">--}}
    {{--        <ol class="breadcrumb">--}}
    {{--            <li class="breadcrumb-item active"><a href="javascript:void(0)">restaurant Admin</a></li>--}}
    {{--            <li class="breadcrumb-item"><a href="javascript:void(0)">Restaurant Category</a></li>--}}
    {{--        </ol>--}}
    {{--    </div>--}}

    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Cash Payments</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>

                                <th>Paid by</th>
                                <th>amount</th>
                                <th>Paid at</th>
                                <th>actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$payment->account->account_name}}</td>
                                    <td>{{$payment->amount}}</td>
                                    <td>{{$payment->created_at}}</td>
                                    <td>
                                        <div class="dropdown custom-dropdown mb-0">
                                            <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown"
                                                 aria-expanded="true">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="18px"
                                                     height="18px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                        <rect x="0" y="0" width="24" height="24"></rect>
                                                        <circle fill="#000000" cx="12" cy="5" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                        <circle fill="#000000" cx="12" cy="19" r="2"></circle>
                                                    </g>
                                                </svg>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-end" data-popper-placement="top-end"
                                                 style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(-105px, -37px);">
                                                <a class="dropdown-item text-success approve-payment"
                                                   href="{{route('accept-payment', $payment->id)}}">Accept Payment</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>


        $(document).on('click', ".approve-payment",function (event) {
            event.preventDefault()
            let url = $(this).attr('href');
            swal({
                title: "Accept the payment",
                type: "info",
                showCancelButton: !0,
                confirmButtonColor: "#68e365",
                confirmButtonText: "Yes, Accept it",
                cancelButtonText: "No, cancel it !!",
            }).then((result) => {
                if (result.value) {
                    $('#spinner').show();
                    $.ajax({
                        url: url,
                        type: "GET",
                        success: (response) => {
                            $('#spinner').hide();
                            if (response.result == 'success') {
                                $(this).closest("tr").remove();
                                toastr.success(response.message, "Heads Up", {
                                    positionClass: "toast-top-right",
                                    timeOut: 3e3,
                                    closeButton: !0,
                                    debug: !1,
                                    newestOnTop: !0,
                                    progressBar: !0,
                                    preventDuplicates: !0,
                                    onclick: null,
                                    showDuration: "300",
                                    hideDuration: "1000",
                                    extendedTimeOut: "1000",
                                    showEasing: "swing",
                                    hideEasing: "linear",
                                    showMethod: "fadeIn",
                                    hideMethod: "fadeOut",
                                    tapToDismiss: !1,
                                })

                            }
                        },
                    });

                }
            })

        });
    </script>


@endsection
