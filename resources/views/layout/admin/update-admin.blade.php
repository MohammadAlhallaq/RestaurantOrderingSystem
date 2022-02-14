@extends('layout.mainlayout')
<link href="{{asset('dashboard-layout/css/spinner.css')}}"  rel="stylesheet">
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
    <div class="row">
        <div class="col-xl-12 col-xxl-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Admin</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('update-admin', $account->id)}}" class="form-wizard order-create sw sw-theme-default sw-justified needs-validation" method="post">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="account_name">Account Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="account_name" id="account_name" placeholder="Admin Name" required value="{{$account->account_name}}">
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
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" required value="{{$account->email}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="mobile_number">Phone Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="mobile_number" id="mobile_number" placeholder="Mobile Number" required value="{{$account->phone_number}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="national_number">National Number</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="national_number" id="national_number" placeholder="National Number" required value="{{$account->national_number}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="national_number">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div  class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="national_number">Password Confirmation</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password confirmation" required>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn me-2 btn-primary mt-3 submit">Update</button>
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
            $('#spinner').show();
            event.preventDefault();
            let account_name = $("input[name=account_name]").val();
            let password = $("input[name=password]").val();
            let password_confirmation = $("input[name=password_confirmation]").val();
            let email = $("input[name=email]").val();
            let mobile_number = $("input[name=mobile_number]").val();
            let national_number = $("input[name=national_number]").val();

            var data = new FormData();
            data.append('account_name', account_name)
            data.append('password', password)
            data.append('password_confirmation', password_confirmation)
            data.append('email', email)
            data.append('mobile_number', mobile_number)
            data.append('national_number', national_number)
            var url= $('form').attr('action');
            $.ajax({
                url: url,
                method:"POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,

                success:function(response){
                    $("input[name=password]").val('');
                    $("input[name=password_confirmation]").val('');
                    $('#spinner').hide();
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
                    }else if(response.result == 'exception'){
                        toastr.error(response.message, "Heads Up", {
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
                    }else if (response.result == 'success'){
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
        });
    </script>
@endsection
