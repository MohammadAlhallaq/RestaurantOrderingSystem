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
                                    <a href="/"><img
                                            src="{{URL::asset('dashboard-layout/images/bg-logo.png')}}" alt=""
                                            height="40"></a>
                                </div>
                                <h4 class="text-center mb-4">Sign up your account</h4>
                                <form action="http://lezato.dexignzone.com/xhtml/index.html">
                                    <div class="row">

                                        <div class="mb-3 col-md-6">
                                            <label class="mb-1"><strong>Business Name</strong> <small>(As per trade
                                                    license)</small></label>
                                            <input type="text" class="form-control" name="business_name" required>
                                        </div>


                                        <div class="mb-3 col-md-6">
                                            <label class="mb-1"><strong>Email</strong></label>
                                            <input type="email" class="form-control" name="email">
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="mb-1"><strong>Phone number</strong></label>
                                            <input type="text" class="form-control" name="phone_number" value="00971"
                                                   id="phone_number">
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="mb-1"><strong>Password</strong></label>
                                            <input type="password" class="form-control" name="password" id="password">
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="mb-1"><strong>Confirm Password</strong></label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                   id="password_confirmation">
                                        </div>

                                        <div class="text-center col-md-12">
                                            <button type="submit" class="btn btn-primary btn-block submit">Sign me up
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="new-account mt-3 text-center">
                                    <p>Already have an account? <a class="text-primary" href="{{route('login')}}">Sign
                                            in</a></p>
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

<script src="{{URL::asset('dashboard-layout/libs/mask/jquery.mask.min.js')}}"></script>

<script>
    $("#phone_number").mask("00000 00 000 0000", {placeholder: "Ex: 00971 55 458 3586"});
</script>

<script>
    $("input[name=phone_number]").keyup(function () {
        var prefix = '00971';
        if (!(this.value.match('^00971'))) {
            this.value = prefix;
        }
    });

    $("input[name=phone_number]").blur(function () {
        var prefix = '00971';
        if (!(this.value.match('^00971'))) {
            this.value = prefix;
        }
    });
</script>

<script>
    $(".submit").on('click', function (event) {
        event.preventDefault();
        $('#spinner').show();
        $(this).attr("disabled", true);
        let business_name = $("input[name=business_name]").val();
        let email = $("input[name=email]").val();
        let phone_number = $("input[name=phone_number]").val();
        let password = $("input[name=password]").val();
        let password_confirmation = $("input[name=password_confirmation]").val();
        $.ajax({
            url: '{{route('sign-up')}}',
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            data: {
                business_name: business_name,
                email: email,
                phone_number: phone_number,
                password: password,
                password_confirmation: password_confirmation,
            },

            success: (response) => {
                $('#spinner').hide();
                if (response.result == 'false') {
                    $(this).attr("disabled", false);
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
                } else if (response.result == 'true') {
                    sweetAlert("Great!", response.message, "success").then(
                        (result) => {
                            if (result.value) {
                                window.location.replace("/");
                            }
                        })
                }
            },
        });
    });
</script>
</body>
</html>
