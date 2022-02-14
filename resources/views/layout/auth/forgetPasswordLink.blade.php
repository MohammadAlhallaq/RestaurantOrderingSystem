<html lang="en" class="h-100" dir="ltr">
<head>
    @include('layout.partials.head')
    <link href="{{asset('dashboard-layout/css/spinner.css')}}" rel="stylesheet">

</head>
<body class="vh-100" data-typography="opensans" data-theme-version="dark" data-layout="vertical"
      data-nav-headerbg="color_1" data-headerbg="color_1" data-sidebar-style="full" data-sibebarbg="color_1"
      data-sidebar-position="fixed" data-header-position="fixed" data-container="wide" direction="ltr"
      data-primary="color_1">

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


<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="/">
                                        <img src="{{URL::asset('dashboard-layout/images/bg-logo.png')}}" alt=""
                                             height="40"></a>
                                </div>
                                <h4 class="text-center mb-4">Reset Your Password</h4>
                                <form method="post">

                                    <input type="text" value="{{$token}}" name="token" hidden>

                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control" name="password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Confirm Password</strong></label>
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="login btn btn-primary btn-block">Reset Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--**********************************
    Scripts
***********************************-->

<!-- Required vendors -->
@include('layout.partials.footer-scripts')
<script>

    $(".login").click(function (event) {
        event.preventDefault();
        $('#spinner').show();
        let token = $("input[name=token]").val();
        let email = $("input[name=email]").val();
        let password = $("input[name=password]").val();
        let password_confirmation = $("input[name=password_confirmation]").val();
        $.ajax({
            url: '{{route('reset.password.post')}}',
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            data: {
                token: token,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
            },
            success: (response) => {
                $('#spinner').hide();
                if (response.result == 'false') {
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
                            tapToDismiss: !1
                        })
                    })
                } else if (response.result == 'invalid') {
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
                        tapToDismiss: !1
                    })
                } else if (response.result == 'true') {
                    $(this).attr('disabled', true)
                    sweetAlert("Great!", response.message, "success").then(
                        (result) => {
                            if (result.value) {
                                window.location.replace("/login");
                            }
                        })
                }
            }
        });
    });
</script>
</body>
</html>
