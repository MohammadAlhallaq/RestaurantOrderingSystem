
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
                    <h4><i class="fas fa-check text-success"></i> <strong>{{\Illuminate\Support\Facades\Auth::user()->account_name}}!</strong> Your application is completed. An email will be sent addressing the status of your application</h4>
                    <div>
                        <a class="btn btn-primary" href="{{'general-information-step'}}" style="margin-right: 10px">Edit your application</a>
                        <a class="btn btn-primary" href="{{'log-out'}}">Logout</a>
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
</body>

</html>

