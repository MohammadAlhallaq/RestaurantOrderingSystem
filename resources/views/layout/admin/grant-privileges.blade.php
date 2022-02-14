@extends('layout.mainlayout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Role</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('grant-privileges', $account->id)}}" method="post" id="grant-privileges">
                            <div class="mb-3 ">
                                <label class="text-label form-label">Roles*</label>
                                <select name="role" id="role"
                                        tabindex="-1" class="default-select  form-control wide">
                                    <option value="">Select Role</option>
                                    @foreach(\App\Models\Role::all() as $role)
                                        <option class="form-control"
                                                value="{{$role->id}}" {{$account->role()->exists() ? $account->role()->first()->id == $role->id ? 'selected' : '' : ''}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn me-2 btn-primary send" style="margin-top: 10px">Update</button>
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
            var url = $('#grant-privileges').attr('action');
            let role = $("select[name=role]").val();
            $.ajax({
                url: url,
                type: "POST",
                data: {
                    role: role,
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
                        window.location.replace("/show-admins");
                    }
                }
            });
        });
    </script>

@endsection
