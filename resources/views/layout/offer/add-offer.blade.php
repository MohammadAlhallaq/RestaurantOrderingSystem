@extends('layout.mainlayout')
@section('content')
    {{--    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />--}}
    <!-- Bootstrap Date-Picker Plugin -->
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>--}}
    <style>

        .list {
            max-height: 100px;
            overflow-y: scroll !important;
        }
    </style>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Offer Information</h4>
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
                              action="{{route('add-offer')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Offer
                                            English Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="offerNameEn" id="offerNameEn"
                                                   placeholder="Enter Offer English name" required
                                                   value="{{old('offerNameEn')}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">offer
                                            Arabic Name</label>
                                        <div class="input-group">
                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                            <input type="text" class="form-control" name="offerNameAr" id="offerNameAr"
                                                   placeholder="Enter Offer arabic name" required
                                                   value="{{old('offerNameAr')}}">
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Menu</label>
                                        <select name="sub_category" id="sub_category" data-select2-id="single-select"
                                                tabindex="-1" class="default-select  form-control wide">
                                            <option value="">Choose Menu</option>
                                            @foreach($sub_cat_arr as $cat)
                                                <option
                                                    value={{$cat->id}}  {{ old('sub_category') == $cat->id ? "selected" :""}}>{{$cat->sub_category_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <style>

                                    .list {
                                        max-height: 100px;
                                        overflow-y: scroll !important;
                                    }
                                </style>
                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">Select
                                            Meal</label>
                                        <select name="items" class="default-select  form-control wide   scr-list"
                                                data-display="3"
                                                id="items"
                                                data-select2-id="single-select" tabindex="-1" aria-hidden="true">
                                            <option value="">Choose Meal</option>

                                        </select>

                                        {{--                                        <select id="items" class="form-control select" name="items">--}}
                                        {{--                                            <option value="">Choose Meal</option>--}}
                                        {{--                                        </select>--}}
                                    </div>
                                </div>

                                @foreach($currency as $cur)
                                    <div class="mb-3 col-md-6">
                                        <div class="mb-3">
                                            <label class="text-label form-label"
                                                   for="validationCustomUsername">Price</label>
                                            <div class="input-group">
                                                <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                                <input type="text" class="form-control" name='{{'offerPrice'.$cur->id}}'
                                                       id='{{'offerPrice'.$cur->id}}'
                                                       placeholder="Enter offer price" required
                                                       value="{{old('offerPrice'.$cur->id)}}">
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

{{--                                <div class="mb-3 col-md-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="text-label form-label"--}}
{{--                                               for="validationCustomUsername">Price</label>--}}
{{--                                        <div class="input-group">--}}
{{--                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>--}}
{{--                                            <input type="text" class="form-control" name="offerPrice" id="offerPrice"--}}
{{--                                                   placeholder="Enter offer price" required--}}
{{--                                                   value="{{old('itemPrice')}}">--}}
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
{{--                                                    value={{$cur->id}}  {{ old('currency') == $cur->id ? "selected" :""}}>{{$cur->currency_name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="mb-3 col-md-6">
                                    <div class="mb-3">
                                        <label class="text-label form-label" for="validationCustomUsername">offer
                                            Photo</label>
                                        <div class="input-group">
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control"
                                                       name="offerPhoto"
                                                       id="offerPhoto" value="{{old('offerPhoto')}}">
                                            </div>
                                            <div class="invalid-feedback">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{--                                <div class="mb-3 col-md-6">--}}
                                {{--                                    <div class="mb-3">--}}
                                {{--                                        <label class="text-label form-label" for="validationCustomUsername">Select--}}
                                {{--                                            Expired offer date</label>--}}
                                {{--                                                                                <select name="mealStatus" id="mealStatus" data-select2-id="single-select"--}}
                                {{--                                                                                        tabindex="-1" class="default-select  form-control wide"--}}
                                {{--                                                                                        value="{{old('mealStatus')}}">--}}
                                {{--                                                                                    <option value="">Choose Status</option>--}}
                                {{--                                                                                    @foreach($item_status as $status)--}}
                                {{--                                                                                        <option value='{{$status->id}}' {{ old('mealStatus') == $status->id ? "selected" :""}}>--}}
                                {{--                                                                                            {{$status->status_name_en}}--}}
                                {{--                                                                                        </option>--}}

                                {{--                                                                                    @endforeach--}}
                                {{--                                        <label class="form-label">Default Material Date Picker</label>--}}
                                {{--                                        <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="text"/>--}}
                                {{--                                                                                </select>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                                <div class="mb-3 col-md-6 form-group"> <!-- Date input -->
                                    <label class="control-label" for="date">Date</label>
                                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY"
                                           type="text"/>
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
    {{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>--}}


    <script>
        $('#sub_category').change(function () {
            update_steps_select();
        });
        $(document).ready(function () {

            var date_input = $('input[name="date"]'); //our date input has the name "date"
            var container = $('.form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
            var options = {
                format: 'mm/dd/yyyy',
                container: container,
                todayHighlight: true,
                autoclose: true,
            };

            // $('#date').datetimepicker();

            date_input.datepicker(options);
        });
        var url = 'get_items_by_cat';

        function update_steps_select(selected_step_id) {
            var category_id = $('#sub_category').val();
            $('#items').html('');
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
                        cat_id: category_id
                    },
                    success: function (data) {
                        if (data.status) {
                            // console.log(data);
                            var options_html = '';
                            var cat_items = data.ret_data;

                            // select = document.getElementById('items');
                            // console.log(cat_items.length);
                            for (var i = 0; i < cat_items.length; i++) {
                                // console.log(cat_items[i].item_name_en);
                                var item_name_en = cat_items[i].item_name_en;
                                var item_id = cat_items[i].id;
                                if (item_id == selected_step_id) {
                                    options_html += '<option value="' + item_id + '" selected="selected" >' + item_name_en + '</option>';
                                } else {
                                    options_html += '<option value="' + item_id + '" >' + item_name_en + '</option>';
                                }

                            }


                            $('#items').html(options_html);

                            $('#items').niceSelect('update');


                        } else {
                            // console.log(data);
                            toastr.error(
                                'no meals in this category',
                                'Notification',
                                {
                                    timeOut: 3000,
                                    fadeOut: 1000,
                                    onHidden: function () {
                                        // window.location.reload();
                                    }
                                }
                            );
                            $('#items').html('');
                            $('#items').niceSelect('update');
                        }
                    }
                });
            }
        }

    </script>


@endsection
