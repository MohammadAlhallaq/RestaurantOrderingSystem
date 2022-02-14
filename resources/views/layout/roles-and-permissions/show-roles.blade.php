@extends('layout.mainlayout')

@section('content')
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Roles</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div style="display:flex; justify-content:flex-end; margin-bottom:10px;">
                            <a href="{{route('add-role')}}" class="btn btn-rounded btn-primary">
                                <span class="btn-icon-start" style="color: #fc410c"><i
                                        class="fa fa-plus color-primary"></i></span>
                                Add Role</a>
                        </div>
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr id="{{$role->id}}">
                                    <td>{{$role->name}}</td>
                                    <td>
                                        @if($role->id != \App\Models\Role::MASTER_ADMIN)
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
                                                    <a class="dropdown-item"
                                                       href="{{route('edit-role', $role->id)}}">Edit</a>
                                                    <a class="dropdown-item text-danger sweet-confirm"
                                                       href="{{route('delete-role', $role->id)}}">Delete</a>
                                                </div>
                                            </div>
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
