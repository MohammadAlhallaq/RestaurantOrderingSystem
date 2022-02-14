@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-xxl-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Admin Information</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form class="form-wizard order-create sw sw-theme-default sw-justified needs-validation" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="email">name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Account name" required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="email">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required value="{{old('email')}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="mobile_number">Phone Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number" required value="{{old('mobile_number')}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="national_number">National Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="national_number" id="national_number" placeholder="National Number" required value="{{old('mobile_number')}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="text-label form-label">Roles*</label>
                                    <select name="role" id="role"
                                            tabindex="-1" class="default-select  form-control wide">
                                        <option value="">Select Role</option>
                                        @foreach(\App\Models\Role::all() as $role)
                                            <option class="form-control"
                                                    value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="mobile_number">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="mb-3">
                                        <label class="text-label form-label" for="mobile_number">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <button type="submit" class="btn me-2 btn-primary mt-3 submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end col -->

@endsection
@section('js')
    <script src="{{URL::asset('dashboard-layout/libs/mask/jquery.mask.min.js')}}"></script>

    <script>
        $("#national_number").mask("000-0000-0000000-0",{placeholder:"Ex: 345-6754-6578943-1"});
        $("#mobile_number").mask("00000 00 000 0000",{placeholder:"Ex: 00971 55 458 3586"});

        $(".submit").click(function(event){
            event.preventDefault();
            let account_name = $("input[name=name]").val();
            let email = $("input[name=email]").val();
            let mobile_number = $("input[name=mobile_number]").val();
            let national_number = $("input[name=national_number]").val();
            let password = $("input[name=password]").val();
            let password_confirmation = $("input[name=password_confirmation]").val();
            let role = $("select[name=role]").val();

            var data = new FormData();
            data.append('account_name', account_name)
            data.append('email', email)
            data.append('mobile_number', mobile_number)
            data.append('national_number', national_number)
            data.append('password', password)
            data.append('password_confirmation', password_confirmation)
            data.append('role', role)
            $.ajax({
                url: '{{route('create-admin')}}',
                method:"POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,

                success:function(response){
                    if(response.result == 'false') {
                        Object.keys(response.errors).forEach(key => {
                            toastr.error(response.errors[key], "Heads Up", {
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
                        })
                    }else if(response.result == 'success'){
                        // redirect to page the shows all the admins
                        window.location.replace("show-admins");
                    }
                },
            });
        });
    </script>
@endsection
