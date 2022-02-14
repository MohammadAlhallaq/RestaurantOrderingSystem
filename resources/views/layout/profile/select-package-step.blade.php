@extends('layout.mainlayout')

<style>
    input[type="radio"] {
        display: none;
        cursor: pointer;
    }

    .selected {
        background-color: #fd683e !important;
        color: #fff !important;
    }
</style>
<link href="{{asset('dashboard-layout/css/spinner.css')}}" rel="stylesheet">


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


    @if ($errors->any())
        <div class="alert alert-danger solid alert-dismissible fade show"
             style="width: 25%; position: absolute; right: 50px; z-index: 1">
            <svg viewBox="0 0 24 24" width="24 " height="24" stroke="currentColor" stroke-width="2" fill="none"
                 stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            <strong>Error!</strong> {{$errors->first()}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
            </button>
        </div>
    @endif

    <div class="row">
        @foreach($packages as $package)
            <div class="col-xl-4 col-lg-6 col-sm-6">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="profile-photo">
                                <img src="{{asset('dashboard-layout/images/bg-logo.png')}}" width="100"
                                     class="img-fluid rounded-circle" alt="">
                            </div>
                            <h3 class="mt-4 mb-1">{{$package->title}}</h3>
                            <h4 class="mt-4 mb-1 cost">{{$package->cost != 0 ? 'AED '.$package->cost : 'Free'}}</h4>
                            <input type="radio" name="package" id="{{$package->id}}" value="{{$package->id}}">
                            <label
                                class="btn btn-outline-primary btn-rounded mt-3 px-5 account"
                                for="{{$package->id}}">Select</label>
                        </div>
                    </div>

                    <div class="card-footer pt-0 pb-0 text-center">
                        <div class="row">
                            <div class="col-4 pt-3 pb-3 border-end">
                                <h3 class="mb-1">{{$package->allowed_meals}}</h3><span>Allowed Meals</span>
                            </div>
                            <div class="col-4 pt-3 pb-3 border-end">
                                <h3 class="mb-1">{{$package->duration >= 12 ? floor($package->duration/12).' YR and '.$package->duration%12 .' MTH' : $package->duration . ' MTH'}}</h3>
                            </div>
                            <div class="col-4 pt-3 pb-3">
                                <h3 class="mb-1">{{$package->free_delivery == 1 ? 'Free' : 'Paid'}}</h3>
                                <span>Delivery</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row payment-details">
        <div class="mb-3 col-md-6">
            <div class="mb-3">
                <label class="text-label form-label">Payment Method*</label>
                <select name="payment_method"
                        tabindex="-1" class="default-select form-control wide">
                    <option value="">Select Payment Method</option>
                    @foreach(\App\Models\PaymentType::all()->slice(1) as $type)
                        <option class="form-control" value="{{$type->id}}">{{$type->pay_type_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-4">
            <label class="text-label form-label reference-label">Reference Code</label>
            <input type="text" class="form-control" name="code" autocomplete="off" required>
            <br>
            <button type="button" class="btn btn-outline-primary btn-xs check-code checkCodeButton">Check
                availability
            </button>
        </div>
    </div>

    <div class="form-check custom-checkbox mb-3 col-md-4">
        <label class="form-check-label" for="termsCheckbox">Clicking the Checkbox indicates that you have read
            and agreed to the terms and conditions of Allin1UAE</label>
        <input type="checkbox" class="form-check-input" id="termsCheckbox" name="termsCheckbox"
               required="">
    </div>

    <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
        <button class="btn btn-primary sw-btn-next submit">Checkout</button>
    </div>



    <div class="modal fade" id="payment">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Payment Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="iframe">
                    <iframe id="iframe" style="width: 100%; height: 500px" src=""></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection()




@section('js')
    <script>
        $(document).ready(function () {
            $('.checkCodeButton').attr('disabled', true);
            $("input[name=code]").keyup(function () {
                if ($(this).val().length != 0)
                    $('.checkCodeButton').attr('disabled', false);
                else
                    $('.checkCodeButton').attr('disabled', true);
            })
        });
    </script>


    <script>
        $('.check-code').on('click', function () {
            $('.checkCodeButton').attr('disabled', true);
            let code = $("input[name=code]").val();
            var data = new FormData();
            data.append('code', code)
            $.ajax({
                url: '{{route('check-code')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,
                success: (response) => {
                    $('.checkCodeButton').attr('disabled', false);
                    if (response.result == 'true') {
                        $("input[name=code]").attr('style', 'border-color: #28a745 !important')
                    } else if (response.result == 'false') {
                        $("input[name=code]").attr('style', 'border-color: #dc3545 !important')
                    }
                },
            });
        })
    </script>



    <script>
        $('select').on('change', function () {
            $('#optioanl').remove();
            $('#codeRequired').remove();
            if (this.value == 2) {
                $('.reference-label').append('<strong id="optioanl"> (OPTIONAL)</strong>');
            } else {
                $('.reference-label').append('<i id="codeRequired">*</i>');

            }
        });
    </script>


    <script>
        $(document).ready(function () {
            $(".account").click(function (e) {
                $(".selected").removeClass("selected");
                $(this).addClass("selected")
                const cost = $(this).closest('.text-center').find('.cost').html();
                if (cost === 'Free') {
                    $('.payment-details').hide();
                } else {
                    $('.payment-details').show();
                }
            });
        });
    </script>
    <script>
        $(".submit").click(function (event) {
            event.preventDefault();
            $('#spinner').show();
            $(this).attr("disabled", true);
            let package;
            if ($("input[name=package]:checked").val()) {
                package = $("input[name=package]:checked").val()
            } else {
                package = ''
            }
            let payment_method = $("select[name=payment_method]").val();
            let code = $("input[name=code]").val();

            let termsCheckbox;
            if ($("input[name=termsCheckbox]:checked").val()) {
                termsCheckbox = $("input[name=termsCheckbox]:checked").val();
            } else {
                termsCheckbox = ''
            }


            var data = new FormData();
            data.append('code', code)
            data.append('payment_method', payment_method)
            data.append('package', package)
            data.append('termsCheckbox', termsCheckbox)

            $.ajax({
                url: '{{route('select-package-step')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,
                success: (response) => {
                    if (response.result == 'false') {
                        $('#spinner').hide();
                        $(this).attr("disabled", false);
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
                    } else if (response.result == 'exception') {
                        $('#spinner').hide();
                        $(this).attr("disabled", false);
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
                    } else if (response.result == 'successModal') {
                        $('#spinner').hide();
                        $(this).attr("disabled", false);
                        $('iframe').attr('src', response.payment_url)
                        $('#payment').modal('show');//now its working
                    } else if (response.result == 'success') {
                        window.location.replace("finished-application");
                    }
                },
            });
        });
    </script>
@endsection
