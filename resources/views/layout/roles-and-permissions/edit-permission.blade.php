@extends('layout.mainlayout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Permission</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('edit-permission', $permission->id)}}" method="post" id="add-package">
                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Permission Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="name" value="{{$permission->name}}" required>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn me-2 btn-primary send">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('dashboard-layout/libs/mask/jquery.mask.min.js')}}"></script>

    <script>
        $(".send").on('click', function (event) {
            event.preventDefault();
            var url = $('#add-package').attr('action');
            let name = $("input[name=name]").val();
            $.ajax({
                url: url,
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    name: name,
                },
                success: (response) => {
                    if (response.status == false) {
                        Object.keys(response.errors).forEach(key => {
                            toastr.error(response.errors[key], "Heads Up!", {
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
                        })
                    } else if (response.status == true) {
                        window.location.replace("/show-permissions");
                    }
                }
            });
        });
    </script>

@endsection
