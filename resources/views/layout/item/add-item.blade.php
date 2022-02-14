@extends('layout.mainlayout')
@section('content')

    <div class="row">
        <div class="col-xl-12 col-xxl-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Meal Information</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="my-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @elseif (null !== session('errors') && session('errors')->any())
                        <div class="alert alert-danger">
                            <ul class="my-0">
                                @foreach (session('errors')->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="basic-form">

                        <form class="form-wizard order-create sw sw-theme-default sw-justified needs-validation"
                              action="{{route('add-item')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Meal
                                            English Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="itemNameEn" id="itemNameEn"
                                                   placeholder="Enter Meal English name" required
                                                   value="{{old('itemNameEn')}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Meal
                                            Arabic Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="itemNameAr" id="itemNameAr"
                                                   placeholder="Enter Meal arabic name" required
                                                   value="{{old('itemNameAr')}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">
                                            English Description</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <textarea class="form-control" name="itemDescriptionEn" cols="42" rows="5"
                                                      id="itemDescriptionEn"
                                                      placeholder="Enter English Description" required
                                                      value="{{old('itemDescriptionEn')}}"></textarea>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">
                                            Arabic Description</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <textarea class="form-control" name="itemDescriptionAr" cols="42" rows="5"
                                                      id="itemDescriptionAr"
                                                      placeholder="Enter Arabic Description" required
                                                      value="{{old('itemDescriptionAr')}}"></textarea>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Type</label>
                                        <select name="type_item" id="type_item" data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Choose Type</option>
                                            @foreach($types as $type)
                                                <option
                                                    value={{$type->id}}  {{ old('type_item') == $type->id ? "selected" :""}}>{{$type->parent_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Menu</label>
                                        <select name="sub_category" id="sub_category" data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Choose Menu</option>
                                            {{--                                            @foreach($sub_cat_arr as $cat)--}}
                                            {{--                                                <option--}}
                                            {{--                                                    value={{$cat->id}}  {{ old('sub_category') == $cat->id ? "selected" :""}}>{{$cat->sub_category_name}}</option>--}}
                                            {{--                                            @endforeach--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="validationCustomUsername">Select
                                                Meal
                                                ingredients</label>
                                            <select name="components[]" class="multi-select  form-control" multiple
                                                    data-select2-id="2" tabindex="-1" aria-hidden="true">
                                                @foreach($components as $com)
                                                    <option class="form-control"
                                                            value="{{$com->id}}">{{$com->component_name_en}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="validationCustomUsername">Meal
                                                Execution Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                                <input type="text" class="form-control" name="itemExecTime"
                                                       id="itemExecTime"
                                                       placeholder="Enter Meal Execution Time in minutes" required
                                                       value="{{old('itemExecTime')}}">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                @foreach($currency as $cur)
                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label"
                                                   for="validationCustomUsername">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                                <input type="text" class="form-control" name='{{'itemPrice'.$cur->id}}'
                                                       id='{{'itemPrice'.$cur->id}}'
                                                       placeholder="Enter Meal price" required
                                                       value="{{old('itemPrice'.$cur->id)}}">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label"
                                                   for="validationCustomUsername">Currency</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                                <input type="text" class="form-control" name='{{'currency'.$cur->id}}'
                                                       id='{{'currency'.$cur->id}}'
                                                       readonly
                                                       value="{{$cur->currency_name}}">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--                                    <div class="mb-3 col-md-6">--}}
                                    {{--                                        <div class="mb-3">--}}
                                    {{--                                            <label class="text-label form-label" for="validationCustomUsername">Select--}}
                                    {{--                                                Currency</label>--}}
                                    {{--                                            <select name="currency" id="currency" data-select2-id="single-select"--}}
                                    {{--                                                    tabindex="-1" class="default-select  form-control wide">--}}
                                    {{--                                                <option value="">Choose Currency</option>--}}
                                    {{--                                                @foreach($currency as $cur)--}}
                                    {{--                                                    <option--}}
                                    {{--                                                        value={{$cur->id}}  {{ old('currency') == $cur->id ? "selected" :""}}>{{$cur->currency_name}}</option>--}}
                                    {{--                                           --}}
                                    {{--                                            </select>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                @endforeach
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Meal
                                            Photo</label>
                                        <div class="input-group">
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control"
                                                       name="itemPhoto"
                                                       id="itemPhoto" value="{{old('itemPhoto')}}">
                                            </div>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Meal Status</label>
                                        <select name="mealStatus" id="mealStatus" data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide"
                                                value="{{old('mealStatus')}}">
                                            <option value="">Choose Status</option>
                                            @foreach($item_status as $status)
                                                <option
                                                    value='{{$status->id}}' {{ old('mealStatus') == $status->id ? "selected" :""}}>
                                                    {{$status->status_name_en}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Meal Size</label>
                                        <select name="mealSize" id="mealSize" data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide"
                                                value="{{old('mealSize')}}">
                                            <option value="">Choose Size</option>
                                            @foreach($item_size as $size)
                                                <option
                                                    value='{{$size->id}}'{{ old('mealSize') == $size->id ? "selected" :""}}>
                                                    {{$size->size_name_en}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3" hidden>
                                    <label class="text-label form-label" for="validationCustomUsername">Has
                                        discount</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hasDiscount"
                                               value="1" {{ old('hasDiscount')=="1" ? 'checked='.'"checked"' : '' }}>
                                        <label class="form-check-label">
                                            True
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="hasDiscount" value="0"
                                               {{ old('hasDiscount')=="0" ? 'checked='.'"checked"' : '' }} checked>
                                        <label class="form-check-label">
                                            False
                                        </label>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-5" @if(old('discount_type') == null)style="display: none"
                                     @endif id="discountType">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Discount type</label>
                                        <select name="discount_type" id="discount_type"
                                                data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Choose Discount Type</option>
                                            @foreach($discount_type as $dis)
                                                <option
                                                    value="{{$dis->id}}" {{ old('discount_type') == $dis->id ? "selected" :""}}>
                                                    {{$dis->discount_name_en}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-4" @if(old('itemDiscount')== null)style="display: none"
                                     @endif id="discountValue">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Discount value</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="itemDiscount"
                                                   id="itemDiscount"
                                                   placeholder="Enter Meal Discount"
                                                   value="{{old('itemDiscount')}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn me-2 btn-primary mt-3">Submit</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end col -->

@endsection

@section('js')
    <script>
        $('#type_item').change(function () {
            update_types_select();
        });
        $(document).ready(function () {
            $('input[type="radio"]').click(function () {
                var inputValue = $(this).attr("value");
                if (inputValue == 1) {

                    document.getElementById("discountType").style.display = "block";
                    document.getElementById("discountValue").style.display = "block";
                    $("[name='itemDiscount']").prop('required', true);
                    $("[name='discount_type']").prop('required', true);

                } else {
                    document.getElementById("discountType").style.display = "none";
                    document.getElementById("discountValue").style.display = "none";
                    $("[name='itemDiscount']").prop('required', false);
                    $("[name='discount_type']").prop('required', false);
                }
            });
        });

        var url = 'get_menus_by_par';

        function update_types_select(selected_step_id) {
            var category_id = $('#type_item').val();
            $('#sub_category').html('');
            if (category_id != '') {
                $('#loading_img').fadeIn(0);
                $.ajax({
                    url: url,
                    type: "post",
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        type_id: category_id
                    },
                    success: function (data) {
                        if (data.status) {
                            console.log(data);
                            var options_html = '';
                            var cat_items = data.ret_data;

                            for (var i = 0; i < cat_items.length; i++) {
                                var item_name_en = cat_items[i].sub_category_name;
                                var item_id = cat_items[i].id;
                                if (item_id == selected_step_id) {
                                    options_html += '<option value="' + item_id + '" selected="selected" >' + item_name_en + '</option>';
                                } else {
                                    options_html += '<option value="' + item_id + '" >' + item_name_en + '</option>';
                                }

                            }


                            $('#sub_category').html(options_html);

                            $('#sub_category').niceSelect('update');


                        } else {
                            toastr.error(
                                'no menu in this type',
                                'Notification',
                                {
                                    timeOut: 3000,
                                    fadeOut: 1000,
                                    onHidden: function () {
                                        // window.location.reload();
                                    }
                                }
                            );
                            $('#sub_category').html('');
                            $('#sub_category').niceSelect('update');
                        }
                    }
                });
            }
        }
    </script>


@endsection
