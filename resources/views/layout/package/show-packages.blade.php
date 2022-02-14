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
                    <h4 class="card-title">Packages</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Number of meals
                                <th>Duration</th>
                                <th>cost</th>
                                <th>Created at</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($packages as $package)
                                <tr>
                                    <td>{{$package->title}}</td>
                                    <td>{{$package->category->category_name}}</td>
                                    <td>{{$package->allowed_meals}}</td>
                                    <td>{{$package->duration >= 12 ? floor($package->duration/12).' YR and '.$package->duration%12 .' MTH' : $package->duration . ' MTH'}}</td>
                                    <td>{{$package->cost.' AED'}}</td>
                                    <td>{{date('d-m-Y', strtotime($package->created_at))}}</td>
                                    <td>
                                        @can('manage-packages')
                                            <div class="dropdown custom-dropdown mb-0">
                                                <div class="btn sharp btn-primary tp-btn" data-bs-toggle="dropdown"
                                                     aria-expanded="false">
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
                                                <div class="dropdown-menu dropdown-menu-end" style="margin: 0px;">
                                                    <a class="dropdown-item text-success"
                                                       href="{{route('update-package', $package->id)}}">Edit</a>
                                                    <a class="dropdown-item text-danger delete"
                                                       href="{{route('delete-package', $package->id)}}">Delete</a>
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

        $(document).on('click', ".delete", function (e) {
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
                        $('#spinner').show();
                        $.ajax({
                            url: url,
                            type: "DELETE",
                            headers: {
                                'X-CSRF-Token': '{{ csrf_token() }}',
                            },
                            success: (data) => {
                                $('#spinner').hide();
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
