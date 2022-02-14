@extends('layout.mainlayout')
<link href="{{asset('dashboard-layout/css/spinner.css')}}" rel="stylesheet">
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
                <div class="card-header">
                    <h4 class="card-title">Update Article</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form href="{{route('update.article', $article->id)}}"
                              class="form-wizard order-create sw sw-theme-default sw-justified needs-validation"
                              method="post">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="account_name">Article Title</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="title"
                                                   id="title" placeholder="Title" required
                                                   value="{{$article->title}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="account_name">Article Title (AR)</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="title_ar"
                                                   id="title" placeholder="Arabic Title" required
                                                   value="{{$article->title_ar}}">
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="national_number">Description</label>
                                        <div class="input-group">
                                            <textarea type="text" class="form-control" name="description"
                                                      required>{{$article->description}}</textarea>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="national_number">Description (AR)</label>
                                        <div class="input-group">
                                            <textarea type="text" class="form-control" name="description_ar"
                                                      required>{{$article->description_ar}}</textarea>
                                            <div class="invalid-feedback">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Sub-category</label>
                                        <select name="sub_category" id="sub_category"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Select Sub-category</option>
                                            @foreach(\App\Models\SubCategory::all() as $sub)
                                                <option class="form-control"
                                                        value="{{$sub->id}}" {{$article->sub_category_id == $sub->id ? 'selected' : ''}}>{{$sub->sub_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label">Article Image</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" style="background: #fd683e; color: #ffffff">Upload</span>
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control" name="image"
                                                       accept="image/*"
                                                       id="image">
                                            </div>
                                        </div>
                                        <small>Allowed extension is: jpeg, jpg, png</small><br><br>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn me-2 btn-primary mt-3 submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

    <script type="text/javascript">
        $(".submit").click(function (event) {
            $('#spinner').show();
            $(this).attr("disabled", true);
            event.preventDefault();
            let title = $("input[name=title]").val();
            let title_ar = $("input[name=title_ar]").val();
            let description = $("textarea[name=description]").val();
            let description_ar = $("textarea[name=description_ar]").val();
            let sub_category = $("select[name=sub_category]").val();
            let image = $('#image').get(0).files[0]
            let url = $('form').attr('action');


            var data = new FormData();
            data.append('title', title)
            data.append('title_ar', title_ar)
            data.append('description', description)
            data.append('description_ar', description_ar)
            data.append('sub_category', sub_category)
            data.append('image', image)
            data.append('_method', 'patch')

            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}',
                },
                data: data,
                contentType: 'application/json',
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
                    } else if (response.result === true) {
                        window.location.replace('/show-articles');
                    }
                },
            });
        });

    </script>
@endsection
