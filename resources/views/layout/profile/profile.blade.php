@extends('layout.mainlayout')

<link href="{{asset('dashboard-layout/vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
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
    <div class="row">
        <div class="col-lg-12">
            <div class="profile card card-body px-3 pt-3 pb-0">
                <div class="profile-head">
                    <div class="photo-content">
                        <div class="cover-photo rounded"
                             style=" background: url( '{{ URL::to('/') }}/restaurants/cover/58/cover.jpg' ) "></div>
                    </div>
                    <div class="profile-info">
                        <div class="profile-photo">
                            <img
                                src="{{ URL::to('/') }}/restaurants/logo/{{$account->logo_path != null? $account->id .'/'. $account->logo_path : 'bg-logo.png'}}"
                            class="img-fluid rounded-circle" alt="">
                        </div>
                        <div class="profile-details">
                            <div class="profile-name px-3 pt-2">
                                <h4 class="text-primary mb-0">{{$account->account_name}}</h4>
                                <p>{{$account->category->category_name}}</p>
                            </div>
                            <div class="profile-email px-2 pt-2">
                                <h4 class="text-muted mb-0">{{$account->email}}</h4>
                            </div>
                            <div class="dropdown ms-auto">
                                <a href="#" class="btn btn-primary light sharp" data-bs-toggle="dropdown"
                                   aria-expanded="true">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="18px" height="18px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"></rect>
                                            <circle fill="#000000" cx="5" cy="12" r="2"></circle>
                                            <circle fill="#000000" cx="12" cy="12" r="2"></circle>
                                            <circle fill="#000000" cx="19" cy="12" r="2"></circle>
                                        </g>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <a href="{{route('change-package')}}" class="dropdown-item edit-profile">Change
                                        Package</a>
                                    <a href="{{route('update-restaurant-info', $account->id)}}"
                                       class="dropdown-item edit-profile">Update Info</a>
                                </ul>
                                <label class="switch" style="bottom: 20px">
                                    <input type="checkbox"
                                           {{$account->work_status_id == 1 ? 'checked' : ''}} id="statusSwitch"
                                           data-restaurant-id="{{$account->id}}">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($account->sub_category as $sub)
            <div class="col-lg-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <div class="menu-product d-flex">
                            <img
                                src="{{asset($sub->pivot->image_path != null ? 'restaurants/sub_categories/'. $sub->pivot->id .'/'. $sub->pivot->image_path :'restaurants/sub_categories/bg-logo.png')}}">
                            <div class="content-detail-wrap">
                                <div>
                                    <h4>{{$sub->sub_category_name}}</h4>
                                </div>
                                <div class="mt-4 d-flex justify-content-between align-items-center sub_category">
                                    <div>
                                        <h5 class="mb-0">Upload Image</h5>
                                        <br>
                                        <form id="general-information" enctype="multipart/form-data">
                                            <input type="file" class="form-file-input" name="image"
                                                   accept="image/*">
                                            <input type="text" name="pivot_id" value="{{$sub->pivot->id}}" hidden>
                                        </form>
                                        <div>
                                            <button class="btn btn-primary upload"
                                                    style="background-color: #fd683e;border: 1px solid #fd683e;"
                                                    disabled>
                                                Upload
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <div class="col-md-6 col-xl-3mb-3">
            <div class="mb-3">
                <label class="form-label">Opening time</label>
                <div class="input-group">
                    <input class="form-control" id="opening-time"
                           value="{{date("H:i", strtotime($account->opening_time))}}" name="opening_time"
                           placeholder="Now"
                           readonly>
                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Closing time</label>
                <div class="input-group">
                    <input class="form-control" id="closing-time" name="closing_time"
                           value="{{date("H:i", strtotime($account->closing_time))}}" placeholder="Now"
                           readonly disabled>
                    <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                </div>
            </div>

            <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                <button class="btn btn-primary submit"
                        style="background-color: #fd683e;border: 1px solid #fd683e;" disabled>Save
                </button>
            </div>
        </div>

        <div class="col-md-6 col-xl-3mb-3">
            @foreach($account->currency as $currency)
                <div class="mb-3">
                    <label class="form-label">{{$currency->currency_name}} Minimum Order
                        Price</label>
                    <div class="input-group">
                        <input class="form-control currency" name="currency-{{$currency->id}}"
                               placeholder="{{$currency->currency_name}}"
                               value="{{$account->minPrice->where('currency_id', $currency->id)->first()?$account->minPrice->where('currency_id', $currency->id)->first()->min_price:0}}">
                    </div>
                </div>
            @endforeach
            <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                <button class="btn btn-primary updatePrice" disabled
                        style="background-color: #fd683e;border: 1px solid #fd683e;">Update
                </button>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{URL::asset('dashboard-layout/libs/mask/jquery.mask.min.js')}}"></script>
    <script src="{{URL::asset('dashboard-layout/vendor/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <script>
        "use strict"
        // Clock pickers
        var open = $('#opening-time').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            'default': 'now'
        });

        var close = $('#closing-time').clockpicker({
            placement: 'bottom',
            align: 'left',
            autoclose: true,
            'default': 'now'
        });


        open.change(function () {
            $('#closing-time').attr('disabled', false)
            if (close.val() && open.val()) {
                console.log(close.val())
                $('.submit').attr("disabled", false);

            }
        });

        close.change(function () {
            if (close.val() && open.val()) {
                $('.submit').attr("disabled", false);

            }
        });
    </script>
    <script>
        $('#statusSwitch').click(function () {
            $('#spinner').show();
            let restaurant_id = $(this).data('restaurant-id');
            $.ajax({
                url: '{{route('profile-change-status')}}',
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    restaurant_id: restaurant_id,
                },
                success: (response) => {
                    $('#spinner').hide();
                    if (response.result == 'true') {
                    }
                },
            });
        })
        $(".submit").click(function (event) {
            $(this).attr("disabled", true);
            event.preventDefault();
            let opening_time = $("input[name=opening_time]").val();
            let closing_time = $("input[name=closing_time]").val();

            var data = new FormData();
            data.append('opening_time', opening_time)
            data.append('closing_time', closing_time)

            $.ajax({
                url: '{{route('clock-pick')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,

                success: (response) => {
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
                                tapToDismiss: !1,
                            })
                        })
                    } else if (response.result == 'true') {
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
    <script>

        $("input[name=image]").change(function () {
            if ($(this).val()) {
                $(this).closest("div.sub_category").find('.upload').attr('disabled', false);
            }
        });

        $(".upload").click(function (event) {
            $('#spinner').show();
            event.preventDefault();
            let pivot_id = $(this).closest("div.sub_category").find("input[name=pivot_id]").val();
            let image = $(this).closest("div.sub_category").find("input[name=image]").get(0).files[0];

            var data = new FormData();
            data.append('pivot_id', pivot_id)
            data.append('image', image)

            $.ajax({
                url: '{{route('sub-category-image')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,
                success: (response) => {
                    $('#spinner').hide();
                    if (response.result == 'success') {
                        $(this).attr("disabled", true);
                        location.reload();
                    } else if (response.result == 'false') {
                        $(this).attr("disabled", true);
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
                    } else {
                        toastr.error(response.message, "Heads Up!", {
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
    <script type="text/javascript">

        $('.currency').keydown(function () {
            $('.updatePrice').attr("disabled", false);
        });

        $(".updatePrice").click(function (event) {
            $(this).attr("disabled", true);
            $('#spinner').show();
            event.preventDefault();
            var currencies = {!! json_encode($account->currency) !!};
            var data = new FormData();

            currencies.forEach(function (currency) {
                data.append('currency-' + currency.id, document.getElementsByName("currency-" + currency.id)[0].value)
            })

            $.ajax({
                url: '{{route('update-min-price')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,
                success: (response) => {
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
                                tapToDismiss: !1,
                            })
                        })
                    } else if (response.result == 'true') {
                        $(this).attr("disabled", true);
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

        $(".currency").mask("000");
    </script>
@endsection
