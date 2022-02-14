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
                                <h4 class="text-center mb-4">Sign in your account</h4>
                                <form action="{{route('login')}}" method="post">
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email or Username</strong></label>
                                        <input type="text" class="form-control" name="login">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="row d-flex justify-content-between mt-4 mb-2">
                                        <div class="mb-3">
                                            <div class="form-check custom-checkbox ms-1">
                                                <input type="checkbox" class="form-check-input" id="remember"
                                                       name="remember">
                                                <label class="form-check-label" for="basic_checkbox_1">Remember
                                                    me</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="login btn btn-primary btn-block">Sign In</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3 text-center">
                                    <p>Don't have an account? <a class="text-primary  align"
                                                                 href="{{route('sign-up')}}">Sign up</a></p>
                                    <p>Forgot password? <a class="text-primary  align" href="{{route('forget.password.get')}}">Reset password</a></p>
                                </div>

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
        $(this).attr("disabled", true);
        $('#spinner').show();
        let login = $("input[name=login]").val();
        let password = $("input[name=password]").val();
        let remember = document.getElementById('remember').checked;
        $.ajax({
            url: '{{route('login')}}',
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            data: {
                login: login,
                password: password,
                remember: remember,
            },
            success: (response)=> {
                $('#spinner').hide();
                $(this).attr("disabled", false);
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
                } else if (response.result == 'credentials') {
                    toastr.error(response.message, "Ops!", {
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
                } else {
                    window.location.replace("home");
                }
            },
        });
    });
</script>
</body>
</html>
