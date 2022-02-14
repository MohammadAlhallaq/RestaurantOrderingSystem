@extends('layout.mainlayout')

@section('content')
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
                                <th>Name</th>
                                <th>email</th>
                                <th>Mobile</th>
                                <th>National number</th>
                                <th>Created at</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $admin)
                                <tr id="{{$admin->id}}">
                                    <td>{{$admin->account_name}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>{{$admin->phone_number}}</td>
                                    <td>{{$admin->national_number}}</td>
                                    <td>{{date('d-m-Y', strtotime($admin->created_at))}}</td>
                                    <td>
                                        @if($admin->id != \App\Models\Account::SUPER_ADMIN)
                                            @canany(['delete-admin', 'edit-admin', 'grant-privileges'])
                                                <div class="dropdown custom-dropdown mb-0">
                                                    <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown"
                                                         aria-expanded="true">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="18px"
                                                             height="18px" viewBox="0 0 24 24">
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
                                                        @can('grant-privileges')
                                                            <a class="dropdown-item"
                                                               href="{{route('grant-privileges', $admin->id)}}">change
                                                                Role</a>
                                                        @endcan
                                                        @can('edit-admin')
                                                            <a class="dropdown-item"
                                                               href="{{route('update-admin', $admin->id)}}">Edit</a>
                                                        @endcan
                                                        @can('delete-admin')
                                                                <a class="dropdown-item text-danger sweet-confirm"
                                                                   href="{{route('delete-admin', $admin->id)}}">Delete</a>
                                                        @endcan

                                                    </div>
                                                </div>
                                            @endcanany
                                        @endif
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

        $(document).on('click', ".sweet-confirm", function (e) {
            var url = $(this).attr('href');
            e.preventDefault();
            swal({
                title: "Are you sure to delete ?",
                text: "You will not be able to recover it !!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it !!",
                cancelButtonText: "No, cancel it !!",
            }).then(
                (result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}',
                            },
                            success: (data) => {
                                $(this).closest('tr').remove()
                                toastr.success(data.message, "Great!", {
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
                                    tapToDismiss: !1
                                })
                            }
                        });
                    }
                })
        });
    </script>

@endsection
