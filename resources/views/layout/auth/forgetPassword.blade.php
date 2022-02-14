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
                                <form method="post">
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email address</strong></label>
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="submit btn btn-primary btn-block">Send reset link
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

    $(".submit").click(function (event) {
        event.preventDefault();
        $('#spinner').show();
        let email = $("input[name=email]").val();
        $.ajax({
            url: '{{route('forget.password.post')}}',
            type: "POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            data: {
                email: email,
            },
            success: function (response) {
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
                } else if (response.result == 'true') {
                    $(".submit").attr('disabled', true)
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
                        tapToDismiss: !1
                    })
                }
            },
        });
    });
</script>
</body>
</html>
