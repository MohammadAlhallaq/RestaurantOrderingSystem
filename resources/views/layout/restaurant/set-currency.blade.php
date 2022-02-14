@extends('layout.mainlayout')
<link href="{{asset('dashboard-layout/vendor/clockpicker/css/bootstrap-clockpicker.min.css')}}" rel="stylesheet">
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
                <div class="card-body">
                    <div class="col-md-6 offset-md-3">
                        <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified"
                             style="border: #212130">
                            <div class="basic-form">
                                <form id="general-information" enctype="multipart/form-data"
                                      class="form-wizard order-create sw sw-theme-default sw-justified needs-validation"
                                      method="post" style="border: #212130"
                                      action="#">
                                    <div class="mb-3" style="margin-top: 60px">
                                        <label class="text-label form-label">Restaurant Currency*</label>
                                        <select name="currency" id="currency"
                                                tabindex="-1" class="multi-select form-control wide" multiple>
                                            @foreach(\App\Models\Currency::all() as $currency)
                                                <option class="form-control" value="{{$currency->id}}">{{$currency->currency_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3mb-3 offset-md-3">
                        <div class="mb-3">
                            <label class="form-label">Opening time</label>
                            <div class="input-group">
                                <input class="form-control" id="opening-time"
                                       value="{{date("H:i", strtotime(auth()->user()->opening_time))}}" name="opening_time"
                                       placeholder="Now"
                                       readonly>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Closing time</label>
                            <div class="input-group">
                                <input class="form-control" id="closing-time" name="closing_time"
                                       value="{{date("H:i", strtotime(auth()->user()->closing_time))}}" placeholder="Now"
                                       readonly disabled>
                            </div>
                        </div>
                    </div>

                    <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                        <button class="btn btn-primary submit"
                                style="background-color: #fd683e;border: 1px solid #fd683e;">Submit
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('js')
    <script src="{{URL::asset('dashboard-layout/vendor/clockpicker/js/bootstrap-clockpicker.min.js')}}"></script>
    <script>

        $(".submit").click(function (event) {
            $('#spinner').show();
            $(this).attr("disabled", true);
            event.preventDefault();
            let currency = $("select[name=currency]").val();
            let opening_time = $("input[name=opening_time]").val();
            let closing_time = $("input[name=closing_time]").val();

            var data = new FormData();
            data.append('currency', currency)
            data.append('opening_time', opening_time)
            data.append('closing_time', closing_time)

            $.ajax({
                url: '{{route('set-currency')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,

                success: (response) => {
                    $(this).attr("disabled", false);
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
                                tapToDismiss: !1,
                            })
                        })
                    } else if (response.result == 'success') {
                        window.location.replace("home");
                    }
                },
            });
        });
    </script>
    <script type="application/javascript">
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
    </script>

@endsection
