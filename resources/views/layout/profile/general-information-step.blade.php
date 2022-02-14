@extends('layout.mainlayout')
<link href="{{asset('dashboard-layout/css/spinner.css')}}"  rel="stylesheet">
@section('content')
    <!-- row -->
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
                                      action="{{route('general-information-step')}}">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Restaurant Category*</label>
                                        <select name="category" id="category"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Select Category</option>
                                            @foreach(\App\Models\Category::all() as $cat)
                                                <option class="form-control"
                                                        value="{{$cat->id}}" {{$account->resturant_category_id == $cat->id ? 'selected' : ''}}>{{$cat->category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3" style="margin-top: 60px">
                                        <label class="text-label form-label">Restaurant Sub-Category*</label>
                                        <select name="sub_categories" id="sub_categories"
                                                tabindex="-1" class="multi-select form-control wide" multiple>
                                            @foreach(\App\Models\SubCategory::all() as $sub)
                                                <option class="form-control"
                                                        value="{{$sub->id}}" {{in_array($sub->id, $sub_categories_ids) ? 'selected' : ''}}>{{$sub->sub_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">license*</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" style="background: #fd683e; color: #ffffff">Upload</span>
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control" name="license"
                                                       id="license" accept="application/pdf,application">
                                            </div>
                                        </div>
                                        <small>Allowed extension is: PDF</small><br><br>

                                    </div>

                                    <div class="mb-3">
                                        <label class="text-label form-label">Restaurant Logo*</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" style="background: #fd683e; color: #ffffff">Upload</span>
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control" name="logo"
                                                       accept="image/*"
                                                       id="logo">
                                            </div>
                                        </div>
                                        <small>Allowed extension is: jpeg, jpg, png</small><br><br>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="toolbar toolbar-bottom" role="toolbar" style="text-align: right;">
                        <button class="btn btn-primary submit"
                                style="background-color: #fd683e;border: 1px solid #fd683e;">Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(".submit").click(function (event) {
            $('#spinner').show();
            $(this).attr("disabled", true);
            event.preventDefault();
            let restaurantName = $("input[name=restaurantName]").val();
            let category = $("select[name=category]").val();
            let sub_category = $("select[name=sub_categories]").val();
            let license = $('#license').get(0).files[0]
            let logo = $('#logo').get(0).files[0]

            var data = new FormData();
            data.append('restaurantName', restaurantName)
            data.append('category', category)
            data.append('sub_category', sub_category)
            data.append('license', license)
            data.append('logo', logo)

            $.ajax({
                url: '{{route('general-information-step')}}',
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
                        window.location.replace("owner-details-step");
                    }
                },
            });
        });
    </script>

@endsection
