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
                              action="{{route('edit-item' ,array('item_id'=>$item->id))}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="profile-news">
                                                <div class="cover-photo rounded">
                                                    <img src="{{URL::asset($item->item_url)}}" alt="Item-image"
                                                         class="me-3 rounded"
                                                         style="width: 100%"
                                                    >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Meal
                                            English Name</label>
                                        <div class="input-group">
                                                                <span class="input-group-text"> <i
                                                                        class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control"
                                                   name="itemNameEn" id="itemNameEn"
                                                   placeholder="Enter Meal English name" required
                                                   value="{{$item->item_name_en}}"
                                            >
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Meal
                                            Arabic Name</label>
                                        <div class="input-group">
                                                                <span class="input-group-text"> <i
                                                                        class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control"
                                                   name="itemNameAr" id="itemNameAr"
                                                   placeholder="Enter Meal arabic name" required
                                                   value="{{$item->item_name_ar}}">
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
                                            <textarea class="form-control" name="itemDescriptionEn" rows="5"
                                                      id="itemDescriptionEn"
                                                      placeholder="Enter English Description" required>@if($item->description_en!=null && $item->description_en!=" "){{$item->description_en}}@endif</textarea>
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
                                            <textarea class="form-control" name="itemDescriptionAr" rows="5"
                                                      id="itemDescriptionAr"
                                                      placeholder="Enter Arabic Description" required>@if($item->description_ar!=null&& $item->description_ar!=" "){{$item->description_ar}}@endif</textarea>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">  <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label" for="validationCustomUsername">Meal
                                                Execution Time</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                                <input type="text" class="form-control" name="itemExecTime" id="itemExecTime"
                                                       placeholder="Enter Meal Execution Time in minutes" required
                                                       value="{{$item->execution_time}}">
                                                <div class="invalid-feedback">

                                                </div>
                                            </div>

                                        </div>
                                    </div></div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Type</label>
                                        <select name="type_item" id="type_item" data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Choose Type</option>
                                            @foreach($types as $type)
                                                <option
                                                    value={{$type->id}}  {{ $types_par == $type->id ? "selected" :""}}>{{$type->parent_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Select
                                            Menu</label>
                                        <select name="sub_category" id="sub_category"
                                                data-select2-id="single-select"
                                                tabindex="-1"
                                                class="default-select  form-control wide">
                                            <option value="">Choose Menu</option>
                                            @foreach($sub_cat_arr as $cat)
                                                <option
                                                    value={{$cat->id}}  {{ $item->sub_cat_id == $cat->id ? "selected" :""}}>{{$cat->sub_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Select
                                            Meal
                                            ingredients</label>
                                        <select name="components[]"
                                                class="multi-select  form-control" multiple
                                                data-select2-id="2" tabindex="-1"
                                                aria-hidden="true">
                                            @foreach(\App\Models\components::all()->where('created_by',$my_id) as $com)
                                                <option class="form-control" value="{{$com->id}}"
                                                        @if(count($item_components)>0&&in_array($com->id,$item_components)) selected @endif>
                                                    {{$com->component_name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label"
                                                   for="validationCustomUsername">Select
                                                Ingredients
                                                related to the meal</label>
                                            <select name="belongings[]"
                                                    class="multi-select  form-control" multiple
                                                    data-select2-id="3" tabindex="-1"
                                                    aria-hidden="true">
                                                @foreach(\App\Models\item::all()->where('id','!=',$item->id)->where('created_by',$my_id) as $com)
                                                    <option class="form-control" value="{{$com->id}}"
                                                            @if(count($item_belongs)>0 && in_array($com->id,$item_belongs)) selected @endif>
                                                        {{$com->item_name_en}}</option>
                                                @endforeach
                                            </select>
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
                                                       value="@if(isset($cur->price)&&$cur->price!=null){{$cur->price}}@endif">
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

                                @endforeach

                                {{--                                <div class="mb-3 col-md-6">--}}
                                {{--                                    <div class="mb-3">--}}
                                {{--                                        <label class="text-label form-label"--}}
                                {{--                                               for="validationCustomUsername">Price</label>--}}
                                {{--                                        <div class="input-group">--}}
                                {{--                                                                <span class="input-group-text"> <i--}}
                                {{--                                                                        class="fa fa-list-alt"></i> </span>--}}
                                {{--                                            <input type="text" class="form-control" name="itemPrice"--}}
                                {{--                                                   id="itemPrice"--}}
                                {{--                                                   placeholder="Enter Meal price" required--}}
                                {{--                                                   value="{{$item->price}}">--}}
                                {{--                                            <div class="invalid-feedback">--}}

                                {{--                                            </div>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}


                                {{--                                <div class="mb-3 col-md-6">--}}
                                {{--                                    <div class="mb-3">--}}
                                {{--                                        <label class="text-label form-label" for="validationCustomUsername">Select--}}
                                {{--                                            Currency</label>--}}
                                {{--                                        <select name="currency" id="currency" data-select2-id="single-select"--}}
                                {{--                                                tabindex="-1" class="default-select  form-control wide">--}}
                                {{--                                            <option value="">Choose Currency</option>--}}
                                {{--                                            @foreach($currency as $cur)--}}
                                {{--                                                <option--}}
                                {{--                                                    value={{$cur->id}}  {{ $item->item_currency == $cur->id ? "selected" :""}}>{{$cur->currency_name}}</option>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Meal
                                            Photo</label>
                                        <div class="input-group">
                                            <div class="form-file">
                                                <input type="file"
                                                       class="form-file-input form-control"
                                                       name="itemPhoto"
                                                       id="itemPhoto"
{{--                                                       value="{{}}"--}}
                                                >

{{--                                                <img--}}
{{--                                                    src="{{   }}"--}}
{{--                                                    alt="" title="">--}}
                                            </div>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Select
                                            Meal Status</label>
                                        <select name="mealStatus" id="mealStatus"
                                                data-select2-id="single-select"
                                                tabindex="-1"
                                                class="default-select  form-control wide"
                                                value="{{old('mealStatus')}}">
                                            <option value="">Choose Status</option>
                                            @foreach($item_status as $status)
                                                <option
                                                    value='{{$status->id}}' {{ $item->item_status_id == $status->id ? "selected" :""}}>
                                                    {{$status->status_name_en}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Select
                                            Meal Size</label>
                                        <select name="mealSize" id="mealSize"
                                                data-select2-id="single-select"
                                                tabindex="-1"
                                                class="default-select  form-control wide"
                                                value="{{old('mealSize')}}">
                                            <option value="">Choose Size</option>
                                            @foreach($item_size as $size)
                                                <option
                                                    value='{{$size->id}}'{{ $item->item_size_id  == $size->id ? "selected" :""}}>
                                                    {{$size->size_name_en}}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-6" hidden>
                                    <label class="text-label form-label"
                                           for="validationCustomUsername">Has
                                        discount</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                               name="hasDiscount"
                                               value="1" {{ $item->has_discount =="1" ? 'checked='.'"checked"' : '' }}>
                                        <label class="form-check-label">
                                            True
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio"
                                               name="hasDiscount" value="0"
                                            {{$item->has_discount =="0" ? 'checked='.'"checked"' : '' }} >
                                        <label class="form-check-label">
                                            False
                                        </label>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-6"
                                     @if($item->has_discount==0 )style="display: none"
                                     @endif id="discountType">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Select
                                            Discount type</label>
                                        <select name="discount_type" id="discount_type"
                                                data-select2-id="single-select"
                                                tabindex="-1"
                                                class="default-select  form-control wide">
                                            <option value="null">Choose Discount Type</option>
                                            @foreach($discount_type as $dis)
                                                <option
                                                    value="{{$dis->id}}" {{ $item->discount_type_id == $dis->id ? "selected" :""}}>
                                                    {{$dis->discount_name_en}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="mb-3 col-md-6"
                                     @if($item->has_discount==0)style="display: none"
                                     @endif id="discountValue">
                                    <div class="mb-3">
                                        <label class="text-label form-label"
                                               for="validationCustomUsername">Discount value</label>
                                        <div class="input-group">
                                                                <span class="input-group-text"> <i
                                                                        class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control"
                                                   name="itemDiscount"
                                                   id="itemDiscount"
                                                   placeholder="Enter Meal Discount"
                                                   value="{{$item->discount_val}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn me-2 btn-primary mt-3">Submit</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- end col -->
    </div>
@endsection

@section('js')
    <script>
        $('#type_item').change(function () {
            update_types_select();
        });

        var url = '/get_menus_by_par';

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
                            // console.log(data);
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

                    // $("div.discountType select").val("null").change();
                    $('.discountType option')
                        .removeAttr('selected')
                        .filter('[value=null]')
                        .attr('selected', true)
                    $("#itemDiscount").text("null");
                    //   $("div.discountValue input").val("null").change();
                }
            });
        });
    </script>
@endsection
