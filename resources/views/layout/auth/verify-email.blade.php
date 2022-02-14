
<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edage">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Lezato : Restaurant Admin Template" />
    <meta property="og:title" content="Lezato : Restaurant Admin Template" />
    <meta property="og:description" content="Lezato : Restaurant Admin Template" />
    <meta property="og:image" content="social-image.png" />
    <meta name="format-detection" content="telephone=no">

    <!-- PAGE TITLE HERE -->
    <title>Restaurant Admin</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="{{asset('dashboard-layout/images/bg-logo.png')}}" />
    <link href="{{asset('dashboard-layout/css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('dashboard-layout/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .authincation{
            background-color: #212130;
        }
        h4{
            color: #fff;
        }
    </style>
</head>

<body class="vh-100">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-7">
                <div class="form-input-content text-center error-page">
                    <h4><i class="fa fa-exclamation-triangle text-warning"></i> <strong>Ops!</strong> Looks like you have not verified your email yet...</p>
                        <div>
                            <button class="btn btn-primary send">Re-send email</button>
                        </div>

                        <div>
                            <a href="{{route('log-out')}}" class="btn btn-primary" disabled>Logout</a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('dashboard-layout/vendor/global/global.min.js')}}"></script>
<script src="{{URL::asset('dashboard-layout/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>

<script>


    $(".send").one('click', function(event){
        $(this).attr('disabled', 'true')
        event.preventDefault();
        $.ajax({
            url: '{{route('verification.send')}}',
            type:"POST",
            headers: {
                'X-CSRF-Token': '{{ csrf_token() }}',
            },
            complete: function (){
                sweetAlert("Great!", 'Please check your email', "success")
                $('.send').css('cursor', 'pointer')
            }
        })
    });
</script>
<!--**********************************
	Scripts
***********************************-->
<!-- Required vendors -->
</body>

</html>

