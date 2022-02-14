@extends('layout.mainlayout')
@section('content')
    {{--    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />--}}
    <!-- Bootstrap Date-Picker Plugin -->
    {{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>--}}

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

                        {{--                        <form class="form-wizard order-create sw sw-theme-default sw-justified needs-validation"--}}
                        {{--                              action="{{route('edit-offer',array('offer_id'=>$offer->id))}}" method="post"--}}
                        {{--                              enctype="multipart/form-data" name="edit-offer">--}}
                        {{--                            {{csrf_field()}}--}}
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="profile-news">
                                            <div class="cover-photo rounded">
                                                <img
                                                    src="{{URL::asset('offers/'.$offer->id.'/'.$offer->offer_image)}}"
                                                    alt="Item-image"
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
                                    <label class="text-label form-label" for="validationCustomUsername">Offer
                                        English Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                        <input type="text" class="form-control" name="offerNameEn" id="offerNameEn"
                                               placeholder="Enter Offer English name" required
                                               value="{{$offer->offer_name_en}}" readonly>
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
                                               value="{{$offer->offer_name_ar}}" readonly>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="mb-3 col-md-6">
                                <div class="mb-3">
                                    <label class="text-label form-label"
                                           for="validationCustomUsername">Menu Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                        <input type="text" class="form-control" name="menuName"
                                               id="menuName"
                                               required
                                               value=@foreach($sub_cat_arr as $cat) {{ $item->sub_cat_id  == $cat->id ? $cat->sub_category_name : '' }}@endforeach readonly>
                                        <div class="invalid-feedback">

                                        </div>
                                    </div>
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
                                    <label class="text-label form-label"
                                           for="validationCustomUsername">Mela Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>
                                        <input type="text" class="form-control" name="mealName"
                                               id="mealName"
                                               required
                                               value="{{$item->item_name_en}}" readonly>
                                        <div class="invalid-feedback">

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
                                            <input type="text" class="form-control" name='{{'offerPrice'.$cur->id}}'
                                                   id='{{'offerPrice'.$cur->id}}'
                                                   placeholder="Enter Meal price" required
                                                   value="@if(isset($cur->price)&&$cur->price!=null){{$cur->price}}@endif"
                                                   readonly>
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
                            {{--                                            <span class="input-group-text"> <i class="fa fa-list-alt"></i> </span>--}}
                            {{--                                            <input type="text" class="form-control" name="offerPrice" id="offerPrice"--}}
                            {{--                                                   placeholder="Enter offer price" required--}}
                            {{--                                                   value="{{$offer->price}}">--}}
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
                            {{--                                                    value={{$cur->id}}  {{ $offer->offer_currency == $cur->id ? "selected" :""}}>{{$cur->currency_name}}</option>--}}
                            {{--                                            @endforeach--}}
                            {{--                                        </select>--}}
                            {{--                                    </div>--}}
                            {{--                                </div>--}}


                            <div class="mb-3 col-md-6 form-group"> <!-- Date input -->
                                <label class="control-label" for="date">Date</label>
                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY"
                                       value="{{$offer->expiry_date}}" type="text" readonly/>
                            </div>
                        </div>
                        @if( $acct_type_id== \App\Models\Account::IS_ADMIN && $offer->approve=='')
                            @can('manage-offers')
                                <button class="btn btn-primary me-2 mt-5" style="float: right"
                                        onclick="reject_offer('{{$offer->id}}')"
                                ><span class="me-2"><i
                                            class="fa fa-reply"></i></span>Reject
                                </button>
                                <button class="btn btn-secondary me-2 mt-5" style="float: right"
                                        onclick="approve_offer('{{$offer->id}}')"><span></span>Approve
                                </button>
                            @endcan
                        @endif

                        {{--                        </form>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- end col -->

@endsection

@section('js')

    <script>
        function myFunction() {
            alert('fffff');
        }

        function reject_offer(offer_id) {
            var url = '/reject_offer';

            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    offer_id: offer_id,
                },
                success: function (data) {

                    if (data.status) {
                        location.href = '/show-offers'
                        //
                        // window.location.reload('show-offers');

                    } else {

                        toastr.error(
                            'error in app',
                            'Notification',
                            {
                                timeOut: 2000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.reload();
                                }
                            }
                        );
                    }

                }
            });
        }

        function approve_offer(offer_id) {
            var url = '/approve_offer';
            $.ajax({
                url: url,
                type: "post",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    offer_id: offer_id,
                },
                success: function (data) {

                    if (data.status) {
                        location.href = '/show-offers'
                        //
                        // window.location.reload('show-offers');

                    } else {

                        toastr.error(
                            'error in app',
                            'Notification',
                            {
                                timeOut: 2000,
                                fadeOut: 1000,
                                onHidden: function () {
                                    window.location.reload();
                                }
                            }
                        );
                    }

                }
            });
        }
    </script>

@endsection
