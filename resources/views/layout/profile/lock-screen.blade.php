<html lang="en" class="h-100" dir="ltr">
    <head>
        @include('layout.partials.head')
    </head>


<body class="vh-100" data-typography="poppins" data-theme-version="light" data-layout="vertical" data-nav-headerbg="color_1" data-headerbg="color_1" data-sidebar-style="full" data-sibebarbg="color_1" data-sidebar-position="fixed" data-header-position="fixed" data-container="wide" direction="ltr">
<div class="authincation h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="index.html"><img src="{{URL::asset('dashboard-layout/images/bg-logo.png')}}" alt="" height="40"></a>
                                </div>
                                <h4 class="text-center mb-4">Account Locked</h4>
                                <form action="http://lezato.dexignzone.com/xhtml/index.html">
                                    <div class="mb-3">
                                        <label><strong>Password</strong></label>
                                        <input type="password" class="form-control" value="Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block">Unlock</button>
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
<!-- #/ container -->
<!-- Common JS -->
@include('layout.partials.footer-scripts')
</body></html>
