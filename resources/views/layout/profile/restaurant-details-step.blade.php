@extends('layout.mainlayout')

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-md-6 offset-md-3">
                        <div id="smartwizard" class="form-wizard order-create sw sw-theme-default sw-justified"
                             style="border: #212130">
                            <div class="basic-form">
                                <form id="general-information"
                                      class="form-wizard order-create sw sw-theme-default sw-justified needs-validation"
                                      method="post" style="border: #212130">

                                    <div class="mb-3">
                                        <label class="text-label form-label">Owner Name*</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="owner_name" required
                                                   value="{{$account->owner != null ? $account->owner->account_name : ''}}">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">Owner Email*</label>
                                        <input type="email" class="form-control" name="owner_email" required
                                               value="{{$account->owner != null ? $account->owner->email : ''}}">
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">Owner Mobile*</label>
                                        <input type="text" class="form-control" name="owner_mobile" required
                                               value="{{$account->owner != null ? $account->owner->phone_number : ''}}">
                                        <small>Format: 00971 xx xxx xxxx</small><br>

                                    </div>

                                    <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                                        <button class="btn btn-primary sw-btn-next submit">Next</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".submit").click(function (event) {
            event.preventDefault();
            let owner_name = $("input[name=owner_name]").val();
            let owner_email = $("input[name=owner_email]").val();
            let owner_mobile = $("input[name=owner_mobile]").val();

            var data = new FormData();
            data.append('owner_name', owner_name)
            data.append('owner_email', owner_email)
            data.append('owner_mobile', owner_mobile)
            console.log(data);
            $.ajax({
                url: '{{route('restaurant-details-step')}}',
                method: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                processData: false,
                contentType: false,

                success: function (response) {
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
                        window.location.replace("bank-address-step");
                    }
                },
            });
        });
    </script>

@endsection
