@extends('layout.mainlayout')
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
        <div class="col-md-6">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Mail Details</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('send-notes', $owner->id)}}" method="post" id="send-notes">
                            {{csrf_field()}}
                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">To:</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="categoryName" required
                                           value="{{$owner->email}}" readonly>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Subject</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="subject" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Note</label>
                                <div class="input-group">
                                    <textarea type="text" class="form-control" name="note"
                                              required style="width: 300px;height: 150px;"></textarea>

                                </div>
                            </div>
                            <button type="submit" class="btn me-2 btn-primary send">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".send").on('click', function (event) {
            event.preventDefault();
            $('#spinner').show()
            $(this).attr("disabled", true);
            var url = $('#send-notes').attr('action');
            let subject = $("input[name=subject]").val();
            let note = $("textarea[name=note]").val();
            $.ajax({
                url: url,
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    note: note,
                    subject: subject,
                },
                success: (response) => {
                    $('#spinner').hide()
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
                    } else if (response.status_code == 500) {
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
                    } else if (response.result == 'success') {
                        $('#send-notes')[0].reset();
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
                }
            });
        });
    </script>

@endsection
