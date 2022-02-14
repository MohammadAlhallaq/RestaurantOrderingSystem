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
    <!-- end page title -->
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
                                <th></th>
                                <th>Name</th>
                                <th>email</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>opened/Closed</th>
                                <th>Create at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($restaurants as $res)
                                <tr>
                                    <td class="sorting_1"><img class="rounded-circle" width="35"
                                                               src="{{asset($res->logo_path != null ? '/restaurants/logo/'.$res->id.'/'. $res->logo_path : '/restaurants/logo/bg-logo.png')}}"
                                                               alt=""></td>
                                    <td>{{$res->account_name}}</td>
                                    <td>{{$res->email}}</td>
                                    <td>{{$res->category->category_name}}</td>
                                    <td>
                                        <span
                                            class="badge light {{$res->status->id == 1 ? 'badge-success' : 'badge-danger'}}"
                                            id="{{$res->id}}">{{$res->status->status}}</span>
                                    </td>
                                    <td>
                                        @can('manage-restaurants')
                                            <label class="switch" style="left: 30px">
                                                <input type="checkbox" data-restaurant-id="{{$res->id}}"
                                                       {{$res->work_status_id == 1 ? 'checked' : ''}} class="statusSwitch">
                                                <span class="slider round"></span>
                                            </label>
                                        @endcan
                                    </td>
                                    <td>{{date('d-m-Y', strtotime($res->created_at))}}</td>
                                    <td>
                                        @can('manage-restaurants')
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
                                                       data-status-id="{{$res->status->id}}"
                                                       data-restaurant-id="{{$res->id}}"
                                                       id="dropdown-text">{{$res->status->id == '1' ? 'deactivate' : 'activate'}}</a>
                                                    <a class="dropdown-item" href="#">Delete</a>
                                                </div>
                                                @endcan
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

        $(document).on('click', ".change-status", function (event) {
            event.preventDefault()
            $('#spinner').show();
            let restaurant_id = $(this).data('restaurant-id');
            let status_id = $(this).data('status-id');
            $.ajax({
                url: '{{route('change-Status')}}',
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    restaurant_id: restaurant_id,
                    status_id: status_id,
                },
                success: (response) => {
                    $('#spinner').hide();
                    if (response.result == 'true') {
                        if (document.getElementById(restaurant_id).classList.contains('badge-success')) {
                            document.getElementById(restaurant_id).classList.remove('badge-success');
                            document.getElementById(restaurant_id).classList.add('badge-danger');
                            document.getElementById(restaurant_id).innerHTML = 'inactive';
                            $(this).text("activate");
                        } else if (document.getElementById(restaurant_id).classList.contains('badge-danger')) {
                            document.getElementById(restaurant_id).classList.remove('badge-danger');
                            document.getElementById(restaurant_id).classList.add('badge-success');
                            document.getElementById(restaurant_id).innerHTML = 'active';
                            $(this).text("deactivate");

                        }
                    }
                },
            });
        });
    </script>

    <script>
        $(document).on('change', ".statusSwitch", function () {
            $('#spinner').show();
            let restaurant_id = $(this).data('restaurant-id');
            $.ajax({
                url: '{{route('profile-change-status')}}',
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    restaurant_id: restaurant_id,
                },
                success: (response) => {
                    $('#spinner').hide();
                    if (response.result == 'true') {
                    }
                },
            });
        })
    </script>
@endsection
