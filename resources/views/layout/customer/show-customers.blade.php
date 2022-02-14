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

    <div class="container-fluid">
        <h2 class="mb-3 me-auto">Customers</h2>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Restaurants</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th>Customer ID</th>
                                    <th>Join Date</th>
                                    <th>Customer Name</th>
                                    <th>Status</th>
                                    <th>Last Order</th>
                                    <th>Total spent</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <td>#{{$customer->id}}</td>
                                        <td>{{$customer->created_at}}</td>
                                        <td>{{$customer->username}}</td>
                                        <td>
                                            <span
                                                class="badge light {{$customer->status_id == 1 ? 'badge-success' : 'badge-danger'}}"
                                                id="{{$customer->id}}">{{$customer->status->status}}</span>
                                        </td>
                                        <td>
                                            AED {{count($customer->order) ? $customer->order->last()->total_cost_after : 0}}</td>
                                        <td>AED {{$customer->order->sum('total_cost_after')}}</td>
                                        <td>
                                            @can('manage-customers')
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown"
                                                         aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="18px"
                                                             height="18px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <circle fill="#000000" cx="12" cy="5" r="2"></circle>
                                                                <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                                                <circle fill="#000000" cx="12" cy="19" r="2"></circle>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="dropdown-menu dropdown-menu-end"
                                                         data-popper-placement="top-end"
                                                         style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(-105px, -37px);">
                                                        <a class="dropdown-item change-status" href="#"
                                                           data-customer-id="{{$customer->id}}"
                                                           id="dropdown-text">{{$customer->status_id == '1' ? 'deactivate' : 'activate'}}</a>
                                                    </div>
                                                </div>
                                            @endcan
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
    </div>


@endsection

@section('js')
    <script>

        $(document).on('click', ".change-status", function (event) {
            event.preventDefault()
            $('#spinner').show();

            let customer_id = $(this).data('customer-id');
            $.ajax({
                url: '{{route('customer-change-Status')}}',
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    customer_id: customer_id,
                },
                success: (response) => {
                    $('#spinner').hide();
                    if (response.result == 'true') {
                        if (document.getElementById(customer_id).classList.contains('badge-success')) {
                            document.getElementById(customer_id).classList.remove('badge-success');
                            document.getElementById(customer_id).classList.add('badge-danger');
                            document.getElementById(customer_id).innerHTML = 'inactive';
                            $(this).text("activate");
                        } else if (document.getElementById(customer_id).classList.contains('badge-danger')) {
                            document.getElementById(customer_id).classList.remove('badge-danger');
                            document.getElementById(customer_id).classList.add('badge-success');
                            document.getElementById(customer_id).innerHTML = 'active';
                            $(this).text("deactivate");

                        }
                    }
                },
            });
        });
    </script>

@endsection
