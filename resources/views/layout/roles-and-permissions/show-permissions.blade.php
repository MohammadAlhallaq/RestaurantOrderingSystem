@extends('layout.mainlayout')

@section('content')
    <!-- end page title -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Permissions</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
{{--                        <div style="display:flex; justify-content:flex-end; margin-bottom:10px;">--}}
{{--                            <a href="{{route('add-permission')}}" class="btn btn-rounded btn-primary">--}}
{{--                                <span class="btn-icon-start" style="color: #fc410c"><i--}}
{{--                                        class="fa fa-plus color-primary"></i></span>--}}
{{--                                Add Permission</a>--}}
{{--                        </div>--}}
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                            <tr>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($permissions as $permission)
                                <tr id="{{$permission->id}}">
                                    <td>{{$permission->name}}</td>
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
