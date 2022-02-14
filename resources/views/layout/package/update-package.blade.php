@extends('layout.mainlayout')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Update Package Details</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{route('update-package', $package->id)}}" method="post" id="update-package">
                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Title</label>
                                <div class="input-group">
                                    <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                    <input type="text" class="form-control" name="title" value="{{$package->title}}"
                                           required>
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Number of
                                    allowed meals</label>
                                <div class="input-group">
                                    <input type="text" class="form-control allowed_meals" name="allowed_meals"
                                           value="{{$package->allowed_meals}}" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">Duration</label>
                                <div class="input-group">
                                    <input type="text" class="form-control duration"
                                           placeholder="Calculated by months" value="{{$package->duration}}"
                                           name="duration" required>
                                    <div class="invalid-feedback">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="text-label form-label" for="validationCustomUsername">cost</label>
                                <div class="input-group">
                                    <input type="text" class="form-control cost" name="cost"
                                           value="{{$package->cost}} required>
                                    <div class=" invalid-feedback">
                                </div>
                            </div>

                            <div class="mb-3"  style="margin-bottom: 60px !important;">
                                <label class="text-label form-label">Package Category*</label>
                                <select name="category" id="category"
                                        tabindex="-1" class="default-select form-control wide">
                                    <option value="">Select Category</option>
                                    @foreach(\App\Models\Category::all() as $cat)
                                        <option class="form-control"
                                                value="{{$cat->id}}" {{$package->category_id == $cat->id ? 'selected' : ''}} >{{$cat->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row d-flex justify-content-between mt-4 mb-2">
                                <div class="mb-3">
                                    <div class="form-check custom-checkbox ms-1">
                                        <input type="checkbox" class="form-check-input" name="free_delivery"
                                               id="checkbox" {{$package->free_delivery == '1' ? 'checked' : ''}}>
                                        <label class="form-check-label" for="basic_checkbox_1">Free Delivery</label>
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn me-2 btn-primary send">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{URL::asset('dashboard-layout/libs/mask/jquery.mask.min.js')}}"></script>

    <script>
        $('.cost').mask("000000000");
        $('.duration').mask("000000000");
        $('.allowed_meals').mask("000000000");
    </script>

    <script>
        $(".send").on('click', function (event) {
            event.preventDefault();
            var url = $('#update-package').attr('action');
            let title = $("input[name=title]").val();
            let allowed_meals = $("input[name=allowed_meals]").val();
            let duration = $("input[name=duration]").val();
            let cost = $("input[name=cost]").val();
            let free_delivery = document.getElementById('checkbox').checked;
            let category = $("select[name=category]").val();

            $.ajax({
                url: url,
                type: "POST",
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: {
                    title: title,
                    allowed_meals: allowed_meals,
                    duration: duration,
                    cost: cost,
                    free_delivery: free_delivery,
                    category: category,
                },
                success: (response) => {
                    if (response.result == 'false') {
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
                    } else if (response.result == 'exception') {
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
                    } else {
                        // redirect to page the shows all the admins
                        window.location.replace("/all-packages");
                    }
                }
            });
        });
    </script>

@endsection
